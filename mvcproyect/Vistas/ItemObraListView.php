<script type="text/javascript" src="js/itemObra.js"></script>
<br>
<br>
<br>
<div class="row">
	<div class="form-group">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<button type="button" class="btn btn-primary btn-block" name="btnnuevo" id="idbtnNuevo"><span class="glyphicon glyphicon-new-window"></span> Nuevo Item Obra</button>	
		</div>
	</div>
</div>
<br>
<div class="row">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-hover" >
			<thead>
				<tr class="danger">					
					<th>O.T.</th>
					<th>Codigo</th>
					<th>Descripcion</th>
					<th>Rendimiento</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(isset($ios)){
					foreach($ios as $itemObra){
				?>
						<tr>
							<td><?= $itemObra->data ?></td>
							<td><?= $itemObra->codigo?></td>
							<td><?= $itemObra->descripcion ?></td>
							<td><?= $itemObra->rendimiento ?></td>
						    <?php					 
						    		echo "<td><a href='#' onclick=\"editar('".$itemObra->pkitemobra."')\"><span class='glyphicon glyphicon-edit' data-toggle='tooltip' title='Editar'></span></a></td>";
						    		echo "<td><a href='#' onclick=\"eliminar('".$itemObra->pkitemobra."','" . $itemObra->descripcion."')\"><span class='glyphicon glyphicon-trash' data-toggle='tooltip' title='Eliminar'></span></a></td>";
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
