@extends('layouts.frontend')

@section('title')
				{{ $product->name }}
@endsection

@section('head')
				<!-- Fancybox CSS -->
				<link href="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" rel="stylesheet" />
				<style>
								.product-single__image-item {
												position: relative;
												/* Contain the image */
												overflow: hidden;
												/* Hide zoomed part of image */
								}

								.product-single__image-item img {
												transition: transform 0.3s ease;
												/* Smooth zoom transition */
												transform-origin: center center;
												/* Zoom starts from the center */
												width: 100%;
												/* Ensure the image fills the container */
												height: auto;
								}
				</style>
@endsection

@section('scripts')
				<!-- Fancybox JS -->
				<script src="https://cdn.jsdelivr.net/npm/@fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
				<script>
								document.addEventListener('DOMContentLoaded', function() {
												const images = document.querySelectorAll('.product-single__image-item img');

												images.forEach(img => {
																img.addEventListener('mousemove', (e) => {
																				const rect = img.getBoundingClientRect(); // Get image position
																				const x = e.clientX - rect.left; // X position relative to image
																				const y = e.clientY - rect.top; // Y position relative to image

																				const xPercent = (x / rect.width) * 100; // Calculate x position percentage
																				const yPercent = (y / rect.height) * 100; // Calculate y position percentage

																				// Apply the zoom with transform-origin to follow the mouse position
																				img.style.transform = `scale(2)`; // Increase zoom to 200% of original size
																				img.style.transformOrigin =
																								`${xPercent}% ${yPercent}%`; // Zoom towards mouse position
																});

																img.addEventListener('mouseleave', () => {
																				// Reset the zoom and the origin when the mouse leaves the image
																				img.style.transform = 'scale(1)'; // Reset to original size (no zoom)
																				img.style.transformOrigin = 'center center'; // Center the zoom origin
																});
												});
								});
				</script>
@endsection

@section('content')
				<main>
								<div class="mb-md-1 pb-md-3"></div>
								<section class="product-single container">
												<div class="row">
																<div class="col-lg-7">
																				<div class="product-single__media" data-media-type="vertical-thumbnail">
																								<div class="product-single__image">
																												<div class="swiper-container">
																																<div class="swiper-wrapper">
																																				@if (!empty($product->image_1))
																																								<div class="swiper-slide product-single__image-item">
																																												<img loading="lazy" class="h-auto" src="{{ url($product->image_1) }}"
																																																width="674" height="674" alt="">
																																												<a data-fancybox="gallery" href="{{ url($product->image_1) }}"
																																																data-bs-toggle="tooltip" data-bs-placement="left">
																																																<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																																																				xmlns="http://www.w3.org/2000/svg">
																																																				<use href="#icon_zoom" />
																																																</svg>
																																												</a>
																																								</div>
																																				@endif
																																				@if (!empty($product->image_2))
																																								<div class="swiper-slide product-single__image-item">
																																												<img loading="lazy" class="h-auto" src="{{ url($product->image_2) }}"
																																																width="674" height="674" alt="">
																																												<a data-fancybox="gallery" href="{{ url($product->image_2) }}"
																																																data-bs-toggle="tooltip" data-bs-placement="left">
																																																<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																																																				xmlns="http://www.w3.org/2000/svg">
																																																				<use href="#icon_zoom" />
																																																</svg>
																																												</a>
																																								</div>
																																				@endif
																																				@if (!empty($product->image_3))
																																								<div class="swiper-slide product-single__image-item">
																																												<img loading="lazy" class="h-auto" src="{{ url($product->image_3) }}"
																																																width="674" height="674" alt="">
																																												<a data-fancybox="gallery" href="{{ url($product->image_3) }}"
																																																data-bs-toggle="tooltip" data-bs-placement="left">
																																																<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																																																				xmlns="http://www.w3.org/2000/svg">
																																																				<use href="#icon_zoom" />
																																																</svg>
																																												</a>
																																								</div>
																																				@endif
																																				@if (!empty($product->image_4))
																																								<div class="swiper-slide product-single__image-item">
																																												<img loading="lazy" class="h-auto" src="{{ url($product->image_4) }}"
																																																width="674" height="674" alt="">
																																												<a data-fancybox="gallery" href="{{ url($product->image_4) }}"
																																																data-bs-toggle="tooltip" data-bs-placement="left">
																																																<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																																																				xmlns="http://www.w3.org/2000/svg">
																																																				<use href="#icon_zoom" />
																																																</svg>
																																												</a>
																																								</div>
																																				@endif
																																				@if (!empty($product->image_5))
																																								<div class="swiper-slide product-single__image-item">
																																												<img loading="lazy" class="h-auto" src="{{ url($product->image_5) }}"
																																																width="674" height="674" alt="">
																																												<a data-fancybox="gallery" href="{{ url($product->image_5) }}"
																																																data-bs-toggle="tooltip" data-bs-placement="left">
																																																<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																																																				xmlns="http://www.w3.org/2000/svg">
																																																				<use href="#icon_zoom" />
																																																</svg>
																																												</a>
																																								</div>
																																				@endif
																																				@if (!empty($product->image_6))
																																								<div class="swiper-slide product-single__image-item">
																																												<img loading="lazy" class="h-auto" src="{{ url($product->image_6) }}"
																																																width="674" height="674" alt="">
																																												<a data-fancybox="gallery" href="{{ url($product->image_6) }}"
																																																data-bs-toggle="tooltip" data-bs-placement="left">
																																																<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																																																				xmlns="http://www.w3.org/2000/svg">
																																																				<use href="#icon_zoom" />
																																																</svg>
																																												</a>
																																								</div>
																																				@endif
																																				@if (!empty($product->image_7))
																																								<div class="swiper-slide product-single__image-item">
																																												<img loading="lazy" class="h-auto" src="{{ url($product->image_7) }}"
																																																width="674" height="674" alt="">
																																												<a data-fancybox="gallery" href="{{ url($product->image_7) }}"
																																																data-bs-toggle="tooltip" data-bs-placement="left">
																																																<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																																																				xmlns="http://www.w3.org/2000/svg">
																																																				<use href="#icon_zoom" />
																																																</svg>
																																												</a>
																																								</div>
																																				@endif
																																				@if (!empty($product->image_8))
																																								<div class="swiper-slide product-single__image-item">
																																												<img loading="lazy" class="h-auto" src="{{ url($product->image_8) }}"
																																																width="674" height="674" alt="">
																																												<a data-fancybox="gallery" href="{{ url($product->image_8) }}"
																																																data-bs-toggle="tooltip" data-bs-placement="left">
																																																<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																																																				xmlns="http://www.w3.org/2000/svg">
																																																				<use href="#icon_zoom" />
																																																</svg>
																																												</a>
																																								</div>
																																				@endif
																																				@if (!empty($product->image_9))
																																								<div class="swiper-slide product-single__image-item">
																																												<img loading="lazy" class="h-auto" src="{{ url($product->image_9) }}"
																																																width="674" height="674" alt="">
																																												<a data-fancybox="gallery" href="{{ url($product->image_9) }}"
																																																data-bs-toggle="tooltip" data-bs-placement="left">
																																																<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																																																				xmlns="http://www.w3.org/2000/svg">
																																																				<use href="#icon_zoom" />
																																																</svg>
																																												</a>
																																								</div>
																																				@endif
																																				@if (!empty($product->image_10))
																																								<div class="swiper-slide product-single__image-item">
																																												<img loading="lazy" class="h-auto" src="{{ url($product->image_10) }}"
																																																width="674" height="674" alt="">
																																												<a data-fancybox="gallery" href="{{ url($product->image_10) }}"
																																																data-bs-toggle="tooltip" data-bs-placement="left">
																																																<svg width="16" height="16" viewBox="0 0 16 16" fill="none"
																																																				xmlns="http://www.w3.org/2000/svg">
																																																				<use href="#icon_zoom" />
																																																</svg>
																																												</a>
																																								</div>
																																				@endif
																																</div>
																																<div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11"
																																								xmlns="http://www.w3.org/2000/svg">
																																								<use href="#icon_prev_sm" />
																																				</svg></div>
																																<div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11"
																																								xmlns="http://www.w3.org/2000/svg">
																																								<use href="#icon_next_sm" />
																																				</svg></div>
																												</div>
																								</div>
																								<div class="product-single__thumbnail">
																												<div class="swiper-container">
																																<div class="swiper-wrapper">
																																				@if (!empty($product->image_1))
																																								<div class="swiper-slide product-single__image-item"><img loading="lazy"
																																																class="h-auto" src="{{ url($product->image_1) }}" width="104"
																																																height="104" alt=""></div>
																																				@endif
																																				@if (!empty($product->image_2))
																																								<div class="swiper-slide product-single__image-item"><img loading="lazy"
																																																class="h-auto" src="{{ url($product->image_2) }}" width="104"
																																																height="104" alt=""></div>
																																				@endif
																																				@if (!empty($product->image_3))
																																								<div class="swiper-slide product-single__image-item"><img loading="lazy"
																																																class="h-auto" src="{{ url($product->image_3) }}" width="104"
																																																height="104" alt=""></div>
																																				@endif
																																				@if (!empty($product->image_4))
																																								<div class="swiper-slide product-single__image-item"><img loading="lazy"
																																																class="h-auto" src="{{ url($product->image_4) }}" width="104"
																																																height="104" alt=""></div>
																																				@endif
																																				@if (!empty($product->image_5))
																																								<div class="swiper-slide product-single__image-item"><img loading="lazy"
																																																class="h-auto" src="{{ url($product->image_5) }}" width="104"
																																																height="104" alt=""></div>
																																				@endif
																																				@if (!empty($product->image_6))
																																								<div class="swiper-slide product-single__image-item"><img loading="lazy"
																																																class="h-auto" src="{{ url($product->image_6) }}" width="104"
																																																height="104" alt=""></div>
																																				@endif
																																				@if (!empty($product->image_7))
																																								<div class="swiper-slide product-single__image-item"><img loading="lazy"
																																																class="h-auto" src="{{ url($product->image_7) }}" width="104"
																																																height="104" alt=""></div>
																																				@endif
																																				@if (!empty($product->image_8))
																																								<div class="swiper-slide product-single__image-item"><img loading="lazy"
																																																class="h-auto" src="{{ url($product->image_8) }}" width="104"
																																																height="104" alt=""></div>
																																				@endif
																																				@if (!empty($product->image_9))
																																								<div class="swiper-slide product-single__image-item"><img loading="lazy"
																																																class="h-auto" src="{{ url($product->image_9) }}" width="104"
																																																height="104" alt=""></div>
																																				@endif
																																				@if (!empty($product->image_10))
																																								<div class="swiper-slide product-single__image-item"><img loading="lazy"
																																																class="h-auto" src="{{ url($product->image_10) }}" width="104"
																																																height="104" alt=""></div>
																																				@endif
																																</div>
																												</div>
																								</div>
																				</div>
																</div>
																<div class="col-lg-5">
																				<div class="d-flex justify-content-between pb-md-2 mb-4">
																								<div class="breadcrumb d-none d-md-block flex-grow-1 mb-0">
																												<a href="{{ url('/') }}"
																																class="menu-link menu-link_us-s text-uppercase fw-medium">Home</a>
																												<span class="breadcrumb-separator menu-link fw-medium pe-1 ps-1">/</span>
																												<a href="{{ url('shop') }}" class="menu-link menu-link_us-s text-uppercase fw-medium">The
																																Shop</a>
																								</div><!-- /.breadcrumb -->

																				</div>
																				<h1 class="product-single__name">{{ $product->name }}</h1>

																				<div class="product-card__price d-flex">
																								@if ($product->discounted_rates != 0)
																												<span class="money price price-old">Rs. {{ $product->selling_price }}</span>
																												<span class="money price">Rs. {{ $product->discounted_rates }}</span>
																								@else
																												<span class="money price">Rs. {{ $product->selling_price }}</span>
																								@endif
																				</div>
																				<div class="product-single__short-desc">
																								{!! $product->description !!}
																				</div>

																				<div class="product-single__addtolinks">
																								{{-- <a href="#" class="menu-link menu-link_us-s add-to-wishlist"><svg width="16"
                                height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <use href="#icon_cart" />
                            </svg><span>Add to Cart</span></a> --}}
																								<form action="{{ route('cart.add', $product->id) }}" method="post">
																												@csrf
																												<input type="hidden" name="product_id" value="{{ $product->id }}">
																												<button type="submit" style="background: transparent; border: none; text-align: center;"
																																class="menu-link menu-link_us-s add-to-wishlist d-flex align-items-center gap-1">

																																<svg width="16" height="16" viewBox="0 0 20 20" fill="none"
																																				xmlns="http://www.w3.org/2000/svg">
																																				<use href="#icon_cart" />
																																</svg>
																																<span>Add to Cart</span>
																												</button>

																								</form>
																								<share-button class="share-button">
																												<a href="https://web.whatsapp.com/send?text={{ urlencode('Hey! Check this out: https://www.sajjecocraft.com/shop/' . $product->slug) }}"
																																target="_blank" rel="noopener noreferrer">
																																<svg width="16" height="19" viewBox="0 0 16 19" fill="none"
																																				xmlns="http://www.w3.org/2000/svg">
																																				<use href="#icon_sharing" />
																																</svg>
																																<span>Share on WhatsApp</span>
																												</a>
																								</share-button>

																				</div>
																				<div class="product-single__meta-info">
																								<div class="meta-item">
																												<label>SKU:</label>
																												<span>{{ $product->sku }}</span>
																								</div>
																								<div class="meta-item">
																												<label>Categories:</label>
																												<span>{{ $product->category->name ?? '' }}</span>
																								</div>
																								<div class="meta-item">
																												<label>Size:</label>
																												<span>{!! $product->size !!}</span>
																								</div>
																								<div class="meta-item">
																												<label>Tags:</label>
																												<span>{{ $product->meta_keywords }}</span>
																								</div>
																				</div>
																</div>
												</div>

								</section>

								<br>
								<br>
								<br>
								@if ($relatedProducts->count() > 0)
												<section class="products-carousel container">
																<h2 class="h3 text-uppercase pb-xl-2 mb-xl-4 mb-4">Related <strong>Products</strong></h2>

																<div id="related_products" class="position-relative">
																				<div class="swiper-container js-swiper-slider"
																								data-settings='{
            "autoplay": false,
            "slidesPerView": 4,
            "slidesPerGroup": 4,
            "effect": "none",
            "loop": true,
            "pagination": {
              "el": "#related_products .products-pagination",
              "type": "bullets",
              "clickable": true
            },
            "navigation": {
              "nextEl": "#related_products .products-carousel__next",
              "prevEl": "#related_products .products-carousel__prev"
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "slidesPerGroup": 2,
                "spaceBetween": 14
              },
              "768": {
                "slidesPerView": 3,
                "slidesPerGroup": 3,
                "spaceBetween": 24
              },
              "992": {
                "slidesPerView": 4,
                "slidesPerGroup": 4,
                "spaceBetween": 30
              }
            }
          }'>
																								<div class="swiper-wrapper">
																												@foreach ($relatedProducts as $item)
																																<div class="swiper-slide product-card">
																																				<div class="pc__img-wrapper">
																																								<a href="{{ url('shop/' . $item->slug) }}">
																																												<img loading="lazy" src="{{ url($item->main_image) }}" width="330"
																																																height="400" alt="Cropped Faux leather Jacket" class="pc__img">
																																								</a>

																																								<form action="{{ route('cart.add', $item->id) }}" method="post">
																																												@csrf
																																												<input type="hidden" name="product_id" value="{{ $item->id }}">
																																												<button
																																																class="pc__atc btn anim_appear-bottom btn position-absolute text-uppercase fw-medium  border-0"
																																																data-aside="cartDrawer" title="Add To Cart">Add To Cart</button>
																																								</form>
																																				</div>

																																				<div class="pc__info position-relative">
																																								<p class="pc__category">{{ $item->category->name ?? '' }}</p>
																																								<h6 class="pc__title"><a
																																																href="{{ url('shop/' . $item->slug) }}">{{ $item->name }}</a></h6>
																																								<div class="product-card__price d-flex">
																																												@if ($item->discounted_rates != 0)
																																																<span class="money price price-old">Rs. {{ $item->selling_price }}</span>
																																																<span class="money price">Rs. {{ $item->discounted_rates }}</span>
																																												@else
																																																<span class="money price">Rs. {{ $item->selling_price }}</span>
																																												@endif
																																								</div>
																																				</div>
																																</div>
																												@endforeach

																								</div><!-- /.swiper-wrapper -->
																				</div><!-- /.swiper-container js-swiper-slider -->

																				@if ($relatedProducts->count() > 4)
																								<div
																												class="products-carousel__prev position-absolute top-50 d-flex align-items-center justify-content-center">
																												<svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
																																<use href="#icon_prev_md" />
																												</svg>
																								</div><!-- /.products-carousel__prev -->
																								<div
																												class="products-carousel__next position-absolute top-50 d-flex align-items-center justify-content-center">
																												<svg width="25" height="25" viewBox="0 0 25 25" xmlns="http://www.w3.org/2000/svg">
																																<use href="#icon_next_md" />
																												</svg>
																								</div><!-- /.products-carousel__next -->
																				@endif

																				<div class="products-pagination d-flex align-items-center justify-content-center mb-5 mt-4"></div>
																				<!-- /.products-pagination -->
																</div><!-- /.position-relative -->

												</section><!-- /.products-carousel container -->
								@endif

				</main>
@endsection
