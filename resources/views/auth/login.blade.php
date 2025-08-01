@extends('layouts.frontend')

@section('title', 'Authentication')

@section('head')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection

@section('content')
    <main>
        <div class="mb-4 pb-4"></div>
        <section class="login-register container">
            <h2 class="d-none">Login</h2>

            <ul class="nav nav-tabs mb-5" id="login_register" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore @if (!old('name')) active @endif" id="login-tab"
                        data-bs-toggle="tab" href="#tab-item-login" role="tab" aria-controls="tab-item-login"
                        aria-selected="{{ !old('name') ? 'true' : 'false' }}">Login</a>
                </li>
                {{-- <li class="nav-item" role="presentation">
                    <a class="nav-link nav-link_underscore @if (old('name')) active @endif"
                        id="register-tab" data-bs-toggle="tab" href="#tab-item-register" role="tab"
                        aria-controls="tab-item-register" aria-selected="{{ old('name') ? 'true' : 'false' }}">Register</a>
                </li> --}}
            </ul>

            <div class="tab-content pt-2" id="login_register_tab_content">
                {{-- LOGIN FORM --}}
                <div class="tab-pane fade @if (!old('name')) show active @endif" id="tab-item-login"
                    role="tabpanel" aria-labelledby="login-tab">
                    <div class="login-form">
                        <form method="POST" action="{{ route('login') }}" class="needs-validation">
                            @csrf

                            {{-- Email --}}
                            <div class="form-floating mb-3">
                                <input type="email" name="email" id="login_email"
                                    class="form-control form-control_gray @error('email') is-invalid @enderror"
                                    placeholder="Email address *" value="{{ old('email') }}" required>
                                <label for="login_email">Email address *</label>
                                @error('email')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="form-floating mb-3 position-relative">
                                <input type="password" name="password" id="login_password"
                                    class="form-control form-control_gray @error('password') is-invalid @enderror"
                                    placeholder="Password *" required>
                                <label for="login_password">Password *</label>
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                    style="cursor: pointer;"
                                    onclick="togglePassword('login_password', 'togglePasswordIconLogin')">
                                    <i class="fa fa-eye" id="togglePasswordIconLogin"></i>
                                </span>
                                @error('password')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            {{-- Remember Me --}}
                            {{-- <div class="d-flex align-items-center mb-3 pb-2">
                                <div class="form-check mb-0">
                                    <input type="checkbox" class="form-check-input form-check-input_fill" id="remember"
                                        name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label text-secondary" for="remember">Remember me</label>
                                </div>
                                <a href="{{ route('password.request') }}" class="btn-text ms-auto">Lost password?</a>
                            </div> --}}

                            <button type="submit" class="btn btn-primary w-100 text-uppercase" style="margin-bottom:50px;">Log In</button>

                            {{-- <div class="customer-option mt-4 text-center">
                                <span class="text-secondary">No account yet?</span>
                                <a href="#register-tab" class="btn-text" data-bs-toggle="tab">Create Account</a>
                            </div> --}}
                        </form>
                    </div>
                </div>

                {{-- REGISTER FORM --}}
                <div class="tab-pane fade @if (old('name')) show active @endif" id="tab-item-register"
                    role="tabpanel" aria-labelledby="register-tab">
                    <div class="register-form">
                        <form method="POST" action="{{ route('register') }}" class="needs-validation">
                            @csrf

                            {{-- Name --}}
                            <div class="form-floating mb-3">
                                <input type="text" name="name" id="register_name"
                                    class="form-control form-control_gray @error('name') is-invalid @enderror"
                                    placeholder="Username" value="{{ old('name') }}" required>
                                <label for="register_name">Username</label>
                                @error('name')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-floating mb-3">
                                <input type="email" name="email" id="register_email"
                                    class="form-control form-control_gray @error('email') is-invalid @enderror"
                                    placeholder="Email address" value="{{ old('email') }}" required>
                                <label for="register_email">Email address *</label>
                                @error('email')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            {{-- Phone --}}
                            <div class="form-floating mb-3">
                                <input type="text" name="phone" id="phone"
                                    class="form-control form-control_gray @error('phone') is-invalid @enderror"
                                    placeholder="Phone Number" value="{{ old('phone') }}" required>
                                <label for="phone">Phone Number</label>
                                @error('phone')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            {{-- Address --}}
                            <div class="form-floating mb-3">
                                <input type="text" name="address" id="address"
                                    class="form-control form-control_gray @error('address') is-invalid @enderror"
                                    placeholder="Address" value="{{ old('address') }}" required>
                                <label for="address">Address</label>
                                @error('address')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="form-floating mb-3 position-relative">
                                <input type="password" name="password" id="register_password"
                                    class="form-control form-control_gray @error('password') is-invalid @enderror"
                                    placeholder="Password" required>
                                <label for="register_password">Password *</label>
                                <span class="position-absolute top-50 end-0 translate-middle-y me-3"
                                    style="cursor: pointer;"
                                    onclick="togglePassword('register_password', 'togglePasswordIconRegister')">
                                    <i class="fa fa-eye" id="togglePasswordIconRegister"></i>
                                </span>
                                @error('password')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            {{-- Confirm Password --}}
                            <div class="form-floating mb-3">
                                <input type="password" name="password_confirmation" id="register_password_confirm"
                                    class="form-control form-control_gray" placeholder="Confirm Password" required>
                                <label for="register_password_confirm">Confirm Password *</label>
                            </div>

                            {{-- Privacy Note --}}
                            <div class="mb-3">
                                <p class="small text-muted">
                                    Your personal data will be used to support your experience throughout this website,
                                    to manage access to your account, and for other purposes described in our privacy
                                    policy.
                                </p>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 text-uppercase">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Password Toggle Script --}}
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection
