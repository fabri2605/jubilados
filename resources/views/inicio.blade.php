<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>SUBE MENDOZA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="/sitio/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="/sitio/assets/css/animate.min.css">
	<link rel="stylesheet" href="/sitio/assets/css/fontawesome-all.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,400&display=swap" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="/sitio/assets/css/colors/switch.css">
	<!-- Color Alternatives -->
	<link href="/sitio/assets/css/colors/color-2.css" rel="alternate stylesheet" type="text/css" title="color-2">
	<link href="/sitio/assets/css/colors/color-3.css" rel="alternate stylesheet" type="text/css" title="color-3">
	<link href="/sitio/assets/css/colors/color-4.css" rel="alternate stylesheet" type="text/css" title="color-4">
	<link href="/sitio/assets/css/colors/color-5.css" rel="alternate stylesheet" type="text/css" title="color-5">
	<link rel="stylesheet" type="text/css" href="/sitio/assets/css/colors/switch.css">
	<link rel="stylesheet" href="/landing/fontawesome/css/all.css">
	<style>
		*{
			font-family: 'Roboto', sans-serif;
		}
		.capital{
			text-transform: capitalize;
		}
		.cabecera {
			height: 300px !important;
		}
		.carousel .item img {
			max-height: 300px;
			min-width: auto;
		}
		.elemento{
			font-weight: 500;
    		text-align: center;
    		width: 190px;
    		vertical-align: top;
		}
	</style>
</head>
<body>
	<main role="main">
		<div id="myCarousel" class="carousel slide" data-ride="carousel">
		  <div class="carousel-inner">
			<div class="carousel-item active ">
			  <img class="first-slide img-fluid" src="landing/cabecera.png" alt="First slide">
			</div>
		  </div>
		</div>
		<br>
		<div class="container marketing">
		  <div class="row">
			<div class="col-lg-4">
				<a href="{{route('retirala')}}" class="btn btn-lg" role="button" aria-pressed="true">
					<img src="images/turno.png" class="img-fluid">
				</a>
				<br/><br/>
				<h2>Retirala</h2>
				<p>Si Ud. quiere gestionar un Abono con Tarjeta SUBE, solicite un turno en el lugar de su convenciencia, haciendo click aqui</p>
			</div><!-- /.col-lg-4 -->
			<div class="col-lg-4">
				<a href="{{route('particulares')}}" class="btn  btn-lg active" role="button" aria-pressed="true">
					<img src="images/abono.png" class="img-fluid">
				</a>
				<br/><br/>
				<h2>Abono SUBE</h2>
				<p>Si Ud. todavia no tiene su Tarjeta SUBE, ,solicitela y sera enviada a su domicilio sin cargo, haciendo click aqui</p>
			</div><!-- /.col-lg-4 -->
			<div class="col-lg-4">
				<a href="{{route('home')}}" class="btn  btn-lg active" role="button" aria-pressed="true">
					<img src="images/abono.png" class="img-fluid">
				</a>
				<br/><br/>
				<h2>Abono de Jubilado, Mayores de 70 y Discapacidad</h2>
				<p>Si Ud. es actualmente beneficiario del <b>Abono de Jubilado, Mayores de 70 Años, Discapacidad o Ley 7811</b>, solicite su Tarjeta SUBE y sera enviada a su domicilio, haciendo click aqui</p>
				
			</div><!-- /.col-lg-4 -->
		  </div><!-- /.row -->
  
		  <hr class="featurette-divider">
		</div><!-- /.container -->
	  </main>



    @include('sweetalert::alert')
    <script src="/sitio/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/sitio/assets/js/jquery.validate.min.js"></script>
    <script src="/sitio/assets/js/bootstrap.min.js"></script>
	<script src="/js/jquery-confirm.min.js"></script>
</body>