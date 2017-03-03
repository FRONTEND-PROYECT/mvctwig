<script type="text/javascript" src="js/transferenciaPersonal.js"></script>
<br>
<br>
<br>
<div class="row">
	<div class="form-group">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<button type="button" class="btn btn-primary btn-block" name="btnnuevo" id="idbtnNuevo"><span class="glyphicon glyphicon-new-window"></span> Nueva Transferencia</button>	
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
					<th>Fecha</th>
					<th>Orden Trabajo Origen</th>
					<th>Orden Trabajo Destino</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(isset($listado)){
					foreach($listado as $transfer){
				?>
						<tr>
							<td><?= $transfer->data ?></td>
							<td><?= $transfer->fecha?></td>
							<td><?= $transfer->codotorigen .' ' . $transfer->nombreorigen ?></td>
							<td><?= $transfer->codotdestino . ' ' . $transfer->nombredestino ?></td>
						    <?php					 
						    		echo "<td><a href='#' onclick=\"editar('" . $transfer->pktransfpersonal . "')\"><span class='glyphicon glyphicon-edit' data-toggle='tooltip' title='Editar'></span></a></td>";
						    		echo "<td><a href='#' onclick=\"eliminar('". $transfer->pktransfpersonal . "','" . $transfer->data . "')\"><span class='glyphicon glyphicon-trash' data-toggle='tooltip' title='Eliminar'></span></a></td>";
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
