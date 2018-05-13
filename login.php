<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>INICIAR CUENTA - CECIN</title>

    <!-- Bootstrap core CSS -->
    <link href="static/login_static/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="static/login_static/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="static/login_static/css/style.css" rel="stylesheet">
    <link href="static/login_static/css/style-responsive.css" rel="stylesheet">


  </head>

  <body>

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" action="validate_login.php" method="POST">
		        <h2 class="form-login-heading">INICIAR SESION</h2>
		        <div class="login-wrap">
		            <input type="text" class="form-control" name="username" placeholder="Usuario" autofocus>
		            <br>
		            <input type="password" class="form-control" name="password" placeholder="contraseña">
		            <label class="checkbox">
		                <span class="pull-right">
		                    <a  href="#"> Olvido su contraseña?</a>
		                </span>
		            </label>
		            <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> INGRESAR</button>
		            <hr>
		            
		
		        </div>
	
		      </form>	  	
	  	
	  	</div>
	  </div>


    <script src="static/login_static/js/jquery.js"></script>
    <script src="static/login_static/js/bootstrap.min.js"></script>


    <script type="text/javascript" src="static/login_static/js/jquery.backstretch.min.js"></script>

    <script>
        $.backstretch("static/login_static/weather.jpg", {speed: 500});
    </script>


  </body>
</html>
