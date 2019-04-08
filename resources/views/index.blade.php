<!--
author: W3layouts
author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- for-mobile-apps -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="Product,Discount,alibaba,aliexpress,alipapa,amazon" />
    <meta property="og:image" content="{{ asset('template/images/9.jpg') }}" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false);
        function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- //for-mobile-apps -->
    <link href="{{ asset('template/css/bootstrap.css') }}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{ asset('template/css/style.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!-- font-awesome icons -->
    <link href="{{ asset('template/css/font-awesome.css') }}" rel="stylesheet" type="text/css" media="all" />
    <!-- //font-awesome icons -->
    <!-- js -->
    <script src="{{ asset('template/js/jquery-1.11.1.min.js')}}"></script>
    <!-- //js -->
    <link href='//fonts.googleapis.com/css?family=Ubuntu:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <!-- start-smoth-scrolling -->
    <script type="text/javascript" src="{{ asset('template/js/move-top.js')}}"></script>
    <script type="text/javascript" src="{{ asset('template/js/easing.js')}}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>
    <!-- start-smoth-scrolling -->
</head>

<body>
<!-- header -->
<div class="agileits_header">
    <div class="w3l_offers">
        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank">Share on Facebook</a>
    </div>
    <div class="w3l_search">
        <form action="" method="get">
            <input type="text" name="name" value="{{ request('name')?request('name'):'Search a product...' }}" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search a product...';}" required="">
            <input type="submit" value=" ">
        </form>
    </div>

    <div class="w3l_header_right1" style="margin-right: 25px">
        <ul class="agileits_social_icons">
            <a style="color: #fff;margin-right: 15px;" id="subscribe" href="#newsletter">Subscribe!</a>
            <li><a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
            <li><a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
        </ul>
    </div>
    <div class="clearfix"> </div>
</div>
<!-- script-for sticky-nav -->
<script>
    $(document).ready(function() {
        var navoffeset=$(".agileits_header").offset().top;
        $(window).scroll(function(){
            var scrollpos=$(window).scrollTop();
            if(scrollpos >=navoffeset){
                $(".agileits_header").addClass("fixed");
            }else{
                $(".agileits_header").removeClass("fixed");
            }
        });

    });
</script>
<!-- //script-for sticky-nav -->
<div class="logo_products">
    <div class="container">
        <div class="w3ls_logo_products_left">
            <h1><a href="/"><span>Vouchers</span> Reward</a></h1>
        </div>
        <div class="w3ls_logo_products_left1">
            <div class="row">
                <div class="col-md-6">
                    <!-- admitad.banner: v619tsl55d1f00aba47016525dc3e8 Aliexpress WW -->
                    <a target="_blank" rel="nofollow" href="https://alitems.com/g/v619tsl55d1f00aba47016525dc3e8/?i=4"><img width="350" height="60" border="0" src="https://ad.admitad.com/b/v619tsl55d1f00aba47016525dc3e8/" alt="Aliexpress WW"></a>
                    <!-- admitad.banner: 6bek0vdhig1f00aba47016525dc3e8 Aliexpress WW -->
                </div>
                <div class="col-md-6">
                    <a target="_blank" rel="nofollow" href="https://alitems.com/g/6bek0vdhig1f00aba47016525dc3e8/?i=4"><img width="350" height="60" border="0" src="https://ad.admitad.com/b/6bek0vdhig1f00aba47016525dc3e8/" alt="Aliexpress WW"></a>

                    <!-- /admitad.banner --><!-- /admitad.banner -->
                </div>
            </div>
        </div>
        <div class="clearfix"> </div>
    </div>
</div>
<!-- //header -->

<!-- banner -->
<div class="banner">
    <div class="w3l_banner_nav_left">
        <nav class="navbar nav_bottom">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header nav_2">
                <button type="button" class="navbar-toggle collapsed navbar-toggle1" data-toggle="collapse" data-target="#bs-megadropdown-tabs">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-megadropdown-tabs">
                <ul class="nav navbar-nav nav_1">
                    @foreach($parents as $parent)
                        <li class="dropdown mega-dropdown active">
                            <a href="{{ count($parent->categories)?'':route('home.byParentCategory',['id'=>$parent->id]) }}"
                            {{ count($parent->categories)?'class="dropdown-toggle" data-toggle="dropdown"':'' }}
                            >{{ ucwords($parent->name) }}{!!  count($parent->categories)?'<span class="caret"></span>':'' !!}</a>
                           @if(count($parent->categories))
                                <div class="dropdown-menu mega-dropdown-menu w3ls_vegetables_menu">
                                    <div class="w3ls_vegetables">
                                        <ul>
                                            @foreach($parent->categories as $category)
                                            <li><a href="{{ route('home.byCategory',['id'=>$category->id]) }}">{{ ucwords($category->name) }}</a></li>
                                                <hr style="margin-top: 5px;margin-bottom: 5px;">
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </div>
    <div class="w3l_banner_nav_right">
        <div class="w3l_banner_nav_right_banner3">
            <h3>Best Deals For {{ ucwords($category_name) }}<span class="blink_me"></span></h3>
        </div>
        <br>
        <br>
        <div class="w3ls_w3l_banner_nav_right_grid">

            <h3>{{ ucwords($category_name) }}!</h3>

            <div class=" w3ls_w3l_banner_nav_right_grid1">

                @forelse($products as $product)
                    <div class="col-md-4 w3ls_w3l_banner_left" style="margin-top: 15px;">
                        <div class="hover14 column">
                            <div class="agile_top_brand_left_grid w3l_agile_top_brand_left_grid">
                                <div class="agile_top_brand_left_grid_pos days-after-cont">
                                    <h7 class="days-after text-center"><span>{{ $product->end_date }}</span></h7>

                                    {{--<img src="{{ asset('template/images/offer.png')}}" alt=" " class="img-responsive" />--}}
                                </div>
                                <div class="agile_top_brand_left_grid1">
                                    <figure>
                                        <div class="snipcart-item block">
                                            <div class="snipcart-thumb">
                                                <a href="#"><img src="{{ $product->image }}" alt=" " class="img-responsive" style="height: 220px;" /></a>
                                                <p class="full-title" data-toggle="tooltip" data-title="{{ $product->title }}" style="cursor: pointer;">{{ str_limit($product->title,30) }}</p>
                                                <h4 class="text-center"><span>{{ $product->old_price }}{{ $product->currency_id }}</span> <i class="fa fa-arrow-right"></i> {{ $product->price }}</h4>
                                            </div>
                                            <div class="snipcart-details" style="margin: 10px 0px;">
                                                <a href="{{ route('link.visits',['id'=>$product->id]) }}?url={{ urlencode($product->coupon_url) }}" target="_blank" class="button">Buy Now!</a>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-md-4 w3ls_w3l_banner_left" style="margin-top: 15px;">
                       <div>No Products Found!</div>
                    </div>
                @endforelse
                <div class="clearfix"> </div>
            </div>
        </div>
        <div class="row pagination-cont text-center">
            @if(count($products) && $products->lastPage()>1)
                {{ $products->onEachSide(1)->links('partials.paginate') }}
            @endif
        </div>
    </div>

    <div class="clearfix"></div>
</div>
<!-- //banner -->
<!-- newsletter -->
<div class="newsletter" id="newsletter">
    <div class="container">
        <div class="w3agile_newsletter_left">
            <h3>sign up for our newsletter</h3>
        </div>
        <div class="w3agile_newsletter_right">
            <form action="{{ route('home.subscribe') }}" method="post">
                @csrf
                <input type="email" name="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
                <input type="submit" value="subscribe now">
            </form>
        </div>
        <div class="clearfix"> </div>
    </div>
    <div class="">
        <a href="http://trkur4.com/338941/38834?i=432419"><img src="{{ asset('ad-images/432419-250x250.jpg') }}"></a>
        <a href="http://trkur.com/338941/15951?i=262624"><img src="{{ asset('ad-images/262624-250x250.jpg') }}" ></a>
        <a href="http://trkur4.com/338941/38834?i=431953"><img src="{{ asset('ad-images/431953-250x250.jpg') }}" ></a>
        <a href="http://revshr4.com/cm/338941/390?i=270338"><img src="{{ asset('ad-images/270338-180x150.jpg') }}" ></a>
        <a href="http://revshr4.com/cm/338941/543?i=461936"><img src="{{ asset('ad-images/461936-250x250.jpg') }}" ></a>
        <a href="http://revshr4.com/cm/338941/390?i=270355"><img src="{{ asset('ad-images/270355-250x125.png') }}" ></a>
        <a href="http://revshr4.com/cm/338941/543?i=461933"><img src="{{ asset('ad-images/461933-250x250.jpg') }}" ></a>
    </div>
</div>
<!-- //newsletter -->
<!-- footer -->
<div class="footer">
    <div class="container">
        <div class="col-md-4 w3_footer_grid">
            <h3>policy info</h3>
            <ul class="w3_footer_grid_list">
                <li><a href="faqs.html">FAQ</a></li>
                <li><a href="privacy.html">privacy policy</a></li>
                <li><a href="privacy.html">terms of use</a></li>
            </ul>
        </div>
        <div class="col-md-4 w3_footer_grid">
            <h3>what in stores</h3>
            <ul class="w3_footer_grid_list">
                @foreach($parents as $parent)
                    @if($parent->id % 2 != 0)
                <li><a href="{{ route('home.byParentCategory',['id'=>$parent->id]) }}">{{ ucwords($parent->name) }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-md-4 w3_footer_grid">
            <h3>what in stores</h3>
            <ul class="w3_footer_grid_list">
                @foreach($parents as $parent)
                    @if($parent->id % 2 == 0)
                    <li><a href="{{ route('home.byParentCategory',['id'=>$parent->id]) }}">{{ ucwords($parent->name) }}</a></li>
                    @endif
                @endforeach
            </ul>
        </div>

        <div class="clearfix"> </div>
        <div class="agile_footer_grids">
            <div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
                <div class="w3_footer_grid_bottom">
                    <h4>100% secure payments</h4>
                    <img src="{{ asset('template/images/card.png')}}" alt=" " class="img-responsive" />
                </div>
            </div>
            <div class="col-md-3 w3_footer_grid agile_footer_grids_w3_footer">
                <div class="w3_footer_grid_bottom">
                    <h5>connect with us</h5>
                    <ul class="agileits_social_icons">
                        <li><a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#" class="dribbble"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="clearfix"> </div>
        </div>
        <div class="wthree_footer_copy">
            <p>© 2016 Grocery Store. All rights reserved | Design by <a href="http://w3layouts.com/">W3layouts</a></p>
        </div>
    </div>
</div>
<!-- //footer -->
<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('template/js/bootstrap.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.0.1/dist/sweetalert2.all.min.js"></script>
<script>
    $(document).ready(function(){
        $(".dropdown").hover(
            function() {
                $('.dropdown-menu', this).stop( true, true ).slideDown("fast");
                $(this).toggleClass('open');
            },
            function() {
                $('.dropdown-menu', this).stop( true, true ).slideUp("fast");
                $(this).toggleClass('open');
            }
        );
    });
</script>
<!-- here stars scrolling icon -->
<script type="text/javascript">
    $(document).ready(function() {
        /*
            var defaults = {
            containerID: 'toTop', // fading element id
            containerHoverID: 'toTopHover', // fading element hover id
            scrollSpeed: 1200,
            easingType: 'linear'
            };
        */

        $().UItoTop({ easingType: 'easeOutQuart' });
        $("#subscribe").click(function() {
            $('html, body').animate({
                scrollTop: $("#newsletter").offset().top
            }, 2000);
        });
        $(".full-title").tooltip();


    });
</script>
<!-- //here ends scrolling icon -->
<script src="{{ asset('template/js/minicart.js')}}"></script>
<script>
    paypal.minicart.render();

    paypal.minicart.cart.on('checkout', function (evt) {
        var items = this.items(),
            len = items.length,
            total = 0,
            i;

        // Count the number of each item in the cart
        for (i = 0; i < len; i++) {
            total += items[i].get('quantity');
        }

        if (total < 3) {
            alert('The minimum order quantity is 3. Please add more to your shopping cart before checking out');
            evt.preventDefault();
        }
    });

</script>
@if(session()->has('error'))

    <script type="text/javascript">
        $(document).ready(function(){
            Swal.fire({
                position: 'center',
                type: 'error',
                title: 'Error!',
                text: "{{ session('error') }}",
                showConfirmButton: true,
                timer: 3000
            });
            $('.swal2-container').css('z-index','30000');
        });
    </script>
@endif
@if(session()->has('success'))
    <script type="text/javascript">
        $(document).ready(function(){
            Swal.fire({
                position: 'center',
                type: 'success',
                title: 'Success!',
                text: "{{ session('success') }}",
                showConfirmButton: true,
                timer: 3000
            });
            $('.swal2-container').css('z-index','30000');
        });
    </script>
@endif
</body>
</html>
