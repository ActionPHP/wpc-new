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

		model: App.Models.Product

	});

	App.Views.Product = Backbone.View.extend({

		el: '#view-port',

		initialize : function() {
			
			vent.on('product:show', this.render, this);

			this.model = new App.Models.Product;

			console.log(this.model.toJSON());
		},

		render: function (id) {

			var template = _.template($('#product-form-template').html());
			var view = template(this.model.toJSON());
			this.$el.html(view);
			console.log('Showing product of id: ' + id);
		}
	});
	App.Views.ProducList = Backbone.View.extend({});
	App.Views.ProductListItem = Backbone.View.extend({});

	App.Router = Backbone.Router.extend({

		routes : {

			'product/:id' : 'productForm',
			'products' : 'productList'
		},

		productForm : function(id){

			vent.trigger('product:show', id);
		}

	});

	vent.on('product:show', function(r){

		console.log(r);

	});


	
})();
$(document).ready(function(){

	router = new App.Router;
	new App.Views.Product;
	Backbone.history.start();

});