@extends('layouts.app')


@section('title')
    Edit Category
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Category') }}</div>

                <div class="card-body">
                    @include('partial.alert')


                   <form action="{{ route('category.update',$category->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" value="{{ $category->name }}" id="name" name="name">
                    </div>
                    <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
