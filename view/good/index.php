<h1>Welcome to the shop!</h1>
<ul>
    <li><a href="index.php?ctrl=good&act=categories">Browse categories</a></li>
        <?php if(!isset($_SESSION['loggedIn'])){ ?>
    <li><a href="index.php?ctrl=user&act=logIn"> Login</a> </li>  
        <?php }else if(isset($_SESSION['loggedIn'])) { ?>
    <li><a href="index.php?ctrl=user&act=exit">Exit</a></li>                 
        <?php } ?>
    <li><a href="index.php?ctrl=user&act=users">Browse users</a></li>
</ul>

