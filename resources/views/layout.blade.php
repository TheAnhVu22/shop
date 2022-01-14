<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{csrf_token()}}">
        {{-- 
        <meta name="description" content="{{$meta_desc}}"/>
        <meta name="keywords" content="{{$meta_keywords}}"/>
        <meta name="robots" content="index, follow"> 
        <link rel="canonical" href="{{$url_canonical}}" />

        <!------Share------->
        <meta property="og:type" content="website" />

        <meta property="og:title" content="{{$meta_title}}" />

        <meta property="og:description" content="{{$meta_desc}}" />

        <meta property="og:image" content="{{$image_og}}" />

        <meta property="og:url" content="{{$url_canonical}}" />

        <meta property="og:site_name" content="Sachtruyen247" />

        

        <title>{{$meta_title}}</title>
        <!-- Styles --> --}}
        <link rel="icon" href="{{ asset('img/illustrations/illustration-reset.jpg') }}" type="image/gif" sizes="16x16">
        <meta property="og:url"                content="http://www.nytimes.com/2015/02/19/arts/international/when-great-minds-dont-think-alike.html" />
        <meta property="og:type" content="WEBSITE" />
        <meta property="og:title" content="ATV SHOP" />
        <meta property="og:description" content="Chuyên bán đồ điện tử chính hãng" />
        <meta property="og:image" content="http://static01.nyt.com/images/2015/02/19/arts/international/19iht-btnumbers19A/19iht-btnumbers19A-facebookJumbo-v2.jpg" />
    <!--//-------Seo--------->
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <script src="https://kit.fontawesome.com/f8077388f9.js" crossorigin="anonymous"></script>
        <!-- Styles -->
    <meta name="description" content="">
    <meta name="author" content="">
   
    <link href="{{ asset('css/sweetalert.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ asset('css/price-range.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/responsive.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    
    {{-- css cho gallery ảnh trong chi tiết sản phẩm --}}
    <link href="{{ asset('css/lightgallery.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/lightslider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/prettify.css') }}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144xhttps://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css144" href="{{ asset('images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/ico/apple-touch-icon-57-precomposed.png') }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.default.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
</head>
<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +0374667xxx</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> theanhvuxx@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                       <div class="contactinfo pull-right">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fas fa-clock"></i> 8am - 6pm</a></li>
                                <li><a href="#"><i class="far fa-calendar-alt"></i> Thứ 2 - Thứ 6</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->
        
        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{ route('home') }}"><img src="{{ asset('images/home/logo.png') }}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    Tiếng Anh
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ url('lang/en') }}">Tiếng Anh</li>
                                    <li><a href="{{ url('lang/vi') }}">Tiếng Việt</a></li>
                                </ul>
                            </div>
                            
                            <div class="btn-group">
                                <button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
                                    VND
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Dollar</a></li>
                                    <li><a href="#">VND</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ route('taikhoan') }}"><i class="fa fa-user"></i> Tài khoản, lịch sử mua hàng</a></li>
                                <li><a href="{{ route('yeuthich') }}"><i class="fa fa-heart"></i> Yêu thích</a></li>

                             {{-- hiển thị giỏ hàng --}}
                                <style type="text/css">
                                    .shop-menu ul li.cart-hover{
                                        margin-top: 9px;
                                    }
                                    li.cart-hover{
                                        position: relative;
                                    }
                                    .shop-menu .hover-cart{
                                        display: none;
                                        position: absolute;
                                        z-index: 9999;
                                        background-color: #FAF6F5;
                                        padding: 0;
                                        margin: 0;
                                    }
                                    ul.hover-cart li{
                                        padding: 10px;
                                        border-bottom: 1px solid black;
                                    }
                                    
                                    li.cart-hover:hover .hover-cart{
                                        display: inherit;
                                        width: 200px;
                                    }

                                </style>
                       
                                <li class="cart-hover"> <div id="cart_count"></div>
                                    <div class="giohang_hover">
                                        
                                    </div>
                                    
                                </li>

                                

                                @php
                                    $customer_id = Session()->get('customer_id');
                                @endphp
                                @if ($customer_id == null)
                                    <li><a href="{{ route('login_checkout') }}"><i class="fas fa-sign-in-alt"></i> Đăng nhập</a></li>
                                @else
                                    <li><a href="{{ route('logout_checkout') }}"><i class="fas fa-sign-out-alt"></i> Đăng xuất</a></li>
                                @endif
                                
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-middle-->
    
        <div class="header-bottom"><!--header-bottom-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-9">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{ route('homepage') }}" class="{{Request::segment(1)=='' ? 'active' : ''}}"> @lang('lang.home')</a></li>
                                <li class="dropdown"><a class="{{Request::segment(1)=='danh_muc' ? 'active' : ''}}" href="#">{{__('lang.category')}}<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu" style="background-color:black;">
                                        @foreach ($category as $key => $dulieu)
                                            <li><a class="{{Request::segment(2)==$dulieu->category_slug ? 'active' : ''}}"  href="{{ route('danh_muc',$dulieu->category_slug) }}">{{$dulieu->category_name}}</a></li>
                                        @endforeach 
                                    </ul>
                                </li> 
                                <li class="dropdown"><a class="{{Request::segment(1)=='thuong_hieu' ? 'active' : ''}}" href="#">@lang('lang.brand')<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu" style="background-color:black;">
                                         @foreach ($brand as $key => $dulieu)
                                            <li><a class="{{Request::segment(2)==$dulieu->brand_slug ? 'active' : ''}}" href="{{ route('thuong_hieu',$dulieu->brand_slug) }}">{{$dulieu->brand_name}}</a></li>
                                        @endforeach 
                                    </ul>
                                </li> 
                                <li class="dropdown"><a class="{{Request::segment(1)=='tin_tuc' ? 'active' : ''}}" href="#">@lang('lang.blog')<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu" style="background-color:black;">
                                         @foreach ($cate_blog as $key => $dulieu)
                                            <li><a  href="{{ route('tin_tuc',$dulieu->cate_blog_slug) }}">{{$dulieu->cate_blog_name}}</a></li>
                                        @endforeach 
                                    </ul>
                                </li>
                                <li><a class="{{Request::segment(1)=='lien_he' ? 'active' : ''}}" href="{{ route('lien_he') }}">@lang('lang.contact')</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form autocomplete="off" class="form-inline my-2 my-lg-0" action="{{url('tim_kiem')}}" method="POST">
                            @csrf
                            <div class="row">
                              <input class="form-control mr-sm-2" id="keywords" type="search" name="tukhoa"aria-label="Search" style="background-color:#FFF1ED ; color: black;">
                              
                              <button class="btn btn-danger my-2 my-sm-0" type="submit">Tìm kiếm <i class="fas fa-search"></i></button>
                              </div>
                              <div id="search_ajax"></div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
    </header><!--/header-->
    
    <section id="slider"><!--slider-->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div id="slider-carousel" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">
                            @php
                                $i=0;
                            @endphp
                            @foreach ($slide as $key => $dulieu)
                            @php
                                 $i++;
                             @endphp  

                            <div class="item 
                            @if ($i==1)
                                active
                            @endif">
                               
                                <div class="col-12 text-center">
                                    <img src="{{ asset('uploads/'.$dulieu->slide_image) }}" class="responsive"  alt="" width="100%">
                                    {{-- <div >
                                    <h2 class="pricing" style="color: white;">{{$dulieu->slide_name}}</h2>
                                    <p>{{$dulieu->slide_desc}}</p></div> --}}
                                    <img src="images/home/pricing.png"  class="pricing" alt=""/>
                                </div>
                            </div>
                            {{-- expr --}}
                            @endforeach
                            
                        </div>
                        
                        {{-- <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a> --}}
                    </div>
                    
                </div>
            </div>
        </div>
    </section><!--/slider-->
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Danh mục <i class="fas fa-bars"></i></h2>
                        <div class="panel-group category-products" id="accordian">
                         @foreach ($category as $key => $dulieu)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a class="{{Request::segment(2)==$dulieu->category_slug ? 'btn btn-sm btn-outline-dark' : ''}}" href="{{ route('danh_muc',$dulieu->category_slug) }}">{{$dulieu->category_name}}</a></h4>
                                </div>
                            </div>
                         @endforeach   
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu <i class="fas fa-star-half-alt"></i></h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                 @foreach ($brand as $key => $dulieu)   
                                    <li><a  class="{{Request::segment(2)==$dulieu->brand_slug ? 'btn btn-outline-info' : ''}}" href="{{ route('thuong_hieu',$dulieu->brand_slug) }}"> <span class="pull-right">
                                        @php
                                            $dem=0;
                                        @endphp
                                        @foreach ($dulieu->product as $k1 => $v1)
                                        @php
                                            $dem++;
                                        @endphp

                                    @endforeach
                                    ({{$dem}})
                                </span>{{$dulieu->brand_name}}</a></li>
                                  @endforeach 

                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                        <div class="brands_products">
                            <h4>Sản phẩm đã xem</h4>
                            <div class="brands-name">
                                <div class="row" id="row_viewed"></div>
                            </div>
                        </div>
                        
                        <div class="shipping text-center"><!--shipping-->
                            <img src="{{ asset('images/home/shipping.jpg') }}" alt="" />
                        </div><!--/shipping-->
                    
                    </div>
                </div>
                
                <div class="col-sm-9 padding-right">
                   
                   @yield('content')
                    
                </div>
            </div>
        </div>
    </section>
    
    <footer id="footer"><!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-2">
                        <div class="companyinfo">
                            <h2><span>ATV</span>-SHOP</h2>
                            <p>Hàng Việt Nam chất lượng cao</p>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                               
                                    <div class="iframe-img">
                                        <iframe width="100" height="100" src="https://www.youtube.com/embed/BsVm_msaNcA" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                   
                                
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                    <div class="iframe-img">
                                        <iframe width="100" height="100" src="https://www.youtube.com/embed/d4Ame6YME-U" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                
                                    <div class="iframe-img">
                                        <iframe width="100" height="100" src="https://www.youtube.com/embed/u-7Y8hqgb30" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    
                            </div>
                        </div>
                        
                        <div class="col-sm-3">
                            <div class="video-gallery text-center">
                                
                                    <div class="iframe-img">
                                        <iframe width="100" height="100" src="https://www.youtube.com/embed/rbrwIiD_y94" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                    </div>
                                    
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{ asset('images/home/map.png') }}" alt="" />
                            <p>HANOI-VIETNAM</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="footer-widget">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Thông tin</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li>Thời gian mở cửa từ 8am-20pm</li>
                                <li>Từ thứ 2 đến thứ 6 (cả ngày lễ)</li>
                                <li>Hotline: 0374667xxx</li>
                                <li>Email: theanhvuxx@gmail.com</li>
                                
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Chính sách</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="http://shopanhthe.com/shop/public/view_blog/chinh-sach-giao-hang">Chính sách giao hàng</a></li>
                                <li><a href="http://shopanhthe.com/shop/public/view_blog/chinh-sach-bao-hanh">Chính sách bảo hành</a></li>
                                <li><a href="http://shopanhthe.com/shop/public/view_blog/noi-quy-cua-hang">Nội quy cửa hàng</a></li>
                                <li><a href="http://shopanhthe.com/shop/public/view_blog/huong-dan-mua-hang">Hướng dẫn mua hàng</a></li>
                                <li><a href="http://shopanhthe.com/shop/public/view_blog/canh-bao-gia-mao">Cảnh báo giả mạo</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Danh mục</h2>
                            @foreach ($category as $key => $dulieu)
                            <ul >
                                
                                    <li ><a href="{{ route('danh_muc',$dulieu->category_slug) }}" style="color:black">{{$dulieu->category_name}}</a></li>

                               </ul>
                         @endforeach
                                
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="single-widget">
                            <h2>Bản đồ</h2>
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14898.065398380037!2d105.77333698421877!3d21.01201587721354!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135acaacbd219c7%3A0xe19b302ae07c6203!2zTmfDtSAxNCBN4buFIFRyw6wgSOG6oSwgTeG7hSBUcsOsLCBOYW0gVOG7qyBMacOqbSwgSMOgIE7hu5lpLCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1641700201629!5m2!1svi!2s" width="180" height="200" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Copyright © 2013 E-SHOPPER Inc. All rights reserved.</p>
                    <p class="pull-right">Designed by <span><a target="_blank" href="http://www.themeum.com">Themeum</a></span></p>
                </div>
            </div>
        </div>
        
    </footer><!--/Footer-->
    

  
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
    <script src="{{ asset('js/price-range.js') }}"></script>
    <script src="{{ asset('js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    
    

    <script type="text/javascript">
    $(document).ready(function(){
        tab();
        function tab() {
            const danhmuc_id = 1;
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/tabs_danhmuc')}}',
                method:"POST",

                data:{_token:_token, danhmuc_id:danhmuc_id},
                success:function(data){
                    $('#tab_danhmuctruyen').html(data);

                }

            }); 
        }
   $('.tabs_danhmuc').click(function(){
    $('.demo').removeClass('active');
    const danhmuc_id = $(this).data('danhmuc_id');
    var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/tabs_danhmuc')}}',
                method:"POST",

                data:{_token:_token, danhmuc_id:danhmuc_id},
                success:function(data){
                    $('#tab_danhmuctruyen').empty();
                    $('#tab_danhmuctruyen').html(data);

                }

            }); 
            }); 
   })
 </script>

 <!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "100155512433949");
      chatbox.setAttribute("attribution", "biz_inbox");
    </script>

    <!-- Your SDK code -->
    <script>
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v12.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

    {{-- // js SDK liên kết facebook --}}
      <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v12.0" nonce="QTtQYjTq"></script>

 <script src="https://www.google.com/recaptcha/api.js" async defer></script>  

<script src="{{ asset('js/sweetalert.js') }}"></script>
 <script type="text/javascript">
        giohang_hover();
            function giohang_hover() {
                $.ajax({
                    url:"{{ url('/giohang_hover') }}",
                    method:'GET',
                    success:function(data){
                        $('.giohang_hover').html(data);
                    }
                });
            }
            count_cart();
            function count_cart() {
                $.ajax({
                    url:"{{ url('/count_cart') }}",
                    method:'GET',
                    success:function(data){
                        $('#cart_count').html(data);
                    }
                });
            }
            function show_quick_cart() {
                $.ajax({
                    url:"{{ url('/show_quick_cart') }}",
                    method:'GET',
                    success:function(data){
                        $('#cart_show').html(data);
                        $('#quick-cart').modal();
                    }
                    });
            }
            function delete_cart_product(id) {
                var id = id;
                $.ajax({
                    url:"{{ url('/delete_quick_cart') }}",
                    method:'POST',
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    data:{id:id},
                    success:function(){
                        
                        count_cart();
                        giohang_hover();
                        show_quick_cart();
                    }
                    });
            }
            function addtocart(product_id){
                var id = product_id;
                 //alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                // alert(cart_product_id)
                // alert(cart_product_name)
                // alert(cart_product_image)
                // alert(cart_product_quantity)
                // alert(cart_product_price)
                // alert(cart_product_qty)
                // alert(_token)
                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                }else{

                    $.ajax({

                        url: '{{url('/add_cart_ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        success:function(){
                            
                            // swal({
                            //         title: "Thêm vào giỏ hàng thành công !",
                            //         //text: "Bạn muốn mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                            //         showCancelButton: true,
                            //         cancelButtonText: "Xem tiếp",
                            //         confirmButtonClass: "btn-success",
                            //         confirmButtonText: "Đi đến giỏ hàng",
                            //         closeOnConfirm: false
                            //     },
                                // function() {
                                //     window.location.href = "{{url('/gio_hang')}}";
                                // });
                            
                        count_cart();
                        giohang_hover();
                        show_quick_cart();
                        
                        }

                    });
                }

                
            }
        $(document).ready(function(){

            $('.add-to-cart').click(function(){
                var id = $(this).data('id_product');
                 //alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                // alert(cart_product_id)
                // alert(cart_product_name)
                // alert(cart_product_image)
                // alert(cart_product_quantity)
                // alert(cart_product_price)
                // alert(cart_product_qty)
                // alert(_token)
                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                }else{

                    $.ajax({

                        url: '{{url('/add_cart_ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        success:function(){

                            swal({
                                    title: "Thêm vào giỏ hàng thành công !",
                                    //text: "Bạn muốn mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio_hang')}}";
                                });
                        count_cart();
                        giohang_hover();
                        }

                    });
                }

                
            });

            

        });
    </script>

    {{-- tìm kiếm ajax --}}
    <script type="text/javascript">
      $('#keywords').keyup(function(){
          var query = $(this).val();

            if(query != '')
              {
               var _token = $('input[name="_token"]').val();

               $.ajax({
                url:"{{url('/autocomplete-ajax')}}",
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){
                 $('#search_ajax').fadeIn();  
                  $('#search_ajax').html(data);
                }
               });

              }else{

                $('#search_ajax').fadeOut();  
              }
          });

          $(document).on('click', '.li_search_ajax', function(){  
              $('#keywords').val($(this).text());  
              $('#search_ajax').fadeOut();  
          }); 
      </script>

      <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
           
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        });
        });
          
    </script>
    <!----------- tính phí vận chuyển ----------->
    <script type="text/javascript">
        $(document).ready(function(){
            $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh =='' && xaid ==''){
                    alert('Làm ơn chọn để tính phí vận chuyển');
                }else{
                    $.ajax({
                    url : '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(){
                        location.reload(); 
                       // alert(data);
                    }
                    });
                } 
        });
    });
    </script>

    <script type="text/javascript">

          $(document).ready(function(){
            $('.send_order').click(function(){
                swal({
                  title: "Xác nhận đơn hàng",
                  text: "Đơn hàng sẽ không được hoàn trả khi đặt,bạn có muốn đặt không?",
                  type: "warning",
                  showCancelButton: true,
                  confirmButtonClass: "btn-danger",
                  confirmButtonText: "Cảm ơn, Mua hàng",

                    cancelButtonText: "Đóng,chưa mua",
                    closeOnConfirm: false,
                    closeOnCancel: false
                },
                function(isConfirm){
                     if (isConfirm) {
                        var shipping_email = $('.shipping_email').val();
                        var shipping_name = $('.shipping_name').val();
                        var shipping_address = $('.shipping_address').val();
                        var shipping_phone = $('.shipping_phone').val();
                        var shipping_note = $('.shipping_note').val();
                        var shipping_method = $('.payment_select').val();
                        var order_fee = $('.order_fee').val();
                        var order_coupon = $('.order_coupon').val();
                        var _token = $('input[name="_token"]').val();

                        $.ajax({
                            url: '{{url('/confirm-order')}}',
                            method: 'POST',
                            data:{shipping_email:shipping_email,shipping_name:shipping_name,shipping_address:shipping_address,shipping_phone:shipping_phone,shipping_note:shipping_note,_token:_token,order_fee:order_fee,order_coupon:order_coupon,shipping_method:shipping_method},
                            success:function(){
                               swal("Đơn hàng", "Đơn hàng của bạn đã được gửi thành công", "success");
                            }
                        });
                window.setTimeout(function(){ 
                            location.reload();
                        } ,3000);

                        
                      } else {
                        swal("Đóng", "Đơn hàng chưa được gửi", "error");

                      }
              
                });

               
            });
        });
    

    </script>

<script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>
    <script type="text/javascript">
       var owl = $('.owl-carousel');
        owl.owlCarousel({
            items:3,
            loop:true,
            margin:10,
            autoplay:true,
            autoplayTimeout:3000,
            autoplayHoverPause:true
        });
        $('.play').on('click',function(){
            owl.trigger('play.owl.autoplay',[1000])
        })
        $('.stop').on('click',function(){
            owl.trigger('stop.owl.autoplay')
        })
    </script>

    {{-- script cho gallery ảnh trong chi tiết sản phẩm --}}
    <script type="text/javascript" src="{{ asset('js/lightslider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/lightgallery-all.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/prettify.js') }}"></script>
    <script type="text/javascript">
          $(document).ready(function() {
    $('#imageGallery').lightSlider({
        gallery:true,
        item:1,
        loop:true,
        thumbItem:3,
        slideMargin:0,
        enableDrag: false,
        currentPagerPosition:'left',
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '#imageGallery .lslide'
            });
        }   
    });  
  });
    </script>

    {{-- Bình luận ajax --}}
    <script type="text/javascript">
        $(document).ready(function() {
            load_comment();

            function load_comment() {
                var pro_id = $('.pro_id').val();
                // alert(pro_id);               
                $.ajax({
                    url:'{{ route('loadcomment') }}',
                    method:'POST',
                    headers:{
                    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                  },
                    data:{pro_id:pro_id},
                    success:function(data) {
                        // alert(data);
                        $('#binhluan').html(data);
                    }
                });
            }

            $(document).on('click','.guibinhluan',function() {
                var pro_id = $('.pro_id').val();
                var comment_name = $('.comment_name').val();
                var comment_content = $('.comment_content').val();
                // alert(pro_id);
                // alert(comment_name);
                // alert(comment_content);
                $.ajax({
                    url:'{{ route('them_binhluan') }}',
                    method:'POST',
                    headers:{
                        'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
                    },
                    data:{pro_id:pro_id,comment_name:comment_name,comment_content:comment_content},
                    success:function() {
                        $('.comment_name').val("");
                        $('.comment_content').val("");
                        load_comment();
                    }
                });
            });

        });
    </script>

    <script type="text/javascript">
        function remove_background(product_id) {
            for(var count = 1; count <=5 ; count++){
               $('#'+product_id+'-'+count).css('color','#ccc'); 
            }
        }
        //hover chuột đánh giá sao
        $(document).on('mouseenter','.rating',function() {
            var index=$(this).data('index');
            var product_id=$(this).data('product_id');
            remove_background(product_id);
            for(var count = 1; count <=index ; count++){
               $('#'+product_id+'-'+count).css('color','#ffcc00'); 
            }
        });
        //nhả chuột khỏi đánh giá sao
        $(document).on('mouseleave','.rating',function() {
            var index=$(this).data('index');
            var product_id=$(this).data('product_id');
            var rating=$(this).data('rating');
            remove_background(product_id);
            for(var count = 1; count <=rating ; count++){
               $('#'+product_id+'-'+count).css('color','#ffcc00'); 
            }
        });
        $(document).on('click','.rating',function() {
            var index=$(this).data('index');
            var product_id=$(this).data('product_id');
            
            $.ajax({
                url:'{{ route('insert_rating') }}',
                method:'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:{index:index,product_id:product_id},
                success:function(data){
                    if(data=="ok"){
                        alert('Đánh giá thành công '+index+' sao ');
                    }
                    else{
                        alert('đánh giá thất bại');
                    }
                }
            });
        });
    </script>

    {{-- ----- Lưu sản phẩm yêu thích ---- --}}
    <script type="text/javascript">
      show_wishlist();
      function show_wishlist(){
          if(localStorage.getItem('wishlist_sp')!=null){
            // chuyển chuỗi json thành đối tượng js JSON.parse
             var data = JSON.parse(localStorage.getItem('wishlist_sp'));
             // đảo ngược mảng: thêm cuối sẽ hiển thị đầu tiên
             data.reverse();

             for(i=0;i<data.length;i++){

                var title = data[i].title.substring(0, 20);
                var img = data[i].img;
                var id = data[i].id;
                var url = data[i].url;
                var price = new Intl.NumberFormat('de-DE').format(data[i].price);
                
                $('#yeuthich').append(` 
                  <div class="col-sm-4">
                        <div class="product-image-wrapper">                       
                            <div class="single-products">
                                 <div class="productinfo text-center">                              
                                    <a href="`+url+`">
                                        <img src="`+img+`" alt="" />
                                        <h4>`+title+`</h4>
                                        <h3>`+price+` vnđ</h3>                                    
                                     </a>                               <button data-idsp="`+id+`" class="btn btn-primary btn_xoa_sp mt-2"><i class="fa fa-heart" aria-hidden="true"></i> Xóa yêu thích</button>  
                                </div>
                            </div>
                        </div>
                   </div>
                 `);
            }

          }
      }
      $('.btn_thich').click(function(){
        $('.fa.fa-heart').css('color','black');
        const id = $('.wishlist_id').val();       
        const title = $('.wishlist_title').val();
        const img = $('.card-img-top').val();
        const url = $('.wishlist_url').val();
        const price = $('.wishlist_price').val();
    
        const item = {
          'id': id,
          'title': title,
          'img': img,
          'url': url,
          'price':price
          
        }
        if(localStorage.getItem('wishlist_sp')==null){
           localStorage.setItem('wishlist_sp', '[]');
        }
        var old_data = JSON.parse(localStorage.getItem('wishlist_sp'));
        
        // tìm kiếm phần tử có id trong wishlist
        var matches = $.grep(old_data, function(obj){
            return obj.id == id;
        })
        // nếu có phần tử trùng
        if(matches.length){
            alert('Sản phẩm đã có trong danh sách yêu thích');
        }else{
            if(old_data.length<=6){
              old_data.push(item);
            }else{
              alert('Chỉ lưu tối đa 6 sản phẩm');
            }
             // chuyển từ đối tượng js sang json: JSON.stringify
            localStorage.setItem('wishlist_sp', JSON.stringify(old_data));
            alert('Đã lưu vào danh sách yêu thích.');
            
        }
         localStorage.setItem('wishlist_sp', JSON.stringify(old_data));
 
      }
      );
   
    </script>
    <script type="text/javascript">
       $('.btn_xoa_sp').click(function(){
       $('.fa.fa-heart').css('color','#fac');
        const id_xoa = $(this).data('idsp');
         delete_wishlist();
      function delete_wishlist(){
          if(localStorage.getItem('wishlist_sp')!=null){
            // chuyển chuỗi json thành đối tượng js JSON.parse
             var data = JSON.parse(localStorage.getItem('wishlist_sp'));
            
             for(i=0;i<data.length;i++){                
                var id = data[i].id;
                if(id==id_xoa){
                  data.splice(i,1);
                  localStorage.setItem('wishlist_sp', JSON.stringify(data));
                  $('#yeuthich').empty();
                }
             }
          }
       }
       
       show_wishlist();
      });
    </script>

    <script type="text/javascript">
       $('.xoa_yeuthich').click(function(){
        localStorage.removeItem("wishlist_sp"); 
        window.setTimeout(function(){ 
                            location.reload();
                        } ,500);  
      });
    </script>
     {{-- ----- end Lưu sản phẩm yêu thích ---- --}}

     <script type="text/javascript">
         $(document).ready(function() {
            $('#sort').on('change',function() {
                var url = $(this).val();
                // alert(url);
                if(url){
                    window.location = url;
                }
                return false;
            });
         });
     </script>

    {{--  Lọc giá  --}}
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
     <script>
  $(document).ready(function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 100000000,

      values: [ 0, 100000000 ],
      step:100000,
      slide: function( event, ui ) {
        $( "#amount" ).val( new Intl.NumberFormat('de-DE').format(ui.values[ 0 ]) + " vnđ - " + new Intl.NumberFormat('de-DE').format(ui.values[ 1 ]) +"vnđ" );
        $( "#start_price" ).val( ui.values[ 0 ]);
        $( "#end_price" ).val( ui.values[ 1 ]);
      }
        });
        $( "#amount" ).val($( "#slider-range" ).slider( "values", 0 ) +
          " - " + $( "#slider-range" ).slider( "values", 1 ) );
  });
  </script>

  <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
  <script>


    $(document).ready(function() {
     
    // Cấu hình các nhãn phân trang
    $('#xxx,#xxx1').dataTable( {
        "language": {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
            }
        }
    } );
         
    } ); 
  </script>   
  <script>
$(document).ready( function () {
    $('#xxx, #xxx1').DataTable();
} );
</script>

{{-- thanh toán bằng paypal --}}
{{-- <script src="https://www.paypalobjects.com/api/checkout.js"></script>
<script>
    var usd = document.getElementById('vnd_to_usd').value;
  paypal.Button.render({
    // Configure environment
    env: 'sandbox',
    client: {
      sandbox: 'AeoiEVT5aCicJ0xDRhV6yzN_caFDFLHKpmY824_hGyE9l1RGpXscIHwH3Wp4EPLsUM0cS2RSCMnQfWg7',
      production: 'demo_production_client_id'
    },
    // Customize button (optional)
    locale: 'en_US',
    style: {
      size: 'small',
      color: 'gold',
      shape: 'pill',
    },

    // Enable Pay Now checkout flow (optional)
    commit: true,

    // Set up a payment
    payment: function(data, actions) {
      return actions.payment.create({
        transactions: [{
          amount: {
            total: `${usd}`,
            currency: 'USD'
          }
        }]
      });
    },
    // Execute the payment
    onAuthorize: function(data, actions) {
      return actions.payment.execute().then(function() {
        // Show a confirmation message to the buyer
        window.alert('Thank you for your purchase!');
      });
    }
  }, '#paypal-button');

</script> --}}
<script src="https://www.paypal.com/sdk/js?client-id={{ env('PAYPAL_SANDBOX_CLIENT_ID') }}"></script>


{{--  Thêm giỏ hàng phần tab_danhmuc --}}
<script type="text/javascript">
    function Addtocart($product_id) {
        var id = $product_id;
                 //alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                // alert(cart_product_id)
                // alert(cart_product_name)
                // alert(cart_product_image)
                // alert(cart_product_quantity)
                // alert(cart_product_price)
                // alert(cart_product_qty)
                // alert(_token)
                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                }else{

                    $.ajax({

                        url: '{{url('/add_cart_ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        success:function(){
                            
                            swal({
                                    title: "Thêm vào giỏ hàng thành công !",
                                    //text: "Bạn muốn mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio_hang')}}";
                                });
                        

                        }

                    });
                }
    }
</script>

{{-- ----- Lưu sản phẩm đã xem ---- --}}
    <script type="text/javascript">
    $(document).ready(function() {


     
      product_viewed();
      
      
      function product_viewed(){

        const id = $('.wishlist_id').val(); 
         if(id!= undefined){
        const title = $('.wishlist_title').val();
        const img = $('.card-img-top').val();
        const url = $('.wishlist_url').val();
        const price = $('.wishlist_price').val();
    
        const item = {
          'id': id,
          'title': title,
          'img': img,
          'url': url,
          'price':price
          
        }
        if(localStorage.getItem('viewed')==null){
           localStorage.setItem('viewed', '[]');
        }
        var old_data = JSON.parse(localStorage.getItem('viewed'));
        
        // tìm kiếm phần tử có id trong wishlist
        var matches = $.grep(old_data, function(obj){
            return obj.id == id;
        })
        // nếu có phần tử trùng
        if(matches.length){
            
        }else{
            if(old_data.length<=5){
              old_data.push(item);
            }else{
                old_data.splice(1,1);
                localStorage.setItem('viewed', JSON.stringify(old_data));
                old_data.push(item);
                  
            }
            localStorage.setItem('viewed', JSON.stringify(old_data));
            
        }
         localStorage.setItem('viewed', JSON.stringify(old_data));
 
      }
      }
       viewed();
      function viewed(){
        
          if(localStorage.getItem('viewed')!=null){
            // chuyển chuỗi json thành đối tượng js JSON.parse
             var data = JSON.parse(localStorage.getItem('viewed'));
             // đảo ngược mảng: thêm cuối sẽ hiển thị đầu tiên
             data.reverse();

             for(i=0;i<data.length;i++){

                var title = data[i].title.substring(0, 20);
                var img = data[i].img;
                var id = data[i].id;
                var url = data[i].url;
                var price = new Intl.NumberFormat('de-DE').format(data[i].price);
                
                $('#row_viewed').append(` 
                  <div class="row" style="margin:10px 0">
                        <a href="`+url+`">
                            <div class="col-md-4">
                                <img src="`+img+`" alt="" width="100%" />
                            </div>
                            <div class="col-md-8 info-viewed">
                                    <p>`+title+`</p>
                                    <p style="color:orange">`+price+` vnđ</p>
                            </div>                                    
                        </a>                  
                   </div>
                 `);
            }

          }
      }
      });
    </script>

    {{-- ----- Lưu sản phẩm đã xem ---- --}}
    <script type="text/javascript">



        function delete_compare(id) {
              if(localStorage.getItem('compare')!=null){
            // chuyển chuỗi json thành đối tượng js JSON.parse
             var data = JSON.parse(localStorage.getItem('compare'));
             var index = data.findIndex(item => item.id == id);
             data.splice(index,1);
             localStorage.setItem('compare', JSON.stringify(data));
             document.getElementById("row_compare"+id).remove();
         }
        }
      
      sosanh();
      function sosanh(){
        
          if(localStorage.getItem('compare')!=null){
            // chuyển chuỗi json thành đối tượng js JSON.parse
             var data = JSON.parse(localStorage.getItem('compare'));
             // đảo ngược mảng: thêm cuối sẽ hiển thị đầu tiên

             for(i=0;i<data.length;i++){

                var title = data[i].title;
                var img = data[i].img;
                var id = data[i].id;
                var url = data[i].url;
                var desc = data[i].desc;
                var price = data[i].price;

                $('#row_compare').find('tbody').append(` 
                  <tr id="row_compare`+id+`">
                    <td>`+title+`</td>
                    <td>`+price+`</td>
                    <td><img src="`+img+`" alt="" style="width:150px; height:150px"></td>
                    <td>`+desc+`</td>
              
                    <td><a href="`+url+`">Xem sản phẩm</a></td>
                    <td
                    <a href="" style="cursor:pointer;" onclick="delete_compare(`+id+`)">Xóa so sánh</a></td>
                </tr>
                 `);        
                
            }

          }
      }

      function add_compare(product_id){

        var id = product_id; 
        // alert(id);
        var title = document.getElementById('wishlist_productname'+id).value;
        // alert(title);
        var img = document.getElementById('wishlist_productimage'+id).src;
        // alert(img);
        var url = document.getElementById('wishlist_producturl'+id).href;
        // alert(url);
        var price = document.getElementById('wishlist_productprice'+id).value;
        // alert(price);
        var desc = document.getElementById('wishlist_productdesc'+id).value;
        
        
        
        
        
        // alert(desc);
        var item = {
          'id': id,
          'title': title,
          'img': img,
          'url': url,
          'price':price,
          'desc':desc
          
        }
        if(localStorage.getItem('compare')==null){
           localStorage.setItem('compare', '[]');
        }
        var old_data = JSON.parse(localStorage.getItem('compare'));
        
        // tìm kiếm phần tử có id trong wishlist
        var matches = $.grep(old_data, function(obj){
            return obj.id == id;
        })
        // nếu có phần tử trùng
        if(matches.length){
            
        }else{
            if(old_data.length<=30){  
            old_data.push(item);
            $('#row_compare').find('tbody').append(` 
                  <tr id="row_compare`+id+`">
                    <td>`+item.title+`</td>
                    <td>`+item.price+`</td>
                    <td><img src="`+img+`" alt="" style="width:150px; height:150px"></td>
                    <td>`+item.desc+`</td>
              
                    <td><a href="`+item.url+`">Xem sản phẩm</a></td>
                    <td
                    <a href="" style="cursor:pointer;" onclick="delete_compare(`+id+`)">Xóa so sánh</a></td>

                </tr>
                 `);          
        }
      }
      localStorage.setItem('compare', JSON.stringify(old_data));
      $('#sosanh').modal();
      }

    </script>

    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
</body>
</html>
