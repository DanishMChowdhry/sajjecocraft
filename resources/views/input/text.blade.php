<div class="mb-3">
    <label for="{{ $x }}" class="form-label">{{ ucwords(str_replace('_', ' ', $x)) }}</label>
    <input type="text" class="form-control" id="{{ $x }}"
        value="{{ $info->$x }}" name="{{ $x }}">
</div>


