<html>
    <head>
        <title>List of goods of category <?php echo $this->view->category;?></title>
    </head>
    <body>
        <ul>
            <?php 
            foreach ($this->view->goods as $good) {
                echo "<li>{$good->getName()}</li>";
            }
            ?>
        </ul>
    </body>
</html>

