@extends('layouts.app')

@section('head')
    {{-- CKEditor CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('title')
    Create Product
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script>
        ['description', 'short_description', 'size'].forEach(function(id) {
            CKEDITOR.replace(id, {
                filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
                filebrowserUploadMethod: 'form',
                on: {
                    'instanceReady': function(ev) {
                        var warningBox = ev.editor.container.getChild(0);
                        if (warningBox && warningBox.getChildCount() > 0) {
                            warningBox.getChild(0).setStyle('display', 'none');
                        }
                    }
                }
            });
        });

        // Vendor Charges Script
        const vendorData = @json($vendor);

        document.addEventListener('DOMContentLoaded', function() {
            const vendorSelect = document.getElementById('vendor');
            const container = document.getElementById('vendor-charges-container');
            const chargeFields = [
                'parking_charges',
                'operational_charges',
                'transport',
                'dead_stock',
                'branding',
                'damage_and_shrinkege',
                'profit'
            ];

            vendorSelect.addEventListener('change', function() {
                const vendorId = parseInt(this.value);
                const vendor = vendorData.find(v => v.id === vendorId);

                if (vendor) {
                    let total = 0;

                    chargeFields.forEach(field => {
                        const val = parseFloat(vendor[field]) || 0;
                        document.getElementById(field).value = val.toFixed(2);
                        total += val;
                    });

                    document.getElementById('total_vendor_charges').value = total.toFixed(2);
                    container.style.display = 'block';
                } else {
                    container.style.display = 'none';
                }
            });
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('Create Product') }}</div>

                    <div class="card-body">
                        @include('partial.alert')

                        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Name --}}
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" name="name" id="name"
                                    class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Description --}}
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" rows="5"
                                    class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Short Description --}}
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Short Description</label>
                                <textarea name="short_description" id="short_description" rows="3"
                                    class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description') }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- SKU --}}
                            <div class="mb-3" hidden>
                                <label for="sku" class="form-label">SKU</label>
                                <input type="text" name="sku" id="sku"
                                    class="form-control @error('sku') is-invalid @enderror">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Status --}}
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status"
                                    class="form-control @error('status') is-invalid @enderror">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                    </option>
                                    <option value="deactive" {{ old('status') == 'deactive' ? 'selected' : '' }}>Deactive
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Stock --}}
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="text" name="stock" id="stock"
                                    class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Category --}}
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Subcategory (Hidden) --}}
                            <div class="mb-3" hidden>
                                <label for="subcategory_id" class="form-label">Subcategory</label>
                                <select name="subcategory_id" id="subcategory_id"
                                    class="form-control @error('subcategory_id') is-invalid @enderror">
                                    @foreach ($subcategory as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('subcategory_id') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Vendor --}}
                            <div class="mb-3">
                                <label for="vendor" class="form-label">Vendor</label>
                                <select name="vendor" id="vendor"
                                    class="form-control @error('vendor') is-invalid @enderror">
                                    <option value="">Select Vendor</option>
                                    @foreach ($vendor as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('vendor') == $item->id ? 'selected' : '' }}>{{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('vendor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Vendor Charges (Auto-Calculated) --}}
                            <div id="vendor-charges-container" style="display: none;"
                                class="mb-3 border p-3 rounded bg-light">
                                <h6 class="mb-3">Vendor Charges Breakdown</h6>

                                @php
                                    $fields = [
                                        'parking_charges',
                                        'operational_charges',
                                        'transport',
                                        'dead_stock',
                                        'branding',
                                        'damage_and_shrinkege',
                                        'profit',
                                    ];
                                @endphp

                                @foreach ($fields as $field)
                                    <div class="mb-2">
                                        <label
                                            class="form-label text-capitalize">{{ ucwords(str_replace('_', ' ', $field)) }}</label>
                                        <input type="text" id="{{ $field }}" class="form-control vendor-charge"
                                            readonly>
                                    </div>
                                @endforeach

                                <div class="mt-3">
                                    <label class="form-label fw-bold">Total Vendor Charges</label>
                                    <input type="text" name="total_vendor_charges" id="total_vendor_charges"
                                        class="form-control" readonly>
                                </div>
                            </div>

                            {{-- Prices --}}
                            <div class="mb-3">
                                <label for="purchase_price" class="form-label">Purchase Price</label>
                                <input type="text" name="purchase_price" id="purchase_price"
                                    class="form-control @error('purchase_price') is-invalid @enderror"
                                    value="{{ old('purchase_price') }}">
                                @error('purchase_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="selling_price" class="form-label">Selling Price</label>
                                <input type="text" name="selling_price" id="selling_price"
                                    class="form-control @error('selling_price') is-invalid @enderror"
                                    value="{{ old('selling_price') }}">
                                @error('selling_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="discounted_rates" class="form-label">Discounted Price</label>
                                <input type="text" name="discounted_rates" id="discounted_rates"
                                    class="form-control @error('discounted_rates') is-invalid @enderror"
                                    value="{{ old('discounted_rates') }}">
                                @error('discounted_rates')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Size --}}
                            <div class="mb-3">
                                <label for="size" class="form-label">Size</label>
                                <textarea name="size" id="size" class="form-control @error('size') is-invalid @enderror">{{ old('size') }}</textarea>
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Meta and OG/Twitter Tags (unchanged) --}}
                            {{-- Add the rest of your existing fields here (OG, Meta, Twitter, Images, etc.) --}}

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
