@extends('layout')
@section('content')
	 <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">{{$category_name->category_name}}</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-sm-3">
                            <label for="amount">Xắp xếp theo</label>

                            <form>
                                @csrf

                               {{--  Request::url() lấy đường dẫn trang hiện tại --}}
                                <select class="custom-select text-center" id="sort" name="sort">
                                  <option value="{{Request::url()}}?sort_by=none">Lọc</option>
                                  <option value="{{Request::url()}}?sort_by=tang_dan">Giá tăng dần</option>
                                  <option value="{{Request::url()}}?sort_by=giam_dan">Giá giảm dần</option>
                                  <option value="{{Request::url()}}?sort_by=kytu_az">Tên từ A đến Z</option>
                                  <option value="{{Request::url()}}?sort_by=kytu_za">Tên từ Z đến A</option>
                                  
                                </select>
                            </form>
                        </div>
                        <div class="col-sm-5">
                        <form>
                        <p>
                          <label for="amount">Lọc giá:</label>
                          <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold; width: 100%;">
                          <input type="hidden" id="end_price" name="end_price">
                          <input type="hidden" id="start_price" name="start_price">

                        </p>
                         
                        <div id="slider-range"></div>
                        <br>
                        <input type="submit" name="filter_price" value="Lọc giá" class="btn btn-info">
                          </form>
                        </div>
                    </div>
                    <br>
                    
                    @foreach ($product as $key => $dulieu)
                        
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                              {{--   Hiển thị mặc định --}}
                                    <div class="productinfo text-center">
                                        <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
                                            <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" width="200" height="150">
                                            <h4>{{$dulieu->product_content}}</h4>
                                            <h3 style="color:orange;">{{number_format($dulieu->product_price,0,',','.').' '.'VNĐ'}}</h3>
                                            
                                        </a>                                       
                                    </div>
                               {{--  Phần trượt --}}
                               <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            
                                                <p>@php
                                                  $tomtat = substr($dulieu->product_desc, 0,200);
                                                    @endphp                                                       
                                                {!!$tomtat."..."!!} 
                                                </p>
                                               <h4 style="color:white;">{{number_format($dulieu->product_price,0,',','.').' '.'VNĐ'}}</h4>
                                                 
                                            
                                        </div>
                                    </div>
                                </a>    
                                </div>
                                <div class="choose productinfo text-center">
                                    
                                        
                                <form>
                                    @csrf
                                    <input type="hidden" value="{{$dulieu->id}}" class="cart_product_id_{{$dulieu->id}}">
                                    <input type="hidden" value="{{$dulieu->product_content}}" class="cart_product_name_{{$dulieu->id}}">
                                    <input type="hidden" value="{{$dulieu->product_quantity}}" class="cart_product_quantity_{{$dulieu->id}}">                 
                                    <input type="hidden" value="{{$dulieu->product_image}}" class="cart_product_image_{{$dulieu->id}}">
                                    <input type="hidden" value="{{$dulieu->product_price}}" class="cart_product_price_{{$dulieu->id}}">
                                    <input type="hidden" value="1" class="cart_product_qty_{{$dulieu->id}}">
                                    <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$dulieu->id}}" 
                                            name="add-to-cart"><i class="fas fa-shopping-cart"></i> Thêm giỏ hàng</button>
                                </form>   
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach   
                     
                     
                    </div><!--features_items-->
              {{$product->onEachSide(1)->links('pagination::bootstrap-4')}}       
                    
@endsection