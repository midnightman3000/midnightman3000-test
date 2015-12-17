<?php

namespace Alex\Controller;

class ErrorController extends BaseController
{    
    public function error404Action($e)
    {
        return "Error 404";
    }
    
    public function error500Action($e)
    {
        return "Error 500 - " . $e->getMessage();
    }

    public function defeultAction($e)
    {
        return "Some errros occured";
    }
}
