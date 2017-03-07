<script type="text/javascript" src="js/transferenciaPersonal.js"></script>
<!--AQUI SOLO TENGO 12 COLUMNAS PARA REPARTIR-->
	<div class="row">
		<div class="col-sm-12">
			<center>
				<h3>TRANSFERENCIA DE PERSONAL</h3>
			</center>
		</div>
	</div>
	
	<form class="form-horizontal" role="form">

	<?php 
	$edicion = false;
	if(isset($listado)){
		$edicion = true;
		$transferencia= $listado;
	}
	?>
	<div class="panel panel-danger">
		<div class="panel-body">
			<div class="form-group">
				<label class="col-sm-3 control-label" for="TFCodigo">Codigo Doc.</label>
				<div class="col-sm-3">
					<input type="hidden" id = 'TFPkTransfPersonal' value = "<?= ($edicion) ? $transferencia->pktransfpersonal : '0';?>" >
					<input type="text" class="form-control" name="TFCodigo" id="TFCodigo" data-mask="9999" maxlength="4" autocomplete="off"  placeholder="0000" value= "<?= ($edicion) ? $transferencia->codigo : '';?>"/>
				</div>
				
				<label class="col-sm-3 control-label" for="TFFecha">Fecha</label>
				<div   class="col-sm-3" >
					<input type="hidden" id = 'TFFkGestion' value = "<?= ($edicion) ? $_SESSION['pkgestion'] : $_SESSION['pkgestion'] ;?>" >

					<input type="text" class="form-control" name="TFFecha" id="TFFecha" data-date-format="DD-MM-YYYY" value= "<?= ($edicion) ? $transferencia->fecha : date('d-m-Y'); ?>"/>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label" for="TFOrdenOrigen">Orden de Trabajo Origen</label>
				<div class="col-sm-3">
					<input type="hidden" id = 'TFPkOrigen' value = "<?= ($edicion) ? $transferencia->fkordenorigen : '0';?>" >
					<input type="text" onblur="getOrdenTrabajo(1)" class="form-control" name="TFOrdenOrigen" id="TFOrdenOrigen" data-mask="999-99" maxlength="6" autocomplete="off"  placeholder="OT" value= "<?= ($edicion) ? $transferencia->codotorigen : '';?>"/>
				</div>
				<label class="col-sm-6 text-left" id="TFNombreOrigen"><?= ($edicion) ? $transferencia->nombreorigen : '';?></label>
			</div>

			<div class="form-group">
				<label class="col-sm-3 control-label" for="TFOrdenDestino">Orden de Trabajo Destino</label>
				<div class="col-sm-3">
					<input type="hidden" id = 'TFPkDestino' value = "<?= ($edicion) ? $transferencia->fkordendestino : '0';?>" >
					<input type="text" onblur="getOrdenTrabajo(2)" class="form-control" name="TFOrdenDestino" id="TFOrdenDestino" data-mask="999-99" maxlength="6" autocomplete="off"  placeholder="OT" value= "<?= ($edicion) ? $transferencia->codotdestino : '';?>"/>
				</div>
				<label class="col-sm-6 text-left" id="TFNombreDestino"><?= ($edicion) ? $transferencia->nombredestino : '';?></label>
			</div>


			<div class="form-group">
				<label class="col-sm-3 control-label" for="TFObservacion">Observacion</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" name="TFObservacion" id="TFObservacion" placeholder="Escriba una observacion" onKeyUp="this.value=this.value.toUpperCase();" value= "<?= ($edicion) ? $transferencia->observacion : '';?>"/>
				</div>			
			</div>			
		</div>
	</div>


		
		<!-- empieza los detalles de la transferencia -->
		<div class="panel panel-primary">
		  	<div class="panel-heading">Detalle de Transferencia de Personal</div>
		  	<div class="panel-body">
				<!--panel contenedor de los inputs-->
				<div class="panel panel-danger">
					<div class="panel-body">
						<div class="form-group">
							
							<label class="col-sm-1 control-label" for="DTFItem">Item</label>
							<div class="col-sm-2">
								<input type="hidden" id = 'DTpkDetTransfer' value = "0"/>
								<input type="text" class="form-control" name="DTFItem" id="DTFItem" value= ""/>
							</div>

							<label class="col-sm-1 control-label" for="DTfkPersonal">Personal</label>
							<div class="col-sm-2">
								<input type="text" onblur="getPersonal()" class="form-control" name="DTfkPersonal" id="DTfkPersonal" value= "0"/>
							</div>
							<label class="col-sm-6 text-left" id="DTNombrePers">---</label>

						</div>

						<div class="form-group">
							<label class="col-sm-3 control-label" for="DTOnservacion">Observacion</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" name="DTOnservacion" id="DTOnservacion" placeholder="Escriba una observacion" onKeyUp="this.value=this.value.toUpperCase();" value= ""/>
							</div>			
						</div>	
					</div>
				</div>				
				<!--fin de pane contenedor-->


			
			  	<!-- botones del detalle-->
				<div class="panel panel-danger">
					<div class="panel-body">
						<div class="row">
							<div class="col-sm-4"></div>
							<div class="col-sm-2">
								<button type="button" class="btn btn-primary btn-block" name="btnDtNuevo"  id="btnDtNuevo"><span class="glyphicon glyphicon-new-window"></span> Nuevo</button>													
							</div>
							<div class="col-sm-2">
								<button type="button" class="btn btn-success btn-block" name="btnDetAdd"  id="btnDetAdd"><span class="glyphicon glyphicon-save"></span> Adicionar</button>
							</div>
						</div>					
					</div>
				</div>

				<!-- tabla de detalles-->
				<div class="row">
					<div class="table-responsive">
						<table class="table table-striped table-bordered table-hover" id="detalle" >
							<thead>
								<tr class="danger">
									<th>PkDet</th>
									<th>fkTransf</th>
									<th>Item</th>
									<th>fkPerson</th>
									<th>Nombres Completos</th>
									<th>obs</th>
									<th></th>
									<th></th>
								</tr>
							</thead>
							<tbody>
							<?php 
								if($edicion){
									foreach ($detalles as $detalle) {
										echo "<tr>";
											echo "<td>" . $detalle->pkdettransfpersonal . "</td>";
											echo "<td>" . $detalle->fktransfpersonal . "</td>";
											echo "<td>" . $detalle->item . "</td>";
											echo "<td>" . $detalle->fkpersonal	. "</td>";
											echo "<td>" . $detalle->personal	. "</td>";
											echo "<td>" . $detalle->observacion	. "</td>";
									    	echo "<td><a href='#' onclick=\"editarDetalle('".$detalle->pkdettransfpersonal."')\"><span class='glyphicon glyphicon-edit' data-toggle='tooltip' title='Editar'></span></a></td>";
								    		echo "<td><a href='#' onclick=\"eliminarDetalle('".$detalle->pkdettransfpersonal . "','" . $detalle->personal . "')\"><span class='glyphicon glyphicon-trash' data-toggle='tooltip' title='Eliminar'></span></a></td>";
										echo "</tr>";
									}
								}
							?>
							</tbody>
						</table>
					</div>
				</div>

			</div>

		</div>


		<div class="form-group">
			<div class="col-sm-2"></div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-success btn-block" name="btnGuardar"  id="TFGuardar"><span class="glyphicon glyphicon-save"></span> Guardar Transferencia</button>
			</div>
			<div class="col-sm-4">
				<button type="button" class="btn btn-danger btn-block" name="btnAtras" id="TFRetornar"><span class="glyphicon glyphicon-list"></span> Retornar</button>
			</div>
			<div class="col-sm-2"></div>
		</div>
	</form>