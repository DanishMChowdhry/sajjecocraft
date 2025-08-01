@extends('layouts.app')

@section('title')
     Brands
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Brands') }}
                    <a href="{{ route('brands.create') }}" class="btn btn-primary btn-sm" style="float: right;">Add New</a>
                </div>

                <div class="card-body">
                    @include('partial.alert')

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Sr.No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Image</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $item)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                       <a href="{{ url($item->image) }}" target="_blank">
                                             <img src="{{ url($item->image) }}" alt="{{ $item->name }}" >
                                       </a>
                                    </td>
                                    <td>
                                        <a href="{{ route('brands.edit', $item->id) }}" class="btn btn-primary btn-sm" style="float: left; margin-right: 5px;">Edit</a>
                                        <form action="{{ route('brands.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
