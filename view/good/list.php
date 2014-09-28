<html>
    <head>
        <title>List of goods of category <?php echo $this->view->category;?></title>
    </head>
    <body>
        <h4>My Basket:</h4>
        <ul>
            <?php
            $sum = 0;
            if (count($this->view->basket) == 0) {
                echo "<li>Empty basket</li>";
            } else {
                foreach ($this->view->basket as $id => $good) {
                    echo "<li>{$good['good']->getName()}, price: \${$good['good']->getPrice()}, amount: {$good['amount']}, sum: {$good['sum']} </li>";
                    $sum += $good['sum'];
                }
            }
            ?>
        </ul>
        <div><b>Total amount: <?php echo '$' . $sum; ?></b>&nbsp;<a href="index.php?ctrl=good&act=clearBasket&cat=<?php echo $this->view->category; ?>">Clear the basket</a></div>
        
        <ul>
            <?php 
            foreach ($this->view->goods as $good) {
                echo "<li>{$good->getName()}, \${$good->getPrice()} "
                . "(<a href=\"index.php?ctrl=good&act=edit&id={$good->getID()}\">edit</a>)"
                . "&nbsp; <a href=\"index.php?ctrl=good&act=buy&id={$good->getID()}\">Buy</a>"
                . "</li>";
            }
            ?>
        </ul>
        <a href="index.php?ctrl=good&act=edit">add new</a>
      
    </body>
</html>

