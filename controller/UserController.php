<?php
namespace controller;
use model\entity\User;
use model\service\UserService;
use util\Request;
class UserController extends BaseController {
    private $userService;
    
    /**
     * 
     * @return UserService
     */
    private function getUserService() {
        if (empty($this->userService)) {
            $this->userService = new UserService();
        }
        return $this->userService;
    }
    

    
    function logInAction() {
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($this->getUserService()->authorize(
                    $request->getPostValue('name'),
                    $request->getPostValue('password'))) {
                $this->getRequest()->setSessionValue('loggedIn', $request->getPostValue('name'));
                $this->redirect('index.php?ctrl=good&act=categories');
            } else {
                $this->view->message = 'Login incorrect';
                return 'login';
            }
        } else {
            return 'login'; // Hello!
        }
    }
    
    function usersAction() {//
        $this->view->users = $this->getUserService()->getUserList();
        return 'users';//
    }//
    
    function exitAction() {//
        session_unset();
        return 'exit';//
    }//
    
    function editUserAction() {//
        $r = $this->getRequest();//
        if(isset($_SESSION['admin']) && !$_SESSION['admin']){
            $this->view->message = 'Access denied!';
        }
        if (!empty($r->getGetValue('id'))) {//
            $user = $this->getUserService()->find($r->getGetValue('id'));//
        } else {//
            $user = new User();//
        }//
        
        if (!$user) {//
            $this->view->message = 'User not found! Will create a new one!';
            $user = new User();//
        }//
        
        if ($r->isPost()) {//
            $user->setId($r->getPostValue('id'));
            $user->setName($r->getPostValue('name'));
            $user->setEmail($r->getPostValue('email'));
            $user->setPassword($r->getPostValue('password'));
            $user->setIsAdmin($r->getPostValue('isAdmin'));
            if (!$this->getUserService()->addUser($user)) {//
                $error = \util\MySQL::$db->errorInfo();//
                print_r($error);//
                $this->view->message = 'Error! ' . $error[2];//
            }//
            else {
                $this->view->message = "Is Fain!";
        }
        }//
        
        $this->view->user = $user;//
        $this->view->users = $this->getUserService()->getUserList();//
        return 'editUser';//
    }
    
    function signinAction() {//
        $r = $this->getRequest();//
            $user = new User();//       
        if (!$user) {//
            $this->view->message = 'User not found! Will create a new one!';
            $user = new User();//
        }//
        
        if ($r->isPost()) {//
            $user->setId($r->getPostValue('id'));
            $user->setName($r->getPostValue('name'));
            $user->setEmail($r->getPostValue('email'));
            $user->setPassword($r->getPostValue('password'));
            $user->setIsAdmin('0');
            if (!$this->getUserService()->addUser($user)) {//
                $error = \util\MySQL::$db->errorInfo();//
                print_r($error);//
                $this->view->message = 'Error! ' . $error[2];//
            }//
            else {
                $this->view->message = "Is Fain!";
        }
        }//
        
        $this->view->user = $user;//
        $this->view->users = $this->getUserService()->getUserList();//
        return 'signin';//
    }
    
     function deleteAction() {//
        $r = $this->getRequest();//
        if(isset($_SESSION['admin']) && !$_SESSION['admin']){
            $this->view->message = 'Access denied!';
        }
        if (!empty($r->getGetValue('id'))) {//
            $user = $this->getUserService()->deleteUser($r->getGetValue('id'));//
        }
        
        if (!$user) {//
            $this->view->message = 'User not found! Will create a new one!';
            //$user = new User();//
        }//      
        $this->view->user = $user;//
        $this->view->users = $this->getUserService()->getUserList();//
        return 'users';//
    }
}
