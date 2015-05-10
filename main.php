<?php
if (!isset($_COOKIE["LifeUpCookie"]) || $_COOKIE["LifeUpCookie"] == null) {
    header("Location: index.php");
    die();
}
?>



<!doctype html>
<head>
    <meta charset="UTF-8">
    <link href="favicon.ico" rel="icon" type="image/png" />
    <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>

    <script src="lib/cookie.js"></script>
    <script src="lib/sendNewFile.js"></script>
    <script src="lib/objekt.js"></script>
    <script src="lib/bootstrap-tagsinput.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>




    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/bootstrap-tagsinput.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script>

        function logout() {
            setCookie("LifeUpCookie", "0", "-1");
            window.location.replace("main.php");
        }
        
        function view(type){
            setCookie("view", type, "100");
            window.location.replace("main.php");
        }

        $(document).ready(function () {
            if (window.location.toString().indexOf("user=all") !== -1) {
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
                    <?php
                    $query_arr = $_GET;
                    $query_arr["user"] = $_COOKIE["LifeUpCookie"];
                    $query = http_build_query($query_arr);
                    ?>
                    <li id="myFilesNav"><a href='main.php?<?php echo $query ?>'><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> My Files</a></li>
                    <?php
                    $query_arr = $_GET;
                    $query_arr["user"] = "all";
                    $query = http_build_query($query_arr);
                    ?>
                    <li id="wallNav"><a href='main.php?<?php echo $query ?>'><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> Wall</a></li> 




                </ul>
                <p class="navbar-text">Signed in as <b><?php include "./AJAX/returnName.php" ?></b></p>



                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">View<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#" onclick="view('Line');">Lines</a></li>
                            <li><a href="#" onclick="view('Tile');">Tiles</a></li>
                        </ul>
                    </li>



                    <li><a href="#" onclick="$('#addItem').toggle(300)"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add link</a></li>
                    <li><a href="#" onclick="logout()"><span class="glyphicon glyphicon-off" aria-hidden="true"></span> Log out</a></li>
                </ul>

            </div><!--/.nav-collapse -->
        </div>
    </nav>






    <div class="container-fluid" style="//max-width:1800px; padding: 20px;">

        <div class="row" id="addItem" style="display: none;">

            <div class="col-md-3">

            </div>

            <div class="col-md-6">
                <div class="well ">
                    <form class="form-inline" action="" style="text-align: center;">
                        <div class="form-group">
                            <label for="link">Link</label>
                            <input type="text" class="form-control" id="link" placeholder="Insert link here">
                        </div>

                        <div class="form-group">
                            <label for="tags">Tags</label>
                            <input type="text" class="form-control" id="tags" placeholder="Insert tags" data-role="tagsinput">
                        </div>
                        <button type="submit" class="btn btn-default" onclick="addFile();" >Add link <span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button>
                    </form>
                </div>

            </div>


        </div>


        <div class="row">

            <div class="col-md-2">





            </div>


            <div class="col-md-1" style="background-color: #FFF ; padding: 18px; border-radius: 5px;">


                <?php
                $query_arr = $_GET;
                $query_arr["filterTag"] = "";
                $query = http_build_query($query_arr);
                ?>
                <a href='main.php?<?php echo $query ?>' style="margin: 0 0 10px 0; display: block;"><button type="button" class="btn btn-default btn-sm btn-block">All</button></a>
                <?php include "./AJAX/folders.php"; ?>
                <?php
                $query_arr = $_GET;
                $query_arr["filterTag"] = "tagless";
                $query = http_build_query($query_arr);
                ?>
                <a href='main.php?<?php echo $query ?>' style="margin: 0 0 10px 0; display: block;"><button type="button" class="btn btn-default btn-sm btn-block   ">Untagged</button></a>



            </div>



            <div class="col-md-6">


                <?php
                //echo $_COOKIE["LifeUpCookie"];
                if (isset($_GET['page']) && $_GET['page'] === "wall") {
                    include "AJAX/allFiles.php";
                } else {
                    include "AJAX/myFiles.php";
                }
                ?>


            </div>

        </div>






    </div>



    <div id="debug">

    </div>




</body>





