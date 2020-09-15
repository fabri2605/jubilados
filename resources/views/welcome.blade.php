<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>SUBE Jubilados</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="sitio/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.css">
	<link rel="stylesheet" href="sitio/assets/css/animate.min.css">
	<link rel="stylesheet" href="sitio/assets/css/fontawesome-all.css">
	<link rel="stylesheet" href="sitio/assets/css/style.css">

	<link rel="stylesheet" type="text/css" href="sitio/assets/css/colors/switch.css">
	<!-- Color Alternatives -->
	<link href="sitio/assets/css/colors/color-2.css" rel="alternate stylesheet" type="text/css" title="color-2">
	<link href="sitio/assets/css/colors/color-3.css" rel="alternate stylesheet" type="text/css" title="color-3">
	<link href="sitio/assets/css/colors/color-4.css" rel="alternate stylesheet" type="text/css" title="color-4">
	<link href="sitio/assets/css/colors/color-5.css" rel="alternate stylesheet" type="text/css" title="color-5">

	<link rel="stylesheet" href="/css/jquery-confirm.min.css">
	<style>
		.capital{
			text-transform: capitalize;
		}
	</style>
</head>

<body>
	@include('sweetalert::alert')
	
	<div class="clearfix"></div>
	<div class="wrapper">
		<div class="steps-area steps-area-fixed">
			<div class="image-holder">
				<img class="d-none d-sm-block" src="sitio/assets/img/side-img.png" alt="">
				<img class="d-block d-sm-none" src="sitio/assets/img/side-img-mobile.png" alt="">
			</div>
			<div class="steps clearfix">
				<ul class="tablist multisteps-form__progress">
					<li class="multisteps-form__progress-btn js-active current">
						<span>1</span>
					</li>
					<li class="multisteps-form__progress-btn">
						<span>2</span>
					</li>
					<li class="multisteps-form__progress-btn">
						<span>3</span>
					</li>
				</ul>
			</div>
		</div>
		<form class="multisteps-form__form" action="{{route('sitio.registrar')}}" id="wizard" method="POST">
			<div class="form-area position-relative">
				<div class="multisteps-form__panel js-active" data-animation="slideHorz">
                    <form id="frm-paso1" class="multisteps-form__form">
					<div class="wizard-forms">
						<div class="inner pb-100 clearfix">
							<div class="form-content pera-content">
								<div class="step-inner-content">
									<!--<span class="step-no">PASO 1</span>!-->
									<h4>Si Ud. es actualmente beneficiario del Abono de Jubilado, Mayores de 70 Años,
										Discapacidad o Ley 7811, solicite su Tarjeta SUBE completando el siguiente
										formulario. Su Tarjeta SUBE sera enviada a su domicilio.</h4>
									<hr>
									<h3>Ingrese el Número de D.N.I</h3>
									<div class="form-inner-area">
										<input type="number" name="dni" id="dni" class="form-control required" maxlength="11" minlength="8" placeholder="Ingrese Número de Documento" required>
									</div>
									<h3>Ingrese el Número de Trámite de su Documento Nacional de Identidad</h3>
                                    <p>El número de Trámite son los once dígitos numéricos que se encuentran al frente de su DNI</p>
                                
									<div class="form-inner-area">
										<input type="text" name="nro_tramite" id="nro_tramite" class="form-control required" maxlength="11"  placeholder="Ingrese Número de Trámite" data-inputmask="'mask': '99999999999'" required>
									</div>

									<h3>Ingrese Nuevamente el Número de Trámite de su Documento Nacional de Identidad</h3>
									<div class="form-inner-area">
										<input type="text" name="nro_tramite_repetir" id="nro_tramite_repetir" class="form-control required" maxlength="11"  placeholder="Ingrese Nuevamente su Número de Trámite" data-inputmask="'mask': '99999999999'" required>
									</div>


                                    <div align="center">
                                        <div class="col-6">
                                            <img src="sitio/images/dni-tramite.png" class="img-fluid">
                                        </div>
									</div>
									
									<h4 id="abono-solicitado"></h4>
								</div>
							</div>
						</div>
						<div class="actions">
							<ul>
								<li class="disable" aria-disabled="true"><span class="js-btn-next" title="NEXT">Volver <i class="fa fa-arrow-right"></i></span></li>
								<li><span class="js-btn-next" title="NEXT">Siguiente <i class="fa fa-arrow-right"></i></span></li>
							</ul>
						</div>
                    </div>
				</div>
				<!-- div 2 -->
				<div class="multisteps-form__panel" data-animation="slideHorz">
					<div class="wizard-forms">
						<div class="inner pb-100 clearfix">
							<div class="form-content pera-content">
								<div class="step-inner-content">
									<!--<span class="step-no bottom-line">PASO 2</span>&nbsp;&nbsp;!-->
									<div class="step-progress float-right">
										<span>2 de 3 Completado</span>
										<div class="step-progress-bar">
											<div class="progress">
												<div class="progress-bar" style="width:70%"></div>
											</div>
										</div>
									</div>
									<h2>Complete sus Datos Personales</h2>
									<p>Por favor Complete el Siguiente Formulario.</p>
									<div class="form-inner-area">
                                        <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control required"  placeholder="Fecha de Nacimiento *"  data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy"  required>
                                        <input type="text" id="apellido" name="apellido" class="form-control required capital" minlength="2" placeholder="Apellido *" data-inputmask-regex="[A-Za-z]{25}" required>
                                        <input type="text" id="nombre" name="nombre" class="form-control required capital" minlength="2" placeholder="Nombre *" data-inputmask-regex="[A-Za-z]{25}" required>
                                        <input type="text" id="cuit" name="cuit" class="form-control required" minlength="2" placeholder="CUIT *" data-inputmask="'mask': '99-99999999-9'" required>
										<input type="text" id="email" name="email" class="form-control required" placeholder="Dirección de Correo Electrónico" data-inputmask="'alias': 'email'">
                                        <input type="text" id="celular" name="celular" class="form-control required" placeholder="Celular" data-inputmask="'mask': '+54 999 9999999'" >
                                        <input type="text" id="fijo" name="fijo" class="form-control" placeholder="Teléfono Fijo" data-inputmask="'mask': '+54 999 9999999'">
									</div>
									<div class="gender-selection">
										<h3>Sexo:</h3>
										<label>
											<input type="radio" name="sexo" value="M">
											<span class="checkmark"></span>Masculino
										</label>
										<label>
											<input type="radio" name="sexo" value="F">
											<span class="checkmark"></span>Femenino
										</label>
									</div>
									
								</div>
							</div>
						</div>
						<!-- /.inner -->
						<div class="actions">
							<ul>
								<li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> VOLVER </span></li>
								<li><span class="js-btn-next" title="NEXT">SIGUIENTE <i class="fa fa-arrow-right"></i></span></li>
							</ul>
						</div>
					</div>
				</div>
				<!-- div 3 -->
				<div class="multisteps-form__panel" data-animation="slideHorz">
					<div class="wizard-forms">
						<div class="inner pb-100 clearfix">
							<div class="form-content pera-content">
								<div class="step-inner-content">
									<!--<span class="step-no bottom-line">PASO 3</span>!-->
									<div class="step-progress float-right">
										<span>3 de 3 Completado</span>
										<div class="step-progress-bar">
											<div class="progress">
												<div class="progress-bar" style="width:100%"></div>
											</div>
										</div>
									</div>
									<h2>Complete los Datos de su Domicilio</h2>
                                    <p>Por favor Complete el Formulario con los Datos de su Domicilio donde recibirá la tarjeta</p>
                                    <div class="form-inner-area">
									    <input type="text" name="calle" id="calle" class="form-control required capital" placeholder="Calle de su Domicilio *" required>
                                        <input type="number" name="nro_calle" id="nro_calle" class="form-control required col-lg-5 col-xs-3"  placeholder="Numeración de su Domicilio" required>
                                        <div class="row" style="margin-left: 2px">
                                            <input type="text" name="piso" id="piso" class="form-control col-3 required" placeholder="Piso">
                                            &nbsp;&nbsp;
                                            <input type="text" name="depto" id="depto" class="form-control col-3 required" placeholder="Depto">
                                        </div>
                                        <div class="row" style="margin-left: 2px">
                                            <input type="text" name="manzana" id="manzana" class="form-control col-3 required" placeholder="Manzana">
                                            &nbsp;&nbsp;
                                            <input type="text" name="casa" id="casa" class="form-control col-3 required" placeholder="Casa">
                                        </div>
                                        <input type="text" name="localidad" id="localidad" class="form-control required capital" placeholder="Localidad *" required>
                                        <div class="language-select">
                                            <p>Seleccione el Departamento: </p>
                                            <select name="departamento" id="departamento">
												<option value="Capital">Capital</option>
												<option value="Godoy Cruz">Godoy Cruz</option>
												<option value="Guaymallen">Guaymallén</option>
												<option value="Las Heras">Las Heras</option>
												<option value="Las Heras">Luján de Cuyo</option>
                                                <option value="Maipu">Maipu</option>
                                            </select>
										</div>
										<input type="number" name="codigo_postal" id="codigo_postal" class="form-control required col-lg-5 col-xs-3"  placeholder="Ingrese su Código Postal" data-inputmask="'mask': '9999'" minlength="4" maxlength="4" required>
                                    </div>                                        
								</div>
							</div>
						</div>
						<!-- ./inner -->
						<div class="actions">
							<ul>
								<li><span class="js-btn-prev" title="BACK"><i class="fa fa-arrow-left"></i> VOLVER </span></li>
								<li><button type="submit" title="NEXT">REGISTRAR <i class="fa fa-arrow-right"></i></button></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
	<script src="sitio/assets/js/jquery-3.3.1.min.js"></script>
	<script src="sitio/assets/js/jquery.validate.min.js"></script>
	<script src="sitio/assets/js/input.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="sitio/assets/js/bootstrap.min.js"></script>
	<script src="js/jquery-confirm.min.js"></script>
	<script src="sitio/assets/js/main.js?version=5"></script>
    <script src="sitio/assets/js/switch.js"></script>
	
	
	<script>
		_validate = null;
		_continuar = true;
		_continuarPaso2 = true;
        $(document).ready(function(){
			$(":input").inputmask();_validate = null;
			
			$('#nombre').inputmask({ "placeholder": "" });
			$('#apellido').inputmask({ "placeholder": "" });

			$("#dni" ).focusout(function() {	
				let val = $(this).val();
				if((val != _validate) && val){
					_validate = val;
					$.ajax({
						url: "/sitio/validar/abono/",
						method: 'POST',
						data: {
							documento: val,
						},
					}).done(function(data) {
						if(data.status == 'error'){
							_continuar = false;
							document.getElementById("dni").focus();
							$.alert({
								title: 'Advertencia',
								content: data.msg,
								type: 'red',
								typeAnimated: true,
								icon: 'mdi mdi-alert-circle '+'red',
								buttons: {
									tryAgain: {
										text: 'Aceptar',
										btnClass: 'btn-'+'red',
										close: function(){
											
										}
									},
								
								}
							});
							
						}else{
							$('#abono-solicitado').text(data.msg);
							_continuar = true;
						}
					});

				}
			});
		});
		$("#cuit" ).focusout(function() {
			var vec = new Array(10);
			var cuit = $(this).val();
			esCuit=false;
			esDni=false;
			cuit_rearmado="";
			errors = ''
			for (i=0; i < cuit.length; i++){   
				caracter=cuit.charAt( i);
				if (caracter.charCodeAt(0) >= 48 && caracter.charCodeAt(0) <= 57){
					cuit_rearmado +=caracter;
				}
			}
			cuit=cuit_rearmado;
			if( cuit.length != 11){  // si no estan todos los digitos
				esCuit=false;
			}else {
				x=i=dv=0;
				// Multiplico los dígitos.
				vec[0] = cuit.charAt(  0) * 5;
				vec[1] = cuit.charAt(  1) * 4;
				vec[2] = cuit.charAt(  2) * 3;
				vec[3] = cuit.charAt(  3) * 2;
				vec[4] = cuit.charAt(  4) * 7;
				vec[5] = cuit.charAt(  5) * 6;
				vec[6] = cuit.charAt(  6) * 5;
				vec[7] = cuit.charAt(  7) * 4;
				vec[8] = cuit.charAt(  8) * 3;
				vec[9] = cuit.charAt(  9) * 2;
							
				// Suma cada uno de los resultado.
				for( i = 0;i<=9; i++) {
					x += vec[i];
				}
				dv = (11 - (x % 11)) % 11;
				if (dv == cuit.charAt( 10)){
					esCuit=true;
					_continuarPaso2 = true;
				}
				//valido que el DNI sea el mismo en cuit
				let dni = $('#dni').val();
				let dni_rearmado ='';
				let zerofill = '';

				if(dni.length < 8){
					for(let i = dni.length; i < 8; i++){
						zerofill+='0';
					}
					dni_rearmado = zerofill+dni;
					console.log('dni rearmado', dni_rearmado);
				}
				let dni_str = cuit_rearmado.substring(3,10);

				if(dni_rearmado == dni_str){
					esDni = true;
					_continuarPaso2 = true;
				}
			}
			if(!esCuit ) {
				_continuarPaso2 = false;
				$.alert({
					title: 'Advertencia',
					content: 'El CUIT ingresado no es válido',
					type: 'red',
					typeAnimated: true,
					icon: 'mdi mdi-alert-circle '+'red',
					buttons: {
						tryAgain: {
							text: 'Aceptar',
							btnClass: 'btn-'+'red',
							close: function(){
								document.getElementById("cuit").focus();
							}
						},
					
					}
				});
				
			}
			if(!esDni ) {
				_continuarPaso2 = false;
				$.alert({
					title: 'Advertencia',
					content: 'El DNI Ingresado no concuerda con el CUIL. Verifique',
					type: 'red',
					typeAnimated: true,
					icon: 'mdi mdi-alert-circle '+'red',
					buttons: {
						tryAgain: {
							text: 'Aceptar',
							btnClass: 'btn-'+'red',
							close: function(){
								document.getElementById("cuit").focus();
							}
						},
					
					}
				});
				
			}
			
    	});
	</script>
</body>

</html>