<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../static/assets/images/favicon-cecin.png">
    <title>CECIN UNDAC</title>

    <link href="../static/assets/node_modules/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../static/css/style.css" rel="stylesheet">
    <script src='https://www.google.com/recaptcha/api.js'></script>

</head>

<body>

    <div class="preloader">
        <div class="loader">
            <div class="loader__figure"></div>
            <p class="loader__label">CECIN - UNDAC</p>
        </div>
    </div>
    
    <div class="container">
        <div id="loadContent">
            <div class="header" id="divHeader">
                <div class="col-md-10 col-md-offset-1">
                    <img src="images/cecin2.png" class="imgLogo">
                </div>
            </div>
            <div class="card border-primary">
                <div class="card-header bg-primary">
                    <h3 class="text-white">Críterios de Busqueda</h3> 
                </div>
                <div class="card-body">
                    
                    <form id="form_consult" class="form-horizontal" onsubmit="return searchRegistro(event);">
                    <div class="row">
                        <div class="col-md-4">
                            <label for="cod_alumno">Codigo Estudiante.</label>
                            <input type="text" placeholder="Ingrese codigo" id="cod_alumno" name="cod_alumno" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label for="dni">DNI.</label>
                            <input placeholder="Ingrese DNI" type="text" id="dni" name="dni" class="form-control" pattern="(?=.*\d).{8,8}" title="Incorrecto DNI" required>
                        </div>
                        <div class="col-md-4">
                            <div class="g-recaptcha" data-sitekey="6Ldxul0UAAAAAPCQwN61b10VEkFREiblPTQeO1cu"></div>
                        </div>

                    </div>
                    <div class="col-sm-12 text-center">
                      <button type="submit" class="btn btn-primary" id="btnAceptar" tabindex="3">Buscar</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../static/assets/node_modules/jquery/jquery.min.js"></script>
    <script src="../static/assets/node_modules/bootstrap/js/popper.min.js"></script>
    <script src="../static/assets/node_modules/bootstrap/js/bootstrap.min.js"></script>
    <script src="../static/js/perfect-scrollbar.jquery.min.js"></script>
    <script src="../static/js/sidebarmenu.js"></script>
    <script src="../static/js/custom.min.js"></script>
    <script src="js/javacore.js"></script>

</body>
</html>
