@extends('layout')
@section('content')
<section id="cart_items">
   <div class="container">
      <div class="breadcrumbs">
         <ol class="breadcrumb">
            <li><a href="{{ route('homepage') }}">Trang chủ</a></li>
            <li class="active">Thanh toán giỏ hàng</li>
         </ol>
      </div>
      <!--/breadcrums-->
      <div class="register-req col-12" >
         <h4 style="color:green;">Điền thông tin để hoàn tất mua hàng</h4>
      </div>
      <!--/register-req-->
      @if ($errors->any())
      <div class="alert alert-danger">
         <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
         </ul>
      </div>
      @endif
      <div class="col-sm-12 clearfix">
         @if(session()->has('message'))
         <div class="alert alert-success">
            {!! session()->get('message') !!}
         </div>
        
         @endif

         {{-- thông báo paypal --}}
         @if(Session::has('error'))
        <div class="alert alert-danger">{{ Session::get('error') }}</div>
        {{ Session::forget('error') }}
          @endif
          @if(Session::has('success'))
              <div class="alert alert-success">{{ Session::get('success') }}</div>
              {{ Session::forget('success') }}
          @endif
          
         
      </div>
      <div class="container">
         <div class="row">
            @if (!Session::get('paypal_success')==true)
            <div class="col-sm-6">
                  <form>
                     @csrf 
                     <div class="form-group">
                        <label for="exampleInputPassword1">Chọn thành phố</label>
                        <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                           <option value="">--Chọn tỉnh thành phố--</option>
                           @foreach($city as $key => $ci)
                           <option value="{{$ci->matp}}">{{$ci->name_tp}}</option>
                           @endforeach
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputPassword1">Chọn quận huyện</label>
                        <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                           <option value="">--Chọn quận huyện--</option>
                        </select>
                     </div>
                     <div class="form-group">
                        <label for="exampleInputPassword1">Chọn xã phường</label>
                        <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                           <option value="">--Chọn xã phường--</option>
                        </select>
                     </div>
                     <input type="button" value="Tính phí vận chuyển" name="calculate_order" class="btn btn-primary btn-sm calculate_delivery" style="background-color:#25E4C7; color: black;">
                  </form>
            </div>
            @endif
            <div class="col-sm-6">
               <div class="shopper-info">
                  <p style="color:green">Thông tin nhận hàng</p>
                  {{-- 
                  <form action="{{ route('save_checkout_customer') }}" method="POST"> --}}
                  <form method="POST">
                     @csrf
                     <input type="text" placeholder="Email" name="shipping_email" class="shipping_email">
                     <input type="text" placeholder="Họ tên" name="shipping_name" class="shipping_name">
                     <input type="text" placeholder="Địa chỉ" name="shipping_address" class="shipping_address">
                     <input type="text" placeholder="Số điện thoại" name="shipping_phone" class="shipping_phone">
                     <textarea name="shipping_note"  placeholder="ghi chú về nội dung giao hàng" rows="10" class="shipping_note"></textarea>
                     @if(Session::get('fee'))
                     <input type="hidden" name="order_fee" class="order_fee" value="{{Session::get('fee')}}">
                     @else 
                     <input type="hidden" name="order_fee" class="order_fee" value="29999">
                     @endif
                     @if(Session::get('coupon'))
                     @foreach(Session::get('coupon') as $key => $cou)
                     <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                     @endforeach
                     @else 
                     <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                     @endif
                     <div class="">
                        <div class="form-group">
                           <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                            @if (!Session::get('paypal_success')==true)
                           <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
                              <option value="0">Qua chuyển khoản</option>
                              <option value="1">Tiền mặt</option>
                           </select>
                           @else
                              <select name="payment_select"  class="form-control input-sm m-bot15 payment_select">
                              <option value="2">Đã thanh toán bằng paypal</option>
               
                           </select>
                           @endif
                        </div>
                     </div>
                     <input type="button" value="Xác nhận đơn hàng" name="send_order" class="btn btn-primary btn-sm send_order" style="background-color: green;">
                  </form>
                  
               </div>
            </div>
            <div class="table-responsive cart_info">
            <form action="{{url('/update-cart')}}" method="POST">
               @csrf
               <table class="table table-condensed">
                  <thead>
                     <tr class="cart_menu">
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Giá sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     @if(Session::get('cart')==true)
                     @php
                     $total = 0;
                     @endphp
                     @foreach(Session::get('cart') as $key => $cart)
                     @php
                     $subtotal = $cart['product_price']*$cart['product_qty'];
                     $total+=$subtotal;
                     @endphp
                     <tr>
                        <td class="text-center">
                           <img src="{{asset('uploads/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
                        </td>
                        <td class="text-center">
                           <h4><a href=""></a></h4>
                           <p>{{$cart['product_name']}}</p>
                        </td>
                        <td class="cart_price">
                           <p>{{number_format($cart['product_price'],0,',','.')}}đ</p>
                        </td>
                        <td class="cart_quantity">
                           <div class="cart_quantity_button">
                              <input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}"  >
                           </div>
                        </td>
                        <td class="cart_total">
                           <p class="cart_total_price">
                              {{number_format($subtotal,0,',','.')}}đ
                           </p>
                        </td>
                         @if (!Session::get('paypal_success')==true)
                        <td class="cart_delete">
                           <a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}" style="background-color: red;"><i class="fa fa-times"></i></a>
                        </td>
                        @endif
                     </tr>
                     @endforeach
                     <tr>
                        @if (!Session::get('paypal_success')==true)
                         
                        <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm" style="background-color: #25E4C7; color: black;"></td>
                       
                        <td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}" style="background-color: #F86301;">Xóa tất cả</a></td>
                        <td>
                           @if(Session::get('coupon'))
                           <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã khuyến mãi</a>
                           @endif
                        </td>
                         @endif
                        
                        <td colspan="2">
                           <li>Tổng tiền :<span>{{number_format($total,0,',','.')}}đ</span></li>
                           @if(Session::get('coupon'))
                           <li>
                              @foreach(Session::get('coupon') as $key => $cou)
                              @if($cou['coupon_condition']==1)
                              Mã giảm : {{$cou['coupon_number']}} %
                              <p>
                                 @php 
                                 $total_coupon = ($total*$cou['coupon_number'])/100;
                                 @endphp
                              </p>
                              <p>
                                 @php 
                                 $total_after_coupon = $total-$total_coupon;
                                 @endphp
                              </p>
                              @elseif($cou['coupon_condition']==2)
                              Mã giảm : {{number_format($cou['coupon_number'],0,',','.')}} k
                              <p>
                                 @php 
                                 $total_coupon = $total - $cou['coupon_number'];
                                 @endphp
                              </p>
                              @php 
                              $total_after_coupon = $total_coupon;
                              @endphp
                              @endif
                              @endforeach
                           </li>
                           @endif
                           @if(Session::get('fee'))
                           <li>  
                              <a class="cart_quantity_delete" href="{{url('/del-fee')}}" style="color:red"><i class="fa fa-times"></i></a>
                              Phí vận chuyển <span>{{number_format(Session::get('fee'),0,',','.')}}đ</span>
                           </li>
                           <?php $total_after_fee = $total + Session::get('fee'); ?>
                           @else
                              Phí vận chuyển : 30,000 vnđ
                           @endif 
                           <li>Tổng còn:
                              @php 
                              if(Session::get('fee') && !Session::get('coupon')){
                              $total_after = $total_after_fee;
                              echo number_format($total_after,0,',','.').'đ';
                              }elseif(!Session::get('fee') && Session::get('coupon')){
                              $total_after = $total_after_coupon + 30000;
                              echo number_format($total_after,0,',','.').'đ';
                              }elseif(Session::get('fee') && Session::get('coupon')){
                              $total_after = $total_after_coupon;
                              $total_after = $total_after + Session::get('fee');
                              echo number_format($total_after,0,',','.').'đ';
                              }elseif(!Session::get('fee') && !Session::get('coupon')){
                              $total_after = $total+30000;
                              echo number_format($total_after,0,',','.').'đ';
                              }
                              @endphp
                           </li>

                           @php
                              $vnd_to_usd = round($total_after/22750,2);

                              Session::put('totalusd',$vnd_to_usd);
                           @endphp
                           @if (!Session::get('paypal_success')==true)
                           <div class="col-sm-12">
                              <a class="btn btn-info m-3" href="{{ route('processTransaction') }}" style="color:black">Thanh toán bằng <i class="fab fa-cc-paypal" style="font-size: 22px;"></i></a>
                              {{-- <div id="paypal-button"></div> --}}
                              {{-- <input type="hidden" id="vnd_to_usd" value="{{round($vnd_to_usd,2)}}"> --}}
                           </div>
                           @endif
                        </td>
                     </tr>
                     @else 
                     <tr>
                        <td colspan="5">
                           <center>
                              @php 
                              echo 'Làm ơn thêm sản phẩm vào giỏ hàng';
                              @endphp
                           </center>
                        </td>
                     </tr>
                     @endif
                  </tbody>
               </table>
            </form>
            @if(Session::get('cart'))
            @if (!Session::get('paypal_success')==true)
            <tr>
               <td>
                  <form method="POST" action="{{url('/check-coupon')}}">
                     @csrf
                     <input type="text" class="form-control" name="coupon" placeholder="Nhập mã giảm giá"><br>
                     <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá" style="background-color:#25E4C7 ">
                  </form>
               </td>
            </tr>
            @endif
            @endif
         </div>
         </div>
      </div>
      
   </div>
</section>
<!--/#cart_items-->
@endsection