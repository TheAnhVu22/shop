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
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                @endif
                <div class="col-sm-12">
                    <div class="login-form"><!--login form-->
                        <h2>Nhập email đăng ký tài khoản để lấy lại mật khẩu</h2>
                        <form action="{{ url('/lay_mk') }}" method="POST">
                            @csrf
                            <input type="email" name="login_email" placeholder="Nhập Email" value="{{old('login_email')}}">
                            
                            <button type="submit" class="btn btn-success" style="background-color:#29C31F">Lấy mật khẩu</button>
                        </form>
                       
                    </div><!--/login form-->
                </div>
                
                
            </div>
        </div>
    </section><!--/form-->
@endsection