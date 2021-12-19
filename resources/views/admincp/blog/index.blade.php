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
        <a href="{{ route('blog.create') }}" class="btn btn-success">Thêm</a>
        <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Bài viết</h6>
              </div>
            </div>
            <div class="cadr-body">
              <div class="table-responsive">
                <table class="table align-items-center" id="xxx">
                  <thead>
                    <tr>
                      <th class="text-center">STT</th>
                      <th class="text-center">Bài viết</th>
                      {{-- <th class="text-center">Mô tả</th> --}}
                      <th class="text-center">Tác giả</th>
                      <th class="text-center">Slug</th>
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach ($blog as $key => $dulieu)
                    <tr>
                      {{-- <td>
                        
                      </td> --}}
                     
                        
                      <td class="text-center">
                        {{$key}}
                      </td>
                      <td class="text-center">
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{ asset('uploads/'.$dulieu->blog_image) }}" class="avatar avatar-sm me-3 border-radius-lg" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{$dulieu->blog_name}}</h6>
                          </div>
                        </div>
                      </td class="text-center">
                      {{-- <td class="text-center">
                        @php
                          $tomtat = substr($dulieu->blog_desc, 0,40);
                        @endphp
                        {{$tomtat.'....'}}
                        
                      </td> --}}
                      <td class="text-center">
                        {{$dulieu->blog_author}}
                      </td>
                      <td class="text-center">
                        {{$dulieu->blog_slug}}
                      </td>
                    
                      <td class="text-center">
                        <a href="{{ route('blog.edit',$dulieu->id) }}" class="btn btn-warning btn-sm">
                          Sửa
                        </a>
                      </td>
                      <td class="text-center">
                        <form action="{{ route('blog.destroy',$dulieu->id) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Xác nhận xóa')">Xóa</button>
                        </form>
                      </td>

                    </tr>
                    {{-- expr --}}
                      @endforeach
                  </tbody>
                </table>
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
@endsection
