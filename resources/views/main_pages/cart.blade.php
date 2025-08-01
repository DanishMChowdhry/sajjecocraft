@extends('layouts.frontend')

@section('title', 'Cart')

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        @if (session('error'))
            <div class="alert alert-danger">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        @endif

        @if ($cartItems->isEmpty())
            <div class="my-5 text-center">
                <a href="{{ route('main_page.shop') }}">
                    <img src="{{ asset('images/emptycart.png') }}" alt="Empty Cart"
                        style="max-width: 500px; margin-bottom: 20px;">
                </a>
            </div>
        @else
            <section class="shop-checkout container">
                <h2 class="page-title">Cart</h2>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="shopping-cart">
                    <div class="cart-table__wrapper">
                        <table class="cart-table">
                            <thead>
                                <tr>
                                    <th style="text-align: center" width="15%">Product</th>
                                    <th style="text-align: left">Details</th>
                                    <th style="text-align: center" width="10%">Price</th>
                                    <th style="text-align: center" width="10%">Quantity</th>
                                    <th style="text-align: center" width="10%">Subtotal</th>
                                    <th style="text-align: center" width="5%"></th>
                                </tr>
                            </thead>
                            <tbody id="cart-body">
                                @foreach ($cartItems as $item)
                                    <tr data-row-id="{{ $item->rowId }}">
                                        <td style="text-align: center">
                                            <div class="shopping-cart__product-item">
                                                <a href="#"><img src="{{ $item->options->image }}" width="120"
                                                        height="120" alt="{{ $item->name }}"></a>
                                            </div>
                                        </td>
                                        <td style="text-align: left">
                                            <div class="shopping-cart__product-item__detail">
                                                <h4><a href="#">{{ $item->name }}</a></h4>
                                                <ul class="shopping-cart__product-item__options">
                                                    <li>Category: {{ $item->options['category']['name'] ?? '' }}</li>
                                                    <li>Size: L</li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td style="text-align: center">
                                            <span class="shopping-cart__product-price">Rs.
                                                {{ number_format($item->price, 2) }}</span>
                                        </td>
                                        <td style="text-align: center">
                                            <div class="qty-control position-relative">
                                                <span class="qty-control__reduce"
                                                    style="padding: 0 10px; cursor: pointer;">−</span>
                                                <input type="number" name="qty" value="{{ $item->qty }}"
                                                    min="1" class="qty-control__number text-center"
                                                    data-row-id="{{ $item->rowId }}">
                                                <span class="qty-control__increase"
                                                    style="padding: 0 10px; cursor: pointer;">+</span>
                                            </div>
                                        </td>
                                        <td style="text-align: center" class="item-subtotal">
                                            <span class="shopping-cart__subtotal">Rs.
                                                {{ number_format($item->subtotal, 2) }}</span>
                                        </td>
                                        <td style="text-align: center">
                                            <button class="remove-cart" data-row-id="{{ $item->rowId }}"
                                                style="background:none;border:none; cursor:pointer;"
                                                aria-label="Remove item from cart">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676"
                                                    xmlns="http://www.w3.org/2000/svg" role="img" aria-hidden="true"
                                                    focusable="false">
                                                    <path d="M0.259 8.855L9.114 0l0.886 0.886L1.145 9.741 0.259 8.855Z" />
                                                    <path d="M0.886 0.089l8.855 8.855-0.886 0.885L0 0.974 0.886 0.089Z" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{--
<div class="shopping-cart__totals-wrapper">
<div class="sticky-content">
<div class="mobile_fixed-btn_wrapper">
<div class="button-wrapper container">
<form action="{{ route('submit.enquiry') }}" method="POST">
@csrf
<button type="submit" class="btn btn-primary btn-checkout">Submit Enquiry</button>
</form>
</div>
</div>
</div>
</div> --}}
                <!-- Modal Trigger Button (can be on Cart page or Checkout button) -->
                <button type="button" class="btn btn-primary btn-checkout" style="margin:20px;" data-bs-toggle="modal"
                    data-bs-target="#checkoutModal">
                    GET QUOTE
                </button>
            </section>
        @endif
    </main>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Complete Your Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <form action="{{ route('invoices.fromCart') }}" method="POST">
                            @csrf
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control" placeholder="Full name *"
                                    required>
                                <label>Full name *</label>
                            </div>
                            <button type="submit" class="btn btn-primary float-end">Generate Quote</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Update item quantity
            async function updateQty(input) {
                let qty = parseInt(input.value) || 1;
                const rowId = input.dataset.rowId;

                const formData = new FormData();
                formData.append('qty', qty);

                try {
                    const response = await fetch(`/cart/update/${rowId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json'
                        },
                        body: formData
                    });

                    const contentType = response.headers.get('content-type') || '';

                    if (!response.ok || !contentType.includes('application/json')) {
                        const html = await response.text();
                        throw new Error(`Unexpected response:\n${html.slice(0, 300)}`);
                    }

                    const data = await response.json();

                    if (data.success) {
                        const row = input.closest('tr');
                        row.querySelector('.item-subtotal span').textContent =
                            `Rs. ${parseFloat(data.subtotal).toFixed(2)}`;
                    } else if (data.error) {
                        alert(data.error);
                    }
                } catch (err) {
                    console.error('Cart update failed:', err);
                    alert(`Cart update failed:\n${err.message}`);
                }
            }

            // Quantity controls
            document.querySelectorAll('.qty-control').forEach(control => {
                const input = control.querySelector('.qty-control__number');

                control.querySelector('.qty-control__increase')?.addEventListener('click', () => {
                    input.value = parseInt(input.value || 1);
                    updateQty(input);
                });

                control.querySelector('.qty-control__reduce')?.addEventListener('click', () => {
                    input.value = Math.max(1, parseInt(input.value || 1));
                    updateQty(input);
                });

                let debounceTimeout;
                input.addEventListener('keyup', () => {
                    clearTimeout(debounceTimeout);
                    debounceTimeout = setTimeout(() => {
                        updateQty(input);
                    }, 600);
                });
            });

            // Remove item from cart
            document.querySelectorAll('.remove-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const rowId = this.dataset.rowId;

                    fetch(`/cart/remove/${rowId}`, {
                            method: 'GET',
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest',
                                'Accept': 'application/json'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                this.closest('tr').remove();
                            } else {
                                alert(data.error || 'Failed to remove item.');
                            }
                        })
                        .catch(error => {
                            console.error('Remove failed:', error);
                            alert('Failed to remove item.');
                        });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action="{{ route('invoices.fromCart') }}"]');
            const modalElement = document.getElementById('checkoutModal');
            const modal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);

            form.addEventListener('submit', function(e) {
                e.preventDefault(); // prevent normal form submission

                const formData = new FormData(form);

                fetch(form.action, {
                        method: form.method,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': formData.get('_token')
                        },
                        body: formData
                    })
                    .then(async response => {
                        if (!response.ok) {
                            // Try to extract error message from JSON or text response
                            let errorMessage = 'Network response was not ok';
                            try {
                                const contentType = response.headers.get('content-type');
                                if (contentType && contentType.indexOf('application/json') !== -1) {
                                    const errorData = await response.json();
                                    errorMessage = errorData.message || JSON.stringify(errorData);
                                } else {
                                    errorMessage = await response.text();
                                }
                            } catch (e) {
                                // parsing failed, fallback to default error message
                            }
                            throw new Error(errorMessage);
                        }
                        return response.blob(); // expecting PDF file blob
                    })
                    .then(blob => {
                        // Create a download link for the PDF
                        const url = window.URL.createObjectURL(blob);
                        const a = document.createElement('a');
                        a.href = url;
                        a.download = 'invoice.pdf'; // you can customize the filename here
                        document.body.appendChild(a);
                        a.click();
                        a.remove();
                        window.URL.revokeObjectURL(url);

                        // Hide modal and refresh page after successful download
                        modal.hide();
                        location.reload();
                    })
                    .catch(error => {
                        alert('Error generating invoice: ' + error.message);
                    });
            });
        });
    </script>



@endsection
