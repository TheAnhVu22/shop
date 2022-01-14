<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style type="text/css">
		.coupon{
			border: 5px solid;
			width: 80%;
			max-width: 600px;
		}
		.container{
			background-color: #daf5e1;
			padding: 1px 16px;
		}
		.promo{
			padding: 3px;
			background-color: #abf7bf;
		}
		.expire{
			color: red;
		}
		p.code{
			text-align: center;
		}
		p.expire{
			text-align: center;
		}
		h1.note{
			color: red;
			text-align: center;
			
		}
	</style>
</head>
<body>
	<div class="coupon">
		<div class="container">
			<h3>Khuyến mãi dành cho khách hàng từ shop <a href="http://shopanhthe.com/shop/public/" target="_blank">https://shopanhthe.com</a></h3>
		</div>
		<div class="container">
			<h1 class="note"><b><i>Giảm 
				@if ($ma['condition']==1)
					{{$ma['number']}} %
				@else
					{{number_format($ma['number'])}} vnđ
				@endif cho tổng đơn hàng
			</i></b></h1>
			<p>Chương trình chi ân những khách đã từng mua hàng tại: <a href="http://shopanhthe.com/shop/public/" target="_blank">https://shopanhthe.com</a>. Nếu đã có tài khoản, vui lòng <a href="http://shopanhthe.com/shop/public/login_checkout" target="_blank">đăng nhập</a>
			và nhập mã code bên dưới để được giảm giá!</p>
		</div>
		<div class="container">
			<p>Nhập mã code: <span class="promo">{{$ma['code']}}</span> số lượng mã: {{$ma['quantity']}}</p>
			<p class="expire">Thời gian hiệu lực: từ ngày {{$ma['start_date']}} đến ngày {{$ma['end_date']}}</p>
		</div>
		<div class="container">
			<p class="code">ATVshop xin chân thành cảm ơn</p>
		</div>
	</div>
</body>
</html>