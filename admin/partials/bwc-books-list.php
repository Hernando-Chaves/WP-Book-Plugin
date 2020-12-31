<div class="container mt-4">
	<div class="row">
		<div class="col-sm-12 card">
			<h3 class="card-header bg-primary text-light">Lista de Libros</h3>
			<div class="card-body">
				<table id="bwc-book-list" class="display" style="width:100%">
				        <thead>
				            <tr>
				                <th>ID</th>
				                <th>Nombre</th>
				                <th>Estante</th>
				                <th>Correo</th>
				                <th>Precio</th>
				                <th>Status</th>
				                <th>Imagen</th>
				                <th>Acciones</th>
				            </tr>
				        </thead>
				        <tbody>
				        	<?php 
				        		if(count($data_book) > 0)
				        		{
				        			foreach($data_book as $data => $val)
				        			{ ?>

				        				<tr>
				        					<td><?php echo intval($val->id) ?> </td>
				        					<td><?php echo ucfirst($val->name) ?> </td>
				        					<td><?php echo ucfirst($val->shelf_name) ?> </td>
				        					<td><?php echo $val->correo ?> </td>
				        					<td>CO $ <?php echo intval($val->precio) ?> </td>
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
				        						<?php 
				        							if(!empty($val->book_image))
				        							{ ?>
				        								<img src="<?php echo $val->book_image ?>" class="img-fluid img-thumbnail rounded img_libro" >

				        							<?php } else {
				        								echo "No hay imagen";
				        							}
				        						?>
				        					</td>
				        					<td>
				        						<button class="btn btn-sm btn-info btn-book-edit" data-id="<?php echo $val->id ?>">
				        						<i class="fas fa-pencil-alt"></i>
				        						</button>
				        						<button class="btn btn-sm btn-danger btn-book-del" data-id="<?php echo $val->id ?>">
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
				                <th>Estante</th>
				                <th>Correo</th>
				                <th>Precio</th>
				                <th>Status</th>
				                <th>Imagen</th>
				                <th>Acciones</th>
				            </tr>
				        </tfoot>
				    </table>
			</div>
		</div>
	</div>
</div>





