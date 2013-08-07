<?php
//ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
require_once __WPCART_PATH__ . 'Modules/WPCartVariantManager/Model/WPCartVariantManager.php';

$variantManager = new WPCartVariantManager;

$options = array (

		'1' => array( '5', '6'),
		'2' => array( '8', '9'),

	);

$variantManager->setVariantOptions($options);
$variantManager->setProductID('10');
$variantCombos = $variantManager->generateVariantOptions($options);

$variantManager->generateVariants();

$info = get_option('aa1');
$info2 = get_option('aa2');

?>
<pre>
<?php print_r(get_defined_vars()); ?>
</pre>klj