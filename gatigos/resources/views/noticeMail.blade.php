<!DOCTYPE html>
<html>

<head>
    <META charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <style>

            .obj_central {
                background: #f2f2f2;
            }
            .row {
            	margin-left: 50px;
            }
        </style>
    <title></title>
</head>
<body>
    <div class="container fondo">
        <div class="row justify-content-center">
                <h3 class="">Recordatorio de visita</h3>
        </div>
        <div class="row">
            <div class="col-5 obj_central">
    <p>Hola señor/a {{ $data->Subject }}. Recuerde que su mascota tiene hora con nosotros mañana a las {{$data->StartTime}}! </p>
    <br><br>
   <p> Si no puede asistir o necesita una nueva hora contacte con nosotros llamando al 666777888 o al email gatigosveterinaria@gmail.com</p>
    <p>Para más información sobre nosotros o consultar el historial de su mascota, no se olvide de visitar nuestra web: www.gatigos.com</p>
            </div>
        </div>
    </div>

</html>
