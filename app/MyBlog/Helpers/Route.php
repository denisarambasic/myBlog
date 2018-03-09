<?php

namespace MyBlog\Helpers;

class Route {
	
	private $routes = [];
	
	//if you put this mvc app in the root folder on your host then the rootDirectory is "/"
	private $rootDirectory = "/myblog";
	
	//Here we store all our routes from the Routes.php file in an routes[] array
	public function setRoute($httpMethod, $path, $controller, $controllerMethod, $params)
	{
		$this->routes[] = [
			'httpMethod'		=> $httpMethod,
			'path'				=> $path,
			'controller'		=> $controller,
			'controllerMethod'	=> $controllerMethod,
			'params'			=> $params
		];
	}
	
	//Here we check if the requested route from a client 
	//exists in our routes array and call the given controller
	public function callController()
	{
		
		$requestMethod 	= $_SERVER['REQUEST_METHOD'];
		
		//extract the rootDirectory from the request uri
		$requestUri 	= substr($_SERVER['REQUEST_URI'], strlen($this->rootDirectory));

		$temp = $requestUri;
		
		while($temp != ''){
			foreach($this->routes as $route){
				//check if the request path match
				if($temp == $route['path']){
					//check if the requested method match
					if($requestMethod == $route['httpMethod']){
						//check if the params count match
						$params = ltrim(substr($requestUri, strlen($temp)), "/");
						$params = explode("/", $params);
						
						if($params[0] == ''){
							$params = [];
						}
						
						if(count($params) == count($route['params'])){
							//if we achive this point call the appropriate controller and method with the params
							$controller = 'MyBlog\Controllers\\' . $route['controller'];
							$controller = new $controller();
							$controller->{$route['controllerMethod']}($params);
							
							exit;
						}
					}
				}
			}
			//if the request path dont match we remove the first right pice "/smething" from the request path
			$tempArray = explode("/", $temp);
			array_pop($tempArray);
			$temp = implode("/", $tempArray);
		}

	}
	
}