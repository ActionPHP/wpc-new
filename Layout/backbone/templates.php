<script type="text/template" id="product-form-template" >

<div id="product-form-div" >
<h3><%= (id) ? 'Edit' : 'Create' %> Product</h3>
<%= (id) ? '<pre><strong>Your shortcode for this product: </strong> [wpcart_add_to_cart id="' + id + '"] </pre>' : '' %>
	<form id="product-form" >
		<label>
			<strong>Product name:</strong> <input class="wpcart-long-input" type="text" name="name"
			id="name" value="<%= name %>" />
		</label>
				
		<label>
			<strong>Brief description: </strong> <br/><textarea id="brief-description" name="brief-description"
			><%= (brief_description) ? brief_description : null  %></textarea>
		</label>
	<!--	-->
		<label>
			<strong>Description: </strong> <br/><textarea id="description" name="description"
			><%= description %></textarea>
		</label>
	
		<label>
			<strong>Price: </strong> <input type="text" id="price" name="price" value="<%= price %>" />
		</label>
	<!-- -->
		<label>
			<strong>Product images: </strong> <button  type="button" class="btn btn-inverse">Manage images</button>
		</label>
		
		<label>
			<strong>Tags</strong> <input type="text" name="tags" id="tags"
			value="<%= tags %>" />
		</label>

		<label>
			<strong>Weight</strong> <input type="text" name="weight" id="weight"
			value="<%= weight %>" />
		</label>

		<label>
			<strong>SKU</strong> <input type="text" name="sku" id="sku"
			value="<%= sku %>" />
		</label>
		
		<label>
		<input type="checkbox" name="is-downloadable" value="true" /> Digital download
		</label>
		<label class="hide" >
			<strong>Download URL</strong> <input type="text" name="download-url" value="" id="download-url" /> <button
		type="button" class="btn btn-inverse">Upload file</button>
		</label>

		<!-- Manage product options -->
		<div id="wpcart-product-options" >
				<label>
					<strong>Product options</strong>
				</label>

				<div id="wpcart-product-options-sandbox" ></div>
		</div>
		<!-- End manage product options -->
		<label>
			<input type="button" value="<%= (id) ? 'Save' : 'Create' %> Product" class="btn-large btn-primary" id="edit-product-button" /> 
		</label>
		<label>
			<%= (id) ? '<input type="button" value="Delete" class="btn btn-danger" id="delete-product-button" />' : null %>
		</label>
	</form>
</div>
</script>

<script type="text/template" id="product-list-template" >
<h3>View all products</h3>
<ul id="product-list"></ul>
</script>

<script type="text/template" id="product-list-item-template" >
<a class="remove-product-button pull-right btn-small btn-danger hide" id="remove-item-id-<%= id %>"  >Delete</a>

<!-- <img width="40" src= "https://s3.amazonaws.com/wpcart/rsz_img_0259.jpg" />
-->
<strong><%= name %></strong> | <strong>Shortcode: </strong> [wpcart_add_to_cart
id="<%= id %>"]
<p>
<%= brief_description %>
</p>
</script>

<!-- Product properties -->
<script type="text/template" id="wpcart-product-options-sandbox-template" >
<label>
	<span>Option name: </span><input id="wpcart-option-name" value="<%= name %>" type="text" />
</label>

<label style="float: right;">
	<ul>

	</ul>
</label>

<label>
	<button type="button" class="btn btn-default"  >Save option</button>
</label>
</script>

<script type="text/template" id="" ></script>