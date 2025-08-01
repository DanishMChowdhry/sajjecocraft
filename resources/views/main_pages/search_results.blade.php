@extends('layouts.frontend')

@section('title', 'Shop')

@section('content')
    <main>
        <section class="full-width_padding">
            <div class="full-width_border border-2" style="border-color: #eee">
                <div class="shop-banner position-relative ">
                    <div class="background-img" style="background-color: #eee">
                        <img loading="lazy" src="{{ url($banner->image) }}" width="1759" height="420" alt="Pattern"
                            class="slideshow-bg__img object-fit-cover">
                    </div>

                    <div class="shop-banner__content container position-absolute start-50 top-50 translate-middle">
                        <h2 class="h1 text-uppercase fw-bold">Shop</h2>

                        <div class="breadcrumb mb-0 d-none d-md-block flex-grow-1">
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
                            <span class="breadcrumb-separator menu-link fw-medium ps-1 pe-1">/</span>
                            <a href="#" class="menu-link menu-link_us-s text-uppercase fw-medium">The Shop</a>
                        </div><!-- /.breadcrumb -->
                    </div><!-- /.shop-banner__content -->
                </div><!-- /.shop-banner position-relative -->
            </div><!-- /.full-width_border -->
        </section><!-- /.full-width_padding-->

        <div class="mb-4 pb-lg-3"></div>

        @if ($products->count())
            <section class="shop-main container">
                <div class="products-grid row row-cols-2 row-cols-md-3 row-cols-lg-4" id="products-grid">
                    @foreach ($products as $product)
                        <div class="product-card-wrapper">
                            <div class="product-card mb-3 mb-md-4 mb-xxl-5">
                                <div class="pc__img-wrapper">
                                    <div class="swiper-container background-img js-swiper-slider"
                                        data-settings='{"resizeObserver": true}'>
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                                <a
                                                    href="{{ route('main_page.product_detail', ['slug' => $product->slug]) }}"><img
                                                        loading="lazy" src="{{ url($product->main_image) }}" width="330"
                                                        height="400" alt="Cropped Faux leather Jacket"
                                                        class="pc__img"></a>
                                            </div><!-- /.pc__img-wrapper -->
                                        </div>
                                    </div>
                                    <button
                                        class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium js-add-cart js-open-aside"
                                        data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
                                </div>

                                <div class="pc__info position-relative">
                                    <p class="pc__category">
                                        {{ $product->category ? $product->category->name : 'No Category' }}
                                    </p>
                                    <h6 class="pc__title"><a
                                            href="{{ route('main_page.product_detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
                                    </h6>
                                    <div class="product-card__price d-flex">
                                        @if ($product->discounted_rates != 0)
                                            <span class="money price price-old">Rs. {{ $product->selling_price }}</span>
                                            <span class="money price">Rs. {{ $product->discounted_rates }}</span>
                                        @else
                                            <span class="money price">Rs. {{ $product->selling_price }}</span>
                                        @endif
                                    </div>

                                    <button
                                        class="pc__btn-wl position-absolute top-0 end-0 bg-transparent border-0 js-add-wishlist"
                                        title="Add To Wishlist">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <use href="#icon_heart" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div><!-- /.products-grid row -->

                {{ $products->links('partial.custom_pagination') }}
            </section><!-- /.shop-main container -->
        @else
            <div class="col-12 text-center py-5">
                <img src="{{ asset('images/empty-box.png') }}" alt="No Products" style="width: 150px;">
                <h4 class="mt-4">Oops! Nothing to see here.</h4>
                <p class="text-muted">We couldn’t find any products. Try checking back later or explore other categories.
                </p>
                <a href="{{ route('main_page.home') }}" class="btn btn-primary mt-3">Go Back Home</a>
            </div>
        @endif

    </main>

@endsection
