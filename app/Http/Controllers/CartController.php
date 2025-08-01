<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CustomerEnquiry;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = Cart::content();
        $cartCount = Cart::count();
        return view('main_pages.cart', compact('cartItems', 'cartCount'));
    }

    // ➕ Add item to cart
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        Cart::add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => '1',
            'price' => $product->discounted_rates,
            'weight' => 0,
            'options' => [
                'image' => $product->main_image ?? null,
                'selling_price' => $product->selling_price ?? null,
                'category' => $product->category ?? null,
            ],
        ]);

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    // 🔁 Update quantity
    // public function update(Request $request, $rowId)
    // {
    //     Cart::update($rowId, $request->input('qty'));

    //     if ($request->ajax()) {
    //         return response()->json(['success' => true, 'message' => 'Quantity updated']);
    //     }

    //     return redirect()->route('cart.index')->with('success', 'Cart updated!');
    // }

    public function update(Request $request, $rowId)
    {
        $qty = $request->input('qty');

        if (!is_numeric($qty) || $qty < 1) {
            return response()->json(['error' => 'Invalid quantity'], 400);
        }

        \Cart::update($rowId, $qty);

        $item = \Cart::get($rowId);

        return response()->json([
            'success' => true,
            'subtotal' => $item->subtotal,
        ]);
    }

    public function remove(Request $request, $rowId)
    {
        Cart::remove($rowId);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Item removed']);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }

    // 🧹 Clear entire cart
    public function destroy()
    {
        Cart::destroy();

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }


    public function submitCustomerEnquiry(Request $request)
    {
        $cartItems = Cart::content();

        if ($cartItems->isEmpty()) {
            return back()->with('error', 'Your cart is empty.');
        }

        $customerId = auth()->check() ? auth()->id() : null;
        $user = $customerId ? User::find($customerId) : null;

        // Validate guest fields only if user is not logged in
        if (!$user) {
            $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string|max:500',
            ]);
        }

        $enquiryId = time(); // Unique ID to group enquiry rows

        try {
            foreach ($cartItems as $item) {
                $enquiry = new CustomerEnquiry();

                $enquiry->customer_id = $customerId ?? 0;
                $enquiry->enquiry_id = $enquiryId;
                $enquiry->product_id = $item->id;
                $enquiry->product_name = $item->name;
                $enquiry->product_image = $item->options->image ?? null;
                $enquiry->price = $item->price;
                $enquiry->quantity = $item->qty;
                $enquiry->subtotal = $item->price * $item->qty;

                if (!$user) {
                    $enquiry->guest_name = $request->input('name');
                    $enquiry->guest_phone = $request->input('phone');
                    $enquiry->guest_address = $request->input('address');
                }

                $enquiry->save();
            }

            Cart::destroy();

            return redirect()->route('orders.index')->with('success', 'Enquiry submitted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong. Please try again. ' . $e->getMessage());
        }
    }

}