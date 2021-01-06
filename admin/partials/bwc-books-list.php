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
			        									<button class="btn-sm btn btn-info btn-status" data-status="Activo" title="Activo">
			        									<i class="fas fa-check"></i>
			        									</button>
			        								<?php 
			        								} else 
			        								{ ?>
			        									<button class="btn-sm btn btn-danger btn-status" data-status="Inactivo" title="Inactivo">
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
				        						<button 
				        							type="button" 
				        							data-toggle="modal"
				        							data-target="#edit-book-modal"
				        							class="btn btn-sm btn-info btn-book-edit" 
				        							data-id="<?php echo trim($val->id) ?>">
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
<!-- MODAL DE EDICIÓN -->
<div class="modal fade " id="edit-book-modal" role="dialog" data-backdrop="static">
	<div class="modal-dialog modal-dialog-centered modal-lg" >
		<div class="modal-content px-4 py-2">
			<form  action="javascript:void(0)" id="form_edit_book" method="post">
				<div class="modal-header">
					<h3>Editar libro</h3>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>
				<div class="modal-body">
					
						<div class="row mb-3">
							<label for="" class="col-form-label col-sm-3">Nombre</label>
							<div class="col-sm-9">
								<input type="text" id="txt_name_edit" name="txt_name_edit" class="form-control" placeholder="Ingrese el nombre del libro" required>
							</div>
						</div>
						<div class="row mb-3">
							<label for="" class="col-frorm-label col-sm-3">Correo</label>
							<div class="col-sm-9">
								<input type="email" name="txt_correo_edit" id="txt_correo_edit" class="form-control" placeholder="ingrese el correo electrónico" required>
							</div>
						</div>
						<div class="row mb-3">
							<label for="" class="col-form-label col-sm-3">Seleccione el estante</label>
							<div class="col-sm-9">
								<select name="txt_estante_edit" id="txt_estante_edit" class="form-control" required>
									<option value="">Escoge una opción</option>
									<?php 
									if(count($data_shelf) > 0)
									{
										foreach($data_shelf as $data => $val)
										{ ?>
											<option value="<?php echo $val->id ?> ">
												<?php echo ucfirst($val->shelf_name) ?> 
											</option>

										<?php } }?>									
									
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<label for="" class="col-form-label col-sm-3">Seleccione el estatus</label>
							<div class="col-sm-9">
								<select class="form-control" name="dd_status_edit" id="dd_status_edit">
									<option value="1">Activo</option>
									<option value="0">Inactivo</option>
								</select>
							</div>
						</div>
						<div class="row mb-3">
							<label for="" class="col-form-label col-sm-3">Precio</label>
							<div class="col-sm-9">
								<input type="number" min="1" class="form-control" name="dd_costo_edit" id="dd_costo_edit" required>
							</div>
						</div>
						<div class="row mb-3">
							<label for="" class="col-form-label col-sm-3">Imagen</label>
							<div class="col-sm-9">
								<div class="row">
									<div class="col-sm-10">
										<div class="input-group">
											<div class="custom-file">
												<input type="button"  class="custom-file-input" name="img_book" id="img_book_edit">
												<label for="" class="custom-file-label">Subir imagen</label>
											</div>
										</div>									
									</div>
									<div class="col-sm-2">
										<img src="" id="book_image_edit" alt="" class="img-fluid img-thumbnail rounded img_libro">
										<input type="hidden" name="book_cover_image_edit" id="book_cover_image_edit">
									</div>
									
								</div>
							</div>
						</div>
						
				</div>
				<div class="modal-footer">
					<div class="form-group">
							<div class="">
								<button type="button" class="btn btn-sm btn-primary btn-danger" data-dismiss="modal">Cancelar</button>
								<button type="button" class="btn btn-sm btn-primary btn-info btn-editar-book" >Editar</button>
							</div>
						</div>
				</div>
			</form>

		</div>
	</div>
</div>





