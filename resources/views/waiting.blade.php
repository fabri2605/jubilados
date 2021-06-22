<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>SUBE SAN RAFAEL</title>
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
        <div class="col-12 text-center">
          <h2>El registro se encontrará disponible a partir del 30 de Junio</h2>
        </div>
		  </div>
    </div>
	  </main>



    @include('sweetalert::alert')
    <script src="/sitio/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/sitio/assets/js/jquery.validate.min.js"></script>
    <script src="/sitio/assets/js/bootstrap.min.js"></script>
	<script src="/js/jquery-confirm.min.js"></script>
</body>