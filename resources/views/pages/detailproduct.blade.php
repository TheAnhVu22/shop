@extends('layout')
@section('content')
	
					<div class="product-details"><!--product-details-->
					@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{ asset('uploads/'.$product->product_image) }}" alt="" />
								<h3><i class="fas fa-expand"></i></h3>
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active row">
										  <a href=""><img src="{{ asset('uploads/'.$product->product_image) }}" alt="" width="150" height="100"></a>
										  <a href=""><img src="{{ asset('uploads/'.$product->product_image) }}" alt="" width="150" height="100"></a>
										 
										</div>
										
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							
							<div class="product-information"><!--/product-information-->
								<img src="{{ asset('images/product-details/new.jpg') }}" class="newarrival" alt="" />
								<img src="{{ asset('images/product-details/rating.png') }}" alt="" />
								<h2>{{$product->product_content}}</h2>
								<p>Mã: {{$product->id}}</p>
								
								<span> <br>
									<span>{{number_format($product->product_price)}} vnđ</span>
									
								<form action="{{ route('cart.store') }}" method="POST">
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
								</form>
								<label>Tình trạng:
										@if ($product->product_quantity==0)
											Hết hàng
										@elseif($product->product_quantity<=10)
											Sắp hết hàng
										@else
											Còn hàng
										@endif
									</label>
								</span>
								<p><b>Danh mục:</b>{{$product->category->category_name}}</p>
								<p><b>Thương hiệu:</b> {{$product->brand->brand_name}}</p>
								<p><b>Ngày đăng:</b> {{$product->created_at}}</p>
								<a href=""><img src="{{ asset('images/product-details/share.png') }}" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Thông tin</a></li>
							
								<li class="active"><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								
								<div>{{$product->product_desc}}</div>	
							</div>

							
							<div class="tab-pane fade active in" id="reviews" >
								<!-- ----------------------------------------- chia sẻ facebook ------------------------------------>
					          <div class="fb-share-button" data-href="{{\URL::current()}}" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2F{{\URL::current()}}%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
					           <!-- ----------------------------------------- comment facebook ------------------------------------>
					          <div class="fb-comments" data-href="{{\URL::current()}}" data-width="" data-numposts="10"></div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
									@foreach ($related_product as $key => $dulieu)
										
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
													<img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" />
													<h2>{{number_format($product->product_price)}}</h2>
													<p>{{$product->product_name}}</p>
													</a>
											<form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="soluong" value="1">
                                                <input type="hidden" name="pro_id_hide" value="{{$dulieu->id}}">
                                                <button type="submit" class="btn btn-fefault cart">
                                                <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                                                </button>
                                            </form>
												</div>
											</div>
										</div>
									</div>
									{{-- expr --}}
									@endforeach
								
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->

@endsection