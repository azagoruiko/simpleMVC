<ul style="display: none" id="basketMock">
    <li class="list-group-item" data-sum="0"><a><div data-basket-item-id="0" class="glyphicon glyphicon-remove"></div></a></li>
</ul>
<div class="row">
    <div class="col-md-4">

        <ul id="basket" class="list-group">
            <h4 class="list-group-item-heading list-group-item-active">My Basket:</h4>
            
        </ul>
        <div><b>Total amount: <span id="sum"><?php echo '$' . $sum; ?></span></b></div>
        <div class="row">
            <a class="btn btn-danger" href="index.php?ctrl=good&act=clearBasket&cat=<?php echo $this->view->category; ?>">Clear the basket</a>  
            <a class="btn btn-success" href="index.php?ctrl=good&act=confirmOrder">To confirm the order</a>
        </div>
    </div>
        <div class="col-md-8">
            <ul id="goodList" class="list-group">
                <?php
                foreach ($this->view->goods as $good) {
                    echo "<li data-goodid=\"{$good->getID()}\" class=\"list-group-item\">{$good->getName()}, \${$good->getPrice()} "
                    . "&nbsp; <a name=\"buy\" class=\"btn btn-info\" href=\"index.php?ctrl=good&act=buy&id={$good->getID()}\">Buy</a>"
                    . "&nbsp; <a class=\"btn btn-danger\" href=\"index.php?ctrl=good&act=del&id={$good->getID()}\">Remove from basket</a>";
                    if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                        echo "&nbsp; <a class=\"btn btn-warning\" href=\"index.php?ctrl=good&act=edit&id={$good->getID()}\">edit</a>";
                    }
                    echo "</li>";
                }
                ?>
            </ul>

            <?php
            if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                echo '<a class="btn btn-success" href="index.php?ctrl=good&act=edit">add new</a>';
            }
//         else { echo "= ".$_SESSION['admin'];}
            ?>
        </div>
    </div>
<script src="js/main.js"></script>
