<?php
namespace model\service;

use model\entity\User;

class UserService {
    function add(User $user) {
        file_put_contents("/var/www/data/users/{$user->getName()}", serialize($user));
    }
    
    /**
     * @param string $name
     * @return User
     */
    function findByName($name) {
        $stmt = \util\MySQL::$db->prepare("SELECT id, name, password, email, isAdmin "
                . " FROM users WHERE name = :log_in");        
        $stmt->bindParam('log_in', $name);        
        $stmt->execute();
        return $stmt->fetchObject('model\entity\User');         
    }
    
    function authorize($name, $password) {
        $user = $this->findByName($name);
        $_SESSION['admin'] = $user->getIsAdmin();//
        if (!empty($user)) {
            return $user->getPassword() === $password;
        }
        return false;
    }
        
    function getUserList() {//
        $users = [];//
        $stmt = \util\MySQL::$db->prepare("SELECT id, name, email, password, isAdmin FROM users");//
        
        $stmt->execute();//
        
        while ($item = $stmt->fetchObject('model\entity\User')) {//
            $users[] = $item;//
        }//
        
        return $users;//
    }//
    
    function find($id) {//
        $stmt = \util\MySQL::$db->prepare("SELECT id, name, email, password, isAdmin FROM users WHERE id=:id");//
        $stmt->bindParam('id', $id);//
        $stmt->execute();//
        return $stmt->fetchObject('model\entity\User');//
    }
    
    function addUser(User $user) {//
        if (empty($user->getId())) {//
            $stmt = \util\MySQL::$db->prepare("INSERT INTO users (name, email, password, isAdmin) VALUES (:name, :email, :password, :isAdmin)");//
        } else {//
            $stmt = \util\MySQL::$db->prepare("UPDATE users SET name=:name, email=:email, password=:password, isAdmin=:isAdmin where id=:id");//
            $stmt->bindParam('id', $user->getId());//
        }//
            
        $stmt->bindParam('name', $user->getName());//
        $stmt->bindParam('email', $user->getEmail());//
        $stmt->bindParam('password', $user->getPassword());//
        $stmt->bindParam('isAdmin', $user->getIsAdmin());
        
        return $stmt->execute();//
    }
    
    function deleteUser($id) {//
            $stmt = \util\MySQL::$db->prepare("DELETE FROM users where id=:id");//
            $stmt->bindParam('id', $id);//
            $stmt->execute();//
            return $stmt->fetchObject('model\entity\User');//
    }
}
