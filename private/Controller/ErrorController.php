<?php

namespace Alex\Controller;

class ErrorController extends BaseController
{    
    public function error404Action()
    {
        return "Error 404";
    }
    
    public function error500Action()
    {
        return "Error 500";
    }

    public function defeultAction()
    {
        return "Some errros occured";
    }
}
