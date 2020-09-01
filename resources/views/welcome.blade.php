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
</head>

<body>
	@include('sweetalert::alert')
	<div class="clearfix"></div>
	<div class="wrapper">
		<div class="steps-area steps-area-fixed">
			<div class="image-holder">
				<img src="sitio/assets/img/side-img.jpg" alt="">
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
									<span class="step-no">PASO 1</span>
									<h4>Si Ud. es actualmente beneficiario del Abono de Jubilado, Mayores de 70 Años, Discapacidad o Ley 7811, solicite su Tarjeta SUBE completando el siguiente formulario.
										Su Tarjeta SUBE sera enviada a su domicilio.</h4>
									<h2>Ingrese el número de D.N.I</h2>
									<div class="form-inner-area">
										<input type="number" name="dni" id="dni" class="form-control required" maxlength="11" minlength="8" placeholder="Ingrese número de documento" required>
									</div>
									<h2>Ingrese el número de trámite de su documento nacional de identidad</h2>
                                    <p>El número de Trámite son los once dígitos numéricos que se encuentran al frente de su DNI</p>
                                
                                        <div class="form-inner-area">
                                            <input type="number" name="nro_tramite" id="nro_tramite" class="form-control required" maxlength="11" minlength="11" placeholder="Ingrese número de trámite" required>
                                        </div>
                                    <div align="center">
                                        <div class="col-6">
                                            <img src="sitio/images/dni-tramite.png" class="img-fluid">
                                        </div>
                                    </div>
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
									<span class="step-no bottom-line">PASO 2</span>&nbsp;&nbsp;
									<div class="step-progress float-right">
										<span>2 de 3 Completado</span>
										<div class="step-progress-bar">
											<div class="progress">
												<div class="progress-bar" style="width:70%"></div>
											</div>
										</div>
									</div>
									<h2>Complete sus datos personales</h2>
									<p>Por favor complete el siguiente formulario.</p>
									<div class="form-inner-area">
                                        <input type="text" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control required"  placeholder="Fecha de Nacimiento *"  data-inputmask-alias="date" data-inputmask-inputformat="dd/mm/yyyy"  required>
                                        <input type="text" id="apellido" name="apellido" class="form-control required" minlength="2" placeholder="Apellido *" required>
                                        <input type="text" id="nombre" name="nombre" class="form-control required" minlength="2" placeholder="Nombre *" required>
                                        <input type="text" id="cuit" name="cuit" class="form-control required" minlength="2" placeholder="CUIT *" data-inputmask="'mask': '99-99999999-9'" required>
										<input type="text" id="email" name="email" class="form-control required" placeholder="Dirección de correo electrónico" data-inputmask="'alias': 'email'">
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
									<span class="step-no bottom-line">PASO 3</span>
									<div class="step-progress float-right">
										<span>3 de 3 Completado</span>
										<div class="step-progress-bar">
											<div class="progress">
												<div class="progress-bar" style="width:100%"></div>
											</div>
										</div>
									</div>
									<h2>Complete los datos de su domicilio</h2>
                                    <p>Por favor complete el formulario con los datos de su domicilio</p>
                                    <div class="form-inner-area">
									    <input type="text" name="calle" id="calle" class="form-control required" placeholder="Calle de su domicilio *" required>
                                        <input type="number" name="nro_calle" id="nro_calle" class="form-control required col-lg-5 col-xs-3"  placeholder="Numeración de su domicilio" required>
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
                                        <input type="text" name="localidad" id="localidad" class="form-control required" placeholder="Localidad *" required>
                                        <div class="language-select">
                                            <p>Seleccione el Departamento: </p>
                                            <select name="departamento" id="departamento">
                                                <option value="Capital">Capital</option>
                                                <option value="Maipu">Maipu</option>
                                                <option value="Las Heras">Las Heras</option>
                                                <option value="Godoy Cruz">Godoy Cruz</option>
                                                <option value="Guaymallen">Guaymallén</option>
                                            </select>
                                        </div>
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
	<script src="sitio/assets/js/main.js"></script>
    <script src="sitio/assets/js/switch.js"></script>
	
	
	<script>
		_validate = null;
        $(document).ready(function(){
            $(":input").inputmask();_validate = null;
			$("#cuit" ).focusout(function() {	
				let val = $(this).val();
				if(val != _validate){
					_validate = val;
					$.ajax({
						url: "/sitio/validar/abono/",
						method: 'POST',
						data: {
							documento: val,
						},
					}).done(function(data) {
						if(data.status == 'error'){
							$.alert({
								title: 'Advertencia',
								content: 'Ud. no está registrado como beneficiario jubilado o mayores de 70 años o discapacitados o ley 7811',
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
							
						}
					});

				}
			});
		});
	</script>
</body>

</html>