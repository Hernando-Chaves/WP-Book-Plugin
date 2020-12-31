(function( $ ) {
	'use strict';

	var ajaxurl = ajaxhch.url;

 	$(document).on('click','#book-public-ajax',function(){
 		var postdata = "&action=public_ajax_request&param=first_public_ajax";
 		$.post(ajaxurl,postdata,function(response){
 			console.log(response);
 		});
 	});
})( jQuery );
