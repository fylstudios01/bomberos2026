@extends('front.layouts.main')

@section('content')
<!-- Page Title
============================================= -->
<section id="page-title">

	<div class="container clearfix">
		<h1>Nuestro Presidente</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
			<li class="breadcrumb-item active" aria-current="page">Nuestro Presidente</li>
		</ol>
	</div>

</section><!-- #page-title end -->
<section id="content">
	<div class="content-wrap">
		<div class="container clearfix">
			<p style="text-align: justify;">
				<span class="dropcap">M</span>i nombre es Pedro Hernan Rodriguez Salazar, nacido en Tucumán en el año 1980, crecí en una casa humilde de la ciudad de yerba buena hijo de salma y martin, mis estudios primarios y secundarios completos y actualmente cursando la carrera de abogacía, a pesar de la edad 41 años, siempre creí que jamás es tarde para progresar y capacitarse, actualmente me desempeño como presidente de los bomberos voluntarios de yerba buena, presidente de esta fundación FARA, secretario de la federación 3 de junio de asociaciones de bomberos voluntarios de Tucumán y también ocupo un cargo de revisor de cuentas en el consejo nacional de bomberos de la república argentina. 
			</p>
			<div class="row">
				<div class="col-md-6" style="text-align: justify;">
					En el año 1999 empecé a incursionar en el sistema de bomberos de Tucumán, estando inscripto en un cuartel como aspirante, ya en el 2000 arranque como bombero, ahí di mis primeros pasos en esto que después se convertiría en un sueño echo realidad, estuve en actividad colaborando durante unos años hasta que tome una pausa por mis hijos que ya empezaban a crecer, pero no duro mucho ya que en el año 2007 involucre a unos amigos y vecinos a participar de la construcción de una asociación civil en yerba buena que tuviera como objetivo salvaguardar los bienes y las vidas de las personas, así nació la asociación cuerpo de rescate y bomberos voluntarios de Yerba buena, hoy ya con casi 14 años de vida y con una operatividad muy activa dimos una solución definitiva a una carencia del municipio, contar esto no es por simple ánimo de dar a conocerlo, sino porque por que una cosa lleva a la otra, es asi que se funda FARA! FUNDACION ARGENTINA DE RESCATE ANIMAL en el año 2014, todo lleva a todo, estar en esta área de emergencia te da un panorama amplio y ayuda a elaborar ideas para mejorar, ante una necesidad nace una solución, FARA fue la solución a varias necesidades, que hoy en Tucumán ni en argentina se tenia muy presente, esto sin desmerecer a grandes personas que desarrollaban talvez algunos de estos objetivos pero individualmente o talvez dentro de otras áreas como justamente bomberos voluntarios por ejemplo, pero no así tan especifico.
				</div>
				<div class="col-md-6">
					<img src="{{ asset('img/home/presidente.jpg') }}" alt="Presidente" class="w-100">
				</div>
			</div>

			<p style="text-align: justify;">
			 Muchos llamados por rescates de animales no eran resueltos, ya sea por faltas de recursos o por el simple hecho de que no eran prioritarios para algunos, por lo que muchos animales tenían un final no deseado, es así que desde la institución a la cual pertenecía o sea bomberos voluntarios empecé a prestar más atención a esta problemática que exigía una respuesta, el cariño por los animales y la preocupación fue que nos llevó a ocuparnos, es por esto que quiero que conozcas FARA, una fundación única en el país, que se dedica al rescate de animales de pequeño mediano y gran porte en alto riesgo, o que haga peligrar a terceros, rescate de aves y animales silvestres, actualmente compuesta por voluntarios capacitados que nacen de los mejores instructores de bomberos ya que dentro de nuestras actividades de rescate de animales el conocimiento es fundamental, no solo por el echo de salvar una vida si no por el echo de cuidar la nuestra, si se realiza un trabajo de riesgo se debe tener todo tipo de medidas de seguridad presentes, ya que un error puede costar caro, nuestro trabajo va desde salvar un ave, sacar un  gato de un arbol, hasta sacar un caballo de un pozo, o como de reducir un puma, para conservarlo y devolverlo a su hábitat natural, pero eso lo dejo para que lo vean en nuestra pagina y sigas los rescates y de que manera los hacemos, en estos años se pudo hacer muchos amigos entre ellos FLORA Y FAUNA, RESERVA HORCO MOLLE Y HASTA INTITUCIONES INDPENDIENTES QUE COLABORAN, trabajar en conjunto es lo mejor, por que así es como el resultado mejora. 
			</p>
			<blockquote class="topmargin bottommargin">
			Bueno creo que en estos párrafos resumí un poco de todo, espero te haya sido útil, y te invitamos a que visites nuestras pagina WEB y redes sociales y te sumes a colaborar, un aporte salva una vida. GRACIAS
			</blockquote>
		</div>
	</div>
</section>
@endsection