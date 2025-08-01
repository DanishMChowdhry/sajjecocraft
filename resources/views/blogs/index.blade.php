@extends('layouts.app')

@section('title')
   Blogs
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Blogs') }}
                    <a href="{{ route('blogs.create') }}" class="btn btn-primary btn-sm" style="float: right;">Add New</a>
                </div>

                <div class="card-body">
                   @include('partial.alert')

                   <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="10%" scope="col">Sr.No</th>
                            <th width="40%" scope="col">Title</th>
                            <th width="20%" scope="col">Image</th>
                            <th width="10%" scope="col">Date</th>
                            <th width="20%" scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blogs as $item)
                            <tr>
                                <th scope="row">{{ $no++ }}</th>
                                <td>{{ $item->title }}</td>
                                <td>
                                    <a href="{{ url($item->main_image) }}" target="_blank">
                                        <img src="{{ url($item->main_image) }}" alt="" style="width: 100px; height: auto">
                                    </a>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-M-Y') }}</td>
                                <td>
                                    <a href="{{ route('blogs.edit', $item->id) }}" class="btn btn-primary btn-sm" style="float: left; margin-right: 5px;">Edit</a>
                                    <form action="{{ route('blogs.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this?');" >Delete</button>
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
