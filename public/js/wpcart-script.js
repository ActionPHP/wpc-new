jQuery(document).ready(function($){

	


	window.wpcart = {

		add : function(id){

			var item = { id: id };
			var that = this;
			$.post(

				wpcart_ajaxurl + '&wpcart_action=add', item
				

			).done(function(response){

				that.getCart();
				
			});

		},

		getCart : function(){

			var that = this;
			$.get(wpcart_ajaxurl, function(response){

				that.updateCart(response);

			});
		},

		updateCart: function(data){

			$('#wpcart-cart').html(data);
		},

		emptyCart: function(){

			var that = this;
			$.get(wpcart_ajaxurl + '&wpcart_action=empty', function(response){

				that.updateCart(response);

			});

		}

	}

	$('.wpcart-listing').click(function(){
					
			var id = $(this).attr('id');
			id = id.replace('wpcart-item-', '');
			wpcart.add(id);
	});
});