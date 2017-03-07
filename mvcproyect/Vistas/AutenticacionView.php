<!DOCTYPE>
<html lang="es">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login de usuario</title>
		<script src="frameworks/jquery/jquery.js" type="text/javascript"></script>
		<link rel="stylesheet" href="frameworks/bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="frameworks/bootstrap/css/bootstrap-theme.css">

		<script src="frameworks/bootstrap/js/bootstrap.js"></script>
		
		<script src="js/autenticacion.js" type="text/javascript"></script>
		<style type="text/css">
			body{
				padding-top: 40px;
				padding-bottom: 40px;
				background: url('img/28B.jpg');
			}
			.login{
				max-width: 330px;
				padding: 15px;
				margin: 0 auto;
			}
			#sha{
				max-width: 340px;
				-webkit-box-shadow: 0px 0px 18px 0px rgba(48, 50, 50, 0.48);
				-moz-box-shadow:    0px 0px 18px 0px rgba(48, 50, 50, 0.48);
				box-shadow: 		0px 0px 18px 0px rgba(48, 50, 50, 0.48);
				border-radius: 6%;
			}
			#avatar{
				width: 96px;
				height: 96px;
				margin: 0px auto 10px;
				display: block;
				border-radius: 50%;
			}
		</style>
		<link rel="icon" type="image/png" href="img/favicon.png" />
		<title>Sistema control de produccion </title>
	</head>
	<body>
		<div class="container well" id="sha">
			
			<div class="row">
				<div class="col-sm-12">
					<img src="img/perfil.png" class="img-responsive" id="avatar">
				</div>
			</div>

			<form class="login" id="formlogin" action="." method="post" enctype="multipart/form-data">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="Nombre de usuario" id="nickname" name="nickname" required autofocus>
				</div>
				
				<div class="form-group">
					<input type="password" class="form-control" id="password" name="password" placeholder="Contraseña de usuario" required>
				</div>
				<button type="button" id="btnSession" onclick="validar()" class="btn btn-lg btn-primary btn-block">Iniciar Sesion</button>
				<input type="hidden" id="controlador" name="controlador" value="Autenticacion">
				<input type="hidden" id="accion" name="accion" value="iniciarSession">
				<div class="checkbox">
					<label class="checkbox">
						<input type="checkbox" value="1" name="remember" value="">No cerrar sesion
					</label>
					<p class="help-block">
						<a href="#">¿No puedes acceder a tu cuenta?</a>
					</p>
				</div>
			</form>
		</div>
	</body>
</html>