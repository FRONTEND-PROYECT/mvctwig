<script type="text/javascript" src="js/ordenTrabajo.js"></script>
<br>
<br>
<br>
<div class="row">
	<div class="form-group">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<button type="button" class="btn btn-primary btn-block" name="btnnuevo" id="idbtnNuevo"><span class="glyphicon glyphicon-new-window"></span> Nueva Orden Trabajo</button>	
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" >
			<thead>
				<tr class="danger">					
					<th>Codigo</th>
					<th>Nombre</th>
					<th>Estado</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(isset($listado)){
					foreach($listado as $ot){
				?>
						<tr>
							<td><?= $ot->data ?></td>
							<td><?= $ot->nombre ?></td>
							<td><?= (($ot->estado=='T') ? 'ACTIVO' : 'INACTIVO'); ?></td>
							    <?php
							    	echo "<td><a href='#' onclick=\"editar('".$ot->pkordentrabajo."')\"><span class='glyphicon glyphicon-edit' data-toggle='tooltip' title='Editar'></span></a></td>";
							    	echo "<td><a href='#' onclick=\"eliminar('".$ot->pkordentrabajo."','".$ot->nombre."')\"><span class='glyphicon glyphicon-trash' data-toggle='tooltip' title='Eliminar'></span></a></td>";
							    ?>
						</tr>
		<?php	
					}
				}
		?>		
			</tbody>
		</table>	
	</div>	
</div>
