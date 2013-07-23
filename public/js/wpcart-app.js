(function(){

	window.App = {

		Models: {},
		Views: {},
		Collections: {},
		Router: {}

	}

	var vent = _.extend({}, Backbone.Events);

	App.Models.Product = Backbone.Model.extend({
		
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

	App.Collections.Products = Backbone.Collection.extend({

		url: '/wpcart?route=products'

	});

	App.Views.Product = Backbone.View.extend({

		el: '#view-port',

		events: {

			'click #edit-product-button' : 'saveProduct',

		},

		initialize : function() {
			
			vent.on('product:show', this.render, this);

			//this.model = new App.Models.Product;
			

		},

		render: function (id) {

			var template = _.template($('#product-form-template').html());
			var view = template(this.model.toJSON());
			this.$el.html(view);
			console.log(this.model.toJSON());
		},

		saveProduct: function(){

			var name = $('#name').val();
			var description = $('#description').val();
			var brief_description = $('#brief-description').val();
			var price = $('#price').val();
			var tags = $('#tags').val();
			var sku = $('#sku').val();

			that = this;
			this.model.url = '/wpcart/?route=product&action=save';
			this.model.save({ 
				name: name,
				description: description,
				brief_description: brief_description,
				price: price,
				tags: tags,
				sku: sku
			}, {

				success: function(response){

					that.render();
				}
			});
;

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

		collection: new App.Collections.Products,
		
		events: {

			'click .item-listing' : 'editProduct'
		},

		initialize: function(){
		
			$('#view-port').append($('#product-list-template').html());
			this.$el = $('#product-list');
			vent.on('products:show', this.render(), this);
		},

		render: function(){

			that = this;
			this.collection.fetch({

				success: function(response){

					_.each(that.collection.models, function(product){

						var item = new App.Views.ProductListItem({ model: product});
						var _view = item.render().el;
						that.$el.append(_view);

					},this);
				}

			});
		},

		editProduct: function(e){

			var element = $(e.currentTarget).attr('id');
			id = element.replace('item-id-', '');
			var product = this.collection.get(id);
			var productView = new App.Views.Product({ model: product });
			productView.render();

		}

	});

	
	App.Router = Backbone.Router.extend({

		routes : {

			'product/:id' : 'productForm',
			'products' : 'productList'
		},

		productForm : function(id){

			vent.trigger('product:show', id);
		},

		productList: function(){

			vent.trigger('products:show');
		}

		
	});

	


	
})();
$(document).ready(function(){

	router = new App.Router;
	new App.Views.Product;
	new App.Views.ProductList;
	Backbone.history.start();

});