@extends('layout')
@section('content')
	 <section id="form"><!--form-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Đăng nhập</h2>
                        <form action="#">
                            
                            <input type="email" name="login_email" placeholder="Email Address" />
                            <input type="text" name="login_password" placeholder="Password" />
                            <span>
                                <input type="checkbox" name="luumatkhau" class="checkbox"> 
                                Lưu mật khẩu
                            </span>
                            <button type="submit" class="btn btn-success">Đăng nhập</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">Hoặc</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Đăng ký</h2>
                        <form action="{{ route('customer.store') }}" method="POST">
                            @csrf
                            <input type="text" placeholder="Tên" name="customer_name">
                            <input type="email" placeholder="Email" name="customer_email">
                            <input type="text" placeholder="Số điện thoại" name="customer_phone">
                            <input type="password" placeholder="Mật khẩu" name="customer_password">
                            
                            <button type="submit" class="btn btn-success">Đăng ký</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection