<script type="text/javascript" src="js/equipo.js"></script>
<br>
<br>
hola eliminar
<br>
<div class="row">
	<div class="form-group">
		<div class="col-sm-4"></div>
		<div class="col-sm-4">
			<button type="button" class="btn btn-primary btn-block" name="btnnuevo" id="idbtnNuevo"><span class="glyphicon glyphicon-new-window"></span> Nuevo Equipo</button>
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
					<th>Equipo</th>
					<th>Estado</th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				if(isset($listado)){
					foreach($listado as $equipo){
				?>
						<tr>
							<td><?= $equipo->codigo ?></td>
							<td><?= $equipo->descripcion ?></td>
							<td><?= ($equipo->fktipocontrato == '1') ? "PROPIO" : "ALQUILADO"; ?></td>
						<?php
							echo "<td><a href='#' onclick=\"editar('".$equipo->pkequipo."')\"><span class='glyphicon glyphicon-edit' data-toggle='tooltip' title='Editar'></span></a></td>";
							echo "<td><a href='#' onclick=\"eliminar('".$equipo->pkequipo."','".$equipo->codigo . ' ' . $equipo->descripcion."')\"><span class='glyphicon glyphicon-trash' data-toggle='tooltip' title='Eliminar'></span></a></td>";
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
