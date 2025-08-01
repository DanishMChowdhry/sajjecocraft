@extends('layouts.app')

@section('title')
    Create Subcategory
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Subcategory') }}</div>

                <div class="card-body">
                    @include('partial.alert')

                   <form action="{{ route('subcategory.store') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Name</label>
                       <select name="category_id" id="category_id"  class="form-control">
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach
                       </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
