<?php
//TODO: rework this to remove dependence on Registry::getInstance()
require_once 'core/lib/View/HTMLView.php';
class CheckoutController extends AbstractController

{

	public function index_Action()
	{	
		
		$data = array('where' => 'checkout');

		$this->view = new HTMLView($data);

		$template = $this->getViewPath();
		$this->view->setTemplate($template);
		
		
		return $this->view;
	}
	
	public function getViewPath()
	{
		$reg = Registry::getInstance();

		$route = $reg->matchedRoute;
		
		$viewPath = $reg->modules_path . '/' . $route->Module . '/View/' . $route->Action . '.phtml' ;
		
		return $viewPath;
	}
}