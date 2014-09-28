<html>
    <head>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" />
    </head>
    <body>
        
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                
                <ul class="nav navbar-nav">
                    <li><a href="index.php?ctrl=good&act=categories">Browse categories</a></li>
                    <li><a href="index.php?ctrl=user&act=logIn"> Login</a> </li>
                    <li><a href="index.php?ctrl=user&act=users">Browse users</a></li>
                </ul>
            </div>
        </nav>
        <div class="container">
            <div class="jumbotron">
                <h1>The Shop!</h1>
                <?php $this->view() ?>
            </div>
            <div>&copy; Computer Academy STEP 2014</div>
        </div>
        
    </body>
</html>

