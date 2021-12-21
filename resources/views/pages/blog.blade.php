@extends('layout')
@section('content')
				<div class="col-sm-12">
					<div class="blog-post-area">
						<h2 class="title text-center">Nội dung bài viết</h2>
						<div class="single-blog-post">
							<h3>{{$blog->blog_name}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i>{{$blog->blog_author}}</li>
									
									<li><i class="fa fa-calendar"></i>{{$blog->created_at}}</li>
								</ul>
								<span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<a href="">
								<img src="{{ asset('uploads/'.$blog->blog_image) }}" alt="" width="100%" height="250">
							</a>
							<span>{!!$blog->blog_desc!!}</span>
							
						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area">
						<ul class="ratings">
							<li class="rate-this">Rate this item:</li>
							<li>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</li>
							<li class="color">(6 votes)</li>
						</ul>
						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="images/blog/socials.png" alt=""></a>
					</div><!--/socials-share-->

					<div class="media commnets">
						<h4>Chia sẻ</h4>
						<!-- ----------------------------------------- chia sẻ facebook ------------------------------------>
					    <div class="fb-share-button" data-href="{{\URL::current()}}" data-layout="button_count" data-size="large"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2F{{\URL::current()}}%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Chia sẻ</a></div>
					</div><!--Comments-->
					<div class="response-area">
						<h3>Bình luận</h3>
					
			           <!-- ----------------------------------------- comment facebook ------------------------------------>
			          <div class="fb-comments" data-href="{{\URL::current()}}" data-width="" data-numposts="10"></div>				
					</div>
					
				</div>	
			
@endsection