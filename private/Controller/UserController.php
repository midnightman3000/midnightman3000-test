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
        $user = new \Alex\Model\User();
        $user->setName("ooopps!");
        $user->changeName("new value");
        echo $user->getName();
        return 'WEHJTREWEGH';
    }
    
    public function editAction($args = [])
    {
        
    }
    
    public function deleteAction($args = [])
    {
        
    }
}
