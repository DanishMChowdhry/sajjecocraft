@extends('layouts.app')

@section('title')
   Site Settings
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Site Settings') }}</div>

                    <div class="card-body">
                        @include('partial.alert')

                        <form action="{{ route('site_settings.update', 1) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @include('input.text', ['x' => 'title'])
                            @include('input.text', ['x' => 'phone_number'])
                            @include('input.text', ['x' => 'email_address'])
                            @include('input.image_edit', [
                                'x' => 'logo_light_image',
                                'size' => '1200px x 630px',
                                'url' => $info->logo_light_image,
                            ])
                            @include('input.image_edit', [
                                'x' => 'logo_dark_image',
                                'size' => '1200px x 630px',
                                'url' => $info->logo_dark_image,
                            ])
                            @include('input.image_edit', [
                                'x' => 'favicon_image',
                                'size' => '1200px x 630px',
                                'url' => $info->favicon_image,
                            ])

                            @include('input.textarea', ['x' => 'address'])
                            @include('input.textarea', ['x' => 'description'])
                            @include('input.text', ['x' => 'facebook'])
                            @include('input.text', ['x' => 'youtube'])
                            @include('input.text', ['x' => 'linkedin'])
                            @include('input.text', ['x' => 'instagram'])
                            @include('input.text', ['x' => 'meta_description'])
                            @include('input.text', ['x' => 'meta_keywords'])
                            @include('input.text', ['x' => 'meta_author'])
                            @include('input.text', ['x' => 'canonical_url'])
                            @include('input.text', ['x' => 'og_title'])
                            @include('input.textarea', ['x' => 'og_description'])
                            @include('input.image_edit', [
                                'x' => 'og_image',
                                'size' => '1200px x 630px',
                                'url' => $info->og_image,
                                ])
                            @include('input.text', ['x' => 'og_url'])
                            @include('input.text', ['x' => 'og_type'])
                            @include('input.text', ['x' => 'og_site_name'])
                            @include('input.text', ['x' => 'twitter_card'])
                            @include('input.text', ['x' => 'twitter_title'])
                            @include('input.text', ['x' => 'twitter_description'])
                            @include('input.image_edit', [
                                'x' => 'twitter_image',
                                'size' => '1200px x 630px',
                                'url' => $info->twitter_image,
                                ])
                            @include('input.text', ['x' => 'twitter_url'])
                            @include('input.text', ['x' => 'twitter_site'])
                            @include('input.text', ['x' => 'twitter_creator'])
                            @include('input.text', ['x' => 'latitude'])
                            @include('input.text', ['x' => 'longitude'])
                            @include('input.text', ['x' => 'map_link'])
                            @include('input.text', ['x' => 'gst'])
                            @include('input.text', ['x' => 'account_holder_name'])
                            @include('input.text', ['x' => 'bank_name'])
                            @include('input.text', ['x' => 'account_number'])
                            @include('input.text', ['x' => 'ifsc_code'])
                            @include('input.text', ['x' => 'bank_address'])
                            @include('input.text', ['x' => 'account_type'])
                            @include('input.text', ['x' => 'upi_id'])
                            @include('input.text', ['x' => 'upi_number'])
                            @include('input.image_edit', [
                                'x' => 'upi_qr_code_image',
                                'size' => '1200px x 630px',
                                'url' => $info->upi_qr_code_image,
                                ])

                                <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- <div class="row mb-3">
    <div class="col-10">
        <label for="og_image" class="form-label">OpenGraph Image</label>
        <input type="file" class="form-control" id="og_image" name="og_image">
        <div id="og_image_help" class="form-text">Recommended Size: 1200px x 630px</div>
    </div>
    <div class="col-2">
        <a href="#" target="_blank"><img id="image_preview"
                src="#" alt="Image Preview"
                style="width: 100%; height: auto;"></a>
    </div>
</div>
<div class="mb-3">
    <label for="twitter_title" class="form-label">Twitter Title</label>
    <input type="text" class="form-control" id="twitter_title"
        value="" name="twitter_title">
</div> --}}
