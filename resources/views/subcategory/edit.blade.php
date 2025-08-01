@extends('layouts.app')

@section('title')
    Edit Subcategory
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create Subcategory') }}</div>

                <div class="card-body">
                    @include('partial.alert')


                   <form action="{{ route('subcategory.update',$subcategory->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" value="{{ $subcategory->name }}" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Name</label>
                       <select name="category_id" id="category_id"  class="form-control">
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}"  {{ $subcategory->category_id == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
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
