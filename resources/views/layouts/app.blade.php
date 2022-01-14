<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
  <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <title>Trang Admin</title>
    <script src="https://kit.fontawesome.com/f8077388f9.js" crossorigin="anonymous"></script>
    
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
   {{--  <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet"> --}}
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Nucleo Icons -->
  <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/material-dashboard.css') }}" rel="stylesheet" />

  <link id="pagestyle" href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
  <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
</head>
<body class="g-sidenav-show  bg-gray-200">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand btn btn-outline-danger" href="{{ url('/') }}">
                    ADMIN SHOP
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @hasanyrole('Manager|admin|Staff')
                    <ul class="navbar-nav me-auto">
                      
                            <li class="nav-item">
                              <a class="nav-link {{Request::segment(1)=='home' ? 'active bg-light' : ''}}" href="{{ route('home') }}">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{Request::segment(1)=='category' ? 'active bg-light' : ''}}" aria-current="page" href="{{ route('category.index') }}">Danh mục</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{Request::segment(1)=='brand' ? 'active bg-light' : ''}}" href="{{ route('brand.index') }}">Thương hiệu</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{Request::segment(1)=='product' ? 'active bg-light' : ''}}" href="{{ route('product.index') }}">Sản phẩm</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{Request::segment(1)=='blog' ? 'active bg-light' : ''}}" href="{{ route('blog.index') }}">Blog</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link {{Request::segment(1)=='slide' ? 'active bg-light' : ''}}" href="{{ route('slide.index') }}">Slide</a>
                            </li>
                          
                    </ul>
                    @endhasanyrole
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">Đăng nhập</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">Đăng ký</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a class="nav-link btn btn-outline-success">
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> 

       
    @yield('content')

</div>
   


    <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
{{--   <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script> --}}
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/material-dashboard.min.js?v=3.0.0') }}"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>   
    </script>
     <script type="text/javascript">
        function ChangeToSlug()
        {
            var slug;
         
            //Lấy text từ thẻ input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //Đổi ký tự có dấu thành không dấu
                slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                slug = slug.replace(/đ/gi, 'd');
                //Xóa các ký tự đặt biệt
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //Đổi khoảng trắng thành ký tự gạch ngang
                slug = slug.replace(/ /gi, "-");a
                //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //Xóa các ký tự gạch ngang ở đầu và cuối
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox có id “slug”
            document.getElementById('convert_slug').value = slug;
        }
</script>
  
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css"></script>
  <script>


    $(document).ready(function() {
     
    // Cấu hình các nhãn phân trang
    $('#xxx,#xxx1').dataTable( {
        "language": {
        "sProcessing":   "Đang xử lý...",
        "sLengthMenu":   "Xem _MENU_ mục",
        "sZeroRecords":  "Không tìm thấy dòng nào phù hợp",
        "sInfo":         "Đang xem _START_ đến _END_ trong tổng số _TOTAL_ mục",
        "sInfoEmpty":    "Đang xem 0 đến 0 trong tổng số 0 mục",
        "sInfoFiltered": "(được lọc từ _MAX_ mục)",
        "sInfoPostFix":  "",
        "sSearch":       "Tìm:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Đầu",
            "sPrevious": "Trước",
            "sNext":     "Tiếp",
            "sLast":     "Cuối"
            }
        }
    } );
         
    } ); 
  </script>   
  <script>
$(document).ready( function () {
    $('#xxx, #xxx1').DataTable();
} );
</script>

<script type="text/javascript" src="{{ asset('ckeditor_4.17.1_standard/ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
            CKEDITOR.replace('noidungblog',{
                filebrowserImageUploadUrl: "{{url('uploads-ckeditor?_token='.csrf_token())}}",
                filebrowserBrowseUrl: "{{url('file-browser?_token='.csrf_token())}}",
                filebrowserUploadMethod: 'form'
            });

            CKEDITOR.replace('noidung_sanpham',{
                filebrowserImageUploadUrl: "{{url('uploads-ckeditor?_token='.csrf_token())}}",
                filebrowserBrowseUrl: "{{url('file-browser?_token='.csrf_token())}}",
                filebrowserUploadMethod: 'form'
            });
        </script>

 <!--------------------------- xử lý vận chuyển ajax ------------------------------------>
    <script type="text/javascript">
    $(document).ready(function(){

        fetch_delivery();

        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
             $.ajax({
                url : '{{url('/select-feeship')}}',
                method: 'POST',
                data:{_token:_token},
                success:function(data){
                   $('#load_delivery').html(data);
                }
            });
        }
      // blur() kích hoạt khi thoát khỏi trường focus (trường nhập fee)
        $(document).on('blur','.fee_feeship_edit',function(){

            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
             var _token = $('input[name="_token"]').val();
            // alert(feeship_id);
            // alert(fee_value);
            $.ajax({
                url : '{{url('/update-delivery')}}',
                method: 'POST',
                data:{feeship_id:feeship_id, fee_value:fee_value, _token:_token},
                success:function(data){
                   fetch_delivery();
                }
            });

        });
        $('.add_delivery').click(function(){

           var city = $('.city').val();
           var province = $('.province').val();
           var wards = $('.wards').val();
           var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
           // alert(city);
           // alert(province);
           // alert(wards);
           // alert(fee_ship);
            $.ajax({
                url : '{{url('/insert-delivery')}}',
                method: 'POST',
                data:{city:city, province:province, _token:_token, wards:wards, fee_ship:fee_ship},
                success:function(data){
                   fetch_delivery();
                }
            });


        });
        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
             // alert(action);
             //  alert(ma_id);
            //   alert(_token);

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        }); 
    })


</script>

<!----------- xử lý xác nhận đơn hàng -------------->
<script type="text/javascript">
    $('.order_dulieu').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
         // alert(order_status);
        var _token = $('input[name="_token"]').val();
        // alert(order_status); lấy ra status order
        // alert(order_id); lấy ra id order
        
        //lay ra so luong
        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        //lay ra product id
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        for(i=0;i<order_product_id.length;i++){
            //so luong khach dat
            var order_qty = $('.order_qty_' + order_product_id[i]).val();
            //so luong ton kho
            var order_qty_storage = $('.order_qty_storage_' + order_product_id[i]).val();

            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j = j + 1;
                if(j==1){
                    alert('Số lượng bán trong kho không đủ');
                }
                $('.color_qty_'+order_product_id[i]).css('background','#000');
            }
        }
        if(j==0){
          
                $.ajax({
                        url : '{{url('/update-order-qty')}}',
                            method: 'POST',
                            data:{_token:_token, order_status:order_status ,order_id:order_id ,quantity:quantity, order_product_id:order_product_id},
                            success:function(data){
                               
                                alert('Thay đổi tình trạng đơn hàng thành công');
                                 
                                location.reload();
                            }
                });
            
        }

    });
</script>

  <script type="text/javascript">
      $(document).ready(function(){
        load_gallery();
        function load_gallery() {
          var pro_id = $('.pro_id').val();
          var _token = $('input[name="_token"]').val();
        $.ajax({
          url:"{{ route('select_gallery') }}",
          method:"POST",
          data:{pro_id: pro_id, _token:_token},
          success:function(data){
            $('#gallery_load').html(data);
          }
        });
        }

        $('#file').change(function() {
          var error ="";
          var files = $('#file')[0].files;
          if(files.length>5){
            error+='<p>Chỉ được chọn tối đa 5 ảnh</p>';

          }else if(files.length==""){
            error+='<p>Không được để trống</p>';
          }else if(files.size> 2000000){
            error+='<p>Ảnh không được lớn hơn 2MB</p>';
          }
          if(error ==""){

          }else{
            $('#file').val('');
            $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
            return false;
          }
        });

        $(document).on('blur','.edit_gal_name',function() {
          var gal_id = $(this).data('gal_id');
          var gal_text = $(this).text();
          var _token = $('input[name="_token"]').val();
          $.ajax({
          url:"{{ route('update_gallery_name') }}",
          method:"POST",
          data:{gal_id: gal_id, _token:_token,gal_text:gal_text},
          success:function(data){
            $('#error_gallery').html('<span class="text-danger">Cập nhật tên thành công</span>');
          }
        });
        });

        $(document).on('click','.delete-gallery',function() {
          var gal_id = $(this).data('gal_id');
          
          var _token = $('input[name="_token"]').val();
          if(confirm('Xác nhận xóa')){
          $.ajax({
          url:"{{ route('delete_gallery') }}",
          method:"POST",
          data:{gal_id: gal_id, _token:_token},
          success:function(){
            load_gallery();
            $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');

          }
        });
        }
        });

        $(document).on('change','.file_image',function() {
          var gal_id = $(this).data('gal_id');
          var image = document.getElementById('file-'+gal_id).files[0];
          var form_data = new FormData();
          form_data.append("file",image);
          form_data.append("gal_id",gal_id);

          $.ajax({
          url:"{{ route('update_gallery') }}",
          method:"POST",
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          success:function(){
            load_gallery();
            $('#error_gallery').html('<span class="text-danger">Cập nhật hình ảnh thành công</span>');
          }
        });

        });

      });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      load_video();
      function load_video() {
        $.ajax({
          url:'{{ route('select_video') }}',
          method:'POST',
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },

          success:function(data) {
            $('.list_video').html(data);
          }
        });
      }

      $(document).on('click','.xoavideo',function() {
        var video_id = $(this).data('video_id');
        
        var form_data =new FormData();
        form_data.append('video_id',video_id);
        
          $.ajax({
            url:'{{ route('xoa_video') }}',
            method:'POST',
            headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            success:function() {
              load_video();
            }
          });
        
      });

      $(document).on('click','.themvideo',function() {
        var video_title = $('.video_title').val();
        var video_slug = $('.video_slug').val();
        var video_link = $('.video_link').val();
        var video_desc = $('.video_desc').val();
        // alert(video_title);
        // alert(video_slug);
        // alert(video_link);
        // alert(video_desc);
        var form_data =new FormData();
        form_data.append('video_title',video_title);
        form_data.append('video_slug',video_slug);
        form_data.append('video_link',video_link);
        form_data.append('video_desc',video_desc);
          $.ajax({
            url:'{{ route('them_video') }}',
            method:'POST',
            headers:{
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            success:function() {
              $('.video_title').val('');
              $('.video_slug').val('');
              $('.video_link').val('');
              $('.video_desc').val('');
              load_video();
            }
          });
        
      });

      $(document).on('blur','.video_edit',function(){
        var video_type = $(this).data('video_type');
        var video_id = $(this).data('video_id');
        var video_text = $('#'+video_type+'_'+video_id).text();
        // alert(video_text);
        // alert(video_type);
        // alert(video_id);

        // var form_data = new FormData();
        // form_data.append('video_type',video_type);
        // form_data.append('video_id',video_id);
        // form_data.append('video_text',video_text);

        $.ajax({
          url:'{{ route('update_video') }}',
          method:'POST',
          headers:{
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
          },
          data:{video_type:video_type,video_id:video_id,video_text:video_text},
          
          success:function(){
            
            load_video();
          }
        });
      });

    });
  </script>


{{-- js chạy modal --}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>

  <script type="text/javascript">
    $(document).on('click','.xoa_binhluan',function() {
      var com_id= $(this).data('com_id');
      // alert(com_id);
      if(confirm('Xác nhận xóa !')){
      $.ajax({
        url:'{{ route('xoa_binhluan') }}',
        method:'POST',
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data:{com_id:com_id},
        success:function() {
          window.location.reload();
        }
      });
    }
    }); 

  </script>

  <script type="text/javascript">
    
     $(document).on('click','.rep_binhluan',function() {
      var com_id= $(this).data('com_id');
      var pro_id= $('.pro_id').val();
      var comment_reply = $('.comment_reply_'+com_id).val();
       // alert(comment_reply);
       //  alert(com_id);
       //  alert(pro_id);
      $.ajax({
        url:'{{ route('traloi_binhluan') }}',
        method:'POST',
        headers:{
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        data:{com_id:com_id,comment_reply:comment_reply,pro_id:pro_id},
        success:function() {
          $('.comment_reply_'+com_id).val("");
          $('#thongbao').html('<span class="text-success">Trả lời bình luận thành công</span>');
        }
      });
     
    
    }); 
  </script>

{{-- Xắp xếp danh mục kéo thả --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript">
  
    $('.XapxepJqueryui').sortable({
        // ui-state-highlight ở trong jqueryui
        placeholder : 'ui-state-highlight',
        update: function(event,ui){
            var array_id=[];
            $('.XapxepJqueryui tr').each(function(){
            array_id.push($(this).attr('id'));
        })
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ route('resorting') }}",
                method:"POST",
                data:{array_id:array_id},
                success:function(data){
                    $('.thongbao').html('Xắp xếp thành công');
                }
            })
        }
        
    })

  </script>

 {{--  chọn ngày tháng năm --}}
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
      dateFormat:"yy-mm-dd",
    duration:"slow"
    });
    
  } );
  $( function() {
    $( "#datepicker2" ).datepicker({
      dateFormat:"yy-mm-dd",
    duration:"slow"
    });
    
  } );
  </script>

 {{--  Thống kê --}}
 
 <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
 <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      chart30daysorder();

      var chart = new Morris.Line({
      
        element: 'myfirstchart',
        lineColors:['black','red','blue','green','yellow'],
        pointFillColors: ['cyan'],
        pointStrokeColors: ['gray'],
        fillOpacity:0.6,
        hideHover: 'auto',
        parseTime: false,

       
        xkey: 'period',
       
        ykeys: ['order','sales','profit','quantity'],
        behaveLikeLine: true,
        labels: ['Số đơn hàng','Doanh số','Lợi nhuận','Số lượng bán']
        });

      function chart30daysorder() {
        $.ajax({
          url:'{{ url('/days-order') }}',
          method:'POST',
          dataType:'JSON',
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          data:{},
          success:function(data) {
            chart.setData(data);
          }
        });
      }

      $('.dashboard-filter').change(function() {
        var dashboard_value = $(this).val();
        
         // alert(dashboard_value);
        // alert(to_date);
        $.ajax({
          url:"{{ url('/dashboard-filter') }}",
          method:'POST',
          dataType:'JSON',
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          data:{dashboard_value:dashboard_value},
          success:function(data) {
             chart.setData(data);
            
          }
        });
      });

      $('#btn-dashboard-filter').click(function() {
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        //  alert(from_date);
        // alert(to_date);
        $.ajax({
          url:"{{ url('/filter-by-date') }}",
          method:'POST',
          dataType:'JSON',
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          data:{from_date:from_date,to_date:to_date},
          success:function(data) {
             chart.setData(data);
            
          }
        });
      });
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
    
    var colorDanger = "#FF1744";
    Morris.Donut({
    element: 'donut-example',
    resize: true,
    colors: [
      '#f02929',
      '#f0e929',
      '#47f029',
      '#29edf0',
      '#f029d2'
    ],
    //labelColor:"#cccccc", // text color
    //backgroundColor: '#333333', // border color
    data: [
      {label:"San pham", value:{{$tk_product}}},
      {label:"Bai viet", value:{{$tk_post}}},
      {label:"Don hang", value:{{$tk_order}}},
      {label:"Khach hang", value:{{$tk_customer}}},
      {label:"Video", value:{{$tk_video}}}
    ]
    });

});
  </script>
  <script type="text/javascript" src="{{ asset('js/simple.money.format.js') }}"></script>
  <script type="text/javascript">
      $('.money').simpleMoneyFormat();
  </script>

  <script type="text/javascript">

        
        function delete_ntt(id) {
            //alert(id);
            if(confirm('Xác nhận xóa')){
            $.ajax({
                url:"{{ route('delete_ntt') }}",
                method:'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data:{id:id},
                success:function(data){
                    $('#exampleModal').modal();
                    load_nhataitro();
                }
            });

        }
        }
        load_nhataitro();
        function load_nhataitro() {

            $.ajax({
                url:"{{ route('select_ntt') }}",
                method:'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                success:function(data){
                    $('.nhataitro').html(data);
                }
            });
        }

         $(document).on('blur','.edit_ntt',function(){
            
            var id = $(this).data('ntt_id');
            var type = $(this).data('type');
            var text = $('#ntt_'+type+'_'+id).text();
            // alert(id);
            // alert(type);
            //  alert(text);
             var form_data = new FormData();
             form_data.append('id',id);
             form_data.append('type',type);
             form_data.append('text',text);

            $.ajax({
                url:"{{ route('edit_ntt') }}",
                method:'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                contentType:false,
                cache:false,
                processData:false,
                data:form_data,
                success:function(data){
                    alert("Sửa thành công");
                    load_nhataitro();
                }
            });
        
        });
         $(document).on('change','.file_image',function() {
          var id = $(this).data('ntt_id');
          var image = document.getElementById('file-'+id).files[0];
          var form_data = new FormData();

          form_data.append("file",image);
          form_data.append("id",id);

          $.ajax({
          url:"{{ route('update_ntt') }}",
          method:"POST",
          headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data:form_data,
          contentType:false,
          cache:false,
          processData:false,
          success:function(){
            alert("cập nhật hình ảnh thành công");
            load_nhataitro();
          }
        });

        });
        $('.them-ntt').click(function() {
            var name = $('.name').val();
            var desc = $('.desc').val();
            var image = $('#image_ntt')[0].files[0];
            // alert(name);
            // alert(desc);
             // alert(image);
             var form_data = new FormData();
             form_data.append('name',name);
             form_data.append('desc',desc);
             form_data.append('file',image);

            $.ajax({
                url:"{{ route('add_ntt') }}",
                method:'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                contentType:false,
                cache:false,
                processData:false,
                data:form_data,
                success:function(data){
                    alert("Thêm thành công");
                    load_nhataitro();
                }
            });
        });

  </script>

  <script type="text/javascript">
    function delete_icon(id) {
        if(confirm('Xác nhận xóa')){
            $.ajax({
                url:"{{ url('/delete_icon') }}",
                method:'POST',
                headers:{
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                data: {id:id},
                success:function(){
                    load_icon();
                }
            });
        }
    }
      load_icon();
      function load_icon() {
          $.ajax({
            url:"{{ url('/select_icon') }}",
            method:'POST',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success:function(data){
                $('#icon').html(data);
            }
          });
      }

      $(document).on('blur','.edit_icon',function(){
        var id = $(this).data('icon_id');
        var type = $(this).data('type');
        var text = $('#edit_'+type+'_'+id).text();
        // alert(id);
        // alert(type);
        // alert(text);
        var form_data=new FormData();
        form_data.append('id',id);
        form_data.append('type',type);
        form_data.append('text',text);
        $.ajax({
            url:"{{ url('/edit_icon') }}",
            method:'POST',
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
            },
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                alert('Cập nhật thành công');
                load_icon();
            }
        });
      });

      $(document).on('change','.file',function() {
        var id = $(this).data('icon_id');
        var image = document.getElementById('file-'+id).files[0];
        var form_data = new FormData();

          form_data.append("file",image);
          form_data.append("id",id);
        $.ajax({
            url:"{{ url('/edit_img') }}",
            method:'POST',
            headers:{
                'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content'),
            },
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
                alert('Cập nhật ảnh thành công');
                load_icon();
            }
        });
      });

      $('.add_icon').click(function() {
        var name = $('.name').val();
        var link=$('.link').val();
        var image = $('.image')[0].files[0];
        // alert(name);
        // alert(link);
        // alert(image);
        var form_data=new FormData();
        form_data.append('name',name);
        form_data.append('link',link);
        form_data.append('file',image);
        $.ajax({
            url:"{{ url('/add_icon') }}",
            method:'POST',
            headers:{
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content'),
            },
            data:form_data,
             contentType:false,
          cache:false,
          processData:false,
            success:function(data){
                load_icon();
            }
        });
      });
  </script>

{{-- file manager --}}

  <script>
  var options = {
    filebrowserImageBrowseUrl: '/shop/public/laravel-filemanager?type=Images',
    filebrowserImageUploadUrl: 'laravel-filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: 'laravel-filemanager?type=Files',
    filebrowserUploadUrl: 'laravel-filemanager/upload?type=Files&_token='
  };
</script>

<script>
CKEDITOR.replace('my-editor', options);
</script>

<script type="text/javascript">
    function previewFile(input){
        var file = $('.img_preview').get(0).files[0];
        console.log(file);
        if(file){
            var reader = new FileReader();
            reader.onload = function(){
                $('#previewimg').attr("src",reader.result);
            }
            reader.readAsDataURL(file);
        }
    }
</script>
<style type="text/css">
    #toast-container{
        background-color: green;
    }
</style>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
</body>
</html>
