<?php

namespace view;

class Layout {
    private $layoutName='default';
    private $viewName;
    private $view;
    private $ctrlName;

    public function setDisableLayout($disableLayout) {
        $this->disableLayout = $disableLayout;
    }
    
    public function getViewName() {
        return $this->viewName;
    }

    public function getCtrlName() {
        return $this->ctrlName;
    }

    public function setViewName($viewName) {
        $this->viewName = $viewName;
    }

    public function setCtrlName($ctrlName) {
        $this->ctrlName = $ctrlName;
    }    
    private $disableLayout = 0;
    
    public function getDisableLayout() {
        return $this->disableLayout;
    }
    
    public function getView() {
        return $this->view;
    }

    public function setView($view) {
        $this->view = $view;
    }

        public function getLayoutName() {
        return $this->layoutName;
    }

    public function setLayoutName($layoutName) {
        $this->layoutName = $layoutName;
    }

    public function render($viewName){
        if ($this->disableLayout) {
            $fileName = "view/$viewName.php";
            if (file_exists($fileName)){
                require $fileName;
            } else {
                echo $viewName;
            }
        } else {
            $fileName = "layout/{$this->layoutName}.php";
            if (!file_exists($fileName)){
                throw new \RuntimeException('Нэту такого файла!');
                //echo $fileName;
            } else {
                $this->viewName = $viewName;
                require $fileName;
            }
        }
    }
    public function view() {
        $fileName = "view/{$this->ctrlName}/{$this->viewName}.php";
        require $fileName;
    }
}
