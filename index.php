<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        
        <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
        
        <script src="lib/cookie.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
        
        <link rel="stylesheet" href="style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <h1 class="text-center" style="  font-size: 65px;">Life UP!</h1>
        <?php
        
        
        if(isset($_COOKIE["LifeUpCookie"]) && $_COOKIE["LifeUpCookie"] != null){
            header("Location: main.php");
            die();
        }
        
        require_once 'connect.php';

        echo "<br>";

        include "/Forms/registerF.php";
        include "/Forms/loginF.php";



        
        ?>
    </body>
</html>

