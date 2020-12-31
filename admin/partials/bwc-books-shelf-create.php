<style>
	.custom-file-input:lang(en)~.custom-file-label::after
		{
			content:"Buscar...";
		}
</style>
<div class="container mt-4">
	<div class="row">
		<div class="col-sm-9 card">
			<h3 class="card-header bg-primary text-light">Crear Nuevo Shelf</h3>
			<div class="card-body">
				<form action="javascript:void(0)" id="bwc-add-book-shelf">
					<div class="row mb-3">
						<label for="" class="col-form-label col-sm-2">Nombre</label>
						<div class="col-sm-10">
							<input type="text" id="txt_name_shelf" name="txt_name_shelf" class="form-control" placeholder="Ingrese el nombre del libro" required>
						</div>
					</div>
					<div class="row mb-3">
						<label for="" class="col-form-label col-sm-2">Capacidad</label>
						<div class="col-sm-10">
							<input type="number" min="1" class="form-control" name="dd_capacidad" id="dd_capacidad" placeholder="Ingrese la capacidad del libro" required>
						</div>
					</div>
					<div class="row mb-3">
						<label for="" class="col-form-label col-sm-2">Ubicación</label>
						<div class="col-sm-10">
							<input type="text" id="txt_ubicacion" name="txt_ubicacion" class="form-control" placeholder="Ingrese la ubicación del libro" required>
						</div>
					</div>
					<div class="row mb-3">
						<label for="" class="col-form-label col-sm-2">Estatus</label>
						<div class="col-sm-10">
							<select class="form-control" name="dd_status_shelf" id="dd_status_shelf">
								<option value="1">Activo</option>
								<option value="0">Inactivo</option>
							</select>
						</div>
					</div>
					<div class="form-group">
						<div class="offset-sm-2">
							<button class="btn btn-primary btn-block">Enviar</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>





