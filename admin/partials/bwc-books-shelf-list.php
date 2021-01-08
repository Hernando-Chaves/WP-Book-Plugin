
<div class="container mt-4">
	<div class="row">
		<div class="col-sm-12 card">
			<h3 class="card-header bg-primary text-light">Lista de Shelf Libros</h3>
			<div class="card-body">
				<table id="bwc-book-list-shelf" class="display" style="width:100%">
				        <thead>
				            <tr>
				                <th>ID</th>
				                <th>Nombre</th>
				                <th>Capacidad</th>
				                <td>Ubicación</td>
				                <th>Status</th>
				                <th>Acciones</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php 
				        	if(count($data_shelf) > 0)
				        	{
				        		foreach($data_shelf as $data => $val)
				        		{ ?>
				        			<tr>
				        				<td> <?php echo $val->id ?> </td>
				        				<td><?php echo ucfirst($val->shelf_name) ?> </td>
				        				<td><?php echo intval($val->capacity) ?> </td>
				        				<td><?php echo ucfirst($val->shelf_location) ?> </td>
				        				<td>
				        					<?php
				        						if($val->status)
				        						{ ?>
				        							<button class="btn-sm btn btn-success" title="Activo">
				        							<i class="fas fa-check"></i>
				        							</button>
				        						<?php 
				        						} else 
				        						{ ?>
				        							<button class="btn-sm btn btn-danger" title="Inactivo">
				        								<i class="fas fa-ban"></i>
				        							</button>
				        						<?php 

				        						}
				        					?> 
				        				</td>
				        				<td>
				        					<button class="btn btn-sm btn-info btn-shelf-edit" data-id="<?php echo $val->id ?>">
				        					<i class="fas fa-pencil-alt"></i>
				        					</button>
				        					<button class="btn btn-sm btn-danger btn-shelf-del" data-id="<?php echo $val->id ?>">
				        					<i class="far fa-trash-alt"></i>
				        					</button>
				        				</td>
				        			</tr>

				        		<?php }
				        	}

				        	?>
				        </tbody>
				        <tfoot>
				            <tr>
				                <th>ID</th>
				                <th>Nombre</th>
				                <th>Capacidad</th>
				                <td>Ubicación</td>
				                <th>Status</th>
				                <th>Acciones</th>
				            </tr>
				        </tfoot>
				    </table>
			</div>
		</div>
	</div>
</div>





