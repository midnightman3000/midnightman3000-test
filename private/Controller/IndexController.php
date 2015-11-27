<?php

namespace Alex\Controller;

class IndexController extends BaseController
{    
    public function indexAction($args = [])
    {
        return "IndexController";
    }
    
    public function testAction($args = [])
    {
        return "test action - IndexController";
    }
    
    public function userAction($args = [])
    {
        return "Index action user actionsß";
    }
}
