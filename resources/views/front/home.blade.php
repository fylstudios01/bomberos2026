@extends('front.layouts.main')

@section('content')

<section id="slider" class="slider-element slider-parallax swiper_wrapper min-vh-60 min-vh-md-100">
	<div class="slider-inner">
		<div class="swiper-container swiper-parent">
			<div class="swiper-wrapper">
				<div class="swiper-slide dark">
					<div class="container">
						<div class="slider-caption slider-caption-center">
							<h2 data-animate="fadeInUp text-uppercase">BOMBEROS DE YERBA BUENA</h2>
							<p class="d-none d-sm-block text-uppercase" data-animate="fadeInUp" data-delay="200">Servicio Nacional de Bomberos</p>
						</div>
					</div>
					<div class="swiper-slide-bg" style="background-image: url('{{ asset('img/home/slider/1.jpg') }}');"></div>
				</div>
				<div class="swiper-slide dark">
					<div class="container">
						<div class="slider-caption slider-caption-center">
							<h2 data-animate="fadeInUp">Al servicio de la comunidad desde 2008</h2>
						</div>
					</div>
					<div class="swiper-slide-bg" style="background-image: url('{{ asset('img/home/slider/2.jpg') }}');"></div>
				</div>
				<div class="swiper-slide dark">
					<div class="container">
						<div class="slider-caption">
							<h2 data-animate="fadeInUp">Institucion a la vanguardia de la seguridad siniestral</h2>
						</div>
					</div>
					<div class="swiper-slide-bg" style="background-image: url('{{ asset('img/home/slider/3.jpg') }}'); background-position: center top;"></div>
				</div>
				<div class="swiper-slide dark">
					<div class="container">
						<div class="slider-caption">
							<h2 data-animate="fadeInUp">Referentes en rescate con sistemas de cuerdas en el NOA</h2>
						</div>
					</div>
					<div class="swiper-slide-bg" style="background-image: url('{{ asset('img/home/slider/4.jpg') }}'); background-position: top top;"></div>
				</div>
			</div>
			<div class="slider-arrow-left"><i class="icon-angle-left"></i></div>
			<div class="slider-arrow-right"><i class="icon-angle-right"></i></div>
			<div class="slide-number"><div class="slide-number-current"></div><span>/</span><div class="slide-number-total"></div></div>
		</div>
	</div>
</section>

<section id="content">
	<div class="content-wrap">
		<div id="section-about" class="center page-section pt-0">

			<div class="container clearfix">

				<h2 class="mx-auto bottommargin font-body" style="max-width: 700px; font-size: 40px;">
					Bomberos de Yerba Buena
				</h2>

				<p class="lead mx-auto bottommargin" style="max-width: 800px;">
					El cuerpo de Bomberos de Yerba Buena fue creado el 26 de agosto de 2008 con el proposito de cubrir la jusridcción de la ciudad de Yerba Buena. Institución oficializada por el Consejo Nacional de Bomberos de la República Argentina desde dicha fecha hasta el día de hoy, donde se permanece activamente al servicio de la comunidad.
					Actualmente el Cuerpo se encuentra en pleno desarrollo: Mejorar equipamientos!
					Infraestructura  y gestion para una mejor respuesta al  vecino yerbabuenense.
				</p>

				<a href="{{ route('about') }}" class="button button-border button-dark button-rounded button-large ms-0 topmargin-sm">Conocé a nuestro presidente</a>

				<div class="clear"></div>

			</div>

		</div>

		<div id="section-works" class="page-section pt-0 pb-0">

			<div class="section m-0">
				<div class="container clearfix">
					<div class="mx-auto center" style="max-width: 900px;">
						<h2 class="mb-0 font-weight-light ls1">
							Realizamos rescate y recuperación de animales de todo tipo y tamaños en situación de peligro o que haga peligrar a terceros.
						</h2>
					</div>
				</div>
			</div>

		</div>

		<section id="content">
			<div class="content-wrap">
				<div class="container clearfix">

					<div class="grid-filter-wrap">
						<!-- Grid Filter
						============================================= -->
						<ul class="grid-filter" data-container="#demo-gallery">
							<li class="activeFilter">
								<a href="#" data-filter="*">Todo</a>
							</li>
							<li><a href="#" data-filter=".pf-alto-riesgo">Rescates de alto riesgo</a></li>
							<li><a href="#" data-filter=".pf-vida-salvaje">Vida Salvaje</a></li>

						</ul><!-- .grid-filter end -->
					</div>

					<div id="demo-gallery" class="masonry-thumbs grid-container grid-6" data-lightbox="gallery">
						@for($i = 1; $i < 36; $i++)
							<a href="{{ asset('img/home/rescates-alto-riesgo/'.$i.'.jpg') }}" data-lightbox="gallery-item" class="grid-item pf-alto-riesgo">
								<img src="{{ asset('img/home/rescates-alto-riesgo/th/'.$i.'.jpg') }}" alt="">
							</a>
						@endfor

						@for($j = 1; $j < 31; $j++)
							<a href="{{ asset('img/home/rescates-vida-salvaje/'.$j.'.jpg') }}" data-lightbox="gallery-item" class="grid-item pf-vida-salvaje">
								<img src="{{ asset('img/home/rescates-vida-salvaje/th/'.$j.'.jpg') }}" alt="">
							</a>
						@endfor
					</div>

				</div>
			</div>
		</section><!-- #content end -->

		<div id="section-services" class="page-section pt-0 pb-0">

			<div class="section dark m-0">
				<div class="mx-auto center" style="max-width: 900px;">
					<h2 class="mb-0 font-weight-light ls1">
						Querés colaborar con nosotros? <a href="#" data-scrollto="#section-contact" data-offset="140" data-easing="easeInOutExpo" data-speed="1250" class="button button-border button-circle button-light button-large my-0" style="position: relative; top: -3px;">Sumate como voluntario</a>
						<a href="#" data-scrollto="#section-donate" data-offset="140" data-easing="easeInOutExpo" data-speed="1250" class="button button-border button-circle button-light button-large my-0" style="position: relative; top: -3px;">Doná</a>
					</h2>
				</div>
			</div>

		</div>

		
		<div id="section-blog" class="page-section">
			@if($latestNews->count() > 0)
			<h2 class="text-center text-uppercase font-weight-light ls3 font-body">
				Últimas novedades
			</h2>

			<div class="section mb-0">
				<div class="container clearfix">

					<div class="row justify-content-center col-mb-50">
						@foreach($latestNews as $ln)
						<div class="col-sm-6 col-lg-4">
							<div class="feature-box media-box">
								<div class="fbox-media">
									<a href="{{ route('news.view', $ln->slug) }}">
										@if($ln->photos->count() > 0)
											@php
											$photo = $ln->photos->first();
											$imgSrc = 'photos/'.$photo->path.'IMG1_'.$photo->filename;
											@endphp
											<img src="{{ asset($imgSrc) }}" alt="">
										@else
											<img src="{{ asset('img/posts/post-list.jpg') }}" alt="">
										@endif
									</a>
								</div>
								<div class="fbox-content px-0">
									<h3>
										{{ Str::limit($ln->title, 40, '...') }}
										<span class="subtitle">
											{{ $ln->category->name }}.
										</span>
									</h3>
									<p>
										{!! strip_tags(Str::limit($ln->content, 180, '...')) !!}
									</p>
								</div>
							</div>
						</div>
						@endforeach
					</div>

					<div class="topmargin center">
						<a href="{{ route('news') }}" class="button button-border button-circle font-weight-semibold">
							Ver todas las novedades
						</a>
					</div>

				</div>
			</div>
			@endif

			<div class="container topmargin-lg clearfix">

				<div id="oc-clients" class="owl-carousel topmargin image-carousel carousel-widget" data-margin="80" data-loop="true" data-nav="false" data-autoplay="5000" data-pagi="false" data-items-xs="1" data-items-sm="3" data-items-md="3" data-items-lg="3" data-items-xl="3">

					<div class="oc-item">
						<a href="#"><img src="{{ asset('img/brands/fara.jpg') }}" alt=""></a>
					</div>
					<div class="oc-item">
						<a href="#"><img src="{{ asset('img/brands/ceob.jpg') }}" alt=""></a>
					</div>
					<div class="oc-item">
						<a href="#"><img src="{{ asset('img/brands/bomberos.jpg') }}" alt=""></a>
					</div>

				</div>

			</div>

		</div>

		<div id="section-donate" class="section mb-0 mt-0">
			<div class="container clearfix">

				<div class="row align-items-center col-mb-50">
					<div class="col-md-4 center">
						<img data-animate="fadeInLeft" src="{{ asset('img/logo-donar.png') }}" alt="Sumate a F.A.R.A.">
					</div>

					<div class="col-md-8 text-md-start">
						<div class="heading-block border-bottom-0">
							<h3>Doná &amp; Ayudános.</h3>
						</div>

						<p>
							Podés ayudarnos de diferentes formas, desde sumarte como colaborador, aportar materiales con los que trabajamos. También podés colaborar de forma económica con un aporte mensual a nuestra cuenta corriente (ver datos más abajo) o simplemente con una colaboración rápida a través del botón de colaboración online. Además podés sumarte como socio, para ello contactáte con nosotros a través de cualquiera de nuestros medios de contacto para que un colaborador nuestro se llegue por tu domicilio.
						</p>

						<p>
							A través de tu ayuda podrás participar en la entrega de obsequios y sorteos que se realizarán de forma periódica y a través de una rifa virtual.
						</p>

						<a href="#modalAccount" data-lightbox="inline" class="button button-border button-dark button-rounded button-large ms-0 topmargin-sm">Cuenta Corriente</a>
						<a href="#modalOnlinePayment" data-lightbox="inline" class="button button-border button-dark button-rounded button-large ms-0 topmargin-sm">Colaboración Online</a>

						<!-- Modal -->
						<div class="modal1 mfp-hide" id="modalAccount">
							<div class="block mx-auto" style="background-color: #FFF; max-width: 500px;">
								<div class="center" style="padding: 50px;">
									<h3>Datos Bancarios</h3>
									<p class="mb-0">
										A continuación le brindamos los datos de nuestra cuenta para que puedar realizar su colaboración a través de transferencia bancaria
									</p>
									<ul class="left text-left mt-2">
										<li>
											Banco:&nbsp;
											<b>Banco de la Nación Argentina</b>
										</li>
										<li>
											No. Cuenta:&nbsp;
											<b>7810078520</b>
										</li>
										<li>
											CBU:&nbsp;
											<b>01107816/40078100785208</b>
										</li>
									</ul>
								</div>
								<div class="section center m-0" style="padding: 30px;">
									<a href="#" class="button" onClick="$.magnificPopup.close();return false;">Cerrar</a>
								</div>
							</div>
						</div>

						<!-- Modal -->
						<div class="modal1 mfp-hide" id="modalOnlinePayment">
							<div class="block mx-auto" style="background-color: #FFF; max-width: 500px;">
								<div class="center" style="padding: 50px;">
									<h3>Colaboración Online</h3>
									<p class="text-left">
										Seleccione el monto con el que desea colaborar, luego presione el botón <b>Colaborar</b> y será redirigido a la plataforma de <b>MercadoPago</b> para finalizar la operación. Gracias.
									</p>
									<div class="form-group">
										<select class="form-control" id="select-donate">
											<option value="{{ env('MP_1000') }}">Colaborá con $ 1000</option>
											<option value="{{ env('MP_2000') }}">Colaborá con $ 2000</option>
											<option value="{{ env('MP_3000') }}">Colaborá con $ 3000</option>
											<option value="{{ env('MP_SUBS') }}">Suscripción</option>
										</select>
									</div>
								</div>
								<div class="section center m-0" style="padding: 30px;">
									<a href="#" class="button" onClick="$.magnificPopup.close();return false;">Cerrar</a>
									<button class="button button-3d button-green" id="submit-donate">
										Colaborar
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>

		<div id="section-contact" class="page-section pt-0 pb-0">

			<div class="container clearfix">

				<div class="mx-auto topmargin" style="max-width: 850px;">

					<div class="form-widget">

						<h3>Sumate como voluntario</h3>

						<div class="form-result"></div>

						<form class="row mb-0" id="template-contactform" name="template-contactform" action="{{ route('mail.send') }}" method="post">
							@csrf
							
							<div class="form-process">
								<div class="css3-spinner">
									<div class="css3-spinner-scale-ripple">
										<div></div>
										<div></div>
										<div></div>
									</div>
								</div>
							</div>

							<div class="col-md-6 mb-4">
								<input type="text" id="template-contactform-name" name="template-contactform-name" value="" class="sm-form-control border-form-control required" placeholder="Nombre" />
							</div>
							<div class="col-md-6 mb-4">
								<input type="email" id="template-contactform-email" name="template-contactform-email" value="" class="required email sm-form-control border-form-control" placeholder="Email" />
							</div>

							<div class="w-100"></div>

							<div class="col-md-4 mb-4">
								<input type="text" id="template-contactform-phone" name="template-contactform-phone" value="" class="required sm-form-control border-form-control" placeholder="Teléfono" />
							</div>

							<div class="col-md-8 mb-4">
								<input type="text" id="template-contactform-subject" name="subject" value="" class="required sm-form-control border-form-control" placeholder="Asunto" />
							</div>

							<div class="w-100"></div>

							<div class="col-md-12 mb-4">
								<input type="text" id="template-contactform-subject" name="address" value="" class="required sm-form-control border-form-control" placeholder="Dirección" />
							</div>

							<div class="w-100"></div>

							<div class="col-12 mb-4">
								<textarea class="required sm-form-control border-form-control" id="template-contactform-message" name="template-contactform-message" rows="7" cols="30" placeholder="Tú Mensaje"></textarea>
							</div>

							<div class="col-12 center mb-4">
								<button class="button button-border button-circle font-weight-medium ml-0 topmargin-sm" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">Enviar solicitud</button>
							</div>

							<div class="w-100"></div>

							<div class="col-12 d-none">
								<input type="text" id="template-contactform-botcheck" name="template-contactform-botcheck" value="" class="sm-form-control" />
							</div>

							<input type="hidden" name="prefix" value="template-contactform-">

						</form>

					</div>

				</div>

			</div>

		</div>

	</div>
</section><!-- #content end -->
@endsection

@section('scripts')
<script type="text/javascript">
	$('#submit-donate').on('click', function(){
		var v = $('#select-donate option:selected').val();

		window.open(v);
	});
</script>
@endsection