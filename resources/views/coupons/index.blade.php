@extends('layouts.app')
@section('title', 'Coupons')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        {{ __('Coupons') }}
                        <a href="{{ route('coupons.create') }}" class="btn btn-primary btn-sm float-end">Create</a>
                    </div>

                    <div class="card-body">
                        @include('partial.alert')

                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Code</th>
                                    <th>Discount</th>
                                    <th>Type</th>
                                    <th>Expires At</th>
                                    <th>Active</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($coupons as $index => $coupon)
                                    <tr>
                                        <td>{{ ($coupons->currentPage() - 1) * $coupons->perPage() + $index + 1 }}</td>
                                        <td>{{ $coupon->code }}</td>
                                        <td>
                                            @if ($coupon->discount_type === 'percent')
                                                {{ $coupon->discount_amount }} %
                                            @else
                                                Rs. {{ number_format($coupon->discount_amount, 2) }}
                                            @endif
                                        </td>
                                        <td>{{ ucfirst($coupon->discount_type) }}</td>
                                        <td>{{ $coupon->expires_at ? $coupon->expires_at->format('Y-m-d') : 'Never' }}</td>
                                        <td>{{ $coupon->is_active ? 'Yes' : 'No' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No coupons found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        <div class="mt-3">
                            {{ $coupons->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
