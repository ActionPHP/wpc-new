<?php
//ini_set('error_reporting', E_ALL);
ini_set( 'display_errors', 1 );
require_once __WPCART_PATH__ . 'Modules/WPCartVariantManager/Model/WPCartVariantManager.php';

$variantManager = new WPCartVariantManager;

/*$options = array (

		'1' => 5,
		'2' => 8,
		'3' => 19,
		'4' => 22

	);*/
	
	$variant = new stdClass();
	$product_id = 10;

	$option_1_id = 1;
	$option_2_id = 2;
	$option_3_id = 3;


/*$variants = array (

		(object) array(
			'name' => 'Variant'
			,'product_id' => $product_id
			,'option_1_id' => $option_1_id
			,'option_1_value_id' => 5
			,'option_2_id' => $option_2_id
			,'option_2_value_id' => 8
			,'option_3_id' => $option_3_id
			,'option_3_value_id' => 19

			),

	);

	$variantManager->setVariants($variants);
	$variantManager->createVariants();*/

	$product_id = '150904111';
$options[][id] = '181146691';
$options[][values][] = 'red';
$options[][values][] = 'pink';
$options[][id] = '181146779';
$options[][values][] = 'swede, leather';
$options[][values][] = 'cotton';
$options[][values][] = 'nylon';
$options[][id] = '181146449';
$options[][values][] = 'small';
$options[][values][] = 'big';

?>
<pre>
<?php print_r(get_defined_vars()); ?>
</pre>klj