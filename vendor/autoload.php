<?php

function __autoload($class)
{
	if (strpos($class,'Mockery') !== false) {
    	
    	$class = str_replace('\\', '/', $class);

    	require_once $class . '.php';
    	print_r($class . "\n");
}

}

require_once 'Mockery.php';
require_once 'Mockery/Container.php';
require_once 'Mockery/Generator.php';
require_once 'Mockery/MockInterface.php';
require_once 'Mockery/Configuration.php';
require_once 'Mockery/CompositeExpectation.php';
require_once 'Mockery/ExpectationDirector.php';
require_once 'Mockery/Expectation.php';
require_once 'Mockery/CountValidator/CountValidatorAbstract.php';
require_once 'Mockery/CountValidator/Exact.php';
require_once 'Mockery/Exception.php';
require_once 'Mockery/Exception/NoMatchingExpectationException.php';
