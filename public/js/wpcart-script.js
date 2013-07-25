jQuery(document).ready(function($){

	$('.wpcart-listing').html('<input type="button" value="Add to cart" id="wpcart-item-1" />');


	$('.wpcart-listing').click(function(){

			$.post(wpcart_ajaxurl, {}, function(response){

					console.log(response);

			});
	});
});