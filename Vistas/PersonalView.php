<script type="text/javascript" src="js/personal.js"></script>
<!--AQUI SOLO TENGO 12 COLUMNAS PARA REPARTIR-->
	<div class="row">
		<div class="col-sm-12">
			<center>
				<h3>PERSONAL DE TRABAJO</h3>
			</center>
		</div>
	</div>
	
	<form class="form-horizontal" role="form">

	<?php 
	$edicion = false;
	if(isset($listado)){
		$edicion = true;
		$personal = $listado;
	} ?>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="PEPkPersonal">CODIGO</label>
			<div   class="col-sm-3" >
				<input type="text" class="form-control" name="PEPkPersonal" id="PEPkPersonal" disabled value= "<?= ($edicion) ? $personal->pkpersonal : '0'; ?>"/>
			</div>
			<label class="col-sm-3 control-label" for="PEFechaIngreso">Fecha Ingreso</label>
			<div   class="col-sm-3" >
				<input type="text" class="form-control" name="PEFechaIngreso" id="PEFechaIngreso" data-date-format="DD-MM-YYYY" value= "<?= ($edicion) ? $personal->fechaingreso : date('d-m-Y'); ?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="PENombre">Nombres</label>
			<div class="col-sm-9">
				<input type="text" maxlength="50" class="form-control" name="PENombre" id="PENombre" placeholder="Ecriba sus Nombres completos " onKeyUp="this.value = this.value.toUpperCase();" value= "<?= ($edicion) ? $personal->nombrecomp : '';?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="PEApellidos">Apellidos</label>
			<div class="col-sm-9">
				<input type="text" maxlength="50" class="form-control" name="PEApellidos" id="PEApellidos" placeholder="Escriba sus apellidos" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $personal->apellidos : '';?>"/>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="PEDireccion">Direccion</label>
			<div class="col-sm-9">
				<input type="text" maxlength="50" class="form-control" name="PEDireccion" id="PEDireccion" placeholder="Direccion de domicilio" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $personal->direccion : '';?>"/>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="PEEmail">Corro Elect.</label>
			<div class="col-sm-9">
				<input type="text" maxlength="25" class="form-control" name="PEEmail" id="PEEmail" placeholder="ejemplo@siagro.com.bo" value= "<?= ($edicion) ? $personal->email : '';?>"/>
			</div>			
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="PETelefono">Telefono</label>
			<div class="col-sm-3">
				<input type="text" maxlength="50" class="form-control" name="PETelefono" id="PETelefono" placeholder="7607962222" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $personal->telefono : '';?>"/>
			</div>
			<label class="col-sm-3 control-label" for="PECi">CI</label>
			<div class="col-sm-3">
				<input type="text" maxlength="25" class="form-control" name="PECi" id="PECi" placeholder="6254290-SCZ" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $personal->ci : '';?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="PECargo">Cargo</label>
			<div class="col-sm-4">
				<select class="form-control" name="PECargo" id="PECargo">
					<!--cargamos el select con los cargos llegados	-->
					<?php
							if(!is_null($cargos)){
								foreach($cargos as $cargo){
									if($cargo->pkcargo == $personal->fkcargo)
										echo "<option value=\"" . $cargo->pkcargo . "\" selected >" . $cargo->descripcion . "</option>";
									else
										echo "<option value=\"" . $cargo->pkcargo . "\">" . $cargo->descripcion . "</option>";
								}
							}
					?>					
				</select>
			</div>
			<label class="col-sm-2 control-label" for="PEFechaNac">Fecha Nac.</label>
			<div class="col-sm-3">
				<input type="text" class="form-control" name="PEFechaNac" id="PEFechaNac" data-date-format="DD-MM-YYYY" value= "<?= ($edicion) ? $personal->fechanac : date('d-m-Y');?>"/>
			</div>
		</div>

		<div class="form-group">
			<label class="col-sm-3 control-label" for="PEOrdenTrabajo">Orden de Trabajo</label>
			<div class="col-sm-3">
				<input type="hidden" id = 'PEIDOt' value = "<?= ($edicion) ? $personal->fkordentrabajo : '0';?>" >
				<input type="text" onblur="salidafoco()" class="form-control" name="PEOrdenTrabajo" id="PEOrdenTrabajo" data-mask="999-99" maxlength="6" autocomplete="off"  placeholder="OT" value= "<?= ($edicion) ? $personal->data : '';?>"/>
			</div>
			<label class="col-sm-6 text-left" id="PENombreOt"><?= ($edicion) ? $personal->nombre : '';?></label>
		</div>

		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-success btn-block" name="btnGuardar"  id="PEGuardar"><span class="glyphicon glyphicon-save"></span> Guardar</button>
			</div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-danger btn-block" name="btnAtras" id="PERetornar"><span class="glyphicon glyphicon-list"></span> Retornar</button>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</form>