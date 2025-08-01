@extends('layouts.app')

@section('title')
    Create Invoice
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Create Invoice') }}</div>

                    <div class="card-body">
                        @include('partial.alert')
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="container">
                            <form action="{{ route('invoices.store') }}" method="POST">
                                @csrf

                                <div class="mb-3">
                                    <label for="order_id" class="form-label">Order Id</label>
                                    <input type="text" value="{{ time() }}" class="form-control" id="order_id" name="order_id" readonly>
                                </div>
                                <div class="mb-3">
                                    <label for="customer" class="form-label">Customer</label>
                                    <select name="customer" id="customer" class="form-control">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Search input for filtering products -->
                                <div class="mb-3">
                                    <label for="product_search" class="form-label">Search Products</label>
                                    <input type="text" id="product_search" class="form-control" placeholder="Search by product name...">
                                </div>

                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">Select</th>
                                            <th style="width: 60%;">Product Name</th>
                                            <th style="width: 10%;">Price</th>
                                            <th style="width: 10%;">Offer Price</th>
                                            <th style="width: 10%;">Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody id="product_table_body">
                                        @foreach ($products as $product)
                                            <tr class="product-row" data-product-name="{{ strtolower($product->name) }}">
                                                <td style="width: 10%; text-align: center;">
                                                    <input type="checkbox" name="products[{{ $product->id }}][selected]" value="1">
                                                </td>
                                                <td style="width: 70%;">{{ $product->name }}</td>
                                                <td style="width: 10%; text-align: center;">Rs. {{ $product->discounted_rates }}</td>
                                                <td style="width: 10%; text-align: center;">Rs. {{ $product->selling_price }}</td>
                                                <td style="width: 10%; text-align: center;">
                                                    <input type="number" name="products[{{ $product->id }}][quantity]" value="1" min="1" class="form-control" style="width: 80px;">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-primary">Create Invoice</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript function to filter products based on the search input
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById('product_search');
            const rows = document.querySelectorAll('.product-row');

            searchInput.addEventListener('input', function() {
                const searchQuery = this.value.toLowerCase();

                rows.forEach(function(row) {
                    const productName = row.getAttribute('data-product-name');
                    if (productName.includes(searchQuery)) {
                        row.style.display = ''; // Show row if product name matches search query
                    } else {
                        row.style.display = 'none'; // Hide row if product name does not match
                    }
                });
            });
        });
    </script>
@endsection
