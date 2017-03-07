<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!--libreria jquery-->
	<script src="frameworks/jquery/jquery.js"></script>

	<!-- libreria para maskara de entrada-->
	<!-- <script src="frameworks/jquery-mask/jquery.mask.js"></script> !-->
	
	<!--libreria bootstrap -->
	<link rel="stylesheet" type="text/css" href="frameworks/bootstrap/css/bootstrap.css">
	<link rel="stylesheet" href="frameworks/bootstrap/css/bootstrap-theme.css">

	<script src="frameworks/bootstrap/js/bootstrap.js"></script>

	<script type="text/javascript" src="js/principal.js"></script>
	
	<!--script jasny mask  frameworks\jasny-bootstrap\css   -->
	<link rel="stylesheet" type="text/css" href="frameworks/jasny-bootstrap/css/jasny-bootstrap.css">
	<script src="frameworks/jasny-bootstrap/js/jasny-bootstrap.js"></script>

	<!-- libreria para bootrap datetimepicker -->
	<script src="frameworks/bootstrap-datetimepicker/js/moment.js"></script>
	<script src="frameworks/bootstrap-datetimepicker/js/es.js"></script>
	<script src="frameworks/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
	
	<script src="frameworks/Inputmask-3.x/jquery.inputmask.bundle.min.js"></script>

	<!--css de date time picker bootstrap -->
	<link rel="stylesheet" href="frameworks/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
	
	<!-- es estilo de la pagina-->
	<link rel="stylesheet" href="css/stilo.css">
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<title>Sistema control de produccion </title>
</head>
<body>
	<div class="container" >
		<div class="row">
			<div class="col-sm-12 imgWelcome">
				<a href="#" id="inicio">
					<img src="img/inicio.png" class="img-responsive" alt="Inicio">
				</a>
			</div>
		</div>

		<div class="row">
	        <div class="col-sm-3">
	            <ul class="nav nav-pills nav-stacked admin-menu">
				<?php
					foreach($menus as $menu){?>
	                <li>
	                	<a href="#" data-target-id="principal" id="<?= $menu->idmenu?>">
	                		<i class="fa fa-file-o fa-fw"></i>
	                		<?= $menu->descmenu?>
	                	</a>
	                </li>
				<?php } ?>
	            </ul>
				<form action="index.php" method="post" accept-charset="utf-8">	
					<input 	type="hidden" 
							name="nickname" 
							value="<?=$_SESSION["nickname"]?>">
					<input 	type="hidden" 
							name="controlador" 
							value="Autenticacion">
					<input 	type="hidden" 
							name="accion" 
							value="cerrarSession">
					<button type="submit" class="btn btn-danger btn-block">
						Cerrar Session(<?=$_SESSION["nickname"]?>)
					</button>					
				</form>	            		
	        </div>
	        <div class="col-sm-9 admin-content" id="principal">
				<?php include("IndexView.php") ; ?>
	        </div>
		</div>

		<!--La ventano modal donde se mostrara las validaciones -->
		<div class="modal fade" id="messsageModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		  <div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        <h4 class="modal-title" id="myModalLabel">Datos no validos</h4>
		      </div>
		      <div class="modal-body">
		        <p id="idmsg"></p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" 
		        		class="btn btn-danger" 
		        		data-dismiss="modal">Cerrar</button>		       
		      </div>
		    </div>
		  </div>
		</div>
		<!-- Fin de la ventana de modal -->
		<!-- es el pie de pagina-->
		<div class="row">			
			<div class="col-sm-12">
				<center>					
					<a href="#" class="menu-footer">
						Todos los derechos reservados &copy;
					</a>
				</center>
					
			</div>
		</div>
	</div>
	
</body>
</html>