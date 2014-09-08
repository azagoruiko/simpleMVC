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
    function find($name) {
        $filename = "/var/www/data/users/$name";
        if (file_exists($filename)) {
            return unserialize(file_get_contents("/var/www/data/users/$name"));
        }
        return null;
    }
    
    function authorize($name, $password) {
        $user = $this->find($name);
        if (!empty($user)) {
            return $user->getPassword() === $password;
        }
        return false;
    }
}
