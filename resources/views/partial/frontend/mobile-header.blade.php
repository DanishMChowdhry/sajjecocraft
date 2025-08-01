 <div class="header-mobile header_sticky">
     <div class="container d-flex align-items-center h-100">
         <a class="mobile-nav-activator d-block position-relative" href="#">
             <svg class="nav-icon" width="25" height="18" viewBox="0 0 25 18" xmlns="http://www.w3.org/2000/svg">
                 <use href="#icon_nav" />
             </svg>
             <span class="btn-close-lg position-absolute top-0 start-0 w-100"></span>
         </a>

         <div class="logo">
             <a href="{{ route('main_page.index') }}">
                 <img src="{{ url($site_settings->logo_dark_image) }}" style="width: 150px;height:auto;" alt="Uomo"
                     class="logo__image d-block">
             </a>
         </div><!-- /.logo -->

         <a href="#" class="header-tools__item header-tools__cart js-open-aside" data-aside="cartDrawer">
             <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                 xmlns="http://www.w3.org/2000/svg">
                 <use href="#icon_cart" />
             </svg>
             <span class="cart-amount d-block position-absolute js-cart-items-count">3</span>
         </a>
     </div><!-- /.container -->

     <nav
         class="header-mobile__navigation navigation d-flex flex-column w-100 position-absolute top-100 bg-body overflow-auto">
         <div class="container">
             <form action="{{ route('main_page.search') }}" method="GET"
                 class="search-field position-relative mt-4 mb-3">
                 <div class="position-relative">
                     <input class="search-field__input w-100 border rounded-1" type="text" name="search"
                         id="search" placeholder="Search products" value="{{ request('search') }}">

                     <button class="btn-icon search-popup__submit pb-0 me-2" type="submit">
                         <svg class="d-block" width="20" height="20" viewBox="0 0 20 20" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                             <use href="#icon_search" />
                         </svg>
                     </button>

                     <button class="btn-icon btn-close-lg search-popup__reset pb-0 me-2" type="reset"></button>
                 </div>

                 <div class="position-absolute start-0 top-100 m-0 w-100">
                     <div class="search-result"></div>
                 </div>
             </form>

         </div><!-- /.container -->

         <div class="container">
             <div class="overflow-hidden">
                 <ul class="navigation__list list-unstyled position-relative">
                     <li class="navigation__item">
                         <a href="{{ url('/') }}" class="navigation__link">Home</a>
                     </li>
                     <li class="navigation__item">
                         <a href="{{route('main_page.shop')}}" class="navigation__link">Shop</a>
                     </li>
                     <li class="navigation__item">
                         <a href="{{route('main_page.about_us')}}" class="navigation__link">About Us</a>
                     </li>
                     <li class="navigation__item">
                         <a href="{{route('main_page.blogs')}}" class="navigation__link">Blogs</a>
                     </li>
                     <li class="navigation__item">
                         <a href="{{route('main_page.contact')}}" class="navigation__link">Contact Us</a>
                     </li>

                 </ul><!-- /.navigation__list -->
             </div><!-- /.overflow-hidden -->
         </div><!-- /.container -->

         <div class="border-top mt-auto pb-2">
             <div class="customer-links container mt-4 mb-2 pb-1">
                 <svg class="d-inline-block align-middle" width="20" height="20" viewBox="0 0 20 20"
                     fill="none" xmlns="http://www.w3.org/2000/svg">
                     <use href="#icon_user" />
                 </svg>
                 <span class="d-inline-block ms-2 text-uppercase align-middle fw-medium">My Account</span>
             </div>


             <ul class="container social-links list-unstyled d-flex flex-wrap mb-0">
                 <li>
                     <a href="{{ $site_settings->facebook }}" class="footer__social-link d-block ps-0">
                         <svg class="svg-icon svg-icon_facebook" width="9" height="15" viewBox="0 0 9 15"
                             xmlns="http://www.w3.org/2000/svg">
                             <use href="#icon_facebook" />
                         </svg>
                     </a>
                 </li>
                 <li>
                     <a href="{{ $site_settings->linkedin }}" class="footer__social-link d-block">
                         <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                             class="bi bi-linkedin" viewBox="0 0 16 16">
                             <path
                                 d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z" />
                         </svg>
                     </a>
                 </li>
                 <li>
                     <a href="{{ $site_settings->instagram }}" class="footer__social-link d-block">
                         <svg class="svg-icon svg-icon_instagram" width="14" height="13" viewBox="0 0 14 13"
                             xmlns="http://www.w3.org/2000/svg">
                             <use href="#icon_instagram" />
                         </svg>
                     </a>
                 </li>
                 <li>
                     <a href="{{ $site_settings->youtube }}" class="footer__social-link d-block">
                         <svg class="svg-icon svg-icon_youtube" width="16" height="11" viewBox="0 0 16 11"
                             xmlns="http://www.w3.org/2000/svg">
                             <path
                                 d="M15.0117 1.8584C14.8477 1.20215 14.3281 0.682617 13.6992 0.518555C12.5234 0.19043 7.875 0.19043 7.875 0.19043C7.875 0.19043 3.19922 0.19043 2.02344 0.518555C1.39453 0.682617 0.875 1.20215 0.710938 1.8584C0.382812 3.00684 0.382812 5.46777 0.382812 5.46777C0.382812 5.46777 0.382812 7.90137 0.710938 9.07715C0.875 9.7334 1.39453 10.2256 2.02344 10.3896C3.19922 10.6904 7.875 10.6904 7.875 10.6904C7.875 10.6904 12.5234 10.6904 13.6992 10.3896C14.3281 10.2256 14.8477 9.7334 15.0117 9.07715C15.3398 7.90137 15.3398 5.46777 15.3398 5.46777C15.3398 5.46777 15.3398 3.00684 15.0117 1.8584ZM6.34375 7.68262V3.25293L10.2266 5.46777L6.34375 7.68262Z" />
                         </svg>
                     </a>
                 </li>
             </ul>
         </div>
     </nav><!-- /.navigation -->
 </div><!-- /.header-mobile -->
