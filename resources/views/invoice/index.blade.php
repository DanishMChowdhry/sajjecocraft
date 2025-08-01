@extends('layouts.app')

@section('title')
    Invocies
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Invoices') }}
                    <a href="{{ route('invoices.create') }}" class="btn btn-primary btn-sm float-end">Create</a>
                </div>

                <div class="card-body">
                    @include('partial.alert')

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">Sr.No</th>
                                <th scope="col">Order Id</th>
                                <th scope="col">Client Name</th>
                                <th scope="col">Total</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoices as $item)
                                <tr class="
                                @if ($item->status == 'paid')
                                    table-success  <!-- Green for paid -->
                                @elseif ($item->status == 'cancelled')
                                    table-danger  <!-- Red for cancelled -->
                                @elseif ($item->status == 'pending')
                                    table-light  <!-- Yellow for pending -->
                                @endif
                            ">
                                    <th scope="row">{{ $no++ }}</th>
                                    <td>{{ $item->order_id }}</td>
                                    <td>{{ $item->customer_name }}</td>
                                    <td>Rs. {{ $item->total }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>
                                        <form action="{{ route('generate_invoice_pdf') }}" method="post" style="float: left; margin-right: 5px;">
                                            @csrf
                                            <input type="hidden" name="invoice_id" id="invoice_id" value="{{ $item->id }}">
                                            <button type="submit" class="btn btn-warning btn-sm">PDF</button>
                                        </form>
                                        @if ($item->status == 'paid')
                                            <a href="#" class="btn btn-success btn-sm"><i class="fa-solid fa-check-to-slot"></i>Paid</a>
                                        @else
                                            <a href="#" class="btn btn-success btn-sm">Paid</a>
                                            <a href="#" class="btn btn-danger btn-sm">Cancel</a>
                                        @endif
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
