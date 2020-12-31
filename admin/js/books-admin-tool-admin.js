jQuery(function()
{   
	let 
		url     = '../wp-content/plugins/books-admin-tool/admin/js/lang/es_ES.json',
		// ajaxurl = bwc_book.ajaxurl,
		ajaxtest = ajaxhch.url
	;

	/*ACTIVA DATATABLES PARA LAS TABLAS*/
	if(jQuery('#bwc-book-list').length > 0)
	{
		jQuery('#bwc-book-list').DataTable({

			"language": {
				url: url
			}
		});
	}
	if(jQuery('#bwc-book-list-shelf').length > 0)
	{
		jQuery('#bwc-book-list-shelf').DataTable({

			"language": {
				url: url
			}
		});
	}

	/*PETICIONES AJAX*/

	/*CREA UN LIBRO*/
	jQuery('#form_create_book').validate({
		messages: {
			txt_name   : 'Ingresa el nombre del libro',
			txt_correo : {
				required : 'Este campo es requerido',
				email    : 'Ingresa un correo valido'
			},
			txt_estante : 'Selecciona un estante para el libro',
			dd_costo    : 'Ingres el precio del libro'
		},
		submitHandler:function(){
			var postdata = jQuery('#form_create_book').serialize();
			  postdata  += "&action=admin_ajax_test&param=create_book";

			jQuery.post(ajaxtest, postdata, function(response){
				var data = jQuery.parseJSON(response);
				if(data.status == 1)
				{
					Swal.fire({
		  				position:'top-end',
		  				title: data.mensaje,
		  				icon: 'success',
		  			});
		  			setTimeout(function(){
		  				location.reload();
		  			},1000);
				}else {
					Swal.fire({
		  				position:'top-end',
		  				title: data.mensaje,
		  				icon: 'warning',
		  			});
				}
			})
		}
	})
	/*BORRA UN LIBRO*/
	jQuery(document).on('click','.btn-book-del', function(){

		 Swal.fire({
		 	position :'top-end',
		 	title: ' Estas seguro de borrar este elemento',
		 	text: 'Esta acción no tiene vuela atras',
		 	icon:'warning',
		 	showCancelButton: true,
		 	confirmButtonColor: '#3085d6',
		 	cancelButtonColor: '#d33',
		 	cancelButtonText: 'Cancelar',
		 	confirmButtonText: 'Si, borralo'
		 }).then(result=>{
		 	if(result.isConfirmed)
		 	{
		 		var book_attr = jQuery(this).attr('data-id'),
		 		    postdata  = "&action=admin_ajax_test&param=delete_book&book_id="+ book_attr;

				jQuery.post(ajaxtest,postdata, function(response){
					var data = jQuery.parseJSON(response);
					if(data.status == 1)
					{
						Swal.fire({
							position:'top-end',
							title: data.mensaje,
							icon: 'success',
						});
						setTimeout(function(){
							location.reload();
						},500);

					}else {
						Swal.fire({
							position:'top-end',
							title: data.mensaje,
							icon: 'warning',
						});
					}
				});
		 	}
		 });
		
	});
	
	/*CREA UN SHELF*/
	jQuery('#bwc-add-book-shelf').validate({
		messages: {
			txt_name_shelf : 'Ingresa un nombre para el estante',
			dd_capacidad   : 'Ingresa la capacidad del estante',
			txt_ubicacion  : 'Ingresa la ubicación del estante'

		},
		submitHandler: function(){
			var postdata = jQuery('#bwc-add-book-shelf').serialize();
			postdata += "&action=admin_ajax_test&param=create_book_shelf";
			
			jQuery.post(ajaxtest, postdata, function(response){
				var data = jQuery.parseJSON(response);
     			if(data.status == 1)
     			{
     				Swal.fire({
		  				position:'top-end',
		  				title: data.mensaje,
		  				icon: 'warning',
		  			});
     				setTimeout(function(){
     					location.reload();
     				},1000);
     			}else {
     				Swal.fire({
		  				position:'top-end',
		  				title: data.mensaje,
		  				icon: 'warning',
		  			});
     			}
		    })
		}
	})


	/*BORRA UN SHELF*/
	jQuery(document).on('click','.btn-shelf-del', function(){
		
		Swal.fire({
		  position:'top-end',
		  title: 'Estas seguro de borrar este elemento?',
		  text: "Esta acción no tiene vuelta atras!",
		  icon: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  cancelButtonText: 'Cancelar',
		  confirmButtonText: 'Si, borralo'
		}).then((result) => {
		  if (result.isConfirmed) 
		  {
		  	var shelf_id = jQuery(this).attr('data-id');
		  	postdata = "&action=admin_ajax_test&param=delete_book_shelf&shelf_id="+shelf_id;

		  	jQuery.post(ajaxtest,postdata, function(response){
		  		var data = jQuery.parseJSON(response);
		  		if(data.status == 1)
		  		{
		  			Swal.fire({
		  				position:'top-end',
		  				title: data.mensaje,
		  				icon: 'success',
		  			});
		  			setTimeout(function(){
		  				location.reload();
		  			},500);

		  		}else {
		  			Swal.fire({
		  				position:'top-end',
		  				title: data.mensaje,
		  				icon: 'warning',
		  			});
		  		}
		  	});
		    
		  }
		})

		
	});

	/*HABILITA LA FUNCIÓN PARA SUBIR IMAGENES DESDE WOPRDPRESS*/
	jQuery(document).on('click','#img_book',function(){
		var image = wp.media({
			title : "Subir imagen del libro",
			multiple : false
		}).open().on('select', function(e){
			var uploaded_image = image.state().get('selection').first();
			var image_data = uploaded_image.toJSON();
			jQuery('#book_image').attr('src',image_data.url);
			jQuery('#book_cover_image').val(image_data.url);
		});
	});

})
