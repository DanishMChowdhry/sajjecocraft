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
                                    <input type="text" value="{{ time() }}" class="form-control" id="order_id"
                                        name="order_id" readonly>
                                </div>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label for="customer" class="form-label mb-0">Customer</label>
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#addCustomerModal">
                                            + Add New Customer
                                        </button>
                                    </div>
                                    <select name="customer" id="customer" class="form-control mt-1">
                                        @foreach ($customers as $customer)
                                            <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="product_search" class="form-label">Search Products</label>
                                    <input type="text" id="product_search" class="form-control"
                                        placeholder="Search by product name...">
                                </div>

                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%;">Select</th>
                                            <th style="width: 10%;">Unique ID</th>
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
                                                    <input type="checkbox" name="products[{{ $product->id }}][selected]"
                                                        value="1">
                                                </td>
                                                <td style="width: 10%;">{{ $product->unique_id }}</td>
                                                <td style="width: 60%;">{{ $product->name }}</td>
                                                <td style="width: 10%; text-align: center;">Rs.
                                                    {{ $product->discounted_rates }}</td>
                                                <td style="width: 10%; text-align: center;">Rs.
                                                    {{ $product->selling_price }}</td>
                                                <td style="width: 10%; text-align: center;">
                                                    <input type="number" name="products[{{ $product->id }}][quantity]"
                                                        value="1" min="1" class="form-control"
                                                        style="width: 80px;">
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

    <!-- Add Customer Modal -->
    <div class="modal fade" id="addCustomerModal" tabindex="-1" aria-labelledby="addCustomerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="ajaxCustomerForm">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCustomerModalLabel">Add New Customer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="cust_name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="cust_name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="cust_email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="cust_email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="cust_phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="cust_phone" name="phone" required>
                        </div>
                        <div class="mb-3">
                            <label for="cust_address" class="form-label">Address</label>
                            <textarea class="form-control" id="cust_address" name="address" rows="3" required></textarea>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add Customer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#ajaxCustomerForm').submit(function(e) {
                e.preventDefault();

                const formData = {
                    name: $('#cust_name').val(),
                    email: $('#cust_email').val(),
                    phone: $('#cust_phone').val(),
                    address: $('#cust_address').val()
                };

                $.ajax({
                    url: '{{ route('customer_store') }}',
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        console.log('Success:', response);
                        if (response.success) {
                            $('#customer').append(
                                `<option value="${response.data.id}" selected>${response.data.name}</option>`
                            );
                            $('#ajaxCustomerForm')[0].reset();
                            $('#addCustomerModal').modal('hide');
                        } else {
                            alert('Error: ' + JSON.stringify(response.errors || response
                                .message));
                        }
                    },
                    error: function(xhr) {
                        console.error('Error:', xhr.responseJSON);
                        alert('An error occurred: ' + JSON.stringify(xhr.responseJSON));
                    }
                });
            });
        });
    </script>
@endsection
