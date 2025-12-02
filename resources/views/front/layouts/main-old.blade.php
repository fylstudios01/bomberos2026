<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Bomberos de Yerba Buena" />

	<!-- Stylesheets
	============================================= -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700|Roboto:300,400,500,700&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('style.css') }}" type="text/css" />

	<!-- One Page Module Specific Stylesheet -->
	<link rel="stylesheet" href="{{ asset('one-page/onepage.css') }}" type="text/css" />
	<!-- / -->

	<link rel="stylesheet" href="{{ asset('css/dark.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/font-icons.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('one-page/css/et-line.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ asset('one-page/css/fonts.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css" />

	<link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

	<meta name="viewport" content="width=device-width, initial-scale=1" />


	<!-- Document Title
	============================================= -->
	<title>Bomberos Yerba Buena</title>

</head>

<body class="stretched side-push-panel">

	<div class="body-overlay"></div>

	<div id="side-panel" class="dark">

		<div id="side-panel-trigger-close" class="side-panel-trigger"><a href="#"><i class="icon-line-cross"></i></a></div>

		<div class="side-panel-wrap">

			<div class="widget widget_links clearfix">

				<h4>Acerca de F.A.R.A.</h4>

				<div style="font-size: 14px; line-height: 1.7;">
					<address style="line-height: 1.7;">
						{{ config('constants.city') }}<br>
						{{ config('constants.state') }}, {{ config('constants.zipcode') }}<br>
					</address>

					<div class="clear topmargin-sm"></div>

					<abbr title="Phone Number">Teléfono:</abbr> {!! config('constants.phone') !!}<br>
					<abbr title="Facebook">Celular:</abbr> {{ config('constants.mobile') }}<br>
					<abbr title="Email Address">Email:</abbr> {{ config('constants.email') }}
				</div>

			</div>

			<div class="widget clearfix">

				<h4>Redes sociales</h4>

				<a href="{{ config('constants.facebook_url') }}" class="social-icon si-small si-colored si-facebook" title="Facebook">
					<i class="icon-facebook"></i>
					<i class="icon-facebook"></i>
				</a>
				<a href="#" class="social-icon si-small si-colored si-twitter" title="Twitter">
					<i class="icon-twitter"></i>
					<i class="icon-twitter"></i>
				</a>
				<a href="#" class="social-icon si-small si-colored si-linkedin" title="LinkedIn">
					<i class="icon-linkedin"></i>
					<i class="icon-linkedin"></i>
				</a>
				<a href="{{ config('constants.instagram_url') }}" class="social-icon si-small si-colored si-instagram" title="Instagram">
					<i class="icon-instagram"></i>
					<i class="icon-instagram"></i>
				</a>
				<a href="#" class="social-icon si-small si-colored si-skype" title="Skype">
					<i class="icon-skype"></i>
					<i class="icon-skype"></i>
				</a>

			</div>

		</div>

	</div>

	<!-- Document Wrapper
	============================================= -->
	<div id="wrapper" class="clearfix">

		<!-- Header
		============================================= -->
		<header id="header" class="full-header header-size-custom" data-sticky-shrink="false">
			<div id="header-wrap">
				<div class="container">
					<div class="header-row">

						<!-- Logo
						============================================= -->
						<div id="logo">
							<a href="{{ url('/') }}" class="standard-logo" data-dark-logo="{{ asset('img/logo-header.png') }}">
								<img src="{{ asset('img/logo-header.png') }}" alt="F.A.R.A">
							</a>
							<a href="{{ url('/') }}" class="retina-logo" data-dark-logo="{{ asset('img/logo-header@2x.png') }}">
								<img src="{{ asset('img/logo-header@2x.png') }}" alt="F.A.R.A">
							</a>
						</div><!-- #logo end -->

						<div class="header-misc">

							<div class="side-panel-trigger header-misc-icon">
								<a href="#"><i class="icon-ellipsis-v"></i></a>
							</div>

						</div>

						<div id="primary-menu-trigger">
							<svg class="svg-trigger" viewBox="0 0 100 100"><path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path><path d="m 30,50 h 40"></path><path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path></svg>
						</div>

						<!-- Primary Navigation
						============================================= -->
						<nav class="primary-menu">
							@php
							$path = Route::getCurrentRoute()->getName();
							$menuClass = $path == 'home' ? 'one-page-menu' : '';
							@endphp
							<ul class="{!! $menuClass !!} menu-container" data-easing="easeInOutExpo" data-speed="1250" data-offset="65">
								@if($path === 'home')
								<li class="menu-item">
									<a href="#" class="menu-link" data-href="#wrapper">
										<div>Inicio</div>
									</a>
								</li>
								<li class="menu-item">
									<a href="#" class="menu-link" data-href="#section-about">
										<div>Quiénes somos</div>
									</a>
								</li>
								<li class="menu-item">
									<a href="#" class="menu-link" data-href="#section-works">
										<div>Rescates</div>
									</a>
								</li>
								<li class="menu-item">
									<a href="#" class="menu-link" data-href="#section-services">
										<div>Servicios</div>
									</a>
								</li>
								<li class="menu-item">
									<a href="#" class="menu-link" data-href="#section-blog">
										<div>Novedades</div>
									</a>
								</li>
								<li class="menu-item">
									<a href="#" class="menu-link" data-href="#section-donate">
										<div>Donar</div>
									</a>
								</li>
								@else
									<li class="menu-item">
										<a href="{{ url('/') }}" class="menu-link">
											<div>&lArr; Volver a Inicio</div>
										</a>
									</li>
								@endif
							</ul>

						</nav><!-- #primary-menu end -->

					</div>
				</div>
			</div>
			<div class="header-wrap-clone"></div>
		</header><!-- #header end -->

		<!-- Content
		============================================= -->
		@yield('content')

		<!-- Footer
		============================================= -->
		<footer id="footer" class="dark border-0">

			<div class="container">
				<div class="footer-widgets-wrap py-5">

					<div class="row col-mb-50">
						<div class="col-md-4">

							<div class="widget clearfix">

								<img src="{{ asset('img/logo-footer.png') }}" alt="" class="footer-logo">

								<p>
									Fundación <strong>Argentina</strong> de Rescate <strong>Animal</strong>
									<br />
									{{ config('constants.city') }} - {{ config('constants.state') }}, {{ config('constants.zipcode') }}
								</p>

								<div>
									<abbr title="Teléfono"><strong>Teléfono:</strong></abbr> {{ config('constants.phone') }}<br>
									<abbr title="Celular"><strong>Celular:</strong></abbr> {{ config('constants.mobile') }}<br>
									<abbr title="Email"><strong>Email:</strong></abbr> {{ config('constants.email') }}
								</div>
							</div>

						</div>

						<div class="col-md-4">

							<div class="widget widget_links clearfix">
								<h4 class="mb-20">Enlaces</h4>

								<ul>
									<li><a href="https://codex.wordpress.org/">Inicio</a></li>
									<li><a href="https://wordpress.org/support/forum/requests-and-feedback">Quiénes somos</a></li>
									<li><a href="https://wordpress.org/extend/plugins/">Rescates</a></li>
									<li><a href="https://wordpress.org/support/">Servicios</a></li>
									<li><a href="https://wordpress.org/extend/themes/">Novedades</a></li>
									<li><a href="https://wordpress.org/news/">Donación</a></li>
									<li><a href="#" data-href="#wrapper">Contacto</a></li>
								</ul>

							</div>

						</div>

						<div class="col-md-4">

							<div class="widget clearfix">
								<h4 class="mb-20">Últimas novedades</h4>

								<div class="posts-sm row col-mb-30" id="post-list-footer">
									<div class="entry col-12">
										<div class="grid-inner row">
											<div class="col">
												<div class="entry-title">
													<h3><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h3>
												</div>
												<div class="entry-meta">
													<ul>
														<li>10 Julio 2021</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
									<div class="entry col-12">
										<div class="grid-inner row">
											<div class="col">
												<div class="entry-title">
													<h3><a href="#">Lorem ipsum dolor sit amet, consectetur</a></h3>
												</div>
												<div class="entry-meta">
													<ul>
														<li>10 Julio 2021</li>
													</ul>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>

						
					</div>

				</div>
			</div>

			<div id="copyrights">
				<div class="container center clearfix">
					Copyrights <a href="https://www.bomberosyerbabuena.com.ar">Bomberos de Yerba Buena</a> {{ date('Y') }} | Todos los derechos reservados
				</div>
			</div>

		</footer><!-- #footer end -->

	</div><!-- #wrapper end -->

	<!-- Go To Top
	============================================= -->
	<div id="gotoTop" class="icon-angle-up"></div>

	<!-- JavaScripts
	============================================= -->
	<script src="{{ asset('js/jquery.js') }}"></script>
	<script src="{{ asset('js/plugins.min.js') }}"></script>

	<!-- Footer Scripts
	============================================= -->
	<script src="{{ asset('js/functions.js') }}"></script>

	@yield('scripts')

</body>
</html>