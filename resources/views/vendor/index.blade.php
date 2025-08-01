@extends('layouts.app')

@section('title')
    Vendors
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Vendor') }}
                    <a href="{{ route('vendor.create') }}" class="btn btn-primary btn-sm float-end">Create</a>
                </div>

                <div class="card-body">
                    @include('partial.alert')

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
            <th style="width: 25%;">Name</th>
            <th style="width: 15%;">Phone</th>
            <th style="width: 25%;">Email</th>
            <th style="width: 15%;">Total Charges (₹)</th>
            <th style="width: 15%;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendor as $item)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->phone }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ number_format($item->total_charges, 2) }}</td>
                                    <td>
                                        <a href="{{ route('vendor.edit', $item->id) }}" class="btn btn-primary btn-sm" style="float: left; margin-right: 5px;">Edit</a>
                                        <form action="{{ route('vendor.destroy', $item->id) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" >Delete</button>
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
