<?php

namespace Alex;

use Symfony\Component\Yaml\Parser as YamlParser;
use Alex\Helper\CoreHelper;

class Core
{
    static public $helper;

    static public function init($app)
    {
        CoreHelper::initKeys();
        self::initLandingPage($app);
        self::initErrorManagment($app);
    }

    static private function initLandingPage($app)
    {
        $app->get('/', function(){
            return (new Controller\IndexController())->indexAction();
        });
    }

    static private function initErrorManagment($app)
    {
        $app->error(function (\Exception $e, $code) {
            $action = 'default';
            switch (substr($code, 0, 1)) {
                case 4:
                    $action = 'error404';
                    break;
                case 5:
                    $action = 'error500';
                    break;
            }
            $action .= 'Action';
            return (new Controller\ErrorController)->{$action}($e);
        });
    }

    static public function getHelper()
    {
        if (!isset(self::$helper)) {
            self::$helper = new CoreHelper();
        }
        return self::$helper;
    }

    static public function getDefaultStorage()
    {

    }

    static public function getStorage($name)
    {
        
    }
}