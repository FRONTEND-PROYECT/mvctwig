<script type="text/javascript" src="js/improductiva.js"></script>
<br>
<br>
<br>
<div class="row">
	<div class="form-group">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<button type="button" class="btn btn-primary btn-block" name="btnnuevo" id="idbtnNuevo"><span class="glyphicon glyphicon-new-window"></span> Nueva Actividad Improductiva</button>	
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" >
			<thead>
				<tr class="danger">
					<th>ID</th>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(isset($listado)){
					foreach($listado as $improductiva){
				?>
						<tr>
							<td><?php echo $improductiva->pkimproductiva ?></td>
							<td><?php echo $improductiva->codigo ?></td>
							<td><?php echo $improductiva->descripcion ?></td>
							    <?php					 
							    		echo "<td><a href='#' onclick=\"editar('" . $improductiva->pkimproductiva . "')\"><span class='glyphicon glyphicon-edit' data-toggle='tooltip' title='Editar'></span></a></td>";
							    		echo "<td><a disabled href='#' onclick=\"eliminar('" . $improductiva->pkimproductiva . "','" . $improductiva->descripcion . "')\"><span class='glyphicon glyphicon-trash' data-toggle='tooltip' title='Eliminar'></span></a></td>";
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
