<html>
    <body>
        <div style="color: red;"><?php echo $this->view->message; ?></div>
        <form method="post" action="index.php?ctrl=user&act=signin">
            <input type="hidden" value="<?php echo $this->view->user->getId(); ?>" name="id" />
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo $this->view->user->getName(); ?>" />
            <label for="email">Email:</label>
            <input type="text" name="email" value="<?php echo $this->view->user->getEmail(); ?>" />
            <label for="password">Password:</label>
            <input type="text" name="password" value="<?php echo $this->view->user->getPassword(); ?>" />
            <input type="submit" />
        </form>
    </body>
</html>
