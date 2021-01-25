<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>RETIRALA SUBE MENDOZA</title>
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
		#map {
			width: 100%;
			height: 300px !important;
		}
	</style>
</head>
<body>
	<main role="main">
		<div class="row">
			<div id="map"></div>
		  
		</div>
		<br>
		<div class="container marketing">
		  <div class="row">
            Ventanilla Única (Casa de Gobierno), lunes a viernes de 9 a 15 hs.
            •	Centro de Atención en Perú y Rivadavia, lunes a viernes de 9 a 16 hs; sábado de 9 a 12 hs.
            •	Grupo 100 (STM), lunes a viernes de 9 a 13 hs.
            •	Grupo 200, lunes a viernes de 9 a 16 hs; sábado de 9 a 11 hs.
            •	Grupo 300, luneas a viernes de 8 a 16 hs; sábado de 9 a 12 hs.
            •	Grupo 400, lunes a viernes de 8 a 16 hs; sábado de 9 a 12 hs.
            •	Grupo 700, lunes a viernes de 8 a 14 hs; sábado de 9 a 11 hs.
            •	Grupo 800, lunes a viernes de 9 a 16 hs; sábado de 9 a 11 hs.
            •	Grupo 900 (calle Perón), lunes a viernes de 8 a 15 hs.
            •	Grupo 900 (calle Castro), lunes a viernes de 9 a 12 hs; sábado de 9 a 12 hs.
            •	Terminal de Ómnibus 1 Piso (ala oeste), lunes a viernes de 9 a 17 hs.
          </div>
  
		  <hr class="featurette-divider">
		</div><!-- /.container -->
	  </main>



    @include('sweetalert::alert')
    <script src="/sitio/assets/js/jquery-3.3.1.min.js"></script>
    <script src="/sitio/assets/js/jquery.validate.min.js"></script>
	<script src="/sitio/assets/js/bootstrap.min.js"></script>
	<script src="/sitio/assets/js/retirala.js"></script>
	<script src="/js/jquery-confirm.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ5y0EF8dE6qwc03FcbXHJfXr4vEa7z54&callback=initMap()"></script>
	<script src="/js/jquery-confirm.min.js"></script>
</body>