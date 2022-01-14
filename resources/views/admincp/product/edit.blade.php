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
                <div class="card-header"><h4>Sửa sản phẩm</h4></div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('product.update',$product->id) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <style type="text/css">
                            .bootstrap-tagsinput .tag {
                                margin-right: 2px;
                                color: white;
                                background-color: #c3d4ef;
                            }
                        </style>
                        <div class="row mb-3">
                            <label for="product_content" class="col-md-4 col-form-label text-md-right">Tên sản phẩm:</label>
                            <div class="col-md-6 border">
                                <input autocomplete="off" type="text" class="form-control" name="product_content" value="{{$product->product_content}}" onkeyup="ChangeToSlug();" id="slug">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="product_slug" class="col-md-4 col-form-label text-md-right">Slug sản phẩm:</label>
                            <div class="col-md-6 border">
                                <input autocomplete="off" type="text" class="form-control" name="product_slug" value="{{$product->product_slug}}" id="convert_slug">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="product_image" class="col-md-4 col-form-label text-md-right">Ảnh:</label>
                            <div class="col-md-6 border">
                                <input type="file" class="form-control img_preview" onchange="previewFile(this);" name="product_image">
                            </div>
                            <hr>
                            <div class="col-2">
                            <img id="previewimg" src="{{ asset('uploads/'.$product->product_image) }}" alt="" height="200">
                            </div>
                            
                        </div>

                        <div class="row mb-3">
                            <label for="product_desc" class="col-md-4 col-form-label text-md-right">Mô tả:</label>
                            <div class="col-md-12 border">
                                <textarea autocomplete="off" id="noidung_sanpham" class="form-control" name="product_desc" rows="3" style="resize: none;">{{$product->product_desc}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="product_price" class="col-md-4 col-form-label text-md-right">Giá:</label>
                            <div class="col-md-6 border">
                                <input autocomplete="off" type="text" class="form-control" name="product_price" value="{{$product->product_price}}" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="product_quantity" class="col-md-4 col-form-label text-md-right">Số lượng:</label>
                            <div class="col-md-6 border">
                                <input autocomplete="off" type="text" class="form-control" name="product_quantity" value="{{$product->product_quantity}}" >
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="product_tags" class="col-md-4">Tag sản phẩm:</label>
                            <div class="col-md-6">
                                <input type="text" name="product_tags" data-role="tagsinput" value="{{$product->product_tags}}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="product_desc" class="col-md-4 col-form-label text-md-right">Kích hoạt:</label>
                            <div class="col-md-6">
                                <select class="custom-select" name="product_status">
                                    @if ($product->product_status==0)
                                        <option value="1">Hiển thị</option>
                                        <option value="0" selected>Không</option>
                                    @else
                                        <option value="1" selected>Hiển thị</option>
                                        <option value="0" >Không</option>
                                    @endif
                                  
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category_id" class="col-md-4 col-form-label text-md-right">Danh mục:</label>
                            <div class="col-md-6">
                                <select class="custom-select" name="category_id">
                                  @foreach ($category as $key => $dulieu)
                                      <option
                                      @if ($dulieu->id == $product->category_id)
                                           selected
                                       @endif
                                        value="{{$dulieu->id}}">{{$dulieu->category_name}}</option>
                                  @endforeach
                                  
                                  
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="brand_id" class="col-md-4 col-form-label text-md-right">Thương hiệu:</label>
                            <div class="col-md-6">
                                <select class="custom-select" name="brand_id">
                                  @foreach ($brand as $key => $dulieu)
                                      <option
                                      @if ($dulieu->id == $product->brand_id)
                                           selected
                                       @endif
                                        value="{{$dulieu->id}}">{{$dulieu->brand_name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Sửa
                                </button>
                            </div>
                        </div>

                    </form>
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
