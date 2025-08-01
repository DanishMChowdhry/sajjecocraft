@extends('layouts.frontend')

@section('title', 'Home')

@section('head')
    <style>
        .blog-grid__item {
    position: relative;
}

.blog-grid__item .stretched-link {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    text-indent: -9999px;
    z-index: 1;
}

    </style>
@endsection

@section('content')
    <main>
        <section class="swiper-container js-swiper-slider slideshow full-width_padding-20 slideshow-md"
            data-settings='{
        "autoplay": {
          "delay": 5000
        },
        "slidesPerView": 1,
        "effect": "fade",
        "loop": true,
        "pagination": {
          "el": ".slideshow-pagination",
          "type": "bullets",
          "clickable": true
        }
      }'>
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide">
                        <div class="overflow-hidden position-relative h-100">
                            <div class="slideshow-bg">
                                <img loading="lazy" src="{{ url($slider->image) }}" width="1863" height="700" width="1863"
                                    height="700" alt=""
                                    class="slideshow-bg__img object-fit-cover object-position-right">
                            </div>
                            <div class="slideshow-text container position-absolute start-50 top-50 translate-middle">
                                <h6
                                    class="text_dash text-uppercase fs-base fw-medium animate animate_fade animate_btt animate_delay-3">
                                    {{ $slider->tag }}</h6>
                                <h2
                                    class="text-uppercase h1 fw-normal mb-0 animate animate_fade animate_btt animate_delay-5">
                                    {{ $slider->title }}</h2>
                                <p class="animate animate_fade animate_btt animate_delay-6">{{ $slider->description }}</p>
                                <a href="{{ $slider->cta_url }}" target="_blank"
                                    class="btn-link btn-link_sm default-underline text-uppercase fw-medium animate animate_fade animate_btt animate_delay-7">{{ $slider->cta_label }}
                                </a>
                            </div>
                        </div>
                    </div><!-- /.slideshow-item -->
                @endforeach
            </div><!-- /.slideshow-wrapper js-swiper-slider -->
            <div class="slideshow-pagination position-left-center"></div>
            <!-- /.products-pagination -->
        </section><!-- /.slideshow -->

        {{-- <div class="mb-3 pb-1"></div> --}}
        <div class="mb-1 pb-4 mb-xl-5 pb-xl-5"></div>

        <section class="products-carousel container">
            <h2 class="section-title text-center fw-normal text-uppercase mb-1 mb-md-3 pb-xl-3">Best Selling Products
            </h2>

            <div class="tab-content pt-2" id="collections-tab-content">
                <div class="tab-pane fade show active" id="collections-tab-1" role="tabpanel"
                    aria-labelledby="collections-tab-1-trigger">
                    <div class="row">
                        @foreach ($products as $product)
                            @include('partials.product')
                        @endforeach
                    </div><!-- /.row -->
                    <div class="text-center mt-2">
                        <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium"
                            href="{{ route('main_page.shop') }}">See All Products</a>
                    </div>
                </div><!-- /.tab-pane fade show-->
            </div><!-- /.tab-content pt-2 -->
        </section><!-- /.products-grid -->

        <div class="pt-1 pb-5 mt-4 mt-xl-5"></div>

        <section class="blog-carousel container">
            <h2 class="section-title fw-normal text-center text-uppercase mb-3 pb-xl-3 mb-xl-3">Our Blogs</h2>

            <div class="position-relative">
                <div class="swiper-container js-swiper-slider"
                    data-settings='{
            "autoplay": {
              "delay": 5000
            },
            "slidesPerView": 3,
            "slidesPerGroup": 3,
            "effect": "none",
            "loop": true,
            "breakpoints": {
              "320": {
                "slidesPerView": 1,
                "slidesPerGroup": 1,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 3,
                "slidesPerGroup": 1,
                "spaceBetween": 30
              }
            }
          }'>
                    <div class="swiper-wrapper blog-grid row-cols-xl-3">
                        @foreach ($blogs as $blog)
                            <div class="swiper-slide blog-grid__item mb-4 position-relative">
                                <a href="{{ route('main_page.blog', ['slug' => $blog->slug]) }}" class="stretched-link"></a>
                                <div class="blog-grid__item-image">
                                    <img loading="lazy" class="h-auto" src="{{ url($blog->main_image) }}" width="450"
                                        height="300" alt="{{ $blog->title }}">
                                </div>
                                <div class="blog-grid__item-detail">
                                    <div class="blog-grid__item-title mb-0">
                                        {{ $blog->title }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div><!-- /.swiper-container js-swiper-slider -->
                 <div class="text-center mt-2">
                        <a class="btn-link btn-link_lg default-underline text-uppercase fw-medium"
                            href="{{ route('main_page.blogs') }}">See All Blogs</a>
                    </div>
            </div><!-- /.position-relative -->
        </section>

        <div class="mb-5 pb-4 pb-xl-5 mb-xl-5"></div>
        <div class="mb-3 mb-xl-5"></div>
    </main>
@endsection
