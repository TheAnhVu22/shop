@extends('layout')

@section('content')

	<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Bài viết mới nhất</h2>
						@foreach ($blog as $key => $dulieu)
						
						<div class="single-blog-post">
							<h3>{{$dulieu->blog_name}} </h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> {{$dulieu->blog_author}}</li>
									<li><i class="fa fa-clock-o"></i> {{$dulieu->created_at}}</li>
									
								</ul>
							</div>
							<a href="">
								<img src="{{ asset('uploads/'.$dulieu->blog_image) }}" alt="" height="200">
							</a>
							<p>
							@php
								$tomtat= substr($dulieu->blog_desc, 0, 200);
							@endphp</p>
							{{$tomtat."..."}}
							<a  class="btn btn-primary" href="{{ route('view_blog',$dulieu->blog_slug) }}">Đọc thêm</a>
						</div>
						
							{{-- expr --}}
						@endforeach
						<br>
	{{$blog->onEachSide(1)->links('pagination::bootstrap-4')}}
					</div>
				</div>

@endsection