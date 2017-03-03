<script type="text/javascript" src="js/ordenTrabajo.js"></script>
<!--AQUI SOLO TENGO 12 COLUMNAS PARA REPARTIR-->
	<div class="row">
		<div class="col-sm-12">
			<center>
				<h3>ORDEN DE TRABAJO</h3>
			</center>
		</div>
	</div>
	
	<form class="form-horizontal" role="form">

	<?php 
	$edicion = false;
		if(isset($listado)){
			$edicion = true;
			$ot = $listado;
		} 
	?>
	

		<div class="form-group">
			<label class="col-sm-3 control-label" for="OTPkOrdenTrabajo">ID Orden Trabajo</label>
			<div   class="col-sm-3" >
				<input type="text" class="form-control" name="OTPkOrdenTrabajo" id="OTPkOrdenTrabajo" disabled value= "<?= ($edicion) ? $ot->pkordentrabajo : '0'; ?>"/>
			</div>
			<div class="col-sm-6"></div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="OTCodigo">Codigo</label>
			<div class="col-sm-2">
				<input type="text" maxlength="3" class="form-control" name="OTCodigo" id="OTCodigo" placeholder="001" onKeyUp="this.value = this.value.toUpperCase();" value= "<?= ($edicion) ? $ot->codigo : '';?>"/>
			</div>
			<div class="col-sm-1">
				<p class="form-control-static">-</p>
			</div>
			<div class="col-sm-1">
				<input type="text" class="form-control" name="OTGestion" id="OTGestion" disabled value= "<?= ($edicion) ? $ot->codgest : $_SESSION['codgest']; ?>"/>
			</div>
			<div class="col-sm-5">
				<input type="hidden" class="form-control" name="IDGestion" id="IDGestion" value= "<?= ($edicion) ? $ot->fkgestion : $_SESSION['pkGestion']; ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="OTNombre">Nombre</label>
			<div class="col-sm-9">
				<input type="text" maxlength="50" class="form-control" name="OTNombre" id="OTNombre" placeholder="Nombre de Orden de Trabajo" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $ot->nombre : '';?>"/>
			</div>			
		</div>
		<div class="form-group">
			<label class="col-sm-3 control-label" for="OTSupervisor">Supervisor</label>
			<div class="col-sm-9">
				<input type="text" maxlength="50" class="form-control" name="OTSupervisor" id="OTSupervisor" placeholder="Nombre completo del supervisor de obra" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $ot->supervisor : '';?>"/>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="OTAreaEstimada">Area Estimada</label>
			<div class="col-sm-9">
				<input 	type="number" step='0.01' 
						maxlength="10" 
						class="form-control" 
						name="OTAreaEstimada"
						min="0" 
						id="OTAreaEstimada"
						placeholder="0.00" 
						onKeyUp="this.value=this.value.toUpperCase();" 
						value= "<?= ($edicion) ? $ot->areaestimada : 0;?>"/>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="OTEstado">Estado</label>
			<div class="col-sm-9">
				<select class="form-control" name="OTEstado" id="OTEstado">
				<?php
					if($edicion){
						if($ot->estado == 'T'){
							echo "<option value='T' selected >ACTIVO</option>";
							echo "<option value='F'>INACTIVO</option>";
						}else{
							echo "<option value='T'>ACTIVO</option>";
							echo "<option value='F' selected >INACTIVO</option>";
						}
					}else{
						echo "<option value='T'>ACTIVO</option>";
						echo "<option value='F'>INACTIVO</option>";
					}
				?>
				</select>
			</div>			
		</div>

		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-success btn-block" name="btnGuardar"  id="OTGuardar"><span class="glyphicon glyphicon-save"></span> Guardar</button>
			</div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-danger btn-block" name="btnAtras" id="OTRetornar"><span class="glyphicon glyphicon-list"></span> Retornar</button>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</form>

