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
       <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border">
                <div class="card-header"><h4>Phí vận chuyển</h4></div>

                <div class="card-body">
                    @php
                        $message = Session::get('message');
                        if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                    @endphp

                    <form>
                    @csrf

                        <div class="row mb-3">
                            <label for="a" class="col-md-4 col-form-label text-md-right">Chọn thành phố:</label>
                            <div class="col-md-6 border">
                                <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                
                                        <option value="">--Chọn tỉnh thành phố--</option>
                                    @foreach($city as $key => $ci)
                                        <option value="{{$ci->matp}}">{{$ci->name_tp}}</option>
                                    @endforeach
                                        
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="a" class="col-md-4 col-form-label text-md-right">Chọn quận huyện:</label>
                            <div class="col-md-6 border">
                               <select name="province" id="province" class="form-control input-sm m-bot15 province choose">
                                        <option value="">--Chọn quận huyện--</option>
                                       
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="a" class="col-md-4 col-form-label text-md-right">Chọn xã phường:</label>
                            <div class="col-md-6 border">
                                <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                        <option value="">--Chọn xã phường--</option>   
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="fee_ship" class="col-md-4 col-form-label text-md-right">Phí vận chuyển:</label>
                            <div class="col-md-6 border">
                                <input type="text" class="form-control fee_ship" name="fee_ship">
                            </div>
                        </div>
                       <button type="button" name="add_delivery" class="btn btn-info add_delivery">Thêm phí vận chuyển</button>

                    </form>

                </div>

            </div>
            <div id="load_delivery">
                                
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
@endsection