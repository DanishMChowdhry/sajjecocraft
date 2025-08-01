<!DOCTYPE html>
<html dir="ltr" lang="zxx">

<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="flexkit">

    <link rel="shortcut icon" href="{{ $site_settings->favicon_image }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Allura&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ url('/frontend/css/plugins/swiper.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ url('/frontend/css/style.css') }}" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if lt IE 9]>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
  <![endif]-->

    <!-- Document Title -->
    <title> @yield('title') | SajjEcoCraft </title>

    @yield('head')
</head>

<body>
    @include('partials.frontend.initialSVG')

    <!-- Mobile Header -->
    @include('partial.frontend.mobile-header')

    <!-- Header Type 5 -->
    @include('partial.frontend.main-header')

    <!-- End Header Type 5 -->

    @yield('content')

    <!-- Footer Type 2 -->
    @include('partial.frontend.main_footer')

    <!-- Mobile Footer -->

    @include('partial.frontend.mobile_footer')
    <!-- Customer Login Form -->
    {{-- @include('partial.frontend.custom_login') --}}
    <!-- Cart Drawer -->
    @include('partial.frontend.cart_drawer')
    <!-- Sitemap -->
    {{-- <div class="modal fade" id="siteMap" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
      <div class="sitemap d-flex">
        <div class="w-50 d-none d-lg-block">
          <img loading="lazy" src="{{url('frontend/images/nav-bg.jpg')}}" alt="Site map" class="sitemap__bg">
        </div><!-- /.sitemap__bg w-50 d-none d-lg-block -->
        <div class="sitemap__links w-50 flex-grow-1">
          <div class="modal-content">
            <div class="modal-header">
              <ul class="nav nav-pills" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                  <a class="nav-link active rounded-1 text-uppercase" id="pills-item-1-tab" data-bs-toggle="pill" href="#pills-item-1" role="tab" aria-controls="pills-item-1" aria-selected="true">WOMEN</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link rounded-1 text-uppercase" id="pills-item-2-tab" data-bs-toggle="pill" href="#pills-item-2" role="tab" aria-controls="pills-item-2" aria-selected="false">MEN</a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link rounded-1 text-uppercase" id="pills-item-3-tab" data-bs-toggle="pill" href="#pills-item-3" role="tab" aria-controls="pills-item-3" aria-selected="false">KIDS</a>
                </li>
              </ul>
              <button type="button" class="btn-close-lg" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <div class="tab-content col-12" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-item-1" role="tabpanel" aria-labelledby="pills-item-1-tab">
                  <div class="row">
                    <ul class="nav nav-tabs list-unstyled col-5 d-block" id="myTab" role="tablist">
                      <li class="nav-item position-relative" role="presentation">
                        <a class="nav-link nav-link_rline active" id="tab-item-1-tab" data-bs-toggle="tab" href="#tab-item-1" role="tab" aria-controls="tab-item-1" aria-selected="true"><span class="rline-content">WOMEN</span></a>
                      </li>
                      <li class="nav-item position-relative" role="presentation">
                        <a class="nav-link nav-link_rline" id="tab-item-2-tab" data-bs-toggle="tab" href="#tab-item-2" role="tab" aria-controls="tab-item-2" aria-selected="false"><span class="rline-content">MAN</span></a>
                      </li>
                      <li class="nav-item position-relative" role="presentation">
                        <a class="nav-link nav-link_rline" id="tab-item-3-tab" data-bs-toggle="tab" href="#tab-item-3" role="tab" aria-controls="tab-item-3" aria-selected="false"><span class="rline-content">KIDS</span></a>
                      </li>
                      <li class="nav-item position-relative" role="presentation">
                        <a class="nav-link nav-link_rline" href="#"><span class="rline-content">HOME</span></a>
                      </li>
                      <li class="nav-item position-relative" role="presentation">
                        <a class="nav-link nav-link_rline" href="#"><span class="rline-content">COLLECTION</span></a>
                      </li>
                      <li class="nav-item position-relative" role="presentation">
                        <a class="nav-link nav-link_rline text-red" href="#">SALE UP TO 50% OFF</a>
                      </li>
                      <li class="nav-item position-relative" role="presentation">
                        <a class="nav-link nav-link_rline" href="#"><span class="rline-content">NEW</span></a>
                      </li>
                      <li class="nav-item position-relative" role="presentation">
                        <a class="nav-link nav-link_rline" href="#"><span class="rline-content">SHOES</span></a>
                      </li>
                      <li class="nav-item position-relative" role="presentation">
                        <a class="nav-link nav-link_rline" href="#"><span class="rline-content">ACCESSORIES</span></a>
                      </li>
                      <li class="nav-item position-relative" role="presentation">
                        <a class="nav-link nav-link_rline" href="#"><span class="rline-content">JOIN LIFE</span></a>
                      </li>
                      <li class="nav-item position-relative" role="presentation">
                        <a class="nav-link nav-link_rline" href="#"><span class="rline-content">#UOMOSTYLE</span></a>
                      </li>
                    </ul>

                    <div class="tab-content col-7" id="myTabContent">
                      <div class="tab-pane fade show active" id="tab-item-1" role="tabpanel" aria-labelledby="tab-item-1-tab">
                        <ul class="sub-menu list-unstyled">
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">New</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Best Sellers</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Collaborations®</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Sets</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Denim</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Jackets & Coats</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Overshirts</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Trousers</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Jeans</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Dresses</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Sweatshirts and Hoodies</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">T-shirts & Tops</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Shirts & Blouses</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Shorts and Bermudas</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Shoes</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="./shop3.html" class="menu-link menu-link_us-s">Accessories</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Bags</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="./about.html" class="menu-link menu-link_us-s">Gift Card</a>
                          </li>
                        </ul><!-- /.sub-menu -->
                      </div>
                      <div class="tab-pane fade" id="tab-item-2" role="tabpanel" aria-labelledby="tab-item-2-tab">
                        <ul class="sub-menu list-unstyled">
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Best Sellers</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">New</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Sets</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Denim</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Collaborations®</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Trousers</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Jackets & Coats</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Overshirts</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Dresses</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Jeans</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Sweatshirts and Hoodies</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="./about.html" class="menu-link menu-link_us-s">Gift Card</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Shirts & Blouses</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">T-shirts & Tops</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Shorts and Bermudas</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="./shop3.html" class="menu-link menu-link_us-s">Accessories</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Shoes</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Bags</a>
                          </li>
                        </ul><!-- /.sub-menu -->
                      </div>
                      <div class="tab-pane fade" id="tab-item-3" role="tabpanel" aria-labelledby="tab-item-3-tab">
                        <ul class="sub-menu list-unstyled">
                          <li class="sub-menu__item">
                            <a href="./about.html" class="menu-link menu-link_us-s">Gift Card</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Collaborations®</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Sets</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Denim</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">New</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Best Sellers</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Overshirts</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Jackets & Coats</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Jeans</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Trousers</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Shorts and Bermudas</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Shoes</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="./shop3.html" class="menu-link menu-link_us-s">Accessories</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Dresses</a>
                          </li>
                          <li class="sub-menu__item">
                            <a href="#" class="menu-link menu-link_us-s">Bags</a>
                          </li>
                        </ul><!-- /.sub-menu -->
                      </div>
                    </div>
                  </div><!-- /.row -->
                </div>
                <div class="tab-pane fade" id="pills-item-2" role="tabpanel" aria-labelledby="pills-item-2-tab">
                  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                  Elementum lectus a porta commodo suspendisse arcu, aliquam lectus faucibus.
                </div>
                <div class="tab-pane fade" id="pills-item-3" role="tabpanel" aria-labelledby="pills-item-3-tab">
                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p>
                  Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur?
                </div>
              </div>
            </div><!-- /.modal-body -->
          </div><!-- /.modal-content -->
        </div><!-- /.sitemap__links w-50 flex-grow-1 -->
      </div>
    </div><!-- /.modal-dialog modal-fullscreen -->
  </div><!-- /.sitemap position-fixed w-100 --> --}}

    <!-- Quick View -->
    {{-- <div class="modal fade" id="quickView" tabindex="-1">
    <div class="modal-dialog quick-view modal-dialog-centered">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="product-single">
          <div class="product-single__media m-0">
            <div class="product-single__image position-relative w-100">
              <div class="swiper-container js-swiper-slider"
                data-settings='{
                  "slidesPerView": 1,
                  "slidesPerGroup": 1,
                  "effect": "none",
                  "loop": false,
                  "navigation": {
                    "nextEl": ".modal-dialog.quick-view .product-single__media .swiper-button-next",
                    "prevEl": ".modal-dialog.quick-view .product-single__media .swiper-button-prev"
                  }
                }'>
                <div class="swiper-wrapper">
                  <div class="swiper-slide product-single__image-item">
                    <img loading="lazy" src="{{url('frontend/images/products/quickview_1.jpg')}}" alt="">
                  </div>
                  <div class="swiper-slide product-single__image-item">
                    <img loading="lazy" src="{{url('frontend/images/products/quickview_2.jpg')}}" alt="">
                  </div>
                  <div class="swiper-slide product-single__image-item">
                    <img loading="lazy" src="{{url('frontend/images/products/quickview_3.jpg')}}" alt="">
                  </div>
                  <div class="swiper-slide product-single__image-item">
                    <img loading="lazy" src="{{url('frontend/images/products/quickview_4.jpg')}}" alt="">
                  </div>
                </div>
                <div class="swiper-button-prev"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg"><use href="#icon_prev_sm" /></svg></div>
                <div class="swiper-button-next"><svg width="7" height="11" viewBox="0 0 7 11" xmlns="http://www.w3.org/2000/svg"><use href="#icon_next_sm" /></svg></div>
              </div>
            </div>
          </div>
          <div class="product-single__detail">
            <h1 class="product-single__name">Lightweight Puffer Jacket With a Hood</h1>
            <div class="product-single__price">
              <span class="current-price">$449</span>
            </div>
            <div class="product-single__short-desc">
              <p>Phasellus sed volutpat orci. Fusce eget lore mauris vehicula elementum gravida nec dui. Aenean aliquam varius ipsum, non ultricies tellus sodales eu. Donec dignissim viverra nunc, ut aliquet magna posuere eget.</p>
            </div>
            <form name="addtocart-form" method="post">
              <div class="product-single__swatches">
                <div class="product-swatch text-swatches">
                  <label>Sizes</label>
                  <div class="swatch-list">
                    <input type="radio" name="size" id="swatch-1">
                    <label class="swatch js-swatch" for="swatch-1" aria-label="Extra Small" data-bs-toggle="tooltip" data-bs-placement="top" title="Extra Small">XS</label>
                    <input type="radio" name="size" id="swatch-2" checked>
                    <label class="swatch js-swatch" for="swatch-2" aria-label="Small" data-bs-toggle="tooltip" data-bs-placement="top" title="Small">S</label>
                    <input type="radio" name="size" id="swatch-3">
                    <label class="swatch js-swatch" for="swatch-3" aria-label="Middle" data-bs-toggle="tooltip" data-bs-placement="top" title="Middle">M</label>
                    <input type="radio" name="size" id="swatch-4">
                    <label class="swatch js-swatch" for="swatch-4" aria-label="Large" data-bs-toggle="tooltip" data-bs-placement="top" title="Large">L</label>
                    <input type="radio" name="size" id="swatch-5">
                    <label class="swatch js-swatch" for="swatch-5" aria-label="Extra Large" data-bs-toggle="tooltip" data-bs-placement="top" title="Extra Large">XL</label>
                  </div>
                  <a href="#" class="sizeguide-link" data-bs-toggle="modal" data-bs-target="#sizeGuide">Size Guide</a>
                </div>
                <div class="product-swatch color-swatches">
                  <label>Color</label>
                  <div class="swatch-list">
                    <input type="radio" name="color" id="swatch-11">
                    <label class="swatch swatch-color js-swatch" for="swatch-11" aria-label="Black" data-bs-toggle="tooltip" data-bs-placement="top" title="Black" style="color: #222"></label>
                    <input type="radio" name="color" id="swatch-12" checked>
                    <label class="swatch swatch-color js-swatch" for="swatch-12" aria-label="Red" data-bs-toggle="tooltip" data-bs-placement="top" title="Red" style="color: #C93A3E"></label>
                    <input type="radio" name="color" id="swatch-13">
                    <label class="swatch swatch-color js-swatch" for="swatch-13" aria-label="Grey" data-bs-toggle="tooltip" data-bs-placement="top" title="Grey" style="color: #E4E4E4"></label>
                  </div>
                </div>
              </div>
              <div class="product-single__addtocart">
                <div class="qty-control position-relative">
                  <input type="number" name="quantity" value="1" min="1" class="qty-control__number text-center">
                  <div class="qty-control__reduce">-</div>
                  <div class="qty-control__increase">+</div>
                </div><!-- .qty-control -->
                <button type="submit" class="btn btn-primary btn-addtocart js-open-aside" data-aside="cartDrawer">Add to Cart</button>
              </div>
            </form>
            <div class="product-single__addtolinks">
              <a href="#" class="menu-link menu-link_us-s add-to-wishlist"><svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_heart" /></svg><span>Add to Wishlist</span></a>
              <share-button class="share-button">
                <button class="menu-link menu-link_us-s to-share border-0 bg-transparent d-flex align-items-center">
                  <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg"><use href="#icon_sharing" /></svg>
                </button>
                <details id="Details-share-template__main" class="m-1 xl:m-1.5" hidden="">
                  <summary class="btn-solid m-1 xl:m-1.5 pt-3.5 pb-3 px-5">+</summary>
                  <div id="Article-share-template__main" class="share-button__fallback flex items-center absolute top-full left-0 w-full px-2 py-4 bg-container shadow-theme border-t z-10">
                    <div class="field grow mr-4">
                      <label class="field__label sr-only" for="url">Link</label>
                      <input type="text" class="field__input w-full" id="url" value="https://uomo-crystal.myshopify.com/blogs/news/go-to-wellness-tips-for-mental-health" placeholder="Link" onclick="this.select();" readonly="">
                    </div>
                    <button class="share-button__copy no-js-hidden">
                      <svg class="icon icon-clipboard inline-block mr-1" width="11" height="13" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false" viewBox="0 0 11 13">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2 1a1 1 0 011-1h7a1 1 0 011 1v9a1 1 0 01-1 1V1H2zM1 2a1 1 0 00-1 1v9a1 1 0 001 1h7a1 1 0 001-1V3a1 1 0 00-1-1H1zm0 10V3h7v9H1z" fill="currentColor"></path>
                      </svg>
                      <span class="sr-only">Copy link</span>
                    </button>
                  </div>
                </details>
              </share-button>
              <script src="./js/details-disclosure.js" defer="defer"></script>
              <script src="./js/share.js" defer="defer"></script>
            </div>
            <div class="product-single__meta-info mb-0">
              <div class="meta-item">
                <label>SKU:</label>
                <span>N/A</span>
              </div>
              <div class="meta-item">
                <label>Categories:</label>
                <span>Casual & Urban Wear, Jackets, Men</span>
              </div>
              <div class="meta-item">
                <label>Tags:</label>
                <span>biker, black, bomber, leather</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.modal-dialog -->
  </div><!-- /.quickview position-fixed --> --}}

    <!-- Newsletter Popup -->
    {{-- <div class="modal fade" id="newsletterPopup" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog newsletter-popup modal-dialog-centered">
      <div class="modal-content">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <div class="row p-0 m-0">
          <div class="col-md-6 p-0 d-none d-md-block">
            <div class="newsletter-popup__bg h-100 w-100">
              <img loading="lazy" src="{{url('frontend/images/newsletter-popup.jpg')}}" class="h-100 w-100 object-fit-cover d-block" alt="">
            </div>
          </div>
          <div class="col-md-6 p-0 d-flex align-items-center">
            <div class="block-newsletter w-100">
              <h3 class="block__title">Sign Up to Our Newsletter</h3>
              <p>Be the first to get the latest news about trends, promotions, and much more!</p>
              <form action="{{url('/')}}" class="footer-newsletter__form position-relative bg-body">
                <input class="form-control border-2" type="email" name="email" placeholder="Your email address">
                <input class="btn-link fw-medium bg-transparent position-absolute top-0 end-0 h-100" type="submit" value="JOIN">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.newsletter-popup position-fixed --> --}}

    @include('partial.frontend.scripts')

    @yield('scripts')
</body>

</html>
