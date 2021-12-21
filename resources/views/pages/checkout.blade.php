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
			@if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
			<div class="shopper-informations">
				<div class="row">
					<div class="col-sm-6">
						<div class="shopper-info">
							<p>Thông tin nhận hàng</p>
							<form action="{{ route('save_checkout_customer') }}" method="POST">
								@csrf
								<input type="text" placeholder="Email" name="shipping_email">
								<input type="text" placeholder="Họ tên" name="shipping_name">
								<input type="text" placeholder="Địa chỉ" name="shipping_address">
								<input type="text" placeholder="Số điện thoại" name="shipping_phone">
								
								<textarea name="shipping_note"  placeholder="ghi chú về nội dung giao hàng" rows="16"></textarea>

								<input type="submit" name="guiorder" class="btn btn-primary">
							</form>
						</div>
					</div>
					
								
				</div>
			</div>
			
		</div>
	</section> <!--/#cart_items-->
@endsection