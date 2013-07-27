<?php

	
	$wpcart_ajaxurl = admin_url() . 'admin-ajax.php?action=wpcart_shopping_route';

	
?>
<script>
	jQuery(document).ready(function($){

		window.wpcart_ajaxurl = '<?php echo $wpcart_ajaxurl; ?>';

	});
</script>