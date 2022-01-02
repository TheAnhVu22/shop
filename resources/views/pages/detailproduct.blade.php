@extends('layout')
@section('content')
	
					<div class="product-details"><!--product-details-->
					<nav aria-label="breadcrumb">
                      <ol class="breadcrumb" style="background: none;">
                        <li class="breadcrumb-item"><a href="{{ route('homepage') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('danh_muc',$product->category->category_slug) }}">{{$product->category->category_name}}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{$product->product_content}}</li>
                      </ol>
                    </nav>

					@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
						<div class="col-sm-5">
							<ul id="imageGallery">
							@foreach ($gallery as $key => $dulieu)
								
							  <li data-thumb="{{ asset('uploads/'.$dulieu->gallery_image) }}" data-src="{{ asset('uploads/'.$dulieu->gallery_image) }}">
							    <img height="300" width="100%" src="{{ asset('uploads/'.$dulieu->gallery_image) }}" />
							  </li>
							  {{-- expr --}}
							@endforeach
							</ul>
							
						</div>
						<div class="col-sm-7">
							
							<div class="product-information"><!--/product-information-->
								<img src="{{ asset('images/product-details/new.jpg') }}" class="newarrival" alt="" />
								<img src="{{ asset('images/product-details/rating.png') }}" alt="" />
								<h3>{{$product->product_content}}</h3>
								<p>Mã: {{$product->id}}</p>
								
								<span> 
									<span>{{number_format($product->product_price,0,',','.')}} vnđ</span>
									
								{{-- <form action="{{ route('cart.store') }}" method="POST">
									@csrf
									<label>Số lượng lấy:
										
									<select class="custom-select" name="soluong">
									  <option selected value="1">1</option>
									  <option value="2">2</option>
									  <option value="3">3</option>
									  <option value="4">4</option>
									  <option value="5">5</option>
									</select>
									</label>
									<input type="hidden" name="pro_id_hide" value="{{$product->id}}">

									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm vào giỏ hàng
									</button>
								</form> --}}
								<div class="choose productinfo text-center">
                                            
                                                
                                        <form>
                                            @csrf
                                            <input type="hidden" value="{{$product->id}}" class="cart_product_id_{{$product->id}}">
                                            <input type="hidden" value="{{$product->product_content}}" class="cart_product_name_{{$product->id}}">
                                            <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->id}}">                 
                                            <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->id}}">
                                            <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->id}}">
                                            <label>Số lượng lấy:										
											<select class="custom-select cart_product_qty_{{$product->id}}">
											  <option selected value="1">1</option>
											  <option value="2">2</option>
											  <option value="3">3</option>
											  <option value="4">4</option>
											  <option value="5">5</option>
											</select>
											</label>
											<br>
                                            <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$product->id}}" 
                                            name="add-to-cart"><i class="fas fa-shopping-cart"></i> Thêm giỏ hàng</button>
                                        </form>   
                                            
                                </div>
								<label>Tình trạng:
										@if ($product->product_quantity==0)
											<p style="color:red">Hết hàng</p>
										@elseif($product->product_quantity<=10)
											<p style="color:yellow;">Sắp hết hàng</p>
										@else
											<p style="color:green">Còn hàng</p>
										@endif
									</label>
								</span>
								<p><b>Danh mục:</b>{{$product->category->category_name}}</p>
								<p><b>Thương hiệu:</b> {{$product->brand->brand_name}}</p>
								<p><b>Ngày đăng:</b> {{$product->created_at}}</p>
								<!-------------thẻ tag-------------->
					          <h4><i class="fas fa-tag"></i> Từ khóa: </h4>
					          @php
					          // explode: chia chuỗi theo dấu phẩy, hoặc thay bằng dấu khác
					            $tukhoa = explode(",", $product->product_tags)
					          @endphp
					          @foreach ($tukhoa as $key => $tu)
					         {{--  Str::slug : helper trong laravel, giúp tạo url thân thiện hơn(bằng dấu - thay vì % giữa các từ)  --}}
					            <a href="{{ url('tag/'.\Str::slug($tu)) }}"><span class="badge badge-info cy-2" style="padding: 10px; "> {{$tu}}</span></a>
					          @endforeach
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab"><i class="fas fa-info-circle"></i> Thông tin</a></li>
							
								<li class="active"><a href="#reviews" data-toggle="tab"><i class="fas fa-comment-dots"></i> Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								
								<div>{!!$product->product_desc!!}</div>	
							</div>

							
							<div class="tab-pane fade active in" id="reviews" >
								<!-- ----------------------------------------- chia sẻ facebook ------------------------------------>
					          <div class="fb-share-button" data-href="{{$url_canonical}}" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
					           <!-- ----------------------------------------- comment facebook ------------------------------------>
					          <div class="fb-comments" data-href="{{\URL::current()}}" data-width="" data-numposts="10"></div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						
									@foreach ($related_product as $key => $dulieu)
										
									<div class="col-sm-4">
			                            <div class="product-image-wrapper">
			                           
			                                <div class="single-products">
			                                     <div class="productinfo text-center">
			                                        <form>
			                                            @csrf
			                                        <input type="hidden" value="{{$dulieu->id}}" class="cart_product_id_{{$dulieu->id}}">
			                                        <input type="hidden" value="{{$dulieu->product_content}}" class="cart_product_name_{{$dulieu->id}}">
			                                      
			                                        <input type="hidden" value="{{$dulieu->product_quantity}}" class="cart_product_quantity_{{$dulieu->id}}">
			                                        
			                                        <input type="hidden" value="{{$dulieu->product_image}}" class="cart_product_image_{{$dulieu->id}}">
			                                        <input type="hidden" value="{{$dulieu->product_price}}" class="cart_product_price_{{$dulieu->id}}">
			                                        <input type="hidden" value="1" class="cart_product_qty_{{$dulieu->id}}">

			                                        <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
			                                            <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" />
			                                            <h4> 
			                                            @php
			                                                $tomtat= substr($dulieu->product_content,0,22);
			                                            @endphp
			                                            	{{$tomtat."..."}}
			                                            </h4>
			                                            <h3>{{number_format($dulieu->product_price,0,',','.').' '.'VNĐ'}}</h3>
			                                            

			                                         
			                                         </a>
			                                        <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$dulieu->id}}" 
			                                            name="add-to-cart"><i class="fas fa-shopping-cart"></i> Thêm giỏ hàng</button>
			                                        </form>
			                                    {{-- </li> --}}

			                                    {{-- </ul> --}}
				                                </div>
				                            </div>
				                        </div>
				                   </div>
									{{-- expr --}}
									@endforeach
								
					</div><!--/recommended_items-->

@endsection