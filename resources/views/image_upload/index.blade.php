@extends('layouts.app')

@section('title')
    Image Upload
@endsection

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow-sm">
                <div class="card-header fw-bold">Upload an Image</div>
                <div class="card-body">

                    {{-- Show uploaded image (only for redirect mode) --}}
                    @if (session('image_url'))
                        <div class="alert alert-success">
                            <strong>Uploaded Image:</strong><br>
                            <a href="{{ session('image_url') }}" target="_blank">{{ session('image_url') }}</a><br>
                            <img src="{{ session('image_url') }}" alt="Uploaded Image" class="img-fluid mt-2" style="max-height: 200px;">
                        </div>
                    @endif

                    <form id="uploadForm" action="{{ route('image.upload') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="image" class="form-label">Choose an image to upload</label>
                            <input class="form-control @error('image') is-invalid @enderror" type="file" name="image" id="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="upload_mode" class="form-label">Select Upload Mode</label>
                            <select class="form-select" name="upload_mode" id="upload_mode">
                                <option value="local">Local Redirect</option>
                                <option value="api">API JSON Response</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Upload Image</button>
                    </form>

                    {{-- Output for API response --}}
                    <div id="api-response" class="alert alert-info mt-3 d-none"></div>

                </div>
            </div>

        </div>
    </div>
</div>

<script>
document.getElementById('uploadForm').addEventListener('submit', function(e) {
    const mode = document.getElementById('upload_mode').value;
    if (mode === 'api') {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('{{ route('image.upload') }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const box = document.getElementById('api-response');
            box.classList.remove('d-none');
            box.innerHTML = data.success
                ? `<strong>Uploaded Image:</strong><br><a href="${data.url}" target="_blank">${data.url}</a><br><img src="${data.url}" class="img-fluid mt-2" style="max-height: 200px;">`
                : 'Upload failed.';
        })
        .catch(err => {
            console.error(err);
            alert('Something went wrong');
        });
    }
});
</script>
@endsection
