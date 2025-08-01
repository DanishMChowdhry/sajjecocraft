<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $query = Product::query();

        // Search functionality
        if ($request->has('search') && $request->input('search') !== '') {
            $searchTerm = $request->input('search');
            $query->where('name', 'like', '%' . $searchTerm . '%')->orWhere('category_id', 'like', '%' . $searchTerm . '%');
        }

        // Retrieve paginated products
        $products = $query->paginate(10); // Adjust the pagination as needed

        // Pass products and categories to the view
        $category = Category::all();
        return view('product.index', compact('products', 'category'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::orderBy('pinned', 'asc')->orderBy('created_at', 'desc')->paginate(100);
        $category = Category::all();
        $subcategory = Subcategory::all();
        return view('product.index', compact('product', 'category', 'subcategory'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $subcategory = Subcategory::all();
        $vendor = Vendor::all();
        return view('product.create', compact('category', 'subcategory', 'vendor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'slug' => 'nullable|string|unique:products,slug',
            'sku' => 'nullable|string|unique:products,sku',
            'status' => 'nullable|string|max:50',
            'stock' => 'nullable|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            // 'subcategory_id' => 'nullable|exists:subcategories,id',
            'vendor' => 'nullable|string',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'discounted_rates' => 'nullable|numeric|min:0', // Assuming a percentage rate
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable',
            'twitter_title' => 'nullable|string',
            'twitter_description' => 'nullable|string',
            'twitter_image' => 'nullable',
        ]);
        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->slug = Str::slug($request->input('name'));
        $product->sku = $request->sku;
        $product->status = $request->status;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        // $product->subcategory_id = 'NA';
        $product->vendor = $request->vendor;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;
        $product->discounted_rates = $request->discounted_rates;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->og_title = $request->og_title;
        $product->og_description = $request->og_description;
        $product->twitter_title = $request->twitter_title;
        $product->twitter_description = $request->twitter_description;
        $product->size = $request->size;
        $product->pinned = $request->pinned;

        if ($request->hasFile('main_image')) {
            $main_image_path = ImageHelper::uploadImage($request->file('main_image'), 'images/main_image');
            $product->main_image = $main_image_path;
        }
        if ($request->hasFile('image_1')) {
            $image_1_path = ImageHelper::uploadImage($request->file('image_1'), 'images/image_1');
            $product->image_1 = $image_1_path;
        }
        if ($request->hasFile('image_2')) {
            $image_2_path = ImageHelper::uploadImage($request->file('image_2'), 'images/image_2');
            $product->image_2 = $image_2_path;
        }
        if ($request->hasFile('image_3')) {
            $image_3_path = ImageHelper::uploadImage($request->file('image_3'), 'images/image_3');
            $product->image_3 = $image_3_path;
        }
        if ($request->hasFile('image_4')) {
            $image_4_path = ImageHelper::uploadImage($request->file('image_4'), 'images/image_4');
            $product->image_4 = $image_4_path;
        }
        if ($request->hasFile('image_5')) {
            $image_5_path = ImageHelper::uploadImage($request->file('image_5'), 'images/image_5');
            $product->image_5 = $image_5_path;
        }
        if ($request->hasFile('image_6')) {
            $image_6_path = ImageHelper::uploadImage($request->file('image_6'), 'images/image_6');
            $product->image_6 = $image_6_path;
        }
        if ($request->hasFile('image_7')) {
            $image_7_path = ImageHelper::uploadImage($request->file('image_7'), 'images/image_7');
            $product->image_7 = $image_7_path;
        }
        if ($request->hasFile('image_8')) {
            $image_8_path = ImageHelper::uploadImage($request->file('image_8'), 'images/image_8');
            $product->image_8 = $image_8_path;
        }
        if ($request->hasFile('image_9')) {
            $image_9_path = ImageHelper::uploadImage($request->file('image_9'), 'images/image_9');
            $product->image_9 = $image_9_path;
        }
        if ($request->hasFile('image_10')) {
            $image_10_path = ImageHelper::uploadImage($request->file('image_10'), 'images/image_10');
            $product->image_10 = $image_10_path;
        }
        if ($request->hasFile('og_image')) {
            $og_image_path = ImageHelper::uploadImage($request->file('og_image'), 'images/og_image');
            $product->og_image = $og_image_path;
        }
        if ($request->hasFile('twitter_image')) {
            $twitter_image_path = ImageHelper::uploadImage($request->file('twitter_image'), 'images/twitter_image');
            $product->twitter_image = $twitter_image_path;
        }

        $product->save();

        return redirect()->route('product.index')->with('status', 'Product added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $category = Category::all();
        $subcategory = Subcategory::all();
        $vendor = Vendor::all();
        return view('product.edit', compact('product', 'category', 'subcategory', 'vendor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product = Product::find($id);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'slug' => 'nullable|string|unique:products,slug',
            'status' => 'nullable|string|max:50',
            'stock' => 'nullable|integer|min:0',
            'category_id' => 'nullable|exists:categories,id',
            // 'subcategory_id' => 'nullable|exists:subcategories,id',
            'vendor' => 'nullable|string',
            'purchase_price' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'discounted_rates' => 'nullable|numeric|min:0', // Assuming a percentage rate
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_1' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_2' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_3' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_4' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'image_5' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'og_title' => 'nullable|string',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable',
            'twitter_title' => 'nullable|string',
            'twitter_description' => 'nullable|string',
            'twitter_image' => 'nullable',
        ]);

        $product->name = $request->name;
        $product->description = $request->description;
        $product->short_description = $request->short_description;
        $product->slug = Str::slug($request->input('name'));
        $product->status = $request->status;
        $product->stock = $request->stock;
        $product->category_id = $request->category_id;
        // $product->subcategory_id = "NA";
        $product->vendor = $request->vendor;
        $product->purchase_price = $request->purchase_price;
        $product->selling_price = $request->selling_price;
        $product->discounted_rates = $request->discounted_rates;
        $product->meta_description = $request->meta_description;
        $product->meta_keywords = $request->meta_keywords;
        $product->og_title = $request->og_title;
        $product->og_description = $request->og_description;
        $product->twitter_title = $request->twitter_title;
        $product->twitter_description = $request->twitter_description;
        $product->size = $request->size;
        $product->pinned = $request->pinned;
        if ($request->hasFile('main_image')) {
            $main_image_path = ImageHelper::uploadImage($request->file('main_image'), 'images/main_image');
            $product->main_image = $main_image_path;
        }
        if ($request->hasFile('image_1')) {
            $image_1_path = ImageHelper::uploadImage($request->file('image_1'), 'images/image_1');
            $product->image_1 = $image_1_path;
        }
        if ($request->hasFile('image_2')) {
            $image_2_path = ImageHelper::uploadImage($request->file('image_2'), 'images/image_2');
            $product->image_2 = $image_2_path;
        }
        if ($request->hasFile('image_3')) {
            $image_3_path = ImageHelper::uploadImage($request->file('image_3'), 'images/image_3');
            $product->image_3 = $image_3_path;
        }
        if ($request->hasFile('image_4')) {
            $image_4_path = ImageHelper::uploadImage($request->file('image_4'), 'images/image_4');
            $product->image_4 = $image_4_path;
        }
        if ($request->hasFile('image_5')) {
            $image_5_path = ImageHelper::uploadImage($request->file('image_5'), 'images/image_5');
            $product->image_5 = $image_5_path;
        }
        if ($request->hasFile('image_6')) {
            $image_6_path = ImageHelper::uploadImage($request->file('image_6'), 'images/image_6');
            $product->image_6 = $image_6_path;
        }
        if ($request->hasFile('image_7')) {
            $image_7_path = ImageHelper::uploadImage($request->file('image_7'), 'images/image_7');
            $product->image_7 = $image_7_path;
        }
        if ($request->hasFile('image_8')) {
            $image_8_path = ImageHelper::uploadImage($request->file('image_8'), 'images/image_8');
            $product->image_8 = $image_8_path;
        }
        if ($request->hasFile('image_9')) {
            $image_9_path = ImageHelper::uploadImage($request->file('image_9'), 'images/image_9');
            $product->image_9 = $image_9_path;
        }
        if ($request->hasFile('image_10')) {
            $image_10_path = ImageHelper::uploadImage($request->file('image_10'), 'images/image_10');
            $product->image_10 = $image_10_path;
        }

        if ($request->hasFile('og_image')) {
            $og_image_path = ImageHelper::uploadImage($request->file('og_image'), 'images/og_image');
            $product->og_image = $og_image_path;
        }
        if ($request->hasFile('twitter_image')) {
            $twitter_image_path = ImageHelper::uploadImage($request->file('twitter_image'), 'images/twitter_image');
            $product->twitter_image = $twitter_image_path;
        }

        $product->save();

        return redirect()->route('product.index')->with('status', 'Product upated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('product.index')->with('status', 'Product deleted successfully');
    }

    public function deleteImage($id, $type)
    {
        // Find the product by ID
        $product = Product::find($id);

        // Check if product exists
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found');
        }

        // Switch based on the image type
        switch ($type) {
            case 'main_image':
                $product->main_image = null;
                break;
            case 'image_1':
                $product->image_1 = null;
                break;
            case 'image_2':
                $product->image_2 = null;
                break;
            case 'image_3':
                $product->image_3 = null;
                break;
            case 'image_4':
                $product->image_4 = null;
                break;
            case 'image_5':
                $product->image_5 = null;
                break;
            case 'image_6':
                $product->image_6 = null;
                break;
            case 'image_7':
                $product->image_7 = null;
                break;
            case 'image_8':
                $product->image_8 = null;
                break;
            case 'image_9':
                $product->image_9 = null;
                break;
            case 'image_10':
                $product->image_10 = null;
                break;
            case 'og_image':
                $product->og_image = null;
                break;
            case 'twitter_image':
                $product->twitter_image = null;
                break;
            default:
                return redirect()->back()->with('error', 'Invalid image type');
        }

        // Save the changes
        $product->save();

        // Return a success message
        return redirect()->back()->with('status', 'Image deleted successfully');
    }

    public function downloadBrochure(Request $request)
    {
        $category_id = $request->input('category_id');

        // Check if 'category_id' is provided and is valid
        if (empty($category_id) || $category_id === 'All') {
            // Fetch all products
            $products = Product::all();
            $category = 'SajjEcoCraft';
        } else {
            // Fetch products based on the specific category_id
            $products = Product::where('category_id', $category_id)->get();
            $category = Category::find($category_id)->name;
        }

        // Count the number of products
        $productCount = $products->count();

        // You can check if the category name is empty or invalid and provide a fallback name
        $filename = $category . '_Brochure.pdf';

        // Load the view and generate the PDF
        // $pdf = Pdf::loadView('pdf.brochure', compact('products', 'category'));
        $pdf = Pdf::loadView('pdf.brochure', compact('products', 'category'))
            ->setOptions(['defaultFont' => 'DejaVu Sans']);

        // Download the generated PDF with the dynamically set filename
        return $pdf->download($filename);
    }
}