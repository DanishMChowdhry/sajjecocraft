<div class="col-10">
    <label for="{{ $x }}" class="form-label">{{ ucfirst($x) }}</label>
    <input type="file" class="form-control" id="{{ $x }}" name="{{ $x }}">
    <div id="{{ $x }}_help" class="form-text">Recommended Size: {{ $size }}</div>
</div>
