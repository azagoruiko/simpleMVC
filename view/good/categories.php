<ul>
    <?php
    foreach ($this->view->cats as $cat) {
        echo "<li><a href=\"?ctrl=good&act=list&cat=$cat\">$cat</a></li>";
    }
    ?>
</ul>