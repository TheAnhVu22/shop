@extends('layout')
@section('content')
<div class="features_items">
<!--features_items-->
<h2 class="title text-center">Sản phẩm mới</h2>
@if (session('status'))
<div class="alert alert-success" role="alert">
   {{ session('status') }}
</div>
@endif
<style>
    .modal.in .modal-dialog {
    -webkit-transform: translate(0,0);
    -ms-transform: translate(0,0);
    transform: translate(0,0);
    width: 1000px;
}
</style>
<!-- Modal -->
<div class="modal fade" id="quick-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Giỏ hàng của bạn</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            
            
            <div class="table-responsive cart_info">
               <form action="{{url('/update-cart')}}" method="POST">
                  @csrf
                  <table class="table table-condensed">
                     
                     <div id="cart_show"></div>
               </form>
               </table>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
         </div>
      </div>
   </div>
</div>
@foreach ($new_product as $key => $dulieu)
{{-- 
<div class="col-sm-4">
<div class="product-image-wrapper">
   <div class="single-products">
      <div class="productinfo text-center">
         <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
            <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" width="200" height="150">
            <h4>{{number_format($dulieu->product_price)}} vnđ</h4>
            <p>@php
               $tomtat = substr($dulieu->product_content, 0,30);
               @endphp
               {{$tomtat."..."}} 
            </p>
         </a>
      </div>
      <div class="product-overlay">
         <div class="overlay-content">
            <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
               <p>
                  @php
                  $tomtat = substr($dulieu->product_desc, 0,200);
                  @endphp
                  {{$dulieu->product_content}}
                  {{$tomtat."..."}}    
               </p>
               <h2>{{number_format($dulieu->product_price)}} vnđ</h2>
               <p>{{$dulieu->product_content}}</p>
            </a>
         </div>
      </div>
   </div>
   <div class="choose">
      <ul class="nav nav-pills nav-justified">
         --}}
         {{--  // bumbumman96
         <li>
            <form action="{{ route('cart.store') }}" method="POST">
               @csrf
               <input type="hidden" name="soluong" value="1">
               <input type="hidden" name="pro_id_hide" value="{{$dulieu->id}}">
               <button type="submit" class="btn btn-fefault cart">
               <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
               </button>
            </form>
         </li>
         <li>
            ajax --}}
            <div class="col-sm-4"> 
               <div class="product-image-wrapper">
                  <div class="single-products">
                     <div class="productinfo text-center">
                        <form>
                           @csrf
                           <input type="hidden" value="{{$dulieu->id}}" class="cart_product_id_{{$dulieu->id}}">
                           <input type="hidden" id="wishlist_productname{{$dulieu->id}}" value="{{$dulieu->product_content}}" class="cart_product_name_{{$dulieu->id}}">
                           <input type="hidden" value="{{$dulieu->product_quantity}}" class="cart_product_quantity_{{$dulieu->id}}">
                           <input type="hidden" value="{{$dulieu->product_image}}" class="cart_product_image_{{$dulieu->id}}">
                           <input type="hidden" id="wishlist_productprice{{$dulieu->id}}" value="{{$dulieu->product_price}}" class="cart_product_price_{{$dulieu->id}}">
                           <input type="hidden" id="wishlist_productdesc{{$dulieu->id}}" value="{{$dulieu->product_desc}}" class="cart_product_price_{{$dulieu->id}}">
                           <input type="hidden" value="1" class="cart_product_qty_{{$dulieu->id}}">
                           <a id="wishlist_producturl{{$dulieu->id}}" href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
                              <img id="wishlist_productimage{{$dulieu->id}}" src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" />
                              <h4> 
                                 {{-- @php
                                 $tomtat= substr($dulieu->product_content,0,22);
                                 @endphp
                                 {{$tomtat."..."}} --}}
                                 {{$dulieu->product_content}}
                              </h4>
                              <h3 style="color: orange;">{{number_format($dulieu->product_price,0,',','.').' '.'VNĐ'}}</h3>
                           </a>
                           <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$dulieu->id}}" 
                              name="add-to-cart"><i class="fas fa-shopping-cart"></i> Thêm giỏ hàng</button>
         <li style="list-style: none; float: left;"><a style="cursor: pointer;" onclick="add_compare({{$dulieu->id}})" class="btn btn-sm btn-success"><i class="fas fa-plus-square"></i> So sánh</a></li>
         <div class="modal fade" id="sosanh" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
               <div class="modal-content container-fluid">
                  <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">So sánh</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
               <div class="modal-body">
                  <table class="table table-responsive table-hover" id="row_compare">
                     <thead>
                        <tr>
                           <th>Tên</th>
                           <th>Giá</th>
                           <th>Hình ảnh</th>
                           <th>Thông tin</th>
                           <th>Quản lý</th>
                           <th>Xóa</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                  </table>
               </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  </div>
               </div>
            </div>
         </div>
         </form>
         <style type="text/css">
            p.qrcode{
               position: absolute;
               top: 2%;
               left: 3%;
            } 
         </style>
            @php
            $qrcode_url = url('chi_tiet_san_pham',$dulieu->product_slug);
            @endphp
            <p class="qrcode">{{ QrCode::size(50)->generate($qrcode_url) }}</p>
         {{-- </li> --}}
         {{-- 
      </ul>
      --}}
      </div>
      </div>
      </div>
      </div>
      @endforeach    
   </div>
   <!--features_items-->
   {{$new_product->onEachSide(1)->links('pagination::bootstrap-4')}}
   <hr>
   <!--------------------------------recommended_items------------------------------------------------>
   <div class="recommended_items">
      <h2 class="title text-center">Nổi bật</h2>
      <div class="owl-carousel owl-theme">
         @foreach ($product as $key=> $dulieu)
         <div class="item">
            <form>
               @csrf
               <input type="hidden" value="{{$dulieu->id}}" class="cart_product_id_{{$dulieu->id}}">
               <input type="hidden" value="{{$dulieu->product_content}}" class="cart_product_name_{{$dulieu->id}}">
               <input type="hidden" value="{{$dulieu->product_quantity}}" class="cart_product_quantity_{{$dulieu->id}}">
               <input type="hidden" value="{{$dulieu->product_image}}" class="cart_product_image_{{$dulieu->id}}">
               <input type="hidden" value="{{$dulieu->product_price}}" class="cart_product_price_{{$dulieu->id}}">
               <input type="hidden" value="1" class="cart_product_qty_{{$dulieu->id}}">
               <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
                  <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" height="230">
                  <h4>@php
                     $tomtat = substr($dulieu->product_content,0,50);
                     @endphp
                     {{$tomtat."..."}}
                  </h4>
                  <h3 style="color: orange;">{{number_format($dulieu->product_price,0,',','.').' '.'VNĐ'}}</h3>
               </a>
               <button type="button" class="btn btn-default" onclick="addtocart({{$dulieu->id}})"><i class="fas fa-shopping-cart"></i> Thêm giỏ hàng</button>
            </form>
         </div>
         @endforeach
      </div>
   </div>
   <!--/recommended_items-->
   <hr>
   <!-----------------------category-tab sử dụng ajax----------------------->
   <div class="album">
      <div class="col-sm-12">
         <h3>Sản phẩm theo danh mục</h3>
         <ul class="nav nav-tabs">
            @php
            $i=0;
            @endphp
            @foreach($category as $key => $tab_danhmuc)   
            @php
            $i++;
            @endphp                    
            <form>
               @csrf
               <li class="demo {{$key==0 ? 'active' : ''}}">
                  <a data-danhmuc_id="{{$tab_danhmuc->id}}" 
                     class="tabs_danhmuc" data-toggle="tab" href="#{{$tab_danhmuc->category_slug}}">{{$tab_danhmuc->category_name}}</a>
               </li>
            </form>
            @endforeach
         </ul>
      </div>
      {{--  hiển thị sản phẩm --}}
      <div id="tab_danhmuctruyen" class="row"></div>
   </div>
   <!--/category-tab-->
</div>
@endsection