<?php

namespace Alex\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;

class BaseController implements ControllerProviderInterface
{    
    public function indexAction($args = []) {}
    
    public function connect(Application $app)
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controlerClass = get_called_class();
        $controlerParts = explode('\\', $controlerClass);
        $controler = end($controlerParts);
        $controller = strtolower(str_replace("Controller", "", $controler));
        
        $allActions = get_class_methods($controlerClass);
        
        $this->defineRoute($controllers, "/", "$controlerClass::indexAction");
        foreach($allActions as $method) {
            if (strpos($method, 'Action') !== false) {
                $methodPrefix = str_replace("Action", "", $method);
                $this->defineRoute($controllers, "/$methodPrefix", "$controlerClass::$method");
            }
        }

        return $controllers;
    }
    
    private function defineRoute($controller, $route, $call)
    {
        $controller->get($route, $call);
        $controller->post($route, $call);
        return $controller;
    }
}

