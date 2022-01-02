@extends('layout')

@section('content')

	<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">{{$cate_name->cate_blog_name}}</h2>
						@foreach ($blog as $key => $dulieu)
						<hr>
							<div class="single-products" style="margin: 10px 0;"  class="border">

							<a href="{{ route('view_blog',$dulieu->blog_slug) }}">
										<div class="text-center">
										<img src="{{ asset('uploads/'.$dulieu->blog_image) }}" alt="" style="float: left; width: 40%; padding: 5px;">
										<h4 style="color:black; padding: 5px;">{{$dulieu->blog_name}}</h4>
										{{-- <h6 style="color:black;">
										@php
											$tomtat=substr($dulieu->blog_desc, 0,100);
										@endphp
										{!!$tomtat!!}
										</h6> --}}
										
										<p style="color:black;"><i class="fas fa-user-circle"></i> {{$dulieu->blog_author}} - <i class="fas fa-clock"></i> {{$dulieu->created_at}}</p>
									</div>
								
							</a>
							</div>
							<div class="clearfix"></div>
						@endforeach
						<br>
	{{$blog->onEachSide(1)->links('pagination::bootstrap-4')}}
					</div>
				</div>

@endsection

