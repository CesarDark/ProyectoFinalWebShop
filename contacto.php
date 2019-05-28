<!DOCTYPE html>
<html lang="es">

<head>
    <title>Contacto</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <img src="../Images/3_Spiderman_cara_editado_1200x1200.png" width="30" height="30" alt="">
        <a class="navbar-brand" href="index.php">The Geek Store</a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="somos.php"> ¿Quienes somos? </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="politica.php"> Politica de Compra</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link " href="contacto.php"> Contacto</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Navegación -->

    <div class="container">
        <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="well well-sm">
            <form class="form-horizontal" action="" method="post">
            <fieldset>
                <legend class="text-center">Contacto</legend>
        
                <div class="form-group">
                <label class="col-md-3 control-label" for="name">Nombre:</label>
                <div class="col-md-9">
                    <input id="name" name="name" type="text" placeholder="Nombre:" class="form-control">
                </div>
                </div>
        
                <div class="form-group">
                <label class="col-md-3 control-label" for="email">Correo:</label>
                <div class="col-md-9">
                    <input id="email" name="email" type="text" placeholder="Correo:" class="form-control">
                </div>
                </div>
        
                <div class="form-group">
                <label class="col-md-3 control-label" for="message">Mensaje:</label>
                <div class="col-md-9">
                    <textarea class="form-control" id="message" name="message" placeholder="Escribe tu mensaje..." rows="5"></textarea>
                </div>
                </div>
                
                <div class="form-group">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary btn-lg">Enviar</button>
                </div>
                </div>
            </fieldset>
            </form>
            </div>
        </div>
        </div>
    </div>
    <div class="text-center">
        <strong>&copy; Cesar Rebollar 2019</strong>
    </div><br>
</body>
</html>