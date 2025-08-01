@extends('layouts.app')

@section('title')
    Dashboard
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">{{ __('Total Visitors') }}</div>

                    <div class="card-body">
                        <h1>{{ $totalVisitors }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">Today's Visitors</div>

                    <div class="card-body">
                        <h1>{{ $dailyVisitors }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">Total Products</div>

                    <div class="card-body">
                        <h1>{{ $totalProducts }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">Total Vendors</div>

                    <div class="card-body">
                        <h1>{{ $totalVendors }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">{{ __('Total Contact Request') }}</div>

                    <div class="card-body">
                        <h1>{{ $totalContactRequests }}</h1>
                    </div>
                </div>
            </div>
            <div class="col-md-2">
                <div class="card">
                    <div class="card-header">{{ __('Total Blogs') }}</div>

                    <div class="card-body">
                        <h1>{{ $totalBlogs }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
