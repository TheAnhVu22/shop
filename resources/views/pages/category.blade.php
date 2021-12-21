@extends('layout')
@section('content')
	 <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">{{$category_name->category_name}}</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($product as $key => $dulieu)
                        
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                              {{--   Hiển thị mặc định --}}
                                    <div class="productinfo text-center">
                                        <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
                                            <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" width="200" height="150">
                                            <h4>{{$dulieu->product_content}}</h4>
                                            <h3>{{number_format($dulieu->product_price,0,',','.').' '.'VNĐ'}}</h3>
                                            
                                        </a>                                       
                                    </div>
                               {{--  Phần trượt --}}
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
                                                <p>@php
                                                  $tomtat = substr($dulieu->product_content, 0,100);
                                                    @endphp                                                       
                                                {{$tomtat."..."}} 
                                                </p>
                                               <h4 style="color:white;">{{number_format($dulieu->product_price,0,',','.').' '.'VNĐ'}}</h4>
                                                 
                                            </a>
                                        </div>
                                    </div>
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
           {{$product->onEachSide(1)->links('pagination::bootstrap-4')}}             
                    </div><!--features_items-->
                  
                    
@endsection