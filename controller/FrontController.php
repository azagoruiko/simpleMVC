<?php
namespace controller;

use util\Request;
use util\View;

class FrontController {
    private $view;
    function start() {
        $this->view = new View();
        session_start();
        $r = new Request();
        $ctrlName = $r->getGetValue('ctrl');
        switch ($ctrlName) {
            case 'user':
                $ctrl = new UserController($this->view);
                break;
            case 'good':
                $ctrl = new GoodsController($this->view);
                break;
            default:
                http_response_code(404);
        }
        $action = $r->getGetValue('act');
        $view = $ctrl->{"{$action}Action"}();
        include "view/$ctrlName/$view.php";
    }
}
