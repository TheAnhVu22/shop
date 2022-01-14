
@extends('layout')

@section('content')
<div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h2 class="title text-center">Chi tiết đơn hàng</h2>
              </div>
            </div>
            <div class="card-body">
              <h6>Mã đơn hàng : {{$order->order_code}}</h6>
              <h6>Ngày mua : {{$order->created_at}}</h6>
              <div class="table-responsive">
                <table class="table table-bordered align-items-center">
                  <thead>
                    <tr>
                      <th class="text-center">Tên khách hàng</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Số điện thoại</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                   
                    <tr>
                     
                      <td class="text-center">
                        {{$order->customer->customer_name}}
                      </td>

                      <td class="text-center">
                        {{$order->customer->customer_email}}
                      </td class="text-center">

                      <td class="text-center">
                        {{$order->customer->customer_phone}}
                      </td>
                     
                    </tr>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Thông tin giao hàng</h6>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered align-items-center">
                  <thead>
                    <tr>
                      <th class="text-center">Tên người nhận</th>
                      <th class="text-center">Email</th>
                      <th class="text-center">Số điện thoại</th>
                      <th class="text-center">Địa chỉ</th>
                      <th class="text-center">Hình thức thanh toán</th>
                      <th class="text-center">Trạng thái</th>
                      <th class="text-center">Ghi chú</th>
                    </tr>
                  </thead>
                  <tbody>
                   
                    <tr>
                     
                      <td class="text-center">
                        {{$order->shipping->shipping_name}}
                      </td>

                      <td class="text-center">
                        {{$order->shipping->shipping_email}}
                      </td class="text-center">

                      <td class="text-center">
                        {{$order->shipping->shipping_phone}}
                      </td>
                      <td class="text-center">
                        {{$order->shipping->shipping_address}}
                      </td>
                      
                      <td class="text-center">
                        @if ($order->shipping->shipping_method=='0')
                           Thanh toán bằng thẻ
                        @elseif($order->shipping->shipping_method=='1') 
                            Thanh toán bằng tiền mặt
                        @else
                          Đã thanh toán bằng paypal
                        @endif
                      </td>
                      <td class="text-center">
                        @if($order->order_status==1)
                            Đơn hàng mới
                        @else 
                            Đã xử lý
                        @endif
                      </td>
                        <td class="text-center">
                        {{$order->shipping->shipping_note}}
                      </td>
                      

                    </tr>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Chi tiết đơn hàng</h6>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered align-items-center" id="xxx">
                  <thead>
                    <tr>
                      <th class="text-center">STT</th>
                      <th class="text-center">Tên sản phẩm</th>
                      <th class="text-center">Mã giảm giá</th>
                      <th class="text-center">Số lượng trong kho</th> 

                      <th class="text-center">Số lượng lấy</th>
                      <th class="text-center">Đơn giá</th>
                      <th class="text-center">Thành tiền</th>
                      
                    </tr>
                  </thead>
                  <tbody>
                    @php
                       $tongtien=0;
                     @endphp
                     @foreach ($orderdetail as $key => $dulieu)
                    <tr class="color_qty_{{$dulieu->product_id}}">
                    
                      <td class="text-center">
                        {{$key}}
                      </td>

                      <td class="text-center">
                        {{$dulieu->product_content}}
                      </td class="text-center">

                      <td class="text-center">
                        @if($dulieu->product_coupon!='no')
                            {{$dulieu->product_coupon}}
                          @else 
                            Không mã
                          @endif
                      </td class="text-center">

                      <td class="text-center">
                        {{$dulieu->product->product_quantity}}
                      </td class="text-center">
                      
                      <td class="text-center">
                        {{$dulieu->product_sales_quantity}}
                       
                      </td>
                      <td class="text-center">
                        {{number_format($dulieu->product_price)}}
                      </td>
                      <td class="text-center">
                        @php
                          $tong= $dulieu->product_price*$dulieu->product_sales_quantity;
                        @endphp
                        {{number_format($tong)}}
                      </td>
                      @php
                       $tongtien+=$tong;
                     @endphp

                    </tr>
                    {{-- expr --}}
                      @endforeach
                     <tr>
                    
                    <td colspan="2" style="text-align:right; ">
                      @php 
                      $total_coupon = 0;
                    @endphp
                    @if($coupon_condition==1)
                        @php
                        $total_after_coupon = ($tongtien*$coupon_number)/100;
                        echo 'Số tiền giảm :'.number_format($total_after_coupon,0,',','.').'</br>';
                        $total_coupon = $tongtien + $dulieu->product_feeship - $total_after_coupon ;
                        @endphp
                    @else 
                        @php
                        echo 'Số tiền giảm :'.number_format($coupon_number,0,',','.').'k'.'</br>';
                        $total_coupon = $tongtien + $dulieu->product_feeship - $coupon_number ;

                        @endphp
                    @endif
                    Phí ship : {{number_format($dulieu->product_feeship,0,',','.')}}đ</br> 
             Thanh toán: {{number_format($total_coupon,0,',','.')}}đ 
                    </td>
                   
                  </tr>
                  <tr>
            
          </tr>
                  </tbody>
                </table>
                
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection