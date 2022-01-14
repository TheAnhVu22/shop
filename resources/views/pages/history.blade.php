@extends('layout')

@section('content')

    <div class="container">
        <div class="bg">
            <div class="row">           
                <div class="col-sm-12">                         
                    <h2 class="title text-center">Thông tin tài khoản</h2>                                      
                    <div class="row">
                        <h5>Tên tài khoản: @if ($customer->customer_name)
                            {{$customer->customer_name}}
                        @endif</h5>
                        <h5>Email: @if ($customer->customer_email)
                            {{$customer->customer_email}}
                        @endif</h5>
                        <h5>Số điện thoại: @if ($customer->customer_phone)
                            {{$customer->customer_phone}}
                        @endif</h5>
                    </div> 
                    <h2 class="title text-center">lịch sử mua hàng</h2>      @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif    
                    <div class="row">
                        <table class="table table-responsive table-bordered table-striped" id="xxx">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã đơn</th>
                                    <th>Ngày mua</th>
                                    <th>Tình trạng</th>
                                    <th>Xem chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $key => $dulieu)
                                
                                <tr>
                                    <td>{{$key}}</td>
                                    <td>{{$dulieu->order_code}}</td>
                                    <td>{{$dulieu->created_at}}</td>
                                    <td>
                                        @if ($dulieu->order_status=='1')
                                        Đơn hàng mới
                                        @else
                                        Đã giao
                                        @endif
                                    </td>
                                    <td><a href="{{ route('history_detail',$dulieu->order_code) }}">Xem</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>                  
            </div>      
            
        </div>  
    </div><!--/#contact-page-->
@endsection