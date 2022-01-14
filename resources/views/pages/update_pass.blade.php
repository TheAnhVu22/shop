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
                        <h2>Nhập mật khẩu mới</h2>
                        @php
                            $token = $_GET['token'];
                            $email = $_GET['email'];
                        @endphp
                        <form action="{{ url('/update_new_pass') }}" method="POST">
                            @csrf
                            <input type="hidden" name="email" value="{{$email}}">
                            <input type="hidden" name="token" value="{{$token}}">
                            <input type="text" name="password" placeholder="Nhập mật khẩu mới" value="{{old('password')}}">
                            
                            <button type="submit" class="btn btn-success" style="background-color:#29C31F">Cập nhật</button>
                        </form>
                       
                    </div><!--/login form-->
                </div>
                
                
            </div>
        </div>
    </section><!--/form-->
@endsection