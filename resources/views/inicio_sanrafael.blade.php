<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sube Mendoza </title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
    <link href="/css/principal.css" rel="stylesheet">
</head>

<body>
    <header class="header">
        <img src="/images/assets/logos/logo1.svg" class="img-fluid">
    </header>
    <main>
        <div class="banner">
            <img src="/assets/images/2021/logo.png" class="logo">
            <h4>Conocé todos los medios disponibles para conseguir tu tarjeta SUBE en San Rafael </h4>
        </div>
        <section class="menu">
            <div class="card">
                <div class="item">
                    <a href="{{route('turno')}}"><i class="far fa-calendar-check"></i></a>
                </div>
                <h3 class="item-name">Turno</h3>
                <p class="item-text">
                    Si Ud. todavia no tiene su Tarjeta SUBE, saca un turno para obtenerla
                </p>
            </div>
            <div class="card">
                <div class="item">
                    <a href="{{route('sanrafael')}}"><i class="far fa-credit-card"></i></a>
                </div>
                <h3 class="item-name">Mayor de 70 años y Discapacidad</h3>
                <p class="item-text">
                    Si Ud. es es Mayor de 70 Años o persona con Discapacidad, solicite el envío de su Tarjeta Sube a su domicilio, llenando el siguiente formulario
                </p>
            </div>
        </section>
    </main>
    <footer>
        <img src="/images/assets/logos/logo2.svg" class="img-fluid">
        <img src="/images/assets/logos/logo3.svg" class="img-fluid">
    </footer>


</body>

</html>
