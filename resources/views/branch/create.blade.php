@extends('layouts.app')

@section('title')
    Create Branch
@endsection

@section('head')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                    <div class="card-header">{{ __('Create Branch') }}</div>

                    <div class="card-body">
                        @include('partial.alert')

                        <form action="{{ route('branches.store') }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title') }}">
                            </div>
                            <div class="mb-3">
                                <label for="email_address" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email_address" name="email_address"
                                    value="{{ old('email_address') }}">
                            </div>
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    value="{{ old('phone_number') }}">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address">{{ old('address') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
