@extends('layout')
@section('content')
	 <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">{{$brand_name->brand_name}}</h2>
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @foreach ($product as $key => $dulieu)
                        
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                        <div class="productinfo text-center">
                                            <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
                                            <img src="{{ asset('uploads/'.$dulieu->product_image) }}" alt="" width="200" height="150">
                                            <h4>{{number_format($dulieu->product_price)}} vnđ</h4>
                                            <p>
                                                @php
                                              $tomtat = substr($dulieu->product_content, 0,20);
                                            @endphp
                                            {{$tomtat.'....'}}
                                                
                                            </p>
                                            </a>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <a href="{{ route('chi_tiet_san_pham',$dulieu->product_slug) }}">
                                                <p>
                                                    @php
                                                        $tomtat=substr($dulieu->product_desc, 0,100);
                                                    @endphp
                                                    {{$tomtat."..."}}
                                                </p>
                                                <h2>{{number_format($dulieu->product_price)}} vnđ</h2>
                                                <p>{{$dulieu->product_name}}</p>
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
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        
                                        <li><form action="{{ route('cart.store') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="soluong" value="1">
                                                <input type="hidden" name="pro_id_hide" value="{{$dulieu->id}}">
                                                <button type="submit" class="btn btn-fefault cart">
                                                <i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                   
                    @endforeach    
                        {{$product->onEachSide(1)->links('pagination::bootstrap-4')}}
                    </div><!--features_items-->
                  
                    
@endsection