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
                <h6 class="text-white text-capitalize ps-3">Quản lý user</h6>
              </div>
            </div>
            <div class="cadr-body">
              <div class="table-responsive">
                <table class="table align-items-center" id="xxx">
                  <thead>
                    <tr>
                      <th class="text-center">STT</th>
                      <th class="text-center">Tên user</th>
                      
                      <th class="text-center">Email</th>
                      <th class="text-center">Vai trò</th>
                      <th class="text-center">Quyền</th>
                      <th class="text-center"></th>
                    </tr>
                  </thead>
                  <tbody>
                     @foreach ($user as $key => $dulieu)
                    <tr>
                      {{-- <td>
                        
                      </td> --}}
                     
                        
                      <td class="text-center">
                        {{$key}}
                      </td>
                      <td class="text-center">
                        {{$dulieu->name}}
                          
                      </td class="text-center">
                      
                      <td class="text-center">
                        {{$dulieu->email}}
                      </td>
                      <td class="text-center">
                       
                          @foreach ($dulieu->roles as $key => $role)    
                              <span class="badge bg-dark cy-2">{{$role->name}}</span>
                          @endforeach
                       
                      </td>
                      <td class="text-center">
                        @if (isset($role))
                          @foreach ($role->permissions as $key => $value)
                              <span class="badge bg-success cy-2">{{$value->name}}</span>
                          @endforeach</td>
                        @endif
                      </td>
                    
                      

                      <td class="text-center">
                        <form action="{{ url('/delete_user/'.$dulieu->id) }}" method="POST">
                          @method('DELETE')
                          @csrf
                          <button class="btn btn-sm btn-danger" type="submit" onclick="return confirm('Xác nhận xóa')">Xóa</button>
                        </form>
                        <a href="{{ url('/assign_role/'.$dulieu->id) }}" class="btn btn-warning" >Phân Vai trò</a>
                        <a href="{{ url('/assign_per/'.$dulieu->id) }}" class="btn btn-info" >Phân Quyền</a>
                      </td>

                    </tr>
                    @php
                      $role = null;
                    @endphp
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
