@extends('layouts.app')

@section('content')
@include('layouts.nav')
  <!---------------------------- main ----------------------->
 <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            
          </div>
          <ul class="navbar-nav  justify-content-end">
            
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
            
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->

    <div class="container-fluid py-4">
      <!---------------------------- Nội dung ----------------------->
        <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Thông tin khách hàng</h6>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table align-items-center">
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
          <br>
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Thông tin giao hàng</h6>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table align-items-center">
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
                        @else 
                            Thanh toán bằng tiền mặt
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
          <br>
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Chi tiết đơn hàng</h6>
              </div>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table align-items-center" id="xxx">
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
                       <input type="number" min="1" {{$order->order_status=='2' ? 'disabled' : ''}} class="order_qty_{{$dulieu->product_id}}" value="{{$dulieu->product_sales_quantity}}" name="product_sales_quantity">

                        <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$dulieu->product_id}}" value="{{$dulieu->product->product_quantity}}">

                        <input type="hidden" name="order_code" class="order_code" value="{{$dulieu->order_code}}">

                        <input type="hidden" name="order_product_id" class="order_product_id" value="{{$dulieu->product_id}}">

                       @if($order->order_status!='2') 

                        <button class="btn btn-default update_quantity_order" data-product_id="{{$dulieu->product_id}}" name="update_quantity_order">Cập nhật</button>

                      @endif
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
            <td colspan="6">
              
                @if($order->order_status=='1')
                <form>
                   @csrf
                   <label>Xác nhận trạng thái đơn hàng:</label>
                  <select class="form-control order_dulieu border">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$order->id}}" selected value="1">Chưa xử lý</option>
                    <option id="{{$order->id}}" value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$order->id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>
                @elseif($order->order_status=='2')
                <form>
                  @csrf
                  <select class="form-control order_dulieu border">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$order->id}}" value="1">Chưa xử lý</option>
                    <option id="{{$order->id}}" selected value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$order->id}}" value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>

                @else
                <form>
                   @csrf

                  <select class="form-control order_dulieu custom-select border">
                    <option value="">----Chọn hình thức đơn hàng-----</option>
                    <option id="{{$order->id}}" value="1">Chưa xử lý</option>
                    <option id="{{$order->id}}"  value="2">Đã xử lý-Đã giao hàng</option>
                    <option id="{{$order->id}}" selected value="3">Hủy đơn hàng-tạm giữ</option>
                  </select>
                </form>

                @endif
                


            </td>
          </tr>
                  </tbody>
                </table>
                <a target="_blank" class="btn btn-success" href="{{url('/print-order/'.$order->order_code)}}">In đơn hàng</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!----------------------------end Nội dung ----------------------->  
    <footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © <script>
                  document.write(new Date().getFullYear())
                </script>,
                made with <i class="fa fa-heart"></i> by
                <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative Tim</a>
                for a better web.
              </div>
            </div>
            <div class="col-lg-6">
              <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                <li class="nav-item">
                  <a href="https://www.creative-tim.com" class="nav-link text-muted" target="_blank">Creative Tim</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted" target="_blank">About Us</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/blog" class="nav-link text-muted" target="_blank">Blog</a>
                </li>
                <li class="nav-item">
                  <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted" target="_blank">License</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </main>
  @include('layouts.setting')
@endsection
