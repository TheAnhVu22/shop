@extends('layout')
@section('content')
	 <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Sản phẩm mới</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($new_product as $key => $dulieu)
                        
                        {{-- <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
                                            <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" width="200" height="150">
                                            <h4>{{number_format($dulieu->product_price)}} vnđ</h4>
                                            <p>@php
                                              $tomtat = substr($dulieu->product_content, 0,30);
                                            @endphp
                                           
                                            {{$tomtat."..."}} 
                                            </p>   
                                            </a>
                                            
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
                                                <p>
                                            @php
                                              $tomtat = substr($dulieu->product_desc, 0,200);
                                            @endphp
                                            {{$dulieu->product_content}}
                                            {{$tomtat."..."}}    
                                            </p>
                                                <h2>{{number_format($dulieu->product_price)}} vnđ</h2>
                                                <p>{{$dulieu->product_content}}</p>
                                            </a>
                                            

                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified"> --}}

                                       {{--  // bumbumman96
                                        <li><form action="{{ route('cart.store') }}" method="POST">
                                             @csrf
                                                <input type="hidden" name="soluong" value="1">
                                                <input type="hidden" name="pro_id_hide" value="{{$dulieu->id}}">
                                                <button type="submit" class="btn btn-fefault cart">
                                                <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                                                </button>
                                                
                                            </form>
                                        </li> 
                                        <li>

                                     ajax --}}

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
                                            <h3 style="color: orange;">{{number_format($dulieu->product_price,0,',','.').' '.'VNĐ'}}</h3>
                                            

                                         
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
                    @endforeach    
                        
                    </div><!--features_items-->


                    

                    <hr>        <!--------------------------------recommended_items------------------------------------------------>
                    <div class="recommended_items">
                        <h2 class="title text-center">Nổi bật</h2>
                        
                        <div class="owl-carousel owl-theme">
                            @foreach ($product as $key=> $dulieu)

                                <div class="item">
                                    
                                    <form>
                                            @csrf
                                        <input type="hidden" value="{{$dulieu->id}}" class="cart_product_id_{{$dulieu->id}}">
                                        <input type="hidden" value="{{$dulieu->product_content}}" class="cart_product_name_{{$dulieu->id}}">
                                      
                                        <input type="hidden" value="{{$dulieu->product_quantity}}" class="cart_product_quantity_{{$dulieu->id}}">
                                        
                                        <input type="hidden" value="{{$dulieu->product_image}}" class="cart_product_image_{{$dulieu->id}}">
                                        <input type="hidden" value="{{$dulieu->product_price}}" class="cart_product_price_{{$dulieu->id}}">
                                        <input type="hidden" value="1" class="cart_product_qty_{{$dulieu->id}}">

                                        <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
                                            <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" height="230">
                                            <h4>@php
                                                $tomtat = substr($dulieu->product_content,0,50);
                                            @endphp
                                                {{$tomtat."..."}}</h4>
                                            <h3 style="color: orange;">{{number_format($dulieu->product_price,0,',','.').' '.'VNĐ'}}</h3>
                                            

                                         
                                         </a>
                                        <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$dulieu->id}}" 
                                            name="add-to-cart"><i class="fas fa-shopping-cart"></i> Thêm giỏ hàng</button>
                                        </form>
                                    </div>
                            @endforeach
                        </div> 
                    </div> <!--/recommended_items-->

                    <hr>    <!-----------------------category-tab sử dụng ajax----------------------->
                    <div class="album">
                        <div class="col-sm-12">
                            <h3>Sản phẩm theo danh mục</h3>
                            <ul class="nav nav-tabs">                                
                                @foreach($category as $key => $tab_danhmuc)                       
                                <form>
                                    @csrf
                                <li class="demo">
                                  <a data-danhmuc_id="{{$tab_danhmuc->id}}" class="tabs_danhmuc" data-toggle="tab" href="#{{$tab_danhmuc->category_slug}}">{{$tab_danhmuc->category_name}}</a>
                                </li>
                                </form>

                                @endforeach
                                
                            </ul>
                        </div>
                   {{--  hiển thị sản phẩm --}}
                        <div id="tab_danhmuctruyen" class="row"></div>
                          
                    </div><!--/category-tab-->

</div>
@endsection