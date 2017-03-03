<script type="text/javascript" src="js/personal.js"></script>
<br>
<br>
<br>
<div class="row">
	<div class="form-group">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<button type="button" class="btn btn-primary btn-block"" name="btnnuevo" id="idbtnNuevo"><span class="glyphicon glyphicon-new-window"></span> Nuevo Personal</button>	
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
					<th>Nombre Completo</th>
					<th>Cargo</th>
					<th>Telefono</th>
					<th>CI</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(isset($listado)){
					foreach($listado as $personal){
				?>
						<tr>
							<td><?= $personal->pkpersonal ?></td>
							<td><?= $personal->nombrecomp . ' ' . $personal->apellidos ?></td>
							<td><?= $personal->descripcion ?></td>
							<td><?= $personal->telefono ?></td>
							<td><?= $personal->ci ?></td>
							    <?php					 
							    		echo "<td><a href='#' onclick=\"editar('".$personal->pkpersonal."')\"><span class='glyphicon glyphicon-edit' data-toggle='tooltip' title='Editar'></span></a></td>";
							    		echo "<td><a href='#' onclick=\"eliminar('".$personal->pkpersonal."','".$personal->nombrecomp . ' ' . $personal->apellidos."')\"><span class='glyphicon glyphicon-trash' data-toggle='tooltip' title='Eliminar'></span></a></td>";
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
