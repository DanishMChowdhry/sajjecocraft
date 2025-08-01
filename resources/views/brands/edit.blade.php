@extends('layouts.app')

@section('title')
Edit Brand
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Brand') }}</div>

                <div class="card-body">
                    @include('partial.alert')

                    <form action="{{ route('brands.update',$brand->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $brand->name }}" name="name">
                        </div>
                        <div class="row mb-3">
                            <div class="col-10">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <div id="image_help" class="form-text">Recommended Size: 90px x 20px</div>
                            </div>
                            <div class="col-2">
                                <a href="{{ url($brand->image) }}" target="_blank"><img id="image_preview"
                                        src="{{ url($brand->image) }}" alt="Image Preview"
                                        style="width: 100%; height: auto;"></a>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
