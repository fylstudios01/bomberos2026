<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>

	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Bomberos de Yerba Buena" />

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700|Roboto:300,400,500,700&display=swap" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('style.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ asset('css/swiper.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('one-page/onepage.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ asset('css/dark.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/font-icons.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('one-page/css/et-line.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/animate.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css" />

	<link rel="stylesheet" href="{{ asset('one-page/css/fonts.css') }}" type="text/css" />
	<link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css" />

	<link rel="icon" type="image/x-icon" href="{{ asset('img/favicon.png') }}">

	<meta name="viewport" content="width=device-width, initial-scale=1" />

	<title>Bomberos de Yerba Buena</title>

</head>

<body class="stretched">

<div id="wrapper" class="clearfix">

	<header id="header">
		<div id="header-wrap">
			<div class="container">
				<div class="header-row justify-content-lg-between">

					<div id="logo" class="order-lg-2 col-auto px-0 py-2 mr-0 me-lg-0">
						<a href="{{ url('/') }}" class="standard-logo" data-dark-logo="{{ asset('img/logo-header.png') }}">
							<img src="{{ asset('img/logo-header.png') }}" alt="F.A.R.A">
						</a>
						<a href="{{ url('/') }}" class="retina-logo" data-dark-logo="{{ asset('img/logo-header@2x.png') }}">
							<img src="{{ asset('img/logo-header@2x.png') }}" alt="F.A.R.A">
						</a>
					</div>

					<div class="header-misc d-flex d-lg-none">
						<div class="side-panel-trigger header-misc-icon">
							<a href="#"><i class="icon-ellipsis-v"></i></a>
						</div>
					</div>

					<div id="primary-menu-trigger">
						<svg class="svg-trigger" viewBox="0 0 100 100">
							<path d="m 30,33 h 40 c 3.722839,0 7.5,3.126468 7.5,8.578427 0,5.451959 -2.727029,8.421573 -7.5,8.421573 h -20"></path>
							<path d="m 30,50 h 40"></path>
							<path d="m 70,67 h -40 c 0,0 -7.5,-0.802118 -7.5,-8.365747 0,-7.563629 7.5,-8.634253 7.5,-8.634253 h 20"></path>
						</svg>
					</div>

					@php
						$path = Route::getCurrentRoute()->getName();
					@endphp

					<!-- LEFT MENU -->
					<nav class="primary-menu order-lg-1 col-lg-5 px-0" style="position:inherit;">
						<ul class="menu-container">
							@if($path === 'home')
								<li class="menu-item"><a href="#" class="menu-link" data-href="#section-about"><div>Inicio</div></a></li>
								<li class="menu-item"><a href="{{ route('about') }}" class="menu-link"><div>Quiénes somos</div></a></li>
								<li class="menu-item"><a href="{{ route('news') }}" class="menu-link"><div>Novedades</div></a></li>
							@else
								<li class="menu-item"><a href="{{ url('/') }}" class="menu-link"><div>&lArr; Volver a Inicio</div></a></li>
							@endif
						</ul>
					</nav>

					<!-- RIGHT MENU -->
					<nav class="primary-menu order-lg-3 col-lg-5 px-0" style="position:inherit;">
						<div class="menu-container justify-content-lg-end">

							@if($path === 'home')

								<li class="menu-item">
									<a href="#" class="menu-link" data-scrollto="#section-donate">
										<div>Donar</div>
									</a>
								</li>

								<li class="menu-item">
									<a href="#" class="menu-link" data-scrollto="#section-contact">
										<div>Voluntariado</div>
									</a>
								</li>

								<!-- 🔥 NUEVO BOTÓN ACCESO -->
								<li class="menu-item">
									<a href="{{ url('/admin') }}" class="menu-link">
										<div>Acceso</div>
									</a>
								</li>

							@else

								<li class="menu-item">
									<a href="{{ route('home') }}#section-donate" class="menu-link">
										<div>Donar</div>
									</a>
								</li>

								<li class="menu-item">
									<a href="{{ route('home') }}#section-contact" class="menu-link">
										<div>Voluntariado</div>
									</a>
								</li>

								<!-- 🔥 NUEVO BOTÓN ACCESO -->
								<li class="menu-item">
									<a href="{{ url('/admin') }}" class="menu-link">
										<div>Acceso</div>
									</a>
								</li>

							@endif

						</div>
					</nav>

				</div>
			</div>
		</div>
		<div class="header-wrap-clone"></div>
	</header>

	@yield('content')

	<!-- FOOTER ORIGINAL (NO TOCADO) -->
	<footer id="footer" class="dark">
		<div id="copyrights">
			<div class="container">
				<div class="row justify-content-between col-mb-30">

					<div class="col-12 col-lg-auto text-center text-lg-start order-last order-lg-first">
						<img src="{{ asset('img/logo-footer.png') }}" alt="" class="mb-4 float-start">
						<div class="float-start ms-4">
							<strong>Bomberos de Yerba Buena</strong><br />
							{{ config('constants.address') }} - {{ config('constants.city') }} - {{ config('constants.state') }}, {{ config('constants.zipcode') }}<br />
							<abbr title="Celular"><strong>Telefonos:</strong></abbr> {{ config('constants.mobile') }}<br />
							<abbr title="Email"><strong>Email:</strong></abbr> {{ config('constants.email') }}
						</div>
					</div>

					<div class="col-12 col-lg-auto text-center text-lg-end">
						<div class="copyrights-menu copyright-links">
							<a href="{{ route('home') }}">Inicio</a> /
							<a href="{{ route('about') }}">Quiénes somos</a> /
							<a href="{{ route('news') }}">Novedades</a>
						</div>

						<a href="{{ config('constants.facebook_url') }}" class="social-icon inline-block si-small si-borderless mb-0 si-facebook" target="_blank">
							<i class="icon-facebook"></i><i class="icon-facebook"></i>
						</a>

						<a href="{{ config('constants.instagram_url') }}" class="social-icon inline-block si-small si-borderless mb-0 si-instagram" target="_blank">
							<i class="icon-instagram"></i><i class="icon-instagram"></i>
						</a>

						<a href="https://api.whatsapp.com/send?phone={{ config('constants.phone_app') }}" class="social-icon inline-block si-small si-borderless mb-0 si-whatsapp" target="_blank">
							<i class="icon-whatsapp"></i><i class="icon-whatsapp"></i>
						</a>

						<a href="mailto:{{ config('constants.email') }}" class="social-icon inline-block si-small si-borderless mb-0 si-twitter">
							<i class="icon-envelope"></i><i class="icon-envelope"></i>
						</a>

						<p class="text-right">
							Copyrights <a href="http://bomberosyerbabuena.com.ar" target="_blank">Bomberos de Yerba Buena</a> {{ date('Y') }} | Todos los derechos reservados
						</p>
					</div>

				</div>
			</div>
		</div>
	</footer>

</div>

<div id="gotoTop" class="icon-angle-up"></div>

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/plugins.min.js') }}"></script>
<script src="{{ asset('js/functions.js') }}"></script>

<script type="text/javascript">
	function share(link){
	    var dialogWin = new Object();
	    dialogWin.width = 700;
	    dialogWin.height = 435;
	    now = new Date();
	    var millis=now.getTime();
	    var mstr=""+millis;
	    if (navigator.appName == "Netscape") 
	    {
	        dialogWin.left = window.screenX + ((window.outerWidth - dialogWin.width) / 2);
	        dialogWin.top = window.screenY + ((window.outerHeight - dialogWin.height) / 2);
	        var attr = 'screenX=' + dialogWin.left + ',screenY=' + dialogWin.top + ',resizable=no,width=' + dialogWin.width + ',height=' + dialogWin.height + ',scrollbars=yes,menubar=no,location=no,toolbar=no,status=no,directories=no';
	    } 
	    else if (document.all) 
	    {
	        dialogWin.left = (screen.width - dialogWin.width) / 2;
	        dialogWin.top = (screen.height - dialogWin.height) / 2;
	        var attr = 'left=' + dialogWin.left + ',top=' + dialogWin.top + ',resizable=no,width=' + dialogWin.width + ',height=' + dialogWin.height + ',scrollbars=yes,menubar=no,location=no,toolbar=no,status=no,directories=no';
	    }
	    
	    window.open(link,'Redes',attr);
	};
</script>

@yield('scripts')

</body>
</html>
