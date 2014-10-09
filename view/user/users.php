<html>
    <head>
        <title>List of users.</title>
    </head>
    <body>
        <?php 
            if(!empty($_SESSION['loggedIn'])){
                if ($_SESSION['admin']){ 
                    ?>
                    <ul>
                    <?php 
                    foreach ($this->view->users as $user) {
                        echo "<li>{$user->getName()}, {$user->getEmail()}, {$user->getPassword()}  {$user->getIsAdmin()} (<a href=\"index.php?ctrl=user&act=editUser&id={$user->getId()}\">edit</a>)&nbsp;(<a href=\"index.php?ctrl=user&act=delete&id={$user->getId()}\">delete</a>)</li>";                  
                    ?>
                    </ul> <?php } ?>
                    <a href="index.php?ctrl=user&act=editUser">add new</a> <?php }
                else { echo "You do not have access to this page!"; }
            }
            else { echo "You do not login!"; }
            ?>      
    </body>
</html>
