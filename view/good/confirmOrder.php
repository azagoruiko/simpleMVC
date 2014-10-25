<html>
    <body>
      <h4><?php echo $this->view->loggedIn;?>, your order No <?php echo $this->view->io;?>
     will be delivered on <?php echo $this->view->date;?>  at <?php echo $this->view->address;?></h4>
      <ul>
      <?php 
            $sum = 0;
            foreach ($this->view->orders as $id=> $order) {
                echo //"<li> hi </li>";
                "<li> $order[1],  amount:  $order[2], sum: '$'$order[3]  </li>";
                $sum+=$order[3];                   
            }
            ?>  
          <b>Total amount: <?php echo '$' . $sum; ?></b>
      </ul>
    </body>
</html>

