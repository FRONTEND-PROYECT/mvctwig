<script type="text/javascript" src="js/equipo.js"></script>
<!--AQUI SOLO TENGO 12 COLUMNAS PARA REPARTIR-->
	<div class="row">
		<div class="col-sm-12">
			<center>
				<h3>EQUIPO PESADO</h3>
			</center>
		</div>
	</div>
	
	<form class="form-horizontal" role="form">

	<?php 
	$edicion = false;
	if(isset($listado)){
		$edicion = true;
		$equipo= $listado;
	}
	?>
	

		<div class="form-group">
			<label class="col-sm-3 control-label" for="EQTipo">Tipo de Equipo</label>
			<div class="col-sm-9">
				<select class="form-control" onchange="selectedModelo()" name="EQTipo" id="EQTipo">
					<!--cargamos el select con los tipos llegados	-->
					<?php
							foreach($tipos as $tipo){
								if($edicion){
									if($tipo->pkeqtipo == $equipo->fktipoequipo)
										echo "<option value=\"" . $tipo->pkeqtipo . "\" selected >".$tipo->codigo.' - ' . $tipo->descripcion . "</option>";
									else
										echo "<option value=\"" . $tipo->pkeqtipo . "\" >" . $tipo->codigo . ' - ' . $tipo->descripcion . "</option>";									
								}else{
									echo "<option value=\"" . $tipo->pkeqtipo . "\" >" . $tipo->codigo . ' - ' . $tipo->descripcion . "</option>";
								}

							}
					?>					
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="EQModelo">Modelo de Equipo</label>
			<div class="col-sm-9">
				<select class="form-control" onchange="selectedCodigo()" name="EQModelo" id="EQModelo">
					<!--cargamos el select con los cargos modelos	-->
					<?php
						if($edicion){
							foreach($modelos as $modelo){
								if($edicion){
									if($modelo->pkeqmodelo == $equipo->fkmodelo)
										echo "<option value=\"" . $modelo->pkeqmodelo . "\" selected >" . $modelo->codigo . ' - ' . $modelo->descripcion . "</option>";
									else
										echo "<option value=\"" . $modelo->pkeqmodelo . "\" >" . $modelo->codigo . ' - ' . $modelo->descripcion . "</option>";									
								}else{
									echo "<option value=\"" . $modelo->pkeqmodelo . "\" >" . $modelo->codigo . ' - ' . $modelo->descripcion . "</option>";
								}
							}							
						}
					?>	
				</select>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="EQCodigo">Codigo</label>
			<div class="col-sm-3">
				<input type="hidden" id = "EQPkEquipo" value = "<?= ($edicion) ? $equipo->pkequipo : '0';?>"/>
				<input class="form-control" maxlength="9" name="EQCodigo" id="EQCodigo" 
				data-inputmask="'mask': '**-****'"
				maxlength="9" placeholder="Code" value= "<?= ($edicion) ? $equipo->codigo : '';?>"/>
			</div>

			<label class="col-sm-3 control-label" for="EQContrato">Contrato</label>
			<div class="col-sm-3">
				<select class="form-control" name="EQContrato" id="EQContrato">
				<?php 
					if($edicion){
						if($equipo->fktipocontrato == "1"){
							echo "<option value='1' selected >PROPIO</option>";
							echo "<option value='2'>ALQUILADO</option>";
						}
						else{
							echo "<option value='1'>PROPIO</option>";
							echo "<option value='2' selected>ALQUILADO</option>";
						}						
					}else{
						echo "<option value='1'>PROPIO</option>";
						echo "<option value='2' selected>ALQUILADO</option>";
					}
				?>
				</select>
			</div>
		</div>
	
		<div class="form-group">
			<label class="col-sm-3 control-label" for="EQFechaIngreso">Fecha Ingreso</label>
			<div   class="col-sm-3" >
				<input type="text" class="form-control" name="EQFechaIngreso" id="EQFechaIngreso" data-date-format="DD-MM-YYYY" value= "<?= ($edicion) ? $equipo->fechaingreso : date('d-m-Y'); ?>"/>
			</div>
			<div class="col-sm-6"></div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="EQOrdenTrabajo">Orden de Trabajo</label>
			<div class="col-sm-3">
				<input type="hidden" id = 'EQIDOt' value = "<?= ($edicion) ? $equipo->fkordentrabajo : '0';?>" >
				<input type="text" onblur="salidafoco()" class="form-control" name="EQOrdenTrabajo" id="EQOrdenTrabajo" data-mask="999-99" maxlength="6" autocomplete="off"  placeholder="OT" value= "<?= ($edicion) ? $equipo->data : '';?>"/>
			</div>
			<label class="col-sm-6 text-left" id="EQNombreOt"><?= ($edicion) ? $equipo->nombre : '';?></label>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="EQDescripcion">Descripcion</label>
			<div class="col-sm-9">
				<input type="text" maxlength="50" class="form-control" name="EQDescripcion" id="EQDescripcion" placeholder="Escriba descripcion del equipo" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $equipo->descripcion : '';?>"/>
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-success btn-block" name="btnGuardar"  id="EQGuardar"><span class="glyphicon glyphicon-save"></span> Guardar</button>
			</div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-danger btn-block" name="btnAtras" id="EQRetornar"><span class="glyphicon glyphicon-list"></span> Retornar</button>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</form>