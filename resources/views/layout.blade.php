<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        {{-- <meta name="csrf-token" content="{{csrf_token()}}">
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

        <link rel="icon" href="{{$link_icon}}" type="image/gif" sizes="16x16">

        <title>{{$meta_title}}</title>
        <!-- Styles --> --}}
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
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ asset('images/ico/favicon.ico') }}">
    <link rel="apple-touch-icon-precomposed" sizes="144xhttps://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css144" href="{{ asset('images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('images/ico/apple-touch-icon-57-precomposed.png') }}">

        
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
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
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
                                    VIETNAM
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="#">USA></li>
                                    <li><a href="#">VIETNAM</a></li>
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
                                <li><a href="{{ route('login_checkout') }}"><i class="fa fa-user"></i> Tài khoản</a></li>
                                <li><a href="#"><i class="fa fa-heart"></i> Yêu thích</a></li>
                                <li><a href="{{ route('gio_hang') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                @php
                                    $customer_id = Session()->get('customer_id');
                                @endphp
                                @if ($customer_id == null)
                                    <li><a href="{{ route('login_checkout') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                @else
                                    <li><a href="{{ route('logout_checkout') }}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
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
                                <li><a href="{{ route('homepage') }}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Danh mục<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        @foreach ($category as $key => $dulieu)
                                            <li><a href="{{ route('danh_muc',$dulieu->category_slug) }}">{{$dulieu->category_name}}</a></li>
                                        @endforeach 
                                    </ul>
                                </li> 
                                <li class="dropdown"><a href="#">Thương hiệu<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                         @foreach ($brand as $key => $dulieu)
                                            <li><a href="{{ route('thuong_hieu',$dulieu->brand_slug) }}">{{$dulieu->brand_name}}</a></li>
                                        @endforeach 
                                    </ul>
                                </li> 
                                <li><a href="{{ route('tin_tuc') }}">Thông tin</a></li>
                                <li><a href="{{ route('lien_he') }}">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="search_box pull-right">
                            <form autocomplete="off" class="form-inline my-2 my-lg-0" action="{{url('tim_kiem')}}" method="POST">
                            @csrf
                            <div class="row">
                              <input class="form-control mr-sm-2" id="keywords" type="search" name="tukhoa" placeholder="Tìm kiếm...." aria-label="Search">
                              
                              <button class="btn btn-success my-2 my-sm-0" type="submit">Tìm kiếm <i class="fas fa-search"></i></button>
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
                        <h2>Danh mục</h2>
                        <div class="panel-group category-products" id="accordian"><!--category-productsr-->

                            {{-- <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title">
                                        <a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
                                            <span class="badge pull-right"><i class="fa fa-plus"></i></span>
                                            Phụ kiện
                                        </a>
                                    </h4>
                                </div>
                                <div id="sportswear" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <ul>
                                            <li><a href="#">Nike </a></li>
                                            <li><a href="#">Under Armour </a></li>
                                            <li><a href="#">Adidas </a></li>
                                            <li><a href="#">Puma</a></li>
                                            <li><a href="#">ASICS </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                            
                         @foreach ($category as $key => $dulieu)
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><a href="{{ route('danh_muc',$dulieu->category_slug) }}">{{$dulieu->category_name}}</a></h4>
                                </div>
                            </div>
                         @endforeach   
                        </div><!--/category-products-->
                    
                        <div class="brands_products"><!--brands_products-->
                            <h2>Thương hiệu</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                 @foreach ($brand as $key => $dulieu)   
                                    <li><a href="{{ route('thuong_hieu',$dulieu->brand_slug) }}"> <span class="pull-right">(50)</span>{{$dulieu->brand_name}}</a></li>
                                  @endforeach  
                                </ul>
                            </div>
                        </div><!--/brands_products-->
                        
                        <div class="price-range"><!--price-range-->
                            <h2>Lọc giá</h2>
                            <div class="well text-center">
                                 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                                 <b class="pull-left">0 vnđ</b> <b class="pull-right">50000000 vnđ</b>
                            </div>
                        </div><!--/price-range-->
                        
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
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Dịch vụ</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Online Help</a></li>
                                <li><a href="#">Contact Us</a></li>
                                <li><a href="#">Order Status</a></li>
                                <li><a href="#">Change Location</a></li>
                                <li><a href="#">FAQ’s</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Danh mục</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">T-Shirt</a></li>
                                <li><a href="#">Mens</a></li>
                                <li><a href="#">Womens</a></li>
                                <li><a href="#">Gift Cards</a></li>
                                <li><a href="#">Shoes</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Chính sách</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Terms of Use</a></li>
                                <li><a href="#">Privecy Policy</a></li>
                                <li><a href="#">Refund Policy</a></li>
                                <li><a href="#">Billing System</a></li>
                                <li><a href="#">Ticket System</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-2">
                        <div class="single-widget">
                            <h2>Thông tin</h2>
                            <ul class="nav nav-pills nav-stacked">
                                <li><a href="#">Company Information</a></li>
                                <li><a href="#">Careers</a></li>
                                <li><a href="#">Store Location</a></li>
                                <li><a href="#">Affillate Program</a></li>
                                <li><a href="#">Copyright</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-3 col-sm-offset-1">
                        <div class="single-widget">
                            <h2>Email</h2>
                            <form action="#" class="searchform">
                                <input type="text" placeholder="Your email address" />
                                <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                <p>Get the most recent updates from <br />our site and be updated your self...</p>
                            </form>
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
   $('.tabs_danhmuc').click(function(){
    $('.demo').removeClass('active');
    const danhmuc_id = $(this).data('danhmuc_id');
    var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'{{url('/tabs_danhmuc')}}',
                method:"POST",

                data:{_token:_token, danhmuc_id:danhmuc_id},
                success:function(data){
                    $('#tab_danhmuctruyen').html(data);

                }

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

</body>
</html>
