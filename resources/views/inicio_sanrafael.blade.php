<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sube Mendoza </title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css">
    <link href="css/principal.css" rel="stylesheet">
</head>

<body>
    <header class="header"></header>
    <main>
        <div class="banner">
            <img src="assets/images/2021/logo.png" class="logo">
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
                <h3 class="item-name">Jubilados San Rafael y Discapacidad</h3>
                <p class="item-text">
                    Si Ud. es actualmente reside en San Rafael beneficiario del Mayores de 70 Años, Discapacidad o Ley
                    7811, solicite su Tarjeta SUBE y sera enviada a su domicilio
                </p>
            </div>
        </section>
    </main>
    <footer></footer>

</body>

</html>
