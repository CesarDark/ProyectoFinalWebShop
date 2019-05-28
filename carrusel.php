<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <title>Carrusel</title>

</head>
<body>
    <div class="container"><br>
        <div class="col-md-12">
            <div id="carousel-1" class="carousel slide" data-ride="carousel">
                <!-- Indicadores -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-1" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-1" data-slide-to="1"></li>
                    <li data-target="#carousel-1" data-slide-to="2"></li>
                </ol>
                <!-- Contenedor de los slide -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="/Images/slide1.jpg" class="img-responsive" alt="">
                        <div class="carousel-caption hidden-xs hidden-sm">
                            <h3>Slide #1</h3>
                            <p>slide</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="/Images/slide2.jpg" class="img-responsive" alt="">
                        <div class="carousel-caption hidden-xs hidden-sm">
                            <h3>Slide #2</h3>
                            <p>slide</p>
                        </div>
                    </div>

                    <div class="item">
                        <img src="/Images/slide3.jpg" class="img-responsive" alt="">
                        <div class="carousel-caption hidden-xs hidden-sm">
                            <h3>Slide #3</h3>
                            <p>slide</p>
                        </div>
                    </div>
                </div>

                <!-- Controles -->
                <a href="#carousel-1" class="left carousel-control" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Anterior</span>
                </a>
                <a href="#carousel-1" class="right carousel-control" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Siguiente</span>
                </a>
            </div>
        </div>
    </div>
    
    <script src="http://code.jquery.com/jquery-latest.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>