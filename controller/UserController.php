<?php
namespace controller;
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
                $this->redirect('welcome');
            } else {
                $this->view->message = 'Login incorrect';
                return 'login';
            }
        } else {
            return 'login';
        }
    }
}
