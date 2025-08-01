 <div class="col-6 col-md-4 col-lg-3">
     <div class="product-card mb-3 mb-md-4 mb-xxl-5">
         <div class="pc__img-wrapper">
             <div class="swiper-container background-img js-swiper-slider" data-settings='{"resizeObserver": true}'>
                 <div class="swiper-wrapper">
                     <div class="swiper-slide">
                         <a href="{{ route('main_page.product_detail', ['slug' => $product->slug]) }}">
                             <img loading="lazy" src="{{ url($product->main_image) }}" width="330" height="fit-content"
                                 alt="Colorful Jacket" style="object-fit: inherit;" class="pc__img">
                         </a>
                     </div><!-- /.pc__img-wrapper -->
                 </div>
             </div>
             <form action="{{ route('cart.add', $product->id) }}" method="post">
                 @csrf
                 <input type="hidden" name="product_id" value="{{ $product->id }}">
                 <button type="submit"
                     class="pc__atc btn anim_appear-bottom btn position-absolute border-0 text-uppercase fw-medium"
                     data-aside="cartDrawer" title="Add To Cart"><svg class="d-inline-blockk align-middle mx-2"
                         width="14" height="14" viewBox="0 0 20 20" fill="none"
                         xmlns="http://www.w3.org/2000/svg">
                         <use href="#icon_cart" />
                     </svg><span class="d-inline-block align-middle">Add To Cart</span></button>
             </form>

         </div>

         <div class="pc__info position-relative">
             <p class="pc__category">{{$product->category->name ?? ''}}</p>
             <h6 class="pc__title mb-2"><a
                     href="{{ route('main_page.product_detail', ['slug' => $product->slug]) }}">{{ $product->name }}</a>
             </h6>
             <div class="product-card__price d-flex">
                 @if ($product->discounted_rates > 0 && $product->discounted_rates < $product->selling_price)
                     <span class="money price price-old">₹ {{ number_format($product->selling_price, 2) }}</span>
                     <span class="money price price-sale">₹ {{ number_format($product->discounted_rates, 2) }}</span>
                 @else
                     <span class="money price price-sale">₹ {{ number_format($product->selling_price, 2) }}</span>
                 @endif
             </div>
         </div>
     </div>
 </div>
