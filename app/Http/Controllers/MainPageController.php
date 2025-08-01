<?php

namespace App\Http\Controllers;

use App\Models\FAQ;
use App\Models\Blogs;
use App\Models\Visit;
use App\Models\Policy;
use App\Models\Slider;
use App\Models\AboutUs;
use App\Models\Banners;
use App\Models\Product;
use App\Models\Branches;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\ContactRequest;
use Gloudemans\Shoppingcart\Facades\Cart;

class MainPageController extends Controller
{
    public function index()
    {
        $visitorIp = request()->ip();

        // Check if the visitor has already visited today
        $today = now()->toDateString();
        $existingVisit = Visit::whereDate('visited_at', $today)->where('visitor_ip', $visitorIp)->first();

        // If the visitor has not visited today, log the visit
        if (!$existingVisit) {
            Visit::create([
                'visitor_ip' => $visitorIp,
                'visited_at' => now(),
            ]);
        }

        $sliders = Slider::orderBy('order', 'desc')->get();
        $products = Product::where('status', 'active')
            ->orderBy('pinned', 'asc')
            ->where('stock', '>', 0)
            ->orderBy('created_at', 'desc') // Sort pinned products first (assuming 1 = pinned)
            ->take(20)
            ->get();
        $blogs = Blogs::orderBy('created_at', 'desc')->take(10)->get();
        $cartCount = Cart::count();
        return view('main_page.index', compact('sliders', 'products', 'blogs', 'cartCount'));
    }

    public function cart()
    {
        $cartItems = Cart::content();
        $cartCount = Cart::count();
        return view('main_pages.cart', compact('cartItems', 'cartCount'));
    }

    public function shop()
    {
        $products = Product::where('status', '=', 'active')->orderBy('pinned', 'asc')->where('stock', '>', 0)->orderBy('created_at', 'desc')->paginate(40);
        $banner = Banners::find(1);
        $cartCount = Cart::count();

        return view('main_page.shop', compact('products', 'banner', 'cartCount'));
    }

    public function productDetail($slug)
    {
        $product = Product::where('slug', $slug)->first();

        if (!$product) {
            abort(404, 'Product not found');
        }

        $productCategoryId = $product->category_id;
        $productSubCategoryId = $product->subcategory_id;

        $relatedProducts = Product::where('category_id', $productCategoryId)->where('subcategory_id', $productSubCategoryId)->orderBy('pinned', 'asc')->orderBy('created_at', 'desc')->where('stock', '>', 0)->where('id', '!=', $product->id)->get();
        $cartCount = Cart::count();

        return view('main_pages.product_detail', compact('product', 'relatedProducts', 'cartCount'));
    }

    public function about_us()
    {
        $description = AboutUs::find(1)->description;
        $cartCount = Cart::count();

        return view('main_pages.about_us', compact('description', 'cartCount'));
    }

    public function blogs()
    {
        $blogs = Blogs::paginate(12);
        $banner = Banners::find(2);
        $cartCount = Cart::count();

        return view('main_pages.blogs', compact('blogs', 'banner', 'cartCount'));
    }

    public function blogDetails($slug)
    {
        $blog = Blogs::where('slug', $slug)->first();
        if (!$blog) {
            abort(404, 'Blog not found');
        }
        $cartCount = Cart::count();

        return view('main_pages.blog_details', compact('blog', 'cartCount'));
    }

    public function contact_us()
    {
        $branches = Branches::all();
        $cartCount = Cart::count();

        return view('main_pages.contact_us', compact('branches', 'cartCount'));
    }

    public function sendContactRequest(Request $request)
    {
        $contactRequest = new ContactRequest();
        $contactRequest->name = $request->name;
        $contactRequest->email = $request->email;
        $contactRequest->phone = $request->phone;
        $contactRequest->message = $request->message;
        $contactRequest->save();
        return redirect()->back()->with('status', 'Your Contact Request Has Been Submitted Successfully');
    }
    public function faq()
    {
        $faq = FAQ::all();
        $cartCount = Cart::count();

        return view('main_pages.faq', compact('faq', 'cartCount'));
    }

    public function policy($slug)
    {
        $policy = Policy::where('slug', $slug)->first();
        if (!$policy) {
            abort(404, 'Policy not found');
        }
        $cartCount = Cart::count();

        return view('main_pages.policy', compact('policy', 'cartCount'));
    }

    public function categoryProducts($slug)
    {
        $category = Category::where('slug', $slug)->first();
        if (!$category) {
            abort(404, 'Category not found');
        }
        $products = Product::where('category_id', $category->id)->where('status', 'active')->orderBy('pinned', 'asc')->where('stock', '>', 0)->orderBy('created_at', 'desc')->paginate(40);

        $banner = Banners::find(1);
        $cartCount = Cart::count();

        return view('main_pages.category_products', compact('products', 'category', 'banner', 'cartCount'));
    }

    //   public function search(Request $request)
    // {
    //     $searchTerm = $request->input('search');

    //     $banner = Banners::find(1);

    //     // Correct query with grouped where conditions
    //     $products = Product::where(function ($query) use ($searchTerm) {
    //             $query->where('name', 'like', '%' . $searchTerm . '%')
    //                   ->orWhere('description', 'like', '%' . $searchTerm . '%');
    //         })
    //         ->where('status', 'active')
    //         ->where('stock', '>', 0)
    //         ->orderBy('pinned', 'asc')
    //         ->orderBy('created_at', 'desc')
    //         ->paginate(40);

    //     $cartCount = Cart::count();

    //     // Assuming you want to pass categories as well (used in blade)
    //     $categories = Category::all();

    //     return view('main_pages.search_results', compact('products', 'searchTerm', 'banner', 'cartCount', 'categories'));
    // }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
        $categorySlug = $request->input('category'); // optional category filter

        $categories = Category::all();

        $query = Product::query();

        if ($categorySlug) {
            // Find the category by slug
            $category = Category::where('slug', $categorySlug)->first();

            if ($category) {
                // Assuming your Product model has a relation to Category like `category_id`
                $query->where('category_id', $category->id);
            }
        }

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%");
            });
        }

        $products = $query->where('status', 'active')
            ->where('stock', '>', 0)
            ->orderBy('pinned', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(40);

        return view('main_pages.search_results', compact('products', 'categories', 'searchTerm', 'categorySlug'));
    }
}
