@extends('layouts.app')
@section('title', 'Create Coupon')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Create Coupon
                        <a href="{{ route('coupons.index') }}" class="btn btn-secondary btn-sm float-end">Back</a>
                    </div>

                    <div class="card-body">
                        @include('partial.alert')

                        <form action="{{ route('coupons.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="code" class="form-label">Coupon Code *</label>
                                <input type="text" name="code" id="code"
                                    class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}"
                                    required>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="discount_amount" class="form-label">Discount Amount *</label>
                                <input type="number" name="discount_amount" id="discount_amount" step="0.01"
                                    min="0" class="form-control @error('discount_amount') is-invalid @enderror"
                                    value="{{ old('discount_amount') }}" required>
                                @error('discount_amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="discount_type" class="form-label">Discount Type *</label>
                                <select name="discount_type" id="discount_type"
                                    class="form-select @error('discount_type') is-invalid @enderror" required>
                                    <option value="">Select Type</option>
                                    <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed
                                        Amount ($)</option>
                                    <option value="percent" {{ old('discount_type') == 'percent' ? 'selected' : '' }}>
                                        Percentage (%)</option>
                                </select>
                                @error('discount_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="expires_at" class="form-label">Expires At</label>
                                <input type="date" name="expires_at" id="expires_at"
                                    class="form-control @error('expires_at') is-invalid @enderror"
                                    value="{{ old('expires_at') }}">
                                @error('expires_at')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Leave empty if coupon never expires.</small>
                            </div>

                            <div class="form-check mb-3">
                                <input type="checkbox" name="is_active" id="is_active" class="form-check-input"
                                    {{ old('is_active', true) ? 'checked' : '' }}>
                                <label for="is_active" class="form-check-label">Active</label>
                            </div>

                            <button type="submit" class="btn btn-success">Create Coupon</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
