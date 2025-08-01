<?php

namespace App\Http\Controllers;

use App\Models\Blogs;
use App\Models\Visit;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ContactRequest;

class DashboardController extends Controller
{
    public function index()
    {
       $totalVisitors = Visit::distinct('visitor_ip')->count();
        $dailyVisitors = Visit::whereDate('visited_at', now()->toDateString())
            ->distinct('visitor_ip')
            ->count();
            $totalProducts = Product::count();
            $totalVendors = Vendor::count();
            $totalContactRequests = ContactRequest::count();
        $totalBlogs = Blogs::count();
        return view('dashboard.index', compact('totalVisitors', 'dailyVisitors', 'totalProducts', 'totalVendors', 'totalContactRequests','totalBlogs'));
    }
}
