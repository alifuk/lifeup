<!doctype html>
<head>
    <meta charset="utf-8">
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

    <script>

        function logout() {
            setCookie("LifeUpCookie", "0", "-1");
            window.location.replace("main.php");
        }

        $(document).ready(function () {
            if (window.location.toString().indexOf("wall") !== -1) {
                $("#wallNav").attr("class", "active");
            } else {
                $("#myFilesNav").attr("class", "active");
            }
        });




    </script>

</head>

<body>
    <?php
    include 'components/colorbar.php';
    ?>



    <nav class="navbar navbar-default center-block" style="top: 3px;">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="main.php">Life Up!</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li id="myFilesNav"><a href="main.php"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> My Files</a></li>
                    <li id="wallNav"><a href="main.php?page=wall"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Wall</a></li>                        
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#" onclick="logout()"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log out</a></li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>






    <div class="container" style="max-width:1800px; padding: 20px;">
        <?php
        if (!isset($_COOKIE["LifeUpCookie"]) || $_COOKIE["LifeUpCookie"] == null) {
            header("Location: index.php");
            die();
        }
        //echo $_COOKIE["LifeUpCookie"];
        if (isset($_GET['page']) && $_GET['page'] === "wall") {
            include "AJAX/allFiles.php";
        } else {
            include "AJAX/myFiles.php";
        }
        ?>
    </div>







</body>





