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
    
    private function getBasket() {
        return $this->getRequest()->getSessionValue('basket');
    }
    
    private function setBasket($basket) {
        ksort($basket);
        $this->getRequest()->setSessionValue('basket', $basket);
    }
    
    private function getGoodService() {
        if (empty($this->goodService)) {
            $this->goodService = new GoodService();
        }
        return $this->goodService;
    }
    
    function listAction() {
        $this->view->basket = $this->getRequest()->getSessionValue('basket');
        //$this->getRequest()->setSessionValue('basket', []);
        //print_r ($this->view->basket); die;
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
        if(!$_SESSION['admin']){
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
    
    function basketJsonAction() {
        header('Content-Type: text/json');
        echo json_encode($this->getBasket());
        exit();
    }
    
    function buyAction() {
        $r = $this->getRequest();
        $basket = $r->getSessionValue('basket');
        if (empty($basket)) {
            $basket = [];
        }
        
        $good = $this->getGoodService()->find($r->getPostValue('id'));
        if (!$good) {
            http_response_code(404);
            echo "0";
            exit();
        }
        if (isset($basket[$good->getID()])) {
            $basket[$good->getID()]['amount']++;
            $basket[$good->getID()]['sum'] += $good->getPrice();
        } else {
            $basket[$good->getID()] = ['amount' => 1, 'good' => $good, 'sum' => $good->getPrice()];
        }
        ksort($basket);
        $this->setBasket($basket);
        header('Content-Type: text/json');
        echo json_encode($basket);
        exit();
    }
    
    private function delBasketItem(&$basket, $id) {
        unset($basket[$id]);
    }
    
    function delBasketItemAction() {
        $this->getLayout()->setDisableLayout(true);
        $basket = $this->getBasket();
        $id = $this->getRequest()->getPostValue('id');
        $this->delBasketItem($basket, $id);
        $this->setBasket($basket);
        return "1";
    }
    
    function delAction() {
        $r = $this->getRequest();
        $basket = $this->getBasket();
        
        $good = $this->getGoodService()->find($r->getGetValue('id'));
        if (isset($basket[$good->getID()])) {
            if ($basket[$good->getID()]['amount']==1){
                $this->delBasketItem($basket, $good->getId());
            }
            else{
                $basket[$good->getID()]['amount']--;
                $basket[$good->getID()]['sum'] -= $good->getPrice();
            }
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
    function  insertDataOrderAction(){   
   return 'insertDataOrder'; 
   }
    function  confirmOrderAction(){   
   $request = $this->getRequest();    
   $basket = $request->getSessionValue('basket');   
   $this->view->idUser=$request->getSessionValue('idUser');
   $this->view->loggedIn=$request->getSessionValue('loggedIn');
   $this->view->io=$this->getGoodService()->getIdOder();
   $this->getGoodService()->addOrder($basket,$this->view->io);
   $this->getGoodService()->addOrderInfo($this->view->io,$request->getSessionValue('idUser'),$request->getPostValue('date'),$request->getPostValue('address'));
   $this->view->date=$request->getPostValue('date');
   $this->view->address=$request->getPostValue('address');
   $this->view->orders= $this->getGoodService()->getListOfOrder($this->view->io);
   $request->setSessionValue('basket', []);
  // $request->setSessionValue('idOrder', $this->getGoodService()->getIdOder());
   
   return 'confirmOrder';  
 
   }
    
}

  
