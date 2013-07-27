jQuery(document).ready(function($){

	window.WPCART_APP = {

		Models : {},
		Views : {},
		Collections: {},

	}

	WPCART_APP.Models.Item = Backbone.Model.extend({

		defaults: {
			
			id: null,
			name: null,
			brief_description: null,
			description: null,
			sku: null,
			price: null,
			images: null,
			tags: null
		}

	});

	WPCART_APP.Views.Cart = Backbone.View.extend({

		events: {


		},

		render: function(){

			//First, we will empty the current cart, since we're receiving a full cart
			this.$el.html('');
			that = this;
			_.each(this.collection.models, function(item){

				var itemView = new WPCART_APP.Views.Item({model: item });
				that.$el.append(itemView.render().el);
			});
		}

	});

	WPCART_APP.Views.Item = Backbone.View.extend({
		tagName : 'li',

		initialize: function(){

			this.template = 'Product id: <%= product.id %>	| Quantity: <span style="width: 45px;" class="wpcart-item-quantity" ><%= quantity %></span><span class="wpcart-remove-item" >[x] Remove</span>';
		},

		events : {

			'change .wpcart-item-quantity' : 'changeQuantity',
			'click .wpcart-remove-item' : 'removeItem'
		},

		render: function(){

			var template = _.template(this.template);
			var view = template(this.model.toJSON());
			this.$el.html(view);
			this.$el.addClass('wpcart-basket-item');
			return this;

		},

		changeQuantity : function(e){

			console.log(e);
		},

		removeItem: function(e){
			this.model.url = wpcart_ajaxurl + '&wpcart_action=remove&item_id=' + this.model.get('id');
			this.model.destroy({});
			this.$el.fadeOut();

		}
	});

	WPCART_APP.Collections.Items = Backbone.Collection.extend({});

	window.wpcart = {

		add : function(id){

			var item = { id: id };
			var that = this;
			$.post(

				wpcart_ajaxurl + '&wpcart_action=add', item
				

			).done(function(response){

				that.updateCart(response);
				
			});

		},

		updateCart: function(data){

			data = JSON.parse(data);

			var collection = new WPCART_APP.Collections.Items(data);
			var cart = new WPCART_APP.Views.Cart({ el: '#wpcart-cart-basket', collection: collection });
			cart.render();
		},

		emptyCart: function(){

			var that = this;
			$.get(wpcart_ajaxurl + '&wpcart_action=empty', function(response){

				that.updateCart(response);

			});

		},


		fetchCart: function(){

			var that = this;

			$.get(wpcart_ajaxurl, function(data){

				that.updateCart(data);
			});
		}

	}

	$('.wpcart-listing').click(function(){
					
			var id = $(this).attr('id');
			id = id.replace('wpcart-item-', '');
			wpcart.add(id);
			console.log(window.wpcart_ajaxurl);


	});

	window.onload = function(){

		wpcart.fetchCart();

	};

});