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
	/*EDITA UN LIBRO*/

	/*ACCIONAR MODAL PARA EDITA UN LIBRO*/
	jQuery(document).on('click','.btn-book-edit', function(){
		var 
			attr       = jQuery(this).attr('data-id'),
			tr         = jQuery(this).parent().parent(),
			book_name  = tr.find(jQuery('td:nth-child(2)')).text(),
			opt_shelf  = tr.find(jQuery('td:nth-child(3)')).text(),
			sel_shelf  = jQuery('#txt_estante_edit option'),
			correo     = tr.find(jQuery('td:nth-child(4)')).text(),
			precio     = tr.find(jQuery('td:nth-child(5)')).text().split('$'),
			opt_status = jQuery('#dd_status_edit option'),
			sel_status = tr.find('.btn-status').attr('data-status'),
			imagen     = tr.find(jQuery('td:nth-child(7) img')).attr('src')
	    ;
	    jQuery('#txt_estante_edit option:selected').prop('selected',false);
	    jQuery('#dd_status_edit option:selected').prop('selected',false);
	    jQuery('#txt_name_edit').val(book_name);
	    jQuery('#txt_correo_edit').val(correo);
	    jQuery('#dd_status_edit').val(status);
	    jQuery('#dd_costo_edit').val(parseInt(precio[1]));
	    jQuery('#book_image_edit').val(imagen);
	    sel_shelf.each(function(){
			 if(jQuery(this).text().trim() == opt_shelf.trim())
			 {
			 	 jQuery(this).prop('selected', true);
			 }
		});
	    opt_status.each(function(){
	    	if(jQuery(this).text().trim() == sel_status.trim())
	    	{
	    		jQuery(this).prop('selected', true);
	    	}
	    });
	    jQuery('#book_image_edit').attr('src', imagen);

	   /*EDITAR INFO DEL LIBRO*/
	   jQuery(document).on('click','.btn-editar-book', function(){
	   		var postdata  = jQuery('#form_edit_book').serialize();
	   			postdata += "&action=admin_ajax_test&param=edit_book&book_id="+ attr;

	   		jQuery.post(ajaxtest,postdata, function(response){
	   			var data = jQuery.parseJSON(response)
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
	   });
	   console.log(attr);
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
