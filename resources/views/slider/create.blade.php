@extends('layouts.app')

@section('title')
    Create Slider
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Slider') }}</div>

                    <div class="card-body">
                        @include('partial.alert')

                        <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <input type="text" class="form-control" id="description" name="description">
                            </div>
                            <div class="mb-3">
                                <label for="tag" class="form-label">Tag</label>
                                <input type="text" class="form-control" id="tag" name="tag">
                            </div>
                            <div class="mb-3">
                                <label for="cta_label" class="form-label">CTA Label</label>
                                <input type="text" class="form-control" id="cta_label" name="cta_label">
                            </div>
                            <div class="mb-3">
                                <label for="cta_url" class="form-label">CTA Url</label>
                                <input type="text" class="form-control" id="cta_url" name="cta_url">
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <div id="image_help" class="form-text">Recommanded Size: 1880px x 700px</div>
                            </div>
                            <div class="mb-3">
                                <label for="order" class="form-label">Order</label>
                                <input type="text" class="form-control" value="{{ $nextOrder }}" id="order"
                                    name="order">
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="deactive">Deactive</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
