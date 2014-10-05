<?php
namespace controller;

use util\Request;
use view\Layout;

class BaseController {
    private $request;
    protected $view;
    
    function __construct($view) {
        $this->view = $view;
    }
    
     /**
     * 
     * @return Request
     */
    protected function getRequest() {
        if (empty($this->request)) {
            $this->request = new Request();
        }
        return $this->request;
    }
    
    /**
     *
     * @var Layout
     */
    protected $layout;
    
    public function getLayout() {
        return $this->layout;
    }

    public function setLayout(Layout $layout) {
        $this->layout = $layout;
    } 
    
    protected function redirect($where) {
        header("location: $where");
    }
}
