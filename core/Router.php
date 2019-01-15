<?php
  class Router extends Controller {

    public function __construct()
    {
      $this->determineDestination($this->getUri());
    }

    private function getUri()
    {
      $url = $_SERVER["REQUEST_URI"];
      $uri = explode("/", $url);

      return $uri;
    }

    private function sendToDestination($className, $method, $params)
    {
      $class = ROOT . APP . 'controllers/' . $className . '.php';
    	require_once($class);
    	$obj = new $className;
    	die(call_user_func_array(array($obj, $method), $params));
    }

    private function determineDestination($uri = "")
    {
      if(isset($uri[1]) && $uri[1] != "")
      {
        if(class_exists(ucfirst($uri[1])))
        {
          $className = ucfirst($uri[1]);
        }
        else
        {
          $className = CONTROLLER;
        }
	  }
      else
      {
        $className = CONTROLLER;
      }
	  if(isset($uri[2]) && $uri[2] != "")
      {
        if(method_exists($className, ucfirst($uri[2])))
        {
          $method = ucfirst($uri[2]);
        }
        else
        {
          $method = METHOD;
        }
	  }
      else
      {
        $className = CONTROLLER;
        $method = METHOD;
      }
      $params = array_slice($uri, 3);
	    $this->sendToDestination($className, $method, $params);
    }

  }
