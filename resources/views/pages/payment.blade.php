@extends('layout')
@section('content')
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ route('homepage') }}">Trang chủ</a></li>
				  <li class="active">Thanh toán giỏ hàng</li>
				</ol>
			</div><!--/breadcrums-->

			
			
			@if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="container">
			<div class="heading">
				<h3>Thông tin đơn hàng</h3>
				<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<th>Ảnh</th>
							<th>Tên sản phẩm</th>
							<th>Đơn giá</th>
							<th>Số lượng</th>
							<th>Thành tiền</th>
							<th>Hủy</th>
						</tr>
					</thead>
					<tbody>
						@php
							$content=Cart::content();
						@endphp
						@foreach ($content as $dulieu)
							
						<tr>
							<td>
								<a href=""><img src="{{ asset('uploads/'.$dulieu->options->image) }}" alt="" width="100" height="100"></a>
							</td>
							<td>
								<h4><a href="">{{$dulieu->name}}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{number_format($dulieu->price)}} vnđ</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
								<form action="{{ route('update_cart',) }}" method="POST">	
									@csrf
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$dulieu->qty}}" autocomplete="off" size="2">
									<input type="hidden" name="cart_rowId" value="{{$dulieu->rowId}}">
									<button type="submit" class="btn btn-success btn-sm">Cập nhật</button>
								</form>	
								</div>
							</td>
							<td class="cart_total">
								@php
									$subtotal = $dulieu->qty*$dulieu->price;
								@endphp
								<p class="cart_total_price">{{number_format($subtotal)}}</p>
							</td>
							<td>
								<a class="cart_quantity_delete btn btn-danger btn-sm" href="{{ route('cart_delete',$dulieu->rowId) }}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						{{-- expr --}}
						@endforeach
					</tbody>
				</table>
			</div>
			</div>
			<div class="payment-options row">
				<h3>Chọn hình thức thanh toán</h3>
				<form action="{{ route('order_place') }}" method="POST">
					@csrf
					<span>
						<label><input type="checkbox" name="payment-option" value="ATM"> Trả bằng ATM</label>
					</span>
					<span>
						<label><input type="checkbox" name="payment-option" value="Tiền mặt"> Trả tiền mặt</label>
					</span>
					<span>
						<label><input type="checkbox" name="payment-option" value="Paypal"> Paypal</label>
					</span>
					<input type="submit" name="guiorder" class="btn btn-primary" value="Đặt hàng">
					</form>
			</div>
			<a href="{{ route('checkout') }}" class="btn btn-warning">Đổi địa chỉ giao hàng</a>
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng <span>{{Cart::subtotal(0)}} vnđ</span></li>
							<li>Thuế<span>{{Cart::tax(0)}} vnđ</span></li>
							<li>Phí vận chuyển<span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total(0)}} vnđ</span></li>
						</ul>
								
					</div>
				</div>
			</div>
		</div>

			
		</div>

	</section> <!--/#cart_items-->
@endsection