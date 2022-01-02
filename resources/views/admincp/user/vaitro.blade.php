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
            @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
              @endif
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Phân vai trò - Tên user: {{$user->name}} - ID: {{$user->id}}</h6>
                <h6 class="text-white text-capitalize ps-3">Email: {{$user->email}}</h6>
                <h6 class="text-white text-capitalize ps-3">Vai trò hiện tại: @if ($roles != null)
                  {{$roles->name}}
                @else
                  Chưa có
                @endif</h6>
              </div>
            </div>
            <div class="cadr-body">
              <br>
              <form action="{{ url('/phan_vaitro/'.$user->id) }}" method="POST">
                @csrf
                <fieldset class="form-group">
                <label for="formGroupExampleInput"><h6>Chọn vai trò</h6></label>
                <select class="custom-select" name="vaitro">
                 
                  @foreach ($role as $key => $dulieu)
                    <option value="{{$dulieu->id}}"
                     @if ( $roles!=null && $dulieu->id==$roles->id)
                        selected 
                    @endif>
                    {{$dulieu->name}}
                    </option>
                  @endforeach
                                  
                </select>
                </fieldset> 
                <input type="submit" name="phanvaitro" class="btn btn-success form-control" value="Phân vai trò">
              </form>
            <hr>
            <h4>Thêm vai trò mới</h4>
              <form action="{{ url('/them_vaitro') }}" method="POST"> 
                @csrf
                <div class="row mb-3">
                    <label for="role_name" class="col-md-2 col-form-label text-md-right">Tên vai trò:</label>
                    <div class="col-md-9 border">
                        <input autocomplete="off" type="text" class="form-control" name="role_name" value="{{ old('role_name') }}">
                    </div>
                </div>
                <input type="submit" name="phanvaitro" class="btn btn-info form-control" value="Thêm vai trò">
              </form>

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
