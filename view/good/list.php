
<div class="row">
    <div class="col-md-4">

        <ul id="basket" class="list-group">
            <h4 class="list-group-item-heading list-group-item-active">My Basket:</h4>
            <?php
            $sum = 0;
            if (!is_array($this->view->basket) || count($this->view->basket) == 0) {
                echo "<li>Empty basket</li>";
            } else {

                foreach ($this->view->basket as $id => $good) {
                    echo "<li class=\"list-group-item\""
                    . " data-sum=\"{$good['sum']}\">{$good['good']->getName()}, "
                    . "price: \${$good['good']->getPrice()}, amount: {$good['amount']}, sum: {$good['sum']} <a><div data-basket-item-id=\"{$good['good']->getId()}\" class=\"glyphicon glyphicon-remove\"></div></a></li>";
                    $sum += $good['sum'];
                }
            }
            ?>
        </ul>
        <div><b>Total amount: <span id="sum"><?php echo '$' . $sum; ?></span></b></div>
        <div class="row">
            <a class="btn btn-danger" href="index.php?ctrl=good&act=clearBasket&cat=<?php echo $this->view->category; ?>">Clear the basket</a>  
            <a class="btn btn-success" href="index.php?ctrl=good&act=confirmOrder">To confirm the order</a>
        </div>
    </div>
        <div class="col-md-8">
            <ul class="list-group">
                <?php
                foreach ($this->view->goods as $good) {
                    echo "<li class=\"list-group-item\">{$good->getName()}, \${$good->getPrice()} "
                    . "&nbsp; <a class=\"btn btn-info\" href=\"index.php?ctrl=good&act=buy&id={$good->getID()}\">Buy</a>"
                    . "&nbsp; <a class=\"btn btn-danger\" href=\"index.php?ctrl=good&act=del&id={$good->getID()}\">Remove from basket</a>";
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] === 'Yes') {
                        echo "&nbsp; <a class=\"btn btn-warning\" href=\"index.php?ctrl=good&act=edit&id={$good->getID()}\">edit</a>";
                    }
                    echo "</li>";
                }
                ?>
            </ul>

            <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin'] === 'Yes') {
                echo '<a class="btn btn-success" href="index.php?ctrl=good&act=edit">add new</a>';
            }
//         else { echo "= ".$_SESSION['admin'];}
            ?>
        </div>
    </div>

