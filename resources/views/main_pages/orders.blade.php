@extends('layouts.frontend')

@section('title', 'Orders')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Your Orders</h2>

    @if($orders->isEmpty())
        <div class="alert alert-info">You have not submitted any enquiries yet.</div>
    @else
        <div class="accordion" id="orderAccordion">
            @foreach($orders as $index => $order)
                <div class="card mb-3">
                    <div class="card-header d-flex justify-content-between align-items-center">
    <button class="btn btn-link text-start w-100 text-decoration-none" type="button"
        data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="false"
        aria-controls="collapse{{ $index }}">
        <strong>Enquiry ID:</strong> {{ $order->enquiry_id }} &nbsp;
        <small class="text-muted">({{ $order->first()->created_at->format('d M Y') }})</small>
    </button>

    <a href="{{ route('invoice.download', ['enquiry_id' => $order->enquiry_id]) }}"
        class="btn btn-sm btn-outline-primary ms-3" target="_blank">
        <i class="bi bi-download"></i> PDF
    </a>
</div>
                    <div id="collapse{{ $index }}" class="collapse" data-bs-parent="#orderAccordion">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Product</th>
                                            <th>Image</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order->items as $item)
                                            <tr>
                                                <td>{{ $item->product_name }}</td>
                                                <td>
                                                    @if($item->product_image)
                                                        <img src="{{ asset($item->product_image) }}" alt="Image" width="60">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $item->quantity }}</td>
                                                <td>₹{{ number_format($item->price, 2) }}</td>
                                                <td>₹{{ number_format($item->subtotal, 2) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
