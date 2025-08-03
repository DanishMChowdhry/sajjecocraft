<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FAQController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CkeditorController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImageUploadController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\ContactRequestController;
use App\Http\Controllers\DevelopersConcernController;
use App\Http\Controllers\CouponController;

Route::controller(MainPageController::class )
    ->middleware(['developersconcern'])
    ->group(function () {
        Route::get('/', 'index')->name('main_page.index');
        Route::get('shop', 'shop')->name('main_page.shop');
        Route::get('about_us', 'about_us')->name('main_page.about_us');
        Route::get('blogs', 'blogs')->name('main_page.blogs');
        Route::get('blogs/{slug}', 'blogDetails')->name('main_page.blog');
        Route::get('contact_us', 'contact_us')->name('main_page.contact');
        Route::get('shop/{slug
           }', 'productDetail')->name('main_page.product_detail');
        Route::get('faq', 'faq')->name('main_page.faq');
        Route::get('policy/{slug}', 'policy')->name('main_page.policy');
        Route::get('shop/category/{slug}', 'categoryProducts')->name('main_page.category_products');
        Route::post('shop/search', 'search')->name('main_page.search');
        Route::post('contact_us', 'sendContactRequest')->name('main_page.send_contact_request');
        Route::get('/image-upload', [ImageUploadController::class, 'index'])->name('image.upload.index');
        Route::post('/upload-image', [ImageUploadController::class, 'upload'])->name('image.upload');
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
        Route::post('/cart/update/{rowId}', [CartController::class, 'update'])->name('cart.update');
        Route::get('/cart/remove/{rowId}', [CartController::class, 'remove'])->name('cart.remove');
        Route::get('/cart/destroy', [CartController::class, 'destroy'])->name('cart.destroy');
        Route::post('/submit-enquiry', [CartController::class, 'submitCustomerEnquiry'])->name('submit.enquiry');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/invoice/download/{enquiry_id}', [OrderController::class, 'generateFromEnquiry'])->name('invoice.download');
        Route::post('/guest-checkout', [OrderController::class, 'generateFromEnquiry'])->name('guest.checkout');
        Route::post('/invoices/from-cart', [InvoiceController::class, 'storeFromCartAndGeneratePDF'])->name('invoices.fromCart');
        
        Route::get('/invoice/{order_id}', [InvoiceController::class, 'downloadInvoice']);

        Route::post('invoices/whatsapp_share',[InvoiceController::class,'shareInvoiceOnWhatsapp'])->name('share_invoice_on_whatsapp');

    });

Auth::routes();

Route::prefix('admin')
    ->middleware(['auth', 'developersconcern', 'checkRole'])
    ->group(function () {
        Route::resource('enquiry', EnquiryController::class);
        Route::resource('developersconcern', DevelopersConcernController::class);
        Route::resource('category', CategoryController::class);
        Route::resource('subcategory', SubcategoryController::class);
        Route::resource('vendor', VendorController::class);
        Route::resource('product', ProductController::class);
        Route::resource('brands', BrandController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('staff', StaffController::class);
        Route::resource('slider', SliderController::class);
        Route::resource('branches', BranchController::class);
        Route::resource('blogs', BlogController::class);
        Route::resource('careers', CareerController::class);
        Route::resource('faq', FAQController::class);
        Route::resource('policy', PolicyController::class);
        Route::resource('contact_request', ContactRequestController::class);
        Route::resource('site_settings', SiteSettingsController::class);
        Route::resource('invoices', InvoiceController::class);

        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('banners', [BannerController::class, 'index'])->name('banners');

        Route::post('update_about_banner', [BannerController::class, 'updateAbout'])->name('update_about_banner');
        Route::post('update_blog_banner', [BannerController::class, 'updateBlog'])->name('update_blog_banner');

        Route::get('about_us', [AboutUsController::class, 'index'])->name('about_us');
        Route::post('update_about_us', [AboutUsController::class, 'store'])->name('update_about_us');
        Route::post('download_brochure', [ProductController::class, 'downloadBrochure'])->name('download_brochure');

        Route::post('ckeditor/upload', [CkeditorController::class, 'upload'])->name('ckeditor.upload');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

        Route::post('generate_invoice_pdf', [InvoiceController::class, 'generateInvoicePDF'])->name('generate_invoice_pdf');
        Route::get('/enquiries/{enquiryId}/download-pdf', [EnquiryController::class, 'downloadPdf'])->name('enquiries.downloadPdf');
        Route::resource('coupons', CouponController::class);
        Route::get('/customers/export', [CustomerController::class, 'export'])->name('customers.export');

    });

Route::prefix('admin')
    ->middleware(['auth', 'checkRole'])
    ->group(function () {
        Route::resource('developersconcern', DevelopersConcernController::class);
    });
Route::get('/product/{slug}/qr-code', function ($slug) {
    $url = "https://sajjecocraft.com/shop/{$slug}";

    $qr = QrCode::format('png')->size(300)->generate($url);

    return response($qr)
        ->header('Content-Type', 'image/png')
        ->header('Content-Disposition', 'attachment; filename="qr-' . $slug . '.png"');
})->name('product.qr.download');