<script type="text/template" id="product-form-template" >

<div id="product-form-div" >
<h3><%= (id) ? 'Edit' : 'Create' %> Product</h3>
	<form id="product-form" >
		<label>
			<strong>Product name:</strong> <input type="text" name="name"
			id="name" value="<%= name %>" />
		</label>
				
		<label>
			<strong>Brief description: </strong> <br/><textarea id="brief-description" name="brief-description"
			><%= (brief_description) ? brief_description : null  %></textarea>
		</label>
		
		<label>
			<strong>Description: </strong> <br/><textarea id="description" name="description"
			></textarea>
		</label>
		
		<label>
			<strong>Price: </strong> <input type="text" id="price" name="price" value="" />
		</label>

		<label>
			<strong>Product images: </strong> <button  type="button" class="btn btn-inverse">Manage images</button>
		</label>
		
		<label>
			<strong>Tags</strong> <input type="text" name="tags" id="tags"
			value="" />
		</label>

		<label>
			<strong>SKU</strong> <input type="text" name="sku" id="sku"
			value="" />
		</label>

		<label>
			<input type="button" value="<%= (id) ? 'Save' : 'Create' %> Product" class="btn-large btn-primary" id="edit-product-button" /> 
		</label>
		<label>
			<%= (id) ? '<input type="button" value="Delete" class="btn btn-danger"  />' : null %>
		</label>
	</form>
</div>
</script>