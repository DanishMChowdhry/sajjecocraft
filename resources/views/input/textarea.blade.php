<!-- resources/views/input/textarea_edit.blade.php -->

<div class="row mb-3">
    <div class="col-12">
        <label for="{{ $x }}" class="form-label">{{ ucwords(str_replace('_', ' ', $x)) }}</label>
        <textarea class="form-control" id="{{ $x }}" name="{{ $x }}" rows="4">{{ $info->$x  }}</textarea>
    </div>
</div>
