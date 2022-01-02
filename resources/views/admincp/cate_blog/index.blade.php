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
        <a href="{{ route('cate_blog.create') }}" class="btn btn-success"><i class="fas fa-plus-circle"></i> Thêm</a>
        <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Danh mục bài viết</h6>
              </div>
            </div>
            <div class="cadr-body">
              <div class="table-responsive">
                <table class="table align-items-center" id="xxx">
                  <thead>
                    <tr>
                      <th class="text-center">STT</th>
                      <th class="text-center">Danh mục bài viết</th>
                      <th class="text-center">Slug</th>
                      <th class="text-center">Trạng thái</th>
                      
                      <th class="text-center"></th>
                      <th class="text-center"></th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach ($cate_blog as $key => $dulieu)
                    <tr>                        
                      <td class="text-center">
                        {{$key}}
                      </td>
                      <td class="text-center">
                        {{$dulieu->cate_blog_name}}                    
                      </td class="text-center">
  
                      
                      <td class="text-center">
                        {{$dulieu->cate_blog_slug}}
                      </td>
                      <td class="text-center">
                        @if ($dulieu->cate_blog_status == 0)
                          <span class="badge badge-sm bg-gradient-danger">Không Hiển thị</span>
                         @else
                          <span class="badge badge-sm bg-gradient-success">Hiển thị</span>
                        @endif
                      </td>
                      <td class="text-center">
                        <a href="{{ route('cate_blog.edit',$dulieu->id) }}" class="btn btn-warning btn-sm">
                          Sửa
                        </a>
                      </td>
                      <td class="text-center">
                        <form action="{{ route('cate_blog.destroy',$dulieu->id) }}" method="POST">
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
                  <a href="https://www.creative-tim.com/cate_blog" class="nav-link text-muted" target="_blank">cate_Blog</a>
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
