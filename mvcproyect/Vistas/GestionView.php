<script type="text/javascript" src="js/gestion.js"></script>
<!--AQUI SOLO TENGO 12 COLUMNAS PARA REPARTIR-->
	<div class="row">
		<div class="col-sm-12">
			<center>
				<h3>GESTION</h3>
			</center>
		</div>
	</div>
	
	<form class="form-horizontal" role="form">

	<?php 
	$edicion = false;
	if(isset($listado)){
		$edicion = true;
		$gestion = $listado;		
	}
	?>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="GECodigo">Codigo</label>
			<div class="col-sm-3">
				<input type="hidden" id = "GEPkGestion" value = "<?= ($edicion) ? $gestion->pkgestion : '0';?>"/>
				<input type="text" class="form-control" name="GECodigo" id="GECodigo" data-mask="99" maxlength="2" autocomplete="off" placeholder="00" value= "<?= ($edicion) ? $gestion->codigo : '';?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="GEFechaIni">Fecha Inicial</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" name="GEFechaIni" id="GEFechaIni" data-date-format="DD-MM-YYYY" value= "<?= ($edicion) ? $gestion->fechaini : date('d-m-Y'); ?>" />
			</div>
			<div class="col-sm-6"></div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="GEFechaFin">Fecha Final</label>
			<div   class="col-sm-3" >
				<input type="text" class="form-control" name="GEFechaFin" id="GEFechaFin" data-date-format="DD-MM-YYYY" value= "<?= ($edicion) ? $gestion->fechafin : date('d-m-Y'); ?>"/>
			</div>
			<div class="col-sm-6"></div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="GEEstado">Estado</label>
			<div class="col-sm-3">
				<select class="form-control" name="GEEstado" id="GEEstado">
				<?php
					if($edicion == true){
						if($gestion->estado == "T"){
							echo "<option value='T' selected >ACTIVO</option>";
							echo "<option value='F'>INACTIVO</option>";
						}
						else{
							echo "<option value='T'>ACTIVO</option>";
							echo "<option value='F' selected>INACTIVO</option>";
						}
					}else{
						echo "<option value='T'>ACTIVO</option>";
						echo "<option value='F'>INACTIVO</option>";
					}

				?>
				</select>
			</div>
			<div class="col-sm-6"></div>
		</div>	

		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-success btn-block" name="btnGuardar"  id="GEGuardar"><span class="glyphicon glyphicon-save"></span> Guardar</button>
			</div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-danger btn-block" name="btnAtras" id="GERetornar"><span class="glyphicon glyphicon-list"></span> Retornar</button>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</form>