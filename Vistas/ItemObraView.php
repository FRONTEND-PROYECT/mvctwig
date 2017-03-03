<script type="text/javascript" src="js/itemObra.js"></script>
<!--AQUI SOLO TENGO 12 COLUMNAS PARA REPARTIR-->
	<div class="row">
		<div class="col-sm-12">
			<center>
				<h3>ACTIVIDAD PRODUCTIVA</h3>
			</center>
		</div>
	</div>
	
	<form class="form-horizontal" role="form">

	<?php 
	$edicion = false;
	if(isset($ios)){
		$edicion = true;
		$io= $ios;
	} 
	
	?>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="IOOrdenTrabajo">Orden de Trabajo</label>
			<div class="col-sm-3">
				<input type="hidden" id = 'IOIDOt' value = "<?= ($edicion) ? $io->fkordentrabajo : '0';?>" >
				<input type="text" onblur="salidafoco()" class="form-control" name="IOOrdenTrabajo" id="IOOrdenTrabajo" data-mask="999-99" maxlength="6" autocomplete="off"  placeholder="OT" value= "<?= ($edicion) ? $io->data : '';?>"/>
			</div>
			<label class="col-sm-6 text-left" id="IONombreOt"><?= ($edicion) ? $io->nombre : '';?></label>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="IOPoligono">Poligono o Lote</label>
			<div class="col-sm-9">
				<select class="form-control" name="IOPoligono" id="IOPoligono" onchange="selectedCodigo()">
					<!--cargamos el select con los cargos llegados	-->
					<?php
							foreach($poligonos as $poligono){
								if($poligono->pkpoligono == $io->fkpoligono)
									echo "<option value=\"" . $poligono->pkpoligono . "\" selected >" . $poligono->codigo . ' ' . $poligono->descripcion . "</option>";
								else
									echo "<option value=\"" . $poligono->pkpoligono . "\" >" . $poligono->codigo . ' ' . $poligono->descripcion . "</option>";
							}
					?>					
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="IOActividad">Actividad</label>
			<div class="col-sm-9">
				<select class="form-control" name="IOActividad" id="IOActividad" onchange="selectedCodigo()">
					<!--cargamos el select con los cargos llegados	-->
					<?php
							foreach($actividades as $actividad){
								if($actividad->pkactividad == $io->fkactividad)
									echo "<option value=\"" . $actividad->pkactividad . "\" selected >" . $actividad->codigo . ' ' . $actividad->descripcion . "</option>";
								else
									echo "<option value=\"" . $actividad->pkactividad . "\" >" . $actividad->codigo . ' ' . $actividad->descripcion. "</option>";
							}
					?>	
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="IOCodigo">Codigo</label>
			<div class="col-sm-3">
				<input type="hidden" id = 'IOPkItemObra' value = "<?= ($edicion) ? $io->pkitemobra : '0';?>" >
				<input type="text" class="form-control" name="IOCodigo" id="IOCodigo" data-mask="www-ww" disabled="true" maxlength="6" autocomplete="off" placeholder="Code" value= "<?= ($edicion) ? $io->codigo : '';?>"/>
			</div>
			<div class="col-sm-6"></div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="IODescripcion">Descripcion</label>
			<div class="col-sm-9">
				<input type="text" maxlength="50" class="form-control" name="IODescripcion" id="IODescripcion" placeholder="Escriba actividad productiva" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $io->descripcion : '';?>"/>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="IOArea">Area Estimada</label>
			<div class="col-sm-3">
				<input 	type="number" 
						maxlength="10" 
						step="0.01"
						min="0"
						class="form-control" 
						name="IOArea" 
						id="IOArea" 
						placeholder="0.00" 
						onKeyUp="this.value=this.value.toUpperCase();" 
						value= "<?= ($edicion) ? $io->areatrab : 0;?>"/>
			</div>
			<label class="col-sm-3 control-label" for="IORendimiento">Rendimiento</label>
			<div class="col-sm-3">
				<input 	type="number" 
						class="form-control" 
						step="0.01"
						min="0"
						name="IORendimiento" 
						id="IORendimiento" 
						placeholder="0.00" 
						onKeyUp="this.value=this.value.toUpperCase();" 
						value= "<?= ($edicion) ? $io->rendimiento : 0;?>"/>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-success btn-block" name="btnGuardar"  id="IOGuardar"><span class="glyphicon glyphicon-save"></span> Guardar</button>
			</div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-danger btn-block" name="btnAtras" id="IORetornar"><span class="glyphicon glyphicon-list"></span> Retornar</button>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</form>