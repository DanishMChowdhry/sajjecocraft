@extends('layouts.app')

@section('title', 'All Enquiries')

@section('content')
<div class="container py-4">
    <h2>All Customer Enquiries</h2>

    @if($groupedEnquiries->isEmpty())
        <div class="alert alert-info">No enquiries found.</div>
    @else
        <div class="accordion" id="adminEnquiryAccordion">
            @foreach($groupedEnquiries as $enquiryId => $items)
                @php $firstItem = $items->first(); @endphp
                <div class="card mb-3">
                    <div class="card-header">
                        <button class="btn btn-link w-100 text-start text-decoration-none" type="button"
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $enquiryId }}" aria-expanded="false"
                            aria-controls="collapse{{ $enquiryId }}">
                            <strong>Enquiry ID:</strong> {{ $enquiryId }}
                            <span class="text-muted">({{ $firstItem->created_at->format('d M Y') }})</span> |
                            <strong>Customer:</strong> {{ $firstItem->user->name ?? 'N/A' }} ({{ $firstItem->user->email ?? 'N/A' }})
                        </button>
                    </div>
                    <div id="collapse{{ $enquiryId }}" class="collapse" data-bs-parent="#adminEnquiryAccordion">
                        <div class="card-body">
                            <table class="table table-bordered">
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
                                    @foreach($items as $item)
                                        <tr>
                                            <td>{{ $item->product_name }}</td>
                                            <td>
                                                @if($item->product_image)
                                                    <img src="{{ asset($item->product_image) }}" width="60">
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

                            <div class="text-end mt-3">
                                <a href="{{ route('enquiries.downloadPdf', $enquiryId) }}" class="btn btn-sm btn-primary">
                                    Download PDF
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
