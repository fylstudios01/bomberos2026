@extends('front.layouts.main')

@section('content')
<!-- Page Title ============================================= -->
<section id="page-title">

	<div class="container clearfix">
		<h1>{{ $post->title }}</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
			<li class="breadcrumb-item"><a href="{{ url('/novedades') }}">Novedades</a></li>
			<li class="breadcrumb-item active" aria-current="page">Detalle</li>
		</ol>
	</div>

</section><!-- #page-title end -->

<!-- Content ============================================= -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">

			<div class="row gutter-40 col-mb-80">
				<!-- Post Content ============================================= -->
				<div class="postcontent col-lg-9">

					<div class="single-post mb-0">

						<!-- Single Post ============================================= -->
						<div class="entry clearfix">

							<!-- Entry Title ============================================= -->
							<div class="entry-title">
								<h2>{{ $post->title }}</h2>
							</div><!-- .entry-title end -->

							<!-- Entry Meta ============================================= -->
							<div class="entry-meta">
								<ul>
									<li>
										<i class="icon-calendar3"></i>&nbsp;
										{{ $post->published_at->format('d M Y') }}
									</li>

									<li>
										<a href="{{ route('news', ['category' => $post->category->slug]) }}">
											<i class="icon-tag"></i>&nbsp;
											<small>{{ $post->category->name }}</small>
										</a>
									</li>

									<li>
										@php
											$u = $post->user; 
											$fullName = $u ? trim($u->name . ' ' . $u->last_name) : $post->author_name;
											$rank = ($u && $u->hierarchy) ? $u->hierarchy->name : null;
											$displayAuthor = $rank ? "$rank $fullName" : $fullName;
										@endphp

										<i class="icon-user"></i> {{ $displayAuthor }}
									</li>
								</ul>
							</div><!-- .entry-meta end -->

							<!-- Entry Image ============================================= -->
							@if($post->photos->count() > 0)
							<div class="entry-image">
								<div class="fslider" data-arrows="false" data-lightbox="gallery">
									<div class="flexslider">
										<div class="slider-wrap">
											@foreach($post->photos as $photo)
												@php
													$imgLink = 'photos/'.$photo->path.'IMG0_'.$photo->filename; 
													$imgSrc  = 'photos/'.$photo->path.'IMG1_'.$photo->filename;
												@endphp

												<div class="slide">
													<a href="{{ asset($imgLink) }}" data-lightbox="gallery-item">
														<img src="{{ asset($imgSrc) }}" alt="{{ $photo->title }}" />
													</a>
												</div>
											@endforeach
										</div>
									</div>
								</div>
							</div><!-- .entry-image end -->
							@endif

							<!-- Entry Content ============================================= -->
							<div class="entry-content mt-0">
								{!! $post->content !!}

								<div class="clear"></div>

								<!-- Post Single - Share ============================================= -->
								<div class="si-share border-0 d-flex justify-content-between align-items-center">
									<span>Compartir esta nota:</span>
									<div>

										<a href="javascript:share('https%3A%2F%2Fwww.facebook.com%2Fsharer%2Fsharer.php?u={{ route('news.view',$post->slug) }}')" class="social-icon si-borderless si-facebook">
											<i class="icon-facebook"></i><i class="icon-facebook"></i>
										</a>

										<a href="javascript:share('http://twitter.com/share?text=Terra+Propiedades&url={{ route('news.view',$post->slug) }}')" class="social-icon si-borderless si-twitter">
											<i class="icon-twitter"></i><i class="icon-twitter"></i>
										</a>

										<a href="https://api.whatsapp.com://send?text={{ route('news.view',$post->slug) }}" class="social-icon si-borderless si-whatsapp">
											<i class="icon-whatsapp"></i><i class="icon-whatsapp"></i>
										</a>

										<a href="mailto:?subject={{ $post->title }}&body=Mira ésta noticia: {{ route('news.view', $post->slug) }}" class="social-icon si-borderless si-email3">
											<i class="icon-email3"></i><i class="icon-email3"></i>
										</a>

									</div>
								</div><!-- Post Single - Share End -->
							</div>

						</div>
					</div>
				</div>

				<!-- Sidebar ============================================= -->
				<div class="sidebar col-lg-3">
					<div class="sidebar-widgets-wrap">
						<div id="post-lists" class="widget clearfix">
							<h4 class="highlight-me" style="font-family: 'Source Sans Pro', sans-serif !important">
								Novedades recientes
							</h4>

							<div class="posts-sm row col-mb-30" id="post-list-sidebar">
								@foreach($latestNews as $ln)
								<div class="entry col-12">
									<div class="grid-inner row no-gutters">

										@if($ln->photos->count() > 0)
										<div class="col-auto">
											<div class="entry-image">
												<a href="#">
													<img src="{{ asset('one-page/images/blog/1s.jpg') }}" alt="Image">
												</a>
											</div>
										</div>
										@endif

										<div class="col pl-3">
											<div class="entry-title">
												<h4>
													<a href="{{ route('news.view', $ln->slug) }}">
														{{ Str::limit($ln->title, 30, '...') }}
													</a>
												</h4>
											</div>

											<div class="entry-meta">
												<ul>
													<li>{{ $ln->published_at->format('d M Y') }}</li>
												</ul>
											</div>
										</div>

									</div>
								</div>
								@endforeach
							</div>

						</div>
					</div>
				</div>
				<!-- Sidebar End -->

			</div>
		</div>
	</div>
</section>
@endsection
