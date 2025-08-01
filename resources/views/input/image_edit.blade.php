<div class="row mb-3">
    <div class="col-10">
        <label for="{{ $x }}" class="form-label">{{ ucwords(str_replace('_', ' ', $x)) }} </label>
        <input type="file" class="form-control" id="{{ $x }}" name="{{ $x }}">
        <div id="{{ $x }}_help" class="form-text">Recommended Size: {{ $size }}</div>
    </div>
    <div class="col-2">
        <a href="#" target="_blank">
            <!-- Ensure $url is a string URL -->
            <img id="image_preview" src="{{ is_string($url) ? url($url) : '#' }}" alt="Image Preview" style="width: 100%; height: auto;">
        </a>
    </div>
</div>
