 <footer id="footer" class="footer footer_type_2 bordered">

     <div class="footer-middle container">
         <div class="row row-cols-lg-5 row-cols-2">
             <div class="footer-column footer-store-info col-12 mb-4 mb-lg-0">
                 <div class="logo">
                     <a href="{{ url('/') }}">
                         <img src="{{ url($site_settings->logo_dark_image) }}" alt="Uomo" class="logo__image d-block">
                     </a>
                 </div><!-- /.logo -->
                 <p class="footer-address">{{ $site_settings->description }}</p>
             </div><!-- /.footer-column -->

             <div class="footer-column footer-menu mb-4 mb-lg-0">
                 <h6 class="sub-menu__title text-uppercase">Company</h6>
                 <ul class="sub-menu__list list-unstyled">
                     <li class="sub-menu__item"><a href="{{route('main_page.about_us')}}" class="menu-link menu-link_us-s">About Us</a></li>
                     {{-- <li class="sub-menu__item"><a href="#" class="menu-link menu-link_us-s">Careers</a></li> --}}
                     <li class="sub-menu__item"><a href="{{route('main_page.faq')}}" class="menu-link menu-link_us-s">FAQ</a></li>
                     <li class="sub-menu__item"><a href="{{route('main_page.blogs')}}" class="menu-link menu-link_us-s">Blog</a></li>
                     <li class="sub-menu__item"><a href="{{route('main_page.contact')}}" class="menu-link menu-link_us-s">Contact Us</a></li>
                 </ul>
             </div><!-- /.footer-column -->


             <div class="footer-column footer-menu mb-4 mb-lg-0">
                 <h6 class="sub-menu__title text-uppercase">Shop</h6>
                 <ul class="sub-menu__list list-unstyled">
                     @foreach ($categories as $category)
                         <li class="sub-menu__item"><a href="{{ route('main_page.category_products', $category->slug) }}"
                                 class="menu-link menu-link_us-s">{{ $category->name }}</a></li>
                     @endforeach
                 </ul>
             </div><!-- /.footer-column -->

             <div class="footer-column footer-menu mb-4 mb-lg-0">
                 <h6 class="sub-menu__title text-uppercase">Help</h6>
                 <ul class="sub-menu__list list-unstyled">
                     @foreach ($policies as $policy)
                         <li class="sub-menu__item"><a href="{{ route('main_page.policy', $policy->slug) }}"
                                 class="menu-link menu-link_us-s">{{ $policy->title }}</a></li>
                     @endforeach
                 </ul>
             </div><!-- /.footer-column -->

             <div class="footer-column mb-4 mb-lg-0">
                 <h6 class="sub-menu__title text-uppercase">Get in touch</h6>
                 <ul class="list-unstyled">
                     <li><span class="menu-link">{{ $site_settings->phone_number }}</span></li>
                     <li><span class="menu-link">{{ $site_settings->email_address }}</span></li>
                     <li><span class="menu-link"><a href="https://maps.app.goo.gl/FeLAuxu6i5BwBj686" target="_blank">{{ $site_settings->address }}</a></span></li>
                 </ul>
                 <ul class="social-links list-unstyled d-flex mb-0">
                     @if ($site_settings->facebook !== '#')
                         <li>
                             <a target="_blank" href="{{ $site_settings->facebook }}" class="footer__social-link d-block">
                                 <svg class="svg-icon svg-icon_facebook" width="9" height="15"
                                     viewBox="0 0 9 15" xmlns="http://www.w3.org/2000/svg">
                                     <use href="#icon_facebook" />
                                 </svg>
                             </a>
                         </li>
                     @endif
                     @if ($site_settings->instagram !== '#')
                         <li>
                             <a target="_blank" href="{{ $site_settings->instagram }}" class="footer__social-link d-block">
                                 <svg class="svg-icon svg-icon_instagram" width="14" height="13"
                                     viewBox="0 0 14 13" xmlns="http://www.w3.org/2000/svg">
                                     <use href="#icon_instagram" />
                                 </svg>
                             </a>
                         </li>
                     @endif
                     @if ($site_settings->youtube !== '#')
                         <li>
                             <a target="_blank" href="{{ $site_settings->youtube }}" class="footer__social-link d-block">
                                 <svg class="svg-icon svg-icon_youtube" width="16" height="11"
                                     viewBox="0 0 16 11" xmlns="http://www.w3.org/2000/svg">
                                     <path
                                         d="M15.0117 1.8584C14.8477 1.20215 14.3281 0.682617 13.6992 0.518555C12.5234 0.19043 7.875 0.19043 7.875 0.19043C7.875 0.19043 3.19922 0.19043 2.02344 0.518555C1.39453 0.682617 0.875 1.20215 0.710938 1.8584C0.382812 3.00684 0.382812 5.46777 0.382812 5.46777C0.382812 5.46777 0.382812 7.90137 0.710938 9.07715C0.875 9.7334 1.39453 10.2256 2.02344 10.3896C3.19922 10.6904 7.875 10.6904 7.875 10.6904C7.875 10.6904 12.5234 10.6904 13.6992 10.3896C14.3281 10.2256 14.8477 9.7334 15.0117 9.07715C15.3398 7.90137 15.3398 5.46777 15.3398 5.46777C15.3398 5.46777 15.3398 3.00684 15.0117 1.8584ZM6.34375 7.68262V3.25293L10.2266 5.46777L6.34375 7.68262Z" />
                                 </svg>
                             </a>
                         </li>
                     @endif
                     @if ($site_settings->linkedin !== '#')
                         <li>
                             <a target="_blank" href="{{ $site_settings->linkedin }}" class="footer__social-link d-block">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                     fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                                     <path
                                         d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                                 </svg>
                             </a>
                         </li>
                     @endif
                     <li>
                        <a target="_blank" href="https://maps.app.goo.gl/jriVfeyopdTNBxyP9" class="footer__social-link d-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s-8-4.5-8-11.8A8 8 0 0 1 12 2a8 8 0 0 1 8 8.2c0 7.3-8 11.8-8 11.8z"/><circle cx="12" cy="10" r="3"/></svg>
                        </a>
                    </li>
                 </ul>
             </div><!-- /.footer-column -->
         </div><!-- /.row-cols-5 -->
     </div><!-- /.footer-middle container -->

     <div class="footer-bottom">
         <p style="text-align: center">© {{ now()->year }}
             {{ $site_settings->title }} </p>
     </div>
 </footer>
