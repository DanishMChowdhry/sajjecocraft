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
                        @include('partials.product')
                    @endforeach
                </div><!-- /.products-grid row -->

                {{ $products->links('partial.custom_pagination') }}
            </section><!-- /.shop-main container -->
        @else
            <div class="col-12 text-center py-5">
                <h4 class="mt-4">Oops! Nothing to see here.</h4>
                <p class="text-muted">We couldn’t find any products. Try checking back later or explore other categories.
                </p>
<div class="d-flex justify-content-center align-items-center flex-column text-center">
    <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary"><strong>Go Back</strong></a>
        <a href="{{ url('/') }}" class="btn btn-primary">Go Home</a>
        <a href="{{ route('main_page.shop') }}" class="btn" style="background-color: #306f42; border-color: #306f42; color: #212121; "><strong>Browse Shop</strong></a>
    </div>
</div>

            </div>
        @endif

    </main>

@endsection
