	<script type="text/javascript" src="js/improductiva.js"></script>
<!--AQUI SOLO TENGO NUEVE COLUMNAS PARA REPARTIR-->
	<div class="row">		
		<div class="col-sm-12">
			<center>
				<h3>ACTIVIDADES IMPRODUCTIVAS</h3>
			</center>
		</div>
	</div>
	<form class="form-horizontal" role="form">

<?php 
	$edicion = false;
	if(isset($listado)){
		$edicion = true;
		$improductiva = $listado;

	} ?>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="IMPkImproductiva">ID Improductiva</label>
			<div   class="col-sm-9" >
				<input type="text" class="form-control" name="txtPkImproductiva" id="IMPkImproductiva" disabled value= "<?= ($edicion) ? $improductiva->pkimproductiva : '0'; ?>"/>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="IMCodigo">Codigo</label>
			<div class="col-sm-9">
				<input type="text" maxlength="2" class="form-control" name="txtCodigo" id="IMCodigo" placeholder="Codigo de Actividad" onKeyUp="this.value = this.value.toUpperCase();" value= "<?= ($edicion) ? $improductiva->codigo : '';?>"/>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="IMDescripcion">Descripcion</label>
			<div class="col-sm-9">
				<input type="text" maxlength="50" class="form-control" name="txtDescripcion" id="IMDescripcion" placeholder="Describa la actividad" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $improductiva->descripcion : '';?>"/>
			</div>			
		</div>

		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-success btn-block" name="btnGuardar"  id="IMGuardar"><span class="glyphicon glyphicon-save"></span> Guardar</button>
			</div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-danger btn-block" name="btnAtras" id="IMRetornar"><span class="glyphicon glyphicon-list"></span> Retornar</button>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</form>