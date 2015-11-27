<?php

namespace Alex\Controller;

use Alex\Core;

class UserController extends BaseController
{
    public function indexAction($args = [])
    {
        return "UserController";
    }
    
    public function addAction($args = [])
    {
        var_dump(Core::getConfig('database'));
    }
    
    public function editAction($args = [])
    {
        
    }
    
    public function deleteAction($args = [])
    {
        
    }
}
