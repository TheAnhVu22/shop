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
                <h6 class="text-white text-capitalize ps-3">Danh sách Video</h6>
              </div>
            </div>
            
            <div class="card-body">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Thêm
          </button>

          @if (session('status'))
              <div class="alert alert-success" role="alert">
                  {{ session('status') }}
              </div>
          @endif
              <div class="list_video"></div>

              <!-- Button trigger modal -->


          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Thêm video</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    
                    <form>
                        @csrf
                        <div class="row mb-3">
                            <label for="video_title" class="col-md-4 col-form-label text-md-right">Tên video:</label>
                            <div class="col-md-6 border">
                                <input autocomplete="off" type="text" class="form-control video_title" name="video_title"  onkeyup="ChangeToSlug();" id="slug" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="video_slug" class="col-md-4 col-form-label text-md-right">Slug video:</label>
                            <div class="col-md-6 border">
                                <input autocomplete="off" type="text" class="form-control video_slug" name="video_slug"  id="convert_slug" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="video_link" class="col-md-4 col-form-label text-md-right">Link:</label>
                            <div class="col-md-6 border">
                                <input autocomplete="off" type="text" class="form-control video_link" name="video_link" >
                            </div>
                        </div>

                        <div class="row mb-3">
                          <label for="video_desc" class="col-md-4 col-form-label text-md-right">Mô tả:</label>
                            <div class="col-md-6 border">
                                <textarea autocomplete="off" class="form-control video_desc" name="video_desc" rows="5" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" name="themvideo" class="btn btn-primary themvideo" data-dismiss="modal">Thêm</button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  
                </div>
              </div>
            </div>
          </div>
                     
     
            </div>
          </div>
        </div>
      </div>
      <!----------------------------end Nội dung ----------------------->  
   
    </div>
  </main>
  @include('layouts.setting')
@endsection
