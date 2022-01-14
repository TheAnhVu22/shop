@extends('layout')
@section('content')
	 <section id="form"><!--form-->
        <div class="container">
            <div class="row">
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
                        <div class="alert alert-danger" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                <div class="col-sm-4">
                    <div class="login-form"><!--login form-->
                        <h2>Đăng nhập</h2>
                        <form action="{{ route('login_customer') }}" method="POST">
                            @csrf
                            <input type="email" name="login_email" placeholder="Email Address" value="{{old('login_email')}}">
                            <input autocomplete="off" type="password" name="login_password" placeholder="Password" value="{{old('login_password')}}">
                            <span>
                                <a href="{{ url('/quen_mk') }}">Quên mật khẩu ?</a>
                            </span>
                            <button type="submit" class="btn btn-success" style="background-color:#29C31F">Đăng nhập</button>
                        </form>
                       <p style="text-align: center;">Hoặc</p>
                        <div class="form-group row">
                            <div class="col-4 offset-md-3">
                                <a href="{{ route('login_checkout.google') }}" class="btn btn-warning btn-block">Đăng nhập bằng google</a>
                                <a href="{{ route('login_checkout.facebook') }}" class="btn btn-info btn-block">Đăng nhập bằng facebook</a>
                               
                            </div>
                        </div>
                    </div><!--/login form-->
                </div>
                
                <div class="col-sm-1">
                    <h2 class="or">Hoặc</h2>
                </div>
                <div class="col-sm-4 ">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Đăng ký</h2>
                        <form action="{{ route('customer.store') }}" method="POST">
                            @csrf
                            <input autocomplete="off" type="text" placeholder="Tên" name="customer_name">
                            <input autocomplete="off" type="email" placeholder="Email" name="customer_email">
                            <input autocomplete="off" type="text" placeholder="Số điện thoại" name="customer_phone">
                            <input autocomplete="off" type="password" placeholder="Mật khẩu" name="customer_password">
                            <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                <br/>
                @if($errors->has('g-recaptcha-response'))
                <span class="invalid-feedback" style="display:block">
                    <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                </span>
                @endif
                            <button type="submit" class="btn btn-success" style="background-color:#D13C0F">Đăng ký</button>
                        </form>
                        
                    </div><!--/sign up form-->
                </div>

                

            </div>
        </div>
    </section><!--/form-->
@endsection