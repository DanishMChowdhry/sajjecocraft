@extends('layouts.app')

@section('title')
    Customers
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- <div class="card-header">{{ __('Customers') }}
                    <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm float-end">Create</a>
                </div> --}}

                    <div class="card-body">
                        @include('partial.alert')

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%">Sr.No</th>
                                    <th scope="col" width="20%">Name</th>
                                    <th scope="col" width="10%">Phone</th>
                                    <th scope="col" width="10%">Email</th>
                                    <th scope="col" width="30%">Address</th>
                                    <th scope="col" width="20%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $item)
                                    <tr>
                                        <th scope="row">{{ $no++ }}</th>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->phone }}</td>
                                        <td>{{ $item->email }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td>
                                            <a href="{{ route('customers.edit', $item->id) }}"
                                                class="btn btn-primary btn-sm"
                                                style="float: left; margin-right: 5px;">Edit</a>
                                            <form action="{{ route('customers.destroy', $item->id) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this?');">Delete</button>
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
