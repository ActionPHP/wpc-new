<?php

return array(

		'routes' => array(

				'index' => array(

						'Module' => 'Index',
						'Controller' => 'IndexController',

					),

				'product' => array(

						'Module' => 'Product',
						'Controller' => 'ProductController',

					),

				'products' => array(

						'Module' => 'Product',
						'Controller' => 'ProductController',

					),

				'cart' => array( 

						'Module' => 'Cart',
						'Controller' => 'CartController',

					),

				'checkout' => array(
						'Module' => 'Checkout',
						'Controller' => 'CheckoutController',
					),

			),

		'module_path' => array(

				'Modules',
			),

	);