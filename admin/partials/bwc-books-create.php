<?php wp_enqueue_media() ?>

<div class="container mt-4">
	<div class="row">
		<div class="col-sm-9 card">
			<h3 class="card-header bg-primary text-light">Crear Nuevo Libro</h3>
			<div class="card-body">
				<form  action="javascript:void(0)" id="form_create_book" method="post">
					<div class="row mb-3">
						<label for="" class="col-form-label col-sm-3">Nombre</label>
						<div class="col-sm-9">
							<input type="text" id="txt_name" name="txt_name" class="form-control" placeholder="Ingrese el nombre del libro" required>
						</div>
					</div>
					<div class="row mb-3">
						<label for="" class="col-frorm-label col-sm-3">Correo</label>
						<div class="col-sm-9">
							<input type="email" name="txt_correo" id="txt_correo" class="form-control" placeholder="ingrese el correo electrónico" required>
						</div>
					</div>
					<div class="row mb-3">
						<label for="" class="col-form-label col-sm-3">Seleccione el estante</label>
						<div class="col-sm-9">
							<select name="txt_estante" id="txt_estante" class="form-control" required>
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
							<select class="form-control" name="dd_status" id="dd_status">
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</select>
						</div>
					</div>
					<div class="row mb-3">
						<label for="" class="col-form-label col-sm-3">Precio</label>
						<div class="col-sm-9">
							<input type="number" min="1" class="form-control" name="dd_costo" id="dd_costo" required>
						</div>
					</div>
					<div class="row mb-3">
						<label for="" class="col-form-label col-sm-3">Imagen</label>
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-10">
									<div class="input-group">
										<div class="custom-file">
											<input type="button"  class="custom-file-input" name="img_book" id="img_book">
											<label for="" class="custom-file-label">Subir imagen</label>
										</div>
									</div>									
								</div>
								<div class="col-sm-2">
									<img src="" id="book_image" alt="" class="img-fluid img-thumbnail rounded">
									<input type="hidden" name="book_cover_image" id="book_cover_image">
								</div>
								
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="offset-sm-3">
							<button class="btn btn-primary btn-block">Enviar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>





