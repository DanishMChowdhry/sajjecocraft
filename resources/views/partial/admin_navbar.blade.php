<ul class="navbar-nav ms-auto">
    <!-- Authentication Links -->
    @guest
        @if (Route::has('login'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </li>
        @endif

        @if (Route::has('register'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
            </li>
        @endif
    @else
        @if (Auth::check() && Auth::user()->role === 'developer')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('developersconcern.index') }}">
                    {{ __('Developer Concern') }}
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                Content Management
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('slider.index') }}">Sliders</a>
                <a class="dropdown-item" href="{{ route('branches.index') }}">Branches</a>
                <a class="dropdown-item" href="{{ route('blogs.index') }}">Blogs</a>
                <a class="dropdown-item" href="{{ route('careers.index') }}">Careers</a>
                <a class="dropdown-item" href="{{ route('faq.index') }}">FAQ</a>
                <a class="dropdown-item" href="{{ route('banners') }}">Banners</a>
                <a class="dropdown-item" href="{{ route('about_us') }}">About Us</a>
                <a class="dropdown-item" href="{{ route('coupons.index') }}">Coupons</a>
                <a class="dropdown-item" href="{{ route('contact_request.index') }}">Contact
                    Request</a>
                <a class="dropdown-item" href="{{ route('site_settings.index') }}">Site Settings</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                User Management
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('customers.index') }}">Customers</a>
                <a class="dropdown-item" href="{{ route('staff.index') }}">Staff</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                Products Management
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                {{-- <a class="dropdown-item" href="{{route('brands.index')}}">Brands</a> --}}
                <a class="dropdown-item" href="{{ route('vendor.index') }}">Vendors</a>
                <a class="dropdown-item" href="{{ route('category.index') }}">Category</a>
                {{-- <a class="dropdown-item" href="{{route('subcategory.index')}}">Subcategory</a> --}}
                <a class="dropdown-item" href="{{ route('product.index') }}">Products</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                Sales
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('invoices.index') }}">Invoice</a>
                <a class="dropdown-item" href="{{ route('enquiry.index') }}">Enquiry</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false" v-pre>
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    {{ __('My Profile') }}
                </a>

                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    @endguest
</ul>
