<html>
    <head>
        <title>Please enter the date and address of order</title>
    </head>
    <body>
        <h4> Please enter the date and address of order </h4>        
        <form method="post" action="?ctrl=good&act=confirmOrder">
            <label for="name">Date:</label>
            <input type="text" name="date" id="date" />
            <label for="address">Address</label>
            <input type="text" name="address" id="address" />
            <input type="submit" />
        </form>
    </body>
</html>
