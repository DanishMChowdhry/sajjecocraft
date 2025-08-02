@extends('layouts.app')

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('title')
    Edit Product
@endsection

@section('scripts')
    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            on: {
                'instanceReady': function(ev) {
                    // Hide the version warning by setting the display of the warning box to none
                    var warningBox = ev.editor.container.getChild(0);
                    if (warningBox && warningBox.getChildCount() > 0) {
                        warningBox.getChild(0).setStyle('display', 'none');
                    }
                }
            }
        });
        CKEDITOR.replace('short_description', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            on: {
                'instanceReady': function(ev) {
                    // Hide the version warning by setting the display of the warning box to none
                    var warningBox = ev.editor.container.getChild(0);
                    if (warningBox && warningBox.getChildCount() > 0) {
                        warningBox.getChild(0).setStyle('display', 'none');
                    }
                }
            }
        });
        CKEDITOR.replace('size', {
            filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
            filebrowserUploadMethod: 'form',
            on: {
                'instanceReady': function(ev) {
                    // Hide the version warning by setting the display of the warning box to none
                    var warningBox = ev.editor.container.getChild(0);
                    if (warningBox && warningBox.getChildCount() > 0) {
                        warningBox.getChild(0).setStyle('display', 'none');
                    }
                }
            }
        });
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Upate Product') }}</div>

                    <div class="card-body">
                        @include('partial.alert')

                        <form action="{{ route('product.update', $product->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <!-- Name Field -->
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" value="{{ old('name', $product->name) }}" name="name">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Description Field -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea name="description" id="description" cols="30" rows="10"
                                    class="wysihtml5 form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Short Description Field -->
                            <div class="mb-3">
                                <label for="short_description" class="form-label">Short Description</label>
                                <textarea name="short_description" id="short_description" cols="30" rows="4"
                                    class="form-control @error('short_description') is-invalid @enderror">{{ old('short_description', $product->short_description) }}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- SKU Field -->
                            <div class="mb-3" hidden>
                                <label for="sku" class="form-label">SKU</label>
                                <input disabled type="text" class="form-control @error('sku') is-invalid @enderror"
                                    id="sku" name="sku">
                                @error('sku')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Status Field -->
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status"
                                    class="form-control @error('status') is-invalid @enderror">
                                    <option value="active"
                                        {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="deactive"
                                        {{ old('status', $product->status) == 'deactive' ? 'selected' : '' }}>Deactive
                                    </option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Stock Field -->
                            <div class="mb-3">
                                <label for="stock" class="form-label">Stock</label>
                                <input type="text" class="form-control @error('stock') is-invalid @enderror"
                                    id="stock" value="{{ old('stock', $product->stock) }}" name="stock">
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Category Field -->
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Category</label>
                                <select name="category_id" id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror">
                                    @foreach ($category as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('category_id', $product->category_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Subcategory Field -->
                            <div class="mb-3" hidden>
                                <label for="subcategory_id" class="form-label">Subcategory</label>
                                <select name="subcategory_id" id="subcategory_id"
                                    class="form-control @error('subcategory_id') is-invalid @enderror">
                                    @foreach ($subcategory as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('subcategory_id', $product->subcategory_id) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('subcategory_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Vendor Field -->
                            <div class="mb-3">
                                <label for="vendor" class="form-label">Vendor</label>
                                <select name="vendor" id="vendor"
                                    class="form-control @error('vendor') is-invalid @enderror">
                                    @foreach ($vendor as $item)
                                        <option value="{{ $item->id }}"
                                            {{ old('vendor', $product->vendor) == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('vendor')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Purchase Price Field -->
                            <div class="mb-3">
                                <label for="purchase_price" class="form-label">Purchase Price</label>
                                <input type="text" class="form-control @error('purchase_price') is-invalid @enderror"
                                    id="purchase_price" value="{{ old('purchase_price', $product->purchase_price) }}"
                                    name="purchase_price">
                                @error('purchase_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Selling Price Field -->
                            <div class="mb-3">
                                <label for="selling_price" class="form-label">Selling Price</label>
                                <input type="text" class="form-control @error('selling_price') is-invalid @enderror"
                                    id="selling_price" value="{{ old('selling_price', $product->selling_price) }}"
                                    name="selling_price">
                                @error('selling_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Discounted Rates Field -->
                            <div class="mb-3">
                                <label for="discounted_rates" class="form-label">Discounted Rates</label>
                                <input type="text"
                                    class="form-control @error('discounted_rates') is-invalid @enderror"
                                    id="discounted_rates"
                                    value="{{ old('discounted_rates', $product->discounted_rates) }}"
                                    name="discounted_rates">
                                @error('discounted_rates')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Meta Description Field -->
                            <div class="mb-3">
                                <label for="meta_description" class="form-label">Meta Description</label>
                                <input type="text"
                                    class="form-control @error('meta_description') is-invalid @enderror"
                                    id="meta_description"
                                    value="{{ old('meta_description', $product->meta_description) }}"
                                    name="meta_description">
                                @error('meta_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Meta Keywords Field -->
                            <div class="mb-3">
                                <label for="meta_keywords" class="form-label">Meta Keywords</label>
                                <input type="text" class="form-control @error('meta_keywords') is-invalid @enderror"
                                    id="meta_keywords" value="{{ old('meta_keywords', $product->meta_keywords) }}"
                                    name="meta_keywords">
                                @error('meta_keywords')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="size" class="form-label">Size</label>
                                <textarea type="text" name="size" id="size" class="form-control @error('size') is-invalid @enderror"
                                    value="{{ old('size', $product->size) }}">{{ $product->size }}</textarea>
                                @error('size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="pinned" class="form-label">Pinned</label>
                                <select name="pinned" id="pinned"
                                    class="form-control @error('pinned') is-invalid @enderror">
                                    <option value="active"
                                        {{ old('pinned', $product->pinned) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="deactive"
                                        {{ old('pinned', $product->pinned) == 'deactive' ? 'selected' : '' }}>Deactive
                                    </option>
                                </select>
                                @error('pinned')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- OG Title Field -->
                            <div class="mb-3">
                                <label for="og_title" class="form-label">OG Title</label>
                                <input type="text" class="form-control @error('og_title') is-invalid @enderror"
                                    id="og_title" value="{{ old('og_title', $product->og_title) }}" name="og_title">
                                @error('og_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- OG Description Field -->
                            <div class="mb-3">
                                <label for="og_description" class="form-label">OG Description</label>
                                <input type="text" class="form-control @error('og_description') is-invalid @enderror"
                                    id="og_description" value="{{ old('og_description', $product->og_description) }}"
                                    name="og_description">
                                @error('og_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Twitter Title Field -->
                            <div class="mb-3">
                                <label for="twitter_title" class="form-label">Twitter Title</label>
                                <input type="text" class="form-control @error('twitter_title') is-invalid @enderror"
                                    id="twitter_title" value="{{ old('twitter_title', $product->twitter_title) }}"
                                    name="twitter_title">
                                @error('twitter_title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Twitter Description Field -->
                            <div class="mb-3">
                                <label for="twitter_description" class="form-label">Twitter Description</label>
                                <input type="text"
                                    class="form-control @error('twitter_description') is-invalid @enderror"
                                    id="twitter_description"
                                    value="{{ old('twitter_description', $product->twitter_description) }}"
                                    name="twitter_description">
                                @error('twitter_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="row mb-3">
                                @if ($product->og_image)
                                    <div class="col-10">
                                        <label for="og_image" class="form-label">OpenGraph Image</label>
                                        <input type="file" class="form-control" id="og_image" name="og_image">
                                        <div id="og_image_help" class="form-text">Recommended Size: 1200px x 630px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/og_image') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->og_image) }}" target="_blank"><img id="image_preview"
                                                src="{{ url($product->og_image) }}" alt="Image Preview"
                                                style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('og_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="og_image" class="form-label">OpenGraph Image</label>
                                        <input type="file" class="form-control" id="og_image" name="og_image">
                                        <div id="og_image_help" class="form-text">Recommended Size: 1200px x 630px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/og_image') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    @error('og_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>



                            <div class="row mb-3">
                                @if ($product->twitter_image)
                                    <div class="col-10">
                                        <label for="twitter_image" class="form-label">Twitter Image</label>
                                        <input type="file" class="form-control" id="twitter_image"
                                            name="twitter_image">
                                        <div id="twitter_image_help" class="form-text">Recommended Size: 1200px x 675px
                                            <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/twitter_image') }}">Delete
                                                This Image</a>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->twitter_image) }}" target="_blank"><img
                                                id="image_preview" src="{{ url($product->twitter_image) }}"
                                                alt="Image Preview" style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('twitter_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="twitter_image" class="form-label">Twitter Image</label>
                                        <input type="file" class="form-control" id="twitter_image"
                                            name="twitter_image">
                                        <div id="twitter_image_help" class="form-text">Recommended Size: 1200px x 675px
                                            <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/twitter_image') }}">Delete
                                                This Image</a>
                                        </div>
                                    </div>
                                    @error('twitter_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif

                            </div>

                            <div class="row mb-3">
                                @if ($product->main_image)
                                    <div class="col-10">
                                        <label for="main_image" class="form-label">Main Image</label>
                                        <input type="file" class="form-control" id="main_image" name="main_image">
                                        <div id="main_image_help" class="form-text">Recommended Size: 330px x 400px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/main_image') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->main_image) }}" target="_blank"><img
                                                id="image_preview" src="{{ url($product->main_image) }}"
                                                alt="Image Preview" style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('main_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="main_image" class="form-label">Main Image</label>
                                        <input type="file" class="form-control" id="main_image" name="main_image">
                                        <div id="main_image_help" class="form-text">Recommended Size: 330px x 400px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/main_image') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    @error('main_image')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif

                            </div>
                            <div class="row mb-3">
                                @if ($product->image_1)
                                    <div class="col-10">
                                        <label for="image_1" class="form-label">Image 1</label>
                                        <input type="file" class="form-control" id="image_1" name="image_1">
                                        <div id="image_1_help" class="form-text">Recommended Size: 700px x 700px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/image_1image_1') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->image_1) }}" target="_blank"><img id="image_preview"
                                                src="{{ url($product->image_1) }}" alt="Image Preview"
                                                style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('image_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="image_1" class="form-label">Image 1</label>
                                        <input type="file" class="form-control" id="image_1" name="image_1">
                                        <div id="image_1_help" class="form-text">Recommended Size: 700px x 700px</div>
                                    </div>
                                    @error('image_1')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif

                            </div>

                            <div class="row mb-3">
                                @if ($product->image_2)
                                    <div class="col-10">
                                        <label for="image_2" class="form-label">Image 2</label>
                                        <input type="file" class="form-control" id="image_2" name="image_2">
                                        <div id="image_2_help" class="form-text">Recommended Size: 700px x 700px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/image_2') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->image_2) }}" target="_blank"><img id="image_preview"
                                                src="{{ url($product->image_2) }}" alt="Image Preview"
                                                style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('image_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="image_2" class="form-label">Image 2</label>
                                        <input type="file" class="form-control" id="image_2" name="image_2">
                                        <div id="image_2_help" class="form-text">Recommended Size: 700px x 700px</div>
                                    </div>
                                    @error('image_2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif

                            </div>

                            <div class="row mb-3">
                                @if ($product->image_3)
                                    <div class="col-10">
                                        <label for="image_3" class="form-label">Image 3</label>
                                        <input type="file" class="form-control" id="image_3" name="image_3">
                                        <div id="image_3_help" class="form-text">Recommended Size: 700px x 700px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/image_3') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->image_3) }}" target="_blank"><img id="image_preview"
                                                src="{{ url($product->image_3) }}" alt="Image Preview"
                                                style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('image_3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="image_3" class="form-label">Image 3</label>
                                        <input type="file" class="form-control" id="image_3" name="image_3">
                                        <div id="image_3_help" class="form-text">Recommended Size: 700px x 700px</div>
                                    </div>
                                    @error('image_3')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif

                            </div>

                            <div class="row mb-3">
                                @if ($product->image_4)
                                    <div class="col-10">
                                        <label for="image_4" class="form-label">Image 4</label>
                                        <input type="file" class="form-control" id="image_4" name="image_4">
                                        <div id="image_4_help" class="form-text">Recommended Size: 700px x 700px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/image_4') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->image_4) }}" target="_blank"><img id="image_preview"
                                                src="{{ url($product->image_4) }}" alt="Image Preview"
                                                style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('image_4')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="image_4" class="form-label">Image 4</label>
                                        <input type="file" class="form-control" id="image_4" name="image_4">
                                        <div id="image_4_help" class="form-text">Recommended Size: 700px x 700px</div>
                                    </div>
                                    @error('image_4')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="row mb-3">
                                @if ($product->image_5)
                                    <div class="col-10">
                                        <label for="image_5" class="form-label">Image 5</label>
                                        <input type="file" class="form-control" id="image_5" name="image_5">
                                        <div id="image_5_help" class="form-text">Recommended Size: 700px x 700px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/image_5') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->image_5) }}" target="_blank"><img id="image_preview"
                                                src="{{ url($product->image_5) }}" alt="Image Preview"
                                                style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('image_5')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="image_5" class="form-label">Image 5</label>
                                        <input type="file" class="form-control" id="image_5" name="image_5">
                                        <div id="image_5_help" class="form-text">Recommended Size: 700px x 700px</div>
                                    </div>
                                    @error('image_5')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>


                            <div class="row mb-3">
                                @if ($product->image_6)
                                    <div class="col-10">
                                        <label for="image_6" class="form-label">Image 6</label>
                                        <input type="file" class="form-control" id="image_6" name="image_6">
                                        <div id="image_6_help" class="form-text">Recommended Size: 700px x 700px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/image_6') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->image_6) }}" target="_blank"><img id="image_preview"
                                                src="{{ url($product->image_6) }}" alt="Image Preview"
                                                style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('image_6')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="image_6" class="form-label">Image 6</label>
                                        <input type="file" class="form-control" id="image_6" name="image_6">
                                        <div id="image_6_help" class="form-text">Recommended Size: 700px x 700px</div>
                                    </div>
                                    @error('image_6')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="row mb-3">
                                @if ($product->image_7)
                                    <div class="col-10">
                                        <label for="image_7" class="form-label">Image 7</label>
                                        <input type="file" class="form-control" id="image_7" name="image_7">
                                        <div id="image_7_help" class="form-text">Recommended Size: 700px x 700px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/image_7') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->image_7) }}" target="_blank"><img id="image_preview"
                                                src="{{ url($product->image_7) }}" alt="Image Preview"
                                                style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('image_7')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="image_7" class="form-label">Image 7</label>
                                        <input type="file" class="form-control" id="image_7" name="image_7">
                                        <div id="image_7_help" class="form-text">Recommended Size: 700px x 700px</div>
                                    </div>
                                    @error('image_7')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="row mb-3">
                                @if ($product->image_8)
                                    <div class="col-10">
                                        <label for="image_8" class="form-label">Image 8</label>
                                        <input type="file" class="form-control" id="image_8" name="image_8">
                                        <div id="image_8_help" class="form-text">Recommended Size: 700px x 700px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/image_8') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->image_8) }}" target="_blank"><img id="image_preview"
                                                src="{{ url($product->image_8) }}" alt="Image Preview"
                                                style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('image_8')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="image_8" class="form-label">Image 8</label>
                                        <input type="file" class="form-control" id="image_8" name="image_8">
                                        <div id="image_8_help" class="form-text">Recommended Size: 700px x 700px</div>
                                    </div>
                                    @error('image_8')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="row mb-3">
                                @if ($product->image_9)
                                    <div class="col-10">
                                        <label for="image_9" class="form-label">Image 9</label>
                                        <input type="file" class="form-control" id="image_9" name="image_9">
                                        <div id="image_9_help" class="form-text">Recommended Size: 700px x 700px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/image_9') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->image_9) }}" target="_blank"><img id="image_preview"
                                                src="{{ url($product->image_9) }}" alt="Image Preview"
                                                style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('image_9')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="image_9" class="form-label">Image 9</label>
                                        <input type="file" class="form-control" id="image_9" name="image_9">
                                        <div id="image_9_help" class="form-text">Recommended Size: 700px x 700px</div>
                                    </div>
                                    @error('image_9')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <div class="row mb-3">
                                @if ($product->image_10)
                                    <div class="col-10">
                                        <label for="image_10" class="form-label">Image 10</label>
                                        <input type="file" class="form-control" id="image_10" name="image_10">
                                        <div id="image_10_help" class="form-text">Recommended Size: 700px x 700px <a
                                                href="{{ url('admin/product_delete_image/' . $product->id . '/image_10') }}">Delete
                                                This Image</a></div>
                                    </div>
                                    <div class="col-2">
                                        <a href="{{ url($product->image_10) }}" target="_blank"><img id="image_preview"
                                                src="{{ url($product->image_10) }}" alt="Image Preview"
                                                style="width: 100%; height: auto;"></a>
                                    </div>
                                    @error('image_10')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @else
                                    <div class="col-12">
                                        <label for="image_10" class="form-label">Image 10</label>
                                        <input type="file" class="form-control" id="image_10" name="image_10">
                                        <div id="image_10_help" class="form-text">Recommended Size: 700px x 700px</div>
                                    </div>
                                    @error('image_10')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
