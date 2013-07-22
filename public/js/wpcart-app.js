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
			images: null
		}
	});

	App.Collections.Products = Backbone.Collection.extend({

		model: App.Models.Product,
		url: '/wpcart?route=products'

	});

	App.Views.Product = Backbone.View.extend({

		el: '#view-port',

		events: {

			'click #edit-product-button' : 'saveProduct'
		},

		initialize : function() {
			
			vent.on('product:show', this.render, this);

			this.model = new App.Models.Product;
			console.log(this.model);
			console.log('---')

		},

		render: function (id) {

			var template = _.template($('#product-form-template').html());
			var view = template(this.model.toJSON());
			this.$el.html(view);
			console.log('Showing product of id: ' + id);
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

					console.log(that.model.toJSON());
					that.render();
				}
			});
;

		}

	});

	App.Views.ProductList = Backbone.View.extend({

		collection: new App.Collections.Products,

		initialize: function(){

			vent.on('products:show', this.render(), this);
			console.log(this.collection.toJSON());
		},

		render: function(){

			that = this;
			this.collection.fetch({

				success: function(){

					var template = $('#product-list-template');

					_.each(that.collection.models, function(product){

						var item = new App.Views.ProductListItem({ model: product});
						var _view = item.render.el;
						that.$el.append(_view);

					});

				}

			});
		}

	});

	App.Views.ProductListItem = Backbone.View.extend({

		render: function(){

			

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
			console.log('Listing all products...');
		}

		
	});

	


	
})();
$(document).ready(function(){

	router = new App.Router;
	new App.Views.Product;
	new App.Views.ProductList;
	Backbone.history.start();

});