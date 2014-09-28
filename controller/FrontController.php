<?php
namespace controller;

use PDO;
use util\MySQL;
use util\Request;
use util\View;
use view\Layout;

class FrontController {
    private $view;
    function start() {
        MySQL::$db = new PDO('mysql:host=localhost;dbname=simplemvc', 'simplemvc', 'mypassword');
        
        $this->view = new View();
        session_start();
        $r = new Request();
        $ctrlName = $r->getGetValue('ctrl');
        if (empty($ctrlName)) {
            $ctrlName = 'good';
        }
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
        if (empty($action)) {
            $action = 'index';
        }
        $view = $ctrl->{"{$action}Action"}();
        $layOut = new Layout();
        $layOut->setCtrlName($ctrlName);
        $layOut->setView($this->view);
        $layOut->render($view);
        //include "view/$ctrlName/$view.php";
    }
}
