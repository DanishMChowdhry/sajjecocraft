@extends('layouts.app')

@section('title')
    Contact Requests
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Customers') }}
                    <a href="{{ route('customers.create') }}" class="btn btn-primary btn-sm float-end">Create</a>
                </div>

                <div class="card-body">
                    @include('partial.alert')

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th style="width: 5%;">#</th>
                                <th style="width: 20%;">Request</th>
                            </tr>
                        </thead>
                        <tbody>
                             @foreach ($contactRequest as $item)
                                    <tr
                                        class="contact-row"
                                        style="cursor: pointer;"
                                        data-bs-toggle="modal"
                                        data-bs-target="#contactModal"
                                        data-name="{{ $item->name }}"
                                        data-phone="{{ $item->phone }}"
                                        data-email="{{ $item->email }}"
                                        data-message="{{ $item->message }}"
                                    >
                                        <td>{{ $loop->iteration }}</td>
                                      <td>
                                       <b>Name:</b> {{ $item->name }}<br>
                                        <b>Phone:</b>  {{ $item->phone }}<br>
                                        <b>Email: </b> {{ $item->email }}<br>
                                        <b>Message: </b> {{ $item->message}}<br>
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

<!-- Modal for contact details -->
<div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content shadow-sm">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="contactModalLabel">Contact Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div class="mb-3"><strong>Name:</strong> <span id="modalName"></span></div>
                <div class="mb-3"><strong>Phone:</strong> <span id="modalPhone"></span></div>
                <div class="mb-3"><strong>Email:</strong> <span id="modalEmail"></span></div>
                <div><strong>Message:</strong></div>
                <div id="modalMessage" class="bg-light p-3 rounded mt-2" style="white-space: pre-wrap; word-wrap: break-word;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const rows = document.querySelectorAll('.contact-row');
        rows.forEach(row => {
            row.addEventListener('click', () => {
                document.getElementById('modalName').textContent = row.dataset.name;
                document.getElementById('modalPhone').textContent = row.dataset.phone;
                document.getElementById('modalEmail').textContent = row.dataset.email;
                document.getElementById('modalMessage').textContent = row.dataset.message;
            });
        });
    });
</script>
@endsection
