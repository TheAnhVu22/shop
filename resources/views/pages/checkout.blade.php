@extends('layout')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ route('homepage') }}">Trang chủ</a></li>
				  <li class="active">Thanh toán</li>
				</ol>
			</div><!--/breadcrums-->

			
			<div class="register-req">
				<p>Điền thông tin để hoàn tất đặt hàng</p>
			</div><!--/register-req-->

			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-3">
						<div class="shopper-info">
							<p>Thông tin nhận hàng</p>
							<form action="route" method="POST">
								<input type="text" placeholder="Email" name="shipping_email">
								<input type="text" placeholder="Họ tên" name="shipping_name">
								<input type="password" placeholder="Mật khẩu" name="shipping_password">
								<input type="text" placeholder="Số điện thoại" name="shipping_phone">
								<input type="submit" name="send_order" class="btn btn-success">
							</form>
						</div>
					</div>
					
					<div class="col-sm-4">
						<div class="order-message">
							<p>Ghi chú</p>
							<textarea name="message"  placeholder="ghi chú về nội dung giao hàng" rows="16"></textarea>
							<label><input type="checkbox"> Vận chuyển đến địa chỉ thanh toán</label>
						</div>	
					</div>					
				</div>
			</div>
			

			
			<div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
				</div>
		</div>
	</section> <!--/#cart_items-->
@endsection