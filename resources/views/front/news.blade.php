@extends('front.layouts.main')

@section('content')
<!-- Page Title ============================================= -->
<section id="page-title">

	<div class="container clearfix">
		<h1>Novedades</h1>
		<span>{{ $category ? $category->name : 'Nuestras últimas novedades' }}</span>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
			@if($category)
				<li class="breadcrumb-item"><a href="{{ route('news') }}">Novedades</a></li>
				<li class="breadcrumb-item active" aria-current="page">
					{{ $category->name }}
				</li>
			@else
				<li class="breadcrumb-item active" aria-current="page">Novedades</li>
			@endif
		</ol>
	</div>

</section><!-- #page-title end -->


<!-- Content ============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">

			<!-- Posts
			============================================= -->
			<div id="posts" class="post-grid row grid-container gutter-30" data-layout="fitRows">
				@foreach($posts as $p)
					<div class="entry col-lg-3 col-md-4 col-sm-6 col-12">
						<div class="grid-inner">
							<div class="entry-image">
								<a href="{{ route('news.view', $p->slug) }}">
									@if($p->photos->count() > 0)
										@php
										$photo = $p->photos->first();
										$imgSrc = 'photos/'.$photo->path.'IMG1_'.$photo->filename;
										@endphp
										<img src="{{ asset($imgSrc) }}" alt="">
									@else
										<img src="{{ asset('img/posts/post-list.jpg') }}" alt="">
									@endif
									
								</a>
							</div>
							<div class="entry-title">
								<h2>
									<a href="{{ route('news.view', $p->slug) }}">
										{{ Str::limit($p->title, 40, '...') }}
									</a>
								</h2>
							</div>
							<div class="entry-meta">
								<ul>
									<li>
										<i class="icon-calendar3"></i>&nbsp;
										<small>
											{{ $p->published_at->format('d M Y') }}
										</small>
									</li>
									<li>
										<a href="{{ route('news', ['category' => $p->category->slug]) }}">
											<i class="icon-tag"></i>&nbsp;
											<small>
												{{ $p->category->name }}
											</small>
										</a>
									</li>
								</ul>
							</div>
							<div class="entry-content">
								<p>
									{!! strip_tags(Str::limit($p->content, 150, '...')) !!}
								</p>
								<a href="{{ route('news.view', $p->slug) }}" class="more-link">Leer más</a>
							</div>
						</div>
					</div>
				@endforeach
			</div>



			<!-- Pagination
			============================================= -->
			{{ $posts->appends($request->all())->links() }}
		</div>
	</div>
</section>
@endsection