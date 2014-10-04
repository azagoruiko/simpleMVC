
<div class="row">
    <div class="col-md-4">
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
        <div><b>Total amount: <?php echo '$' . $sum; ?></b>&nbsp;<a class="btn btn-danger" href="index.php?ctrl=good&act=clearBasket&cat=<?php echo $this->view->category; ?>">Clear the basket</a></div>
        </div>
    <div class="col-md-8">
        <ul class="list-group">
            <?php 
            foreach ($this->view->goods as $good) {
                echo "<li class=\"list-group-item\">{$good->getName()}, \${$good->getPrice()} "
                . "&nbsp; <a class=\"btn btn-info\" href=\"index.php?ctrl=good&act=buy&id={$good->getID()}\">Buy</a>";
                if (isset($_SESSION['admin'])&& $_SESSION['admin']==='Yes'){
                    echo "&nbsp; <a class=\"btn btn-warning\" href=\"index.php?ctrl=good&act=edit&id={$good->getID()}\">edit</a>";
                }
                echo "</li>";
            }
            ?>
        </ul>
        
        <?php 
        if(isset($_SESSION['admin'])&& $_SESSION['admin']==='Yes'){
        echo '<a class="btn btn-success" href="index.php?ctrl=good&act=edit">add new</a>';
         } 
//         else { echo "= ".$_SESSION['admin'];}
                ?>
        </div>
</div>

