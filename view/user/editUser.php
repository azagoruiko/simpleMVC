<html>
    <body>
        <div style="color: red;"><?php echo $this->view->message; ?></div>
        <?php 
        if($_SESSION['admin']){ 
            ?>
        <form method="post" action="index.php?ctrl=user&act=editUser">
            <input type="hidden" value="<?php echo $this->view->user->getId(); ?>" name="id" />
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $this->view->user->getName(); ?>" />
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $this->view->user->getEmail(); ?>" />
            <label for="password">Password:</label>
            <input type="text" name="password" value="<?php echo $this->view->user->getPassword(); ?>" />
            <label for="isAdmin">Is admin:</label>
            <input type="checkbox" name="isAdmin" value="1" <?php if($this->view->user->getIsAdmin()) { echo 'checked=""'; }?> />
            <input type="submit" />
        </form>
        <?php } ?>
    </body>
</html>
