<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   </head>
   <body>
   	<div class="container border" style="padding:10px; margin-top: 10px;">
      <div class="row">
         
         <div class="col-12">
            <h2 style="text-align:center">Tập đoàn viễn thông ATV</h2>
            <h4>
               <center>Mã đơn hàng: {{$order_mail['order_code']}}</center>
            </h4>
            <h4>
               <center>Ngày:{{$order_mail['ngay']}}</center>
            </h4>
         </div>
      </div>
	     <h6 style="color:red;">Thông báo xác nhận đặt hàng thành công</h6>
	     <h6>Email đặt hàng: {{$order_mail['email_user']}}</h6>
      <p>Thông tin nhận hàng:</p>
      <table class="table">
         <thead>
            <tr>
               <th>Tên người nhận</th>
               <th>Địa chỉ</th>
               <th>Số điện thoại</th>
               <th>Email</th>
               <th>Ghi chú</th>

            </tr>
         </thead>
         <tbody>
            <tr>
               <td>{{$order_mail['shipping_name']}}</td>
               <td>{{$order_mail['shipping_email']}}</td>
               <td>{{$order_mail['shipping_phone']}}</td>
               <td>{{$order_mail['shipping_address']}}</td>
               <td>{{$order_mail['shipping_note']}}</td>
            </tr>
         </tbody>
      </table>

      <p>Hình thức thanh toán:
	      @if ($order_mail['shipping_note']==1)
	      	Chuyển khoản ATM
	      @else
	      	Thanh toán tiền mặt
	      @endif
  	  </p>

      <p>Chi tiết đơn hàng:</p>
      <table class="table">
         <thead>
            <tr>
               <th>Tên sản phẩm</th>
               <th>Số lượng</th>
               <th>Giá sản phẩm</th>
               <th>Thành tiền</th>
            </tr>
         </thead>
         <tbody>
         	@php
         		$thanhtien=0;
         		$tong=0;
         	@endphp
         	@foreach ($cart_array as $cart)
         	<tr>
               <td>{{$cart['product_name']}}</td>
               <td>{{$cart['product_qty']}}</td>
               <td>{{number_format($cart['product_price'])}}</td>
               @php
         		$thanhtien=$cart['product_qty']*$cart['product_price'];
         		$tong+=$thanhtien;
         		@endphp
               <td>{{number_format($thanhtien)}}</td>
            </tr>
         	@endforeach
            
            <tr>
               <td colspan="6">
                  <div style="margin-left: 5px">
                     <p>Tổng tiền: {{number_format($tong)}}</p>
                     <p>Mã giảm giá: {{$order_mail['coupon_code']}}</p>
                     <p>Phí ship: {{$order_mail['fee']}}</p>
                     @php
                     	$total = $tong + $order_mail['fee'];
                     @endphp
                     <p>Thanh toán (chưa bao gồm mã giảm giá) : {{number_format($total)}} vnđ </p>
                  </div>
               </td>
            </tr>
         </tbody>
      </table>
     <h5 style="text-align:center">Nếu có thắc mắc, hoặc bất kì vấn đề gì, vui lòng liên hệ 0374667xxx để được tư vấn, xin cảm ơn !</h5>
     </div>
   </body>
</html>