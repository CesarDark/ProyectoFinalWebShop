<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="css/menu.css">
    <title>The Geek Store</title>
</head>

<body>

    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="index.php">The Geek Store</a>
        <button class="navbar-toggler" data-target="#my-nav" data-toggle="collapse" aria-controls="my-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="my-nav" class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="somos.php"> ¿Quienes somos? </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="politica.php"> Politica de Compra</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="contacto.php"> Contacto</a>
                </li>
            </ul>
        </div>
    </nav>
</body>

<body class="hm-gradient">
    <body class="hm-gradient">
        <main>
            <!--MDB Forms-->
            <div class="container mt-4">
            <div class="text-center darken-grey-text mb-4">
            <br><br><br>
            <h4 class="heading"><strong>Únete </strong>| Somos #1 en Cómics <span></span></h4>
            </div>
                <!-- Grid row -->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-6 mb-4">
                        <div class="card bg-light text-dark">
                            <div class="card-body">
                                <form name="login" action="archivos_sesion/login.php" method="post">
                                    <h3 class="text-center default-text py-3"><i class="fa fa-lock"></i> Ingresa:</h3>
                                    <!--Body-->
                                    <div class="md-form">
                                        <i class="fa fa-envelope prefix grey-text"></i>
                                        <input type="text" name="usuario" id="defaultForm-email" class="form-control">
                                        <label for="defaultForm-email">Tú Usuario:</label>
                                    </div>
                                    <div class="md-form">
                                        <i class="fa fa-lock prefix grey-text"></i>
                                        <input type="password" name="password" id="defaultForm-pass" class="form-control">
                                        <label for="defaultForm-pass">Tú contraseña:</label>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-default waves-effect waves-light">Ingresar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                
                    <!-- Grid column -->
                    <!-- Grid column -->
                    <div class="col-md-6 mb-4">
                        <div class="card bg-light text-dark">
                            <div class="card-body">
                                <!-- Form register -->
                                <form name="alta" action="archivos_sesion/alta.php" method="post">
                                    <h2 class="text-center font-up font-bold deep-orange-text py-4">Registrate:</h2>
                                    <div class="md-form">
                                        <i class="fa fa-user prefix grey-text"></i>
                                        <input type="text" name="nombre" id="orangeForm-name3" class="form-control">
                                        <label for="orangeForm-name3">Tú Nombre:</label>
                                    </div>
                                    <div class="md-form">
                                        <i class="fa fa-user prefix grey-text"></i>
                                        <input type="text" name="apaterno" id="orangeForm-name3" class="form-control">
                                        <label for="orangeForm-name3">Tú Apellido:</label>
                                    </div>
                                    <div class="md-form">
                                        <i class="fa fa-user prefix grey-text"></i>
                                        <input type="text" name="usuario" id="orangeForm-name3" class="form-control">
                                        <label for="orangeForm-name3">Tú Usuario:</label>
                                    </div>
                                    <div class="md-form">
                                        <i class="fa fa-envelope prefix grey-text"></i>
                                        <input type="text" name="email" id="orangeForm-email3" class="form-control">
                                        <label for="orangeForm-email3">Tú correo:</label>
                                    </div>
                                    <div class="md-form">
                                        <i class="fa fa-lock prefix grey-text"></i>
                                        <input type="password" name="password" id="orangeForm-pass3" class="form-control">
                                        <label for="orangeForm-pass3">Tú Contraseña:</label>
                                    </div>
                                    <div class="text-center">
                                        <button class="btn btn-deep-orange">Registrar<i class="fa fa-angle-double-right pl-2" aria-hidden="true"></i></button>
                                    </div>
                                </form>
                                <!-- Form register -->
                            </div>
                        </div>
                    </div>
                    <!-- Grid column -->

        </main>

        <!-- MDB core JavaScript -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/js/mdb.min.js"></script>
        <div class="col-12 text-center">
            &copy; Cesar Rebollar 2019
        </div>

    </body>

</html>