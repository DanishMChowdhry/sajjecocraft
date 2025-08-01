@extends('layouts.app')

@section('title')
   Sliders
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Slider') }}
                    <a href="{{ route('slider.create') }}" class="btn btn-primary btn-sm float-end">Create</a>
                </div>

                <div class="card-body">
                    @include('partial.alert')

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Sr.No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Order</th>
                                <th scope="col">Image</th>
                                <th scope="col">CTA</th>
                                <th scope="col">Status</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sliders as $item)
                                <tr>
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->order }}</td>
                                    <td><a href="{{ url($item->image) }}" target="_blank"><img src="{{ url($item->image) }}" alt="{{ $item->title }}"
                                        style="width: 50px;"></a></td>
                                    <td><a href="{{ $item->cta_url }}" target="_blank">{{ $item->cta_label }}</a></td>
                                    <td>{{ ucfirst($item->status) }}</td>

                                    <td>
                                        <a href="{{ route('slider.edit', $item->id) }}" class="btn btn-primary btn-sm" style="float: left; margin-right: 5px;">Edit</a>
                                        <form action="{{ route('slider.destroy', $item->id) }}" method="post">
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
