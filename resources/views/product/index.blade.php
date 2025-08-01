@extends('layouts.app')

@section('title')
    Products
@endsection

@section('head')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<style>
  .dropdown-menu form {
    margin: 0;
  }

  .dropdown-menu button {
    width: 100%;
    text-align: left;
  }
</style>

@endsection

@section('content')
Hello World
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Products') }}
                        <a href="{{ route('product.create') }}" class="btn btn-primary btn-sm" style="float: right;">Add
                            New</a>
                    </div>

                    <div class="card-body">
                        @include('partial.alert')

                        <!-- Search input field -->
                        <div class="mb-3">
                            <label for="product_search" class="form-label">Search Products</label>
                            <input type="text" id="product_search" class="form-control"
                                placeholder="Search by product name...">
                        </div>

                        {{ $product->links('partial.custom_pagination') }}
                        <table class="table table-hover" style="table-layout: fixed; width: 100%;">
                          <thead>
        <tr>
            <th scope="col" style="width: 5%;">Sr.No</th>
            <th scope="col" style="width: 15%;">Name</th>
            <th scope="col" style="width: 12%;">Category</th>
            <th scope="col" style="width: 10%;">Image</th>
            <th scope="col" style="width: 10%;">Price</th>
            <th scope="col" style="width: 10%;">Discount</th>
            <th scope="col" style="width: 8%;">Pinned</th>
            <th scope="col" style="width: 10%;">Stock</th>
            <th scope="col" style="width: 20%;">Action</th>
        </tr>
    </thead>
                            <tbody>
                                @foreach ($product as $item)
                                    <tr class="product-row" data-product-name="{{ strtolower($item->name) }}">
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->category?->name ?? 'No category' }}</td>
                                        <td>
                                            <a href="{{ url($item->main_image) }}" target="_blank"><img
                                                    src="{{ url($item->main_image) }}"
                                                    alt="{{ $item->main_image }}" style="width: 50px; height: 50px;"></a>
                                        </td>
                                        <td>{{ $item->selling_price }}</td>
                                        <td>{{ $item->discounted_rates }}</td>
                                        <td>{{ $item->pinned }}</td>
                                        <td>{{ $item->stock }}</td>
                                        <!-- <td>
                                            <div style="display: flex; align-items: center;">
                                                <a href="{{ route('product.edit', $item->id) }}"
                                                    class="btn btn-primary btn-sm" style="margin-right: 5px;">Edit</a>

                                                <form action="{{ route('product.destroy', $item->id) }}" method="post"
                                                    style="margin-right: 5px;" onsubmit="return confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to delete this?');">Delete</button>
                                                </form>

                                                <form action="{{ url('pdf_generate') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="task" id="task" value="product">
                                                    <input type="hidden" name="product_id" id="product_id"
                                                        value="{{ $item->id }}">
                                                    <button type="submit" class="btn btn-warning btn-sm">PDF</button>
                                                </form>
                                                <a href="{{ route('product.qr.download', $item->slug) }}" class="btn btn-success btn-sm">
                                                    QR Code
                                                </a>
                                            </div>
                                        </td> -->
                                        <td style="vertical-align: middle;">
  <div class="dropdown">
    <button class="btn btn-light btn-sm" type="button" id="dropdownMenuButton{{ $item->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size: 18px; line-height: 1;">
      &#8942; <!-- Unicode for three vertical dots -->
    </button>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton{{ $item->id }}">
      <a class="dropdown-item" href="{{ route('product.edit', $item->id) }}">Edit</a>

      <form action="{{ route('product.destroy', $item->id) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this?');">
        @csrf
        @method('DELETE')
        <button class="dropdown-item text-danger" type="submit">Delete</button>
      </form>

      <form action="{{ url('pdf_generate') }}" method="post">
        @csrf
        <input type="hidden" name="task" value="product">
        <input type="hidden" name="product_id" value="{{ $item->id }}">
        <button type="submit" class="dropdown-item">Generate PDF</button>
      </form>

      <a class="dropdown-item" href="{{ route('product.qr.download', $item->slug) }}">Download QR Code</a>
    </div>
  </div>
</td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // JavaScript function to filter products based on the search input
        document.addEventListener("DOMContentLoaded", function() {
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

        // Function to show confirmation dialog before deleting a product
        function confirmDelete() {
            return confirm("Are you sure you want to delete this product?");
        }
    </script>
@endsection
