@extends('layouts.app')

@section('title')
Edit Vendor
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Vendor') }}</div>

                <div class="card-body">
                    @include('partial.alert')

                    <form action="{{ route('vendor.update',$vendor->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" value="{{ $vendor->name }}" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $vendor->email }}" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" value="{{ $vendor->phone }}" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="parking_charges" class="form-label">Parking Charges</label>
                            <input type="number" class="form-control" id="parking_charges" value="{{$vendor->parking_charges}}" name="parking_charges">
                        </div>
                        <div class="mb-3">
                            <label for="operational_charges" class="form-label">Operational Charges</label>
                            <input type="number" class="form-control" id="operational_charges" value="{{$vendor->operational_charges}}" name="operational_charges">
                        </div>
                        <div class="mb-3">
                            <label for="transport" class="form-label">Transport</label>
                            <input type="number" class="form-control" id="transport" value="{{$vendor->transport}}" name="transport">
                        </div>
                        <div class="mb-3">
                            <label for="dead_stock" class="form-label">Dead Stock</label>
                            <input type="number" class="form-control" id="dead_stock" value="{{$vendor->dead_stock}}" name="dead_stock">
                        </div>
                        <div class="mb-3">
                            <label for="branding" class="form-label">Branding</label>
                            <input type="number" class="form-control" id="branding" value="{{$vendor->branding}}" name="branding">
                        </div>
                        <div class="mb-3">
                            <label for="damage_and_shrinkege" class="form-label">Damage And Shrinkege</label>
                            <input type="number" class="form-control" id="damage_and_shrinkege" value="{{$vendor->damage_and_shrinkege}}" name="damage_and_shrinkege">
                        </div>
                        <div class="mb-3">
                            <label for="profit" class="form-label">Profit</label>
                            <input type="number" class="form-control" id="profit" value="{{$vendor->profit}}" name="profit">
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" cols="30" rows="3" class="form-control">{{ $vendor->address }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="company_name" class="form-label">Company Name</label>
                            <input type="text" class="form-control" id="company_name" value="{{ $vendor->company_name }}" name="company_name">
                        </div>
                        <div class="mb-3">
                            <label for="company_website" class="form-label">Company Website</label>
                            <input type="text" class="form-control" id="company_website" value="{{ $vendor->company_website }}" name="company_website">
                        </div>
                        <div class="mb-3">
                            <label for="account_holder_name" class="form-label">Account Holder Name</label>
                            <input type="text" class="form-control" id="account_holder_name" value="{{ $vendor->account_holder_name }}"
                                name="account_holder_name">
                        </div>
                        <div class="mb-3">
                            <label for="bank_name" class="form-label">Bank Name</label>
                            <input type="text" class="form-control" id="bank_name" value="{{ $vendor->bank_name }}" name="bank_name">
                        </div>
                        <div class="mb-3">
                            <label for="account_number" class="form-label">Account Number</label>
                            <input type="text" class="form-control" id="account_number" value="{{ $vendor->account_number }}" name="account_number">
                        </div>

                        <div class="mb-3">
                            <label for="ifsc_code" class="form-label">IFSC</label>
                            <input type="text" class="form-control" id="ifsc_code" value="{{ $vendor->ifsc_code }}" name="ifsc_code">
                        </div>

                        <div class="mb-3">
                            <label for="bank_address" class="form-label">Bank Address</label>
                            <input type="text" class="form-control" id="bank_address" value="{{ $vendor->bank_address }}" name="bank_address">
                        </div>

                        <div class="mb-3">
                            <label for="account_type" class="form-label">Account Type</label>
                            <select name="account_type" id="account_type" class="form-control">
                                <option value="current" {{ $vendor->account_type == 'current' ? 'selected' : '' }}>Current</option>
                                <option value="savings" {{ $vendor->account_type == 'savings' ? 'selected' : '' }}>Savings</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection