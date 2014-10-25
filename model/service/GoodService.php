<?php
namespace model\service;

use model\entity\Good;

class GoodService {
    function getList($category) {
        $goods = [];     
        $stmt = \util\MySQL::$db->prepare("SELECT id, name, description, price, category_id "
                . " FROM goods WHERE category_id = :cat_id");
        
        $stmt->bindParam('cat_id', $category);        
        $stmt->execute();
        while ($item = $stmt->fetchObject('model\entity\Good')) {
            $goods[] = $item;
        }
        
        return $goods;
    }
    function getCategoruiesList() {
        $cats = [];
        $stmt = \util\MySQL::$db->prepare("SELECT id, name FROM categories");
        
        $stmt->execute();
        
        while ($item = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $cats[] = $item;
        }
        
        return $cats;
    }
    
    function find($id) {
        $stmt = \util\MySQL::$db->prepare("SELECT id, name, description, price, category_id FROM goods WHERE id=:id");
        $stmt->bindParam('id', $id);
        $stmt->execute();
        return $stmt->fetchObject('model\entity\Good');
    }
    
    function add(Good $good) {
        if (empty($good->getId())) {
            $stmt = \util\MySQL::$db->prepare("INSERT INTO goods "
                . "(name, description, price, category_id) VALUES "
                . "(:name, :description, :price, :cat_id)");
        } else {
            $stmt = \util\MySQL::$db->prepare("UPDATE goods "
                . "SET name=:name, description=:description, price=:price, category_id=:cat_id "
                . "where id=:id");
            $stmt->bindParam('id', $good->getId());
        }
        
        
        $stmt->bindParam('name', $good->getName());
        $stmt->bindParam('description', $good->getDescription());
        $stmt->bindParam('price', $good->getPrice());
        $stmt->bindParam('cat_id', $good->getCategory_id());
        
        return $stmt->execute();
    }
    function  addOrder($basket, $idOrder){
        if (count($basket)> 0) {                       
            foreach ($basket as $id => $good) {
                $stmt = \util\MySQL::$db->prepare("INSERT INTO orders "
                . "(idOrder, idGood, amount, price) VALUES "
                . "(:idOrder, :idGood, :amount, :price)");
                   
                $stmt->bindParam('idOrder',$idOrder );
                $stmt->bindParam('idGood', $good['good']->getId());
                $stmt->bindParam('amount', $good['amount']);
                $stmt->bindParam('price', $good['good']->getPrice());
                $stmt->execute();
            }           
        }                                     
        return $stmt->execute();       
    }
    
    function  addOrderInfo($idOrder,$idUser,$date, $address){
        
            $stmt = \util\MySQL::$db->prepare("INSERT INTO order_info "
                . "(idUser, idOrder, date, address) VALUES "
                . "(:idUser, :idOrder, :date, :address)");
                   
                $stmt->bindParam('idUser',$idUser );
                $stmt->bindParam('idOrder',$idOrder);
                $stmt->bindParam('date',$date );
                $stmt->bindParam('address',$address);
                $stmt->execute();
            
                                            
        return $stmt->execute();       
    }
    function getListOfOrder($idOrder){
        $orders = [];         
        $stmt = \util\MySQL::$db->prepare("SELECT idOrder, name, amount, orders.price "
                . " FROM orders INNER JOIN goods WHERE idOrder = :idOrder AND goods.id=idGood");        
        $stmt->bindParam('idOrder', $idOrder);        
        $stmt->execute();
        
        foreach($stmt as $id=>$item) {      
         $orders[] = $item;
          }
               
        return $orders;
    }   
    function getIdOder(){
       $stmt = \util\MySQL::$db->prepare("SELECT MAX(idOrder) AS idOrder FROM order_info");
       $stmt->execute();
       if(isset($stmt)){ $s =$stmt->fetchObject()->idOrder+1;
               return $s;
       }else { 
        return 1;            
       }        
    }
}
