<html>
    <head>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
    </head>
    <body>
        
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                
                <ul class="nav navbar-nav">
                    <li><a href="index.php?ctrl=good&act=categories">Browse categories</a></li>
                    <?php if(!isset($_SESSION['loggedIn'])){ ?>
                    <li><a href="index.php?ctrl=user&act=logIn"> Login</a> </li>  
                    <?php }else if(isset($_SESSION['loggedIn'])) { ?>
                    <li><a href="index.php?ctrl=user&act=exit">Exit</a></li>                 
                    <?php } ?>
                    <li><a href="index.php?ctrl=user&act=users">Browse users</a></li>
                    <li><a href="index.php?ctrl=user&act=signin">Signin</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="jumbotron">
                <h1 lang="en">The Shop!</h1>
                <?php $this->view() ?>
            </div>
            <div lang="en">&copy; Computer Academy STEP 2014</div>
        </div>
        
    </body>
</html>

