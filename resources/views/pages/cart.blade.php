@extends('layout')
@section('content')
	
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ route('homepage') }}">Trang chủ</a></li>
				  <li class="active">Giỏ hàng</li>
				</ol>
			</div>
			@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
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
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Điền thông tin mua hàng</h3>
				<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
			</div>
			<div class="row">
				{{-- <div class="col-sm-6">
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				</div> --}}
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng <span>{{Cart::subtotal(0)}} vnđ</span></li>
							<li>Thuế<span>{{Cart::tax(0)}} vnđ</span></li>
							<li>Phí vận chuyển<span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total(0)}} vnđ</span></li>
						</ul>
							<a class="btn btn-default check_out" href="{{ route('login_checkout') }}">Thanh toán</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection