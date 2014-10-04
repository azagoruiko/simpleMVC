<html>
    <body>
      <h4><?php echo $this->view->user_name;?>, your order: </h4>
      <ul>
      <?php 
            $sum = 0;
            foreach ($this->view->orders as $id=> $order) {
                echo //"<li> hi </li>";
                "<li>$order[1],  amount: $order[2],  sum: '$' $order[3] </li>";
                $sum+=$order[3];                   
            }
            ?>  
          <b>Total amount: <?php echo '$' . $sum; ?></b>
      </ul>
    </body>
</html>

