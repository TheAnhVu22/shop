@extends('layout')
@section('content')
	 <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Sản phẩm mới</h2>

                    @foreach ($new_product as $key => $dulieu)
                        
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" width="200" height="150">
                                            <h4>{{$dulieu->product_price}} vnđ</h4>
                                            <p>
                                                @php
                                              $tomtat = substr($dulieu->product_content, 0,20);
                                            @endphp
                                            {{$tomtat.'....'}}
                                                
                                            </p>
                                            
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" width="200" height="150">
                                                <h2>{{$dulieu->product_price}} vnđ</h2>
                                                <p>{{$dulieu->product_name}}</p>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                            </div>
                                        </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href="#"><i class="far fa-money-bill-alt"></i>Mua ngay</a></li>
                                        <li><a href="#"><i class="fas fa-cart-plus"></i>Thêm vào giỏ hàng</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                   
                    @endforeach    
                        
                    </div><!--features_items-->
                    <hr>
                    <div class="album"><!--category-tab-->
                        <div class="col-sm-12">
                            <ul class="nav nav-tabs">
                                @php
                                $i = 0;
                                @endphp

                            
                                @foreach($category as $key => $tab_danhmuc)
                                @php
                                $i++;
                                @endphp
                                <form>
                                    @csrf
                                <li class="{{$i==1 ? 'active' : ''}} demo">
                                  <a data-danhmuc_id="{{$tab_danhmuc->id}}" class="tabs_danhmuc" data-toggle="tab" href="#{{$tab_danhmuc->category_slug}}">{{$tab_danhmuc->category_name}}</a>
                                </li>
                                </form>

                                @endforeach
                                
                            </ul>
                        </div>
                        <div id="tab_danhmuctruyen" class="row"></div>
                          
                    </div><!--/category-tab-->
                    <hr>
                    <div class="recommended_items"><!--recommended_items-->
                        <h2 class="title text-center">Nổi bật</h2>
                        
                        <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="item active">   
                                  @foreach ($product as $key=> $dulieu)
                                          
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" />
                                                    <h2>{{$dulieu->product_price}}</h2>
                                                    <p>{{$dulieu->product_content}}</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    {{-- expr --}}
                                    @endforeach
                                </div>
                                <div class="item">  
                                    @foreach ($product as $key=> $dulieu)
                                          
                                    <div class="col-sm-3">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" />
                                                    <h2>{{$dulieu->product_price}}</h2>
                                                    <p>{{$dulieu->product_content}}</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
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