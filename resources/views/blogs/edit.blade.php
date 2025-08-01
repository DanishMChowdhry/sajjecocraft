@extends('layouts.app')
@section('head')
    {{-- CKEditor CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
@endsection

@section('title')
   Edit Blog
@endsection
@section('scripts')
<script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
<script>
    CKEDITOR.replace('content', {
        filebrowserUploadUrl: "{{ route('ckeditor.upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
        on: {
            'instanceReady': function (ev) {
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
                    <div class="card-header">{{ __('Edit Blog') }}</div>

                    <div class="card-body">
                        @include('partial.alert')

                        <form action="{{ route('blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" value="{{ $blog->title }}"
                                    name="title">
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea type="text" class="form-control" id="content" name="content"> {{ $blog->content }}</textarea>
                            </div>
                            <div class="row mb-3">
                                <div class="col-10">
                                    <label for="main_image" class="form-label">OpenGraph Image</label>
                                    <input type="file" class="form-control" id="main_image" name="main_image">
                                    <div id="main_image_help" class="form-text">Recommended Size: 450px x 300px</div>
                                </div>
                                <div class="col-2">
                                    <a href="{{ url($blog->main_image) }}" target="_blank"><img id="image_preview"
                                            src="{{ url($blog->main_image) }}" alt="Image Preview"
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
