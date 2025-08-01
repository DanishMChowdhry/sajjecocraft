    <header id="header" class="header header_sticky header-fullwidth">
        <div class="header-desk header-desk_type_5">
            <div class="logo">
                <a href="{{url('/')}}">
                    <img src="{{ url($site_settings->logo_dark_image) }}" style="width: 150px;height:auto;" alt="Uomo"
                        class="logo__image d-block">
                </a>
            </div><!-- /.logo -->

            <form action="./" method="GET" class="header-search search-field d-none d-xxl-flex">
                <button class="btn header-search__btn" type="submit">
                    <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <use href="#icon_search" />
                    </svg>
                </button>
                <input class="header-search__input w-100" type="text" name="search-keyword"
                    placeholder="Search products...">
                <div class="hover-container position-relative">
                    <div class="js-hover__open">
                        <input class="header-search__category search-field__actor border-0 bg-white w-100"
                            type="text" name="search-category" placeholder="All Category" readonly>
                    </div>
                    <div class="header-search__category-list js-hidden-content mt-2">
                        <ul class="search-suggestion list-unstyled">
                            <li class="search-suggestion__item js-search-select">All Category</li>
                            <li class="search-suggestion__item js-search-select">Men</li>
                            <li class="search-suggestion__item js-search-select">Women</li>
                            <li class="search-suggestion__item js-search-select">Kids</li>
                        </ul>
                    </div>
                </div>
            </form><!-- /.header-search -->

            <nav class="navigation mx-auto mx-xxl-0">
                <ul class="navigation__list list-unstyled d-flex">
                    <li class="navigation__item"><a href="{{ url('/') }}" class="navigation__link">Home</a></li>
                    <li class="navigation__item"><a href="{{ url('shop') }}" class="navigation__link">Shop</a></li>
                    <li class="navigation__item"><a href="{{ url('about_us') }}" class="navigation__link">About us</a>
                    </li>
                    <li class="navigation__item"><a href="{{ url('blogs') }}" class="navigation__link">Blogs</a></li>
                    <li class="navigation__item"><a href="{{ url('contact_us') }}" class="navigation__link">Contact
                            us</a></li>
                </ul><!-- /.navigation__list -->
            </nav><!-- /.navigation -->

            <div class="header-tools d-flex align-items-center">
                <div class="header-tools__item hover-container d-block d-xxl-none">
                    <div class="js-hover__open position-relative">
                        <a class="js-search-popup search-field__actor" href="#">
                            <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_search" />
                            </svg>
                            <i class="btn-icon btn-close-lg"></i>
                        </a>
                    </div>

                    <div class="search-popup js-hidden-content">
                     <form action="{{ route('main_page.search') }}" method="GET" class="search-field container">
    <p class="text-uppercase text-secondary fw-medium mb-4">What are you looking for?</p>

    <div class="position-relative">
        <input
            class="search-field__input search-popup__input w-100 fw-medium"
            type="text"
            name="search"
            placeholder="Search products"
            value="{{ request('search') }}"
            required
        >

        <button class="btn-icon search-popup__submit" type="submit">
            <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                <use href="#icon_search" />
            </svg>
        </button>

        <button class="btn-icon btn-close-lg search-popup__reset" type="reset"></button>
    </div>

    <div class="search-popup__results mt-3">
        @if($categories->count())
            <div class="sub-menu search-suggestion mb-3">
                <h6 class="sub-menu__title fs-base">Quicklinks</h6>
                <ul class="sub-menu__list list-unstyled">
                    @foreach ($categories as $category)
                        <li class="sub-menu__item">
                            <a href="{{ route('main_page.category_products', $category->slug) }}" class="menu-link menu-link_us-s">
                                {{ $category->name }}
                                {{-- <a href="{{ route('main_page.shop_by_category', $category->slug) }}" class="menu-link menu-link_us-s">
                                {{ $category->name }} --}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="search-result row row-cols-5">
            <!-- Optional: Show recent or trending products if needed -->
        </div>
    </div>
</form>

                    </div><!-- /.search-popup -->
                </div><!-- /.header-tools__item hover-container -->

                @guest
                    <div class="header-tools__item hover-container">
                        <a class="header-tools__item" href="{{ route('login') }}">
                            <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_user" />
                            </svg>
                        </a>
                    </div>
                      <a href="{{route('cart.index')}}" class="header-tools__item header-tools__cart"
                        data-aside="cartDrawer">
                        <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_cart" />
                        </svg>
                        <span class="cart-amount d-block position-absolute js-cart-items-count">{{$cartCount}}</span>
                    </a>
                @else
                     <a href="{{route('cart.index')}}" class="header-tools__item header-tools__cart"
                        data-aside="cartDrawer">
                        <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <use href="#icon_cart" />
                        </svg>
                        <span class="cart-amount d-block position-absolute js-cart-items-count">{{$cartCount}}</span>
                    </a>
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown">
                                Welcome, {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
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
                    </ul>
                @endguest
            </div><!-- /.header__tools -->
        </div><!-- /.header-desk header-desk_type_1 -->
    </header>
