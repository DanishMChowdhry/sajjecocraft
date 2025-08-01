@extends('layouts.app')


@section('title')
    Category
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Category') }}
                        <a href="{{ route('category.create') }}" class="btn btn-primary btn-sm float-end">Create</a>
                    </div>

                    <div class="card-body">
                        @include('partial.alert')


                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Sr.No</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $item)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>
                                            <a href="{{ route('category.edit', $item->id) }}" class="btn btn-primary btn-sm" style="float: left; margin-right: 5px;">Edit</a>
                                            <form action="{{ route('category.destroy', $item->id) }}" method="post" style="float: left; margin-right: 5px;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');">Delete</button>
                                            </form>
                                             <form action="{{ route('download_brochure') }}" method="post" style="float: left; margin-right: 5px;">
                                                @csrf
                                               <input type="hidden" name="category_id" id="category_id" value="{{ $item->id }}">
                                                <button type="submit" class="btn btn-warning btn-sm">PDF</button>
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
