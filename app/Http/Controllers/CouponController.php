<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    // Show all coupons
    public function index()
    {
        $coupons = Coupon::orderBy('created_at', 'desc')->paginate(10);
        return view('coupons.index', compact('coupons'));
    }

    // Show form to create coupon
    public function create()
    {
        return view('coupons.create');
    }

    // Store new coupon
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'discount_amount' => 'required|numeric|min:0',
            'discount_type' => 'required|in:fixed,percent',
            'expires_at' => 'nullable|date|after_or_equal:today',
        ]);

        Coupon::create([
            'code' => strtoupper($request->code),
            'discount_amount' => $request->discount_amount,
            'discount_type' => $request->discount_type,
            'expires_at' => $request->expires_at,
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        return redirect()->route('coupons.index')->with('success', 'Coupon created successfully!');
    }

    // Apply coupon to a cart total
    // Assume $request->code and $request->cart_total are provided
    public function apply(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'cart_total' => 'required|numeric|min:0',
        ]);

        $coupon = Coupon::where('code', strtoupper($request->code))->first();

        if (!$coupon) {
            return response()->json(['success' => false, 'message' => 'Invalid coupon code.']);
        }

        if (!$coupon->is_active) {
            return response()->json(['success' => false, 'message' => 'This coupon is inactive.']);
        }

        if ($coupon->expires_at && Carbon::now()->gt($coupon->expires_at)) {
            return response()->json(['success' => false, 'message' => 'This coupon has expired.']);
        }

        $cartTotal = $request->cart_total;
        $discount = 0;

        if ($coupon->discount_type === 'fixed') {
            $discount = min($coupon->discount_amount, $cartTotal);
        } elseif ($coupon->discount_type === 'percent') {
            $discount = ($coupon->discount_amount / 100) * $cartTotal;
        }

        $newTotal = max($cartTotal - $discount, 0);

        return response()->json([
            'success' => true,
            'message' => 'Coupon applied successfully!',
            'discount' => round($discount, 2),
            'new_total' => round($newTotal, 2),
        ]);
    }
}