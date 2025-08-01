@extends('layouts.app')
@section('title')
     Branch
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Branches') }}
                    <a href="{{ route('branches.create') }}" class="btn btn-primary btn-sm float-end">Create</a>
                </div>

                <div class="card-body">
                    @include('partial.alert')
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col" width="16px;">Sr.No</th>
                                <th scope="col" width="16px;">Title</th>
                                <th scope="col" width="16px;">Email</th>
                                <th scope="col" width="16px;">Phone</th>
                                <th scope="col" width="16px;">Address</th>
                                <th scope="col" width="16px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($branches as $item)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->email_address }}</td>
                                    <td>{{ $item->phone_number }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>
                                        <a href="{{ route('branches.edit', $item->id) }}" class="btn btn-primary btn-sm" style="float: left; margin-right: 5px;">Edit</a>
                                        <form action="{{ route('branches.destroy', $item->id) }}" method="post">
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
