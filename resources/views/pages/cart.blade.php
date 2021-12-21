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
				<h3>Thông tin đơn hàng</h3>
				
			</div>
			<div class="row">
				
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li>Tổng <span>{{Cart::subtotal(0)}} vnđ</span></li>
							<li>Thuế<span>{{Cart::tax(0)}} vnđ</span></li>
							<li>Phí vận chuyển<span>Free</span></li>
							<li>Thành tiền <span>{{Cart::total(0)}} vnđ</span></li>
						</ul>
						@if (Cart::subtotal(0)!=0)
							@php
                                $customer_id = Session()->get('customer_id');
                                $shipping_id = Session()->get('shipping_id');
                                @endphp
                                @if ($customer_id == null)
								<a class="btn btn-default check_out" href="{{ route('login_checkout') }}">Thanh toán</a>
								 @elseif($customer_id != null && $shipping_id != null)
								 <a class="btn btn-default check_out" href="{{ route('payment') }}"> Thanh toán</a>
								 @else
                                    <a class="btn btn-default check_out" href="{{ route('checkout') }}"> Thanh toán</a>
                                @endif
						@endif
								
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection