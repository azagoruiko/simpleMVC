<?php
namespace controller;

use model\entity\Good;
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
        $this->view->basket = $this->getRequest()->getSessionValue('basket');
        $this->view->category = $this->getRequest()->getGetValue('cat');
        $this->view->goods = $this->getGoodService()->getList($this->view->category);
        return 'list';
    }
    
    function categoriesAction() {
        $this->view->cats = $this->getGoodService()->getCategoruiesList();
        return 'categories';
    }
    
    function editAction() {
        $r = $this->getRequest();
        if($_SESSION['admin']!=='Yes'){
            $this->view->message = 'Access denied!';
        }
        if (!empty($r->getGetValue('id'))) {
            $good = $this->getGoodService()->find($r->getGetValue('id'));
        } else {
            $good = new Good();
        }
        
        if (!$good) {
            $good = new Good();
        }
        
        if ($r->isPost()) {
            $good->setId($r->getPostValue('id'));
            $good->setName($r->getPostValue('name'));
            $good->setCategory_id($r->getPostValue('cat'));
            $good->setPrice($r->getPostValue('price'));
            $good->setDescription($r->getPostValue('desc'));
            if (!$this->getGoodService()->add($good)) {
                $error = \util\MySQL::$db->errorInfo();
                print_r($error);
                $this->view->message = 'Error! ' . $error[2];
            }
            else { $this->view->message = "Is Fain!";
            }
        }
        
        $this->view->good = $good;
        $this->view->cats = $this->getGoodService()->getCategoruiesList();
        return 'edit';
    }
    
    function buyAction() {
        $r = $this->getRequest();
        $basket = $r->getSessionValue('basket');
        if (empty($basket)) {
            $basket = [];
        }
        
        $good = $this->getGoodService()->find($r->getGetValue('id'));
        if (isset($basket[$good->getID()])) {
            $basket[$good->getID()]['amount']++;
            $basket[$good->getID()]['sum'] += $good->getPrice();
        } else {
            $basket[$good->getID()] = ['amount' => 1, 'good' => $good, 'sum' => $good->getPrice()];
        }
        $r->setSessionValue('basket', $basket);
        $this->redirect("index.php?ctrl=good&act=list&cat={$good->getCategory_id()}");
    }
    
    function clearBasketAction() {
        $this->getRequest()->setSessionValue('basket', []);
        $this->redirect("index.php?ctrl=good&act=list&cat={$this->getRequest()->getGetValue('cat')}");
    }
    
    function indexAction() {
        return 'index';
    }
}
