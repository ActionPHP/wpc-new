jQuery(document).ready(function($){


(function(){

	window.App = {

		Models: {},
		Views: {},
		Collections: {},
		Router: {}

	}

	var vent = _.extend({}, Backbone.Events);

	App.Models.Product = Backbone.Model.extend({

		urlRoot: ajaxurl + '?action=wpcart_route&wpcart_route=product',
		
		defaults: {
			id: null,
			name: null,
			brief_description: null,
			description: null,
			sku: null,
			price: null,
			weight: null,
			images: null,
			tags: null
		}
	});

	App.Collections.Products = Backbone.Collection.extend({

		url: ajaxurl + '?action=wpcart_route&wpcart_route=products'

	});

	App.Views.Product = Backbone.View.extend({

		el: '#view-port',

		events: {

			'click #edit-product-button' : 'saveProduct',
			'click #delete-product-button' : 'deleteProduct',
			'click #wpcart-add-property-button' : 'addProperty'

		},

		initialize : function() {

			vent.on('product:edit', this.render, this);
			vent.on('product:create', this.createProduct, this);
			
		},

		render: function (id) {
			
			if(!this.model){

				this.fetchProduct(id);
			}

			var template = _.template($('#product-form-template').html());
			var view = template(this.model.toJSON());
			this.$el.html(view);

			//Let's make sure we can toggle checkboxes that we need
			//Downloadable product?
			//$('#is-downloadable')._toggle({toggle: '#wpcart-downloadable-options'});
			

			vent.trigger('product:options');
		},

		createProduct: function(){

			this.model = new App.Models.Product;
			this.render();

		},

		saveProduct: function(){

			var name = $('#name').val();
			var description = $('#description').val();
			var brief_description = $('#brief-description').val();
			var price = $('#price').val();
			var tags = $('#tags').val();
			var sku = $('#sku').val();

			//Now let's get the product properties
			
			var property_fields = $('.wpcart-property-options');

			property_fields.each(function(idx, property_field){

				var property_name = $(property_field).find('.wpcart-property-name').val();
				console.log(property_name);

			});

			var that = this;
			this.model.url = ajaxurl + '?action=wpcart_route&wpcart_route=product&wpcart_action=save';
			this.model.save({ 
				name: name,
				description: description,
				brief_description: brief_description,
				price: price,
				tags: tags,
				sku: sku
			}, {

				success: function(response){

					//that.render();
				}
			});
;

		},

		deleteProduct: function(){

			var id = this.model.get('id');
			var that = this;
			this.model.url = ajaxurl + '?action=wpcart_route&wpcart_route=product&wpcart_action=delete';
			this.model.save({}, {

				success: function(response){

					alert('Item deleted!');
				}
			});

		},

		fetchProduct: function(id){

			var that = this;
			this.model = new App.Models.Product({id : id});
			this.model.url = ajaxurl + '?action=wpcart_route&wpcart_route=product&id=' + id;
			this.model.fetch({

				success: function(product){

						
						that.render();

				}

			});

		},

		addProperty: function(){

			vent.trigger('property:add');
		}

	});

App.Views.ProductListItem = Backbone.View.extend({
		tagName: 'li',

		
		render: function(){

			var template = _.template($('#product-list-item-template').html());
			var item = this.model.toJSON();
			var view = template(item);
			this.$el.html(view);
			this.$el.addClass('item-listing');
			this.$el.attr('id', 'item-id-' + item.id );
			return this;
		}

	});


	App.Views.ProductList = Backbone.View.extend({

		el: '#view-port',
		collection: new App.Collections.Products,
		
		events: {

			'click .item-listing' : 'editProduct',
			'click .remove-product-button' : 'removeProduct'
		},

		initialize: function(){
			
			this.$el = $('#view-port');
			vent.on('products:show', this.render, this);
		},

		render: function(){

			this.$el.html(($('#product-list-template').html()));
			//this.el = '#product-list';

			var that = this;
			this.collection.fetch({

				success: function(response){

					_.each(that.collection.models, function(product){

						var item = new App.Views.ProductListItem({ model: product});
						var _view = item.render().el;
						that.$el.find('#product-list').append(_view);
					},this);

				}

			});
		},

		editProduct: function(e){

			var id = this.getID(e, 'item-id-');
			router.navigate('product/' + id);

			vent.trigger('product:edit', id);

		},

		removeProduct: function(e){
			
			e.stopImmediatePropagation();
			var id = this.getID(e, 'remove-item-id-');

			var product = new App.Models.Product;

			var model = this.collection.get(id);
			model.url = ajaxurl + '?action=wpcart_route&wpcart_route=product&wpcart_action=delete';

			model.save({});
	
			return;
		},

		getID: function(e, replace){
			console.log(e);
			var element = $(e.currentTarget).attr('id');
			id = element.replace(replace, '');
			return id;

		}

	});

	
	

//
//
//
//
//
//
// /*******************************************************************************/


	//Product properties
	App.Models.ProductOption = Backbone.Model.extend({

		defaults: {

			id: null,
			name: null,
			product_id: null,
			value: null,
			position: null
		}
	});

	App.Views.ProductOptionsSandbox = Backbone.View.extend({

		el: '#wpcart-product-options-sandbox',

		initialize: function(){

			vent.on('product:options', this.render, this);
		},

		render: function(){

			this.setModel();
			var template = _.template($('#wpcart-product-options-sandbox-template').html());
			var view = template(this.model.toJSON());
			$('#wpcart-product-options-sandbox').html(view);
			console.log(this.el);
		},

		setModel: function(){

			if(!this.model){

				this.model = new App.Models.ProductOption;
			}

			return;
		}


	});

	App.Router = Backbone.Router.extend({

		routes : {

			'product' : 'productCreate',
			'product/:id' : 'productEdit',
			'products' : 'productList'
		},

		productEdit : function(id){

			vent.trigger('product:edit', id);
		},

		productCreate : function(){

			vent.trigger('product:create');
		},

		productList: function(){

			vent.trigger('products:show');
		}

		
	});
})();

	router = new App.Router;
	new App.Views.Product;
	new App.Views.ProductList;
	new App.Views.ProductOptionsSandbox;
	
	Backbone.history.start();


});