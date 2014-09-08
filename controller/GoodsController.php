<?php
namespace controller;

use model\service\GoodService;

class GoodsController extends BaseController {
    private $goodService;
    
    /**
     * 
     * @return GoodService
     */
    
    private function getGoodService() {
        if (empty($this->goodService)) {
            $this->goodService = new GoodService();
        }
        return $this->goodService;
    }
    
    function listAction() {
        $this->view->category = $this->getRequest()->getGetValue('cat');
        $this->view->goods = $this->getGoodService()->getList($this->view->category);
        return 'list';
    }
    
    function categoriesAction() {
        $this->view->cats = $this->getGoodService()->getCategoruiesList();
        return 'categories';
    }
}
