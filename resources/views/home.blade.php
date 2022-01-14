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
        
        <div class="row" style="background-color: white ;">
        <h3 class="title_thongke text-center text-danger">Thống kê đơn hàng theo doanh số</h3>

        <form autocomplete="off">
          @csrf
          <div class="col-2" style="float:left; margin-right: 5px;">
            <p>Từ ngày <input type="text" id='datepicker' class="form-control border"></p>
            <input type="button" id="btn-dashboard-filter" class="btn btn-info" value="Lọc kết quả">
          </div>
          <div class="col-2" style="float:left; margin-right: 5px;">
            <p>Đến ngày <input type="text" id='datepicker2' class="form-control border"></p>
          </div>

          <div class="col-2" style="float:left;">
            <p>
              Lọc theo:
              <select class="c-select dashboard-filter">
                <option >Chọn kiểu</option>
                <option value="7ngay">7 ngày qua</option>
                <option value="thangnay">Tháng này</option>
                <option value="thangtruoc">Tháng trước</option>
                <option value="365ngayqua">365 ngày qua</option>
              </select>
            </p>
          </div>
        </form>
        <div id="myfirstchart" style="width: 100%;height: 250px;"></div>
      </div>
      <hr>
      <div class="row">
        <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h3 class="text-center text-white">Thống kê truy cập</h3>
              </div>
            </div>
            <div class="cadr-body">
              <div class="table-responsive">
                <table class="table align-items-center">
                  <thead>
                    <tr>
                      <th class="text-center">Đang online</th>
                      <th class="text-center">Tháng trước</th>
                      <th class="text-center">Tháng này</th>
                      <th class="text-center">Một năm</th>
                      <th class="text-center">Tổng truy cập</th>
                    
                    </tr>
                  </thead>
                  <tbody>
                   
                    <tr>

                      <td class="text-center">
                       {{$visitor_count}}
                      </td>
                      <td class="text-center">
                       {{$visitor_lastmonth_count}}
                      </td>
                      <td class="text-center">
                       {{$visitor_thismonth_count}}
                      </td>
                      <td class="text-center">
                       {{$visitor_year_count}}
                      </td>
                      <td class="text-center">
                       {{$visitor_total}}
                      </td>
                    </tr>  
                  </tbody>
                </table>
              </div>
            </div>
          </div>
      </div>
      <div class="row">
        <h3 class="title_thongke text-center text-danger">Thống kê sản phẩm</h3>
        <div class="col-sm-4">
          <h6>Số lượng:</h6>
          <div id="donut-example" class="morris-donut-inverse"></div>
        </div>
        
        <div class="col-sm-4">
          <h6>Bài viết xem nhiều:</h6>
          <ol>
            @foreach ($blog_view as $key => $value)
             
              <li>{{$value->blog_name}} ({{$value->blog_views}})</li>
              <br>
            @endforeach
          </ol>
        </div>
        <div class="col-sm-4">
          <h6>Sản phẩm xem nhiều:</h6>
          <ol>
            @foreach ($product_view as $key => $value)
  
              <li>{{$value->product_content}} ({{$value->product_views}})</li>
              <br>
            @endforeach
          </ol>
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

@endsection
