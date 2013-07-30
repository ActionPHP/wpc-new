<?php
	include __WPCART_PATH__.'/Layout/header.php';
?>
<div id="main-view-port">
<pre>
<strong>Place this shortcode wherever you want the shopping cart to appear: </strong> [wpcart_temp_cart]

</pre>
	<ul>
		<li><a href="#product" id="create-product" >Create product</a></li>
		<li><a href="#products" id="list-all-products" >List all products</a></li>
	</ul>
	<div id="view-port"></div>

</div>




<!--- Backbone Templates -->
<?php 

	include __WPCART_PATH__.'/Layout/backbone/templates.php';

?>
