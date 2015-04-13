<html>
    <head>
        <script>
            
            function login() {

                //alert(document.getElementById("NickField").value + document.getElementById("EmailField").value);
                var xmlhttp = new XMLHttpRequest();
               
                xmlhttp.open("POST", 'AJAX/loginCheck.php', true);
                xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            //alert(xmlhttp.responseText);
                            if(xmlhttp.responseText.toString().trim() !== "W"){
                                setCookie("LifeUpCookie", xmlhttp.responseText, "100");
                                window.location.replace("main.php"); 
                            } else{
                                $("#nickGroupL").attr("class", "form-group has-error");                                
                                $("#passwordGroupL").attr("class", "form-group has-error");
                                $("#nickFieldL").attr('data-original-title', 'Wrong login credentials')
                                        .tooltip('fixTitle')
                                $("#nickFieldL").tooltip('show');
                            }                            

                        }
                    }
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xmlhttp.send("nick=" + document.getElementById("nickFieldL").value +
                        "&password=" + document.getElementById("passwordFieldL").value);                

            }

            
            $(document).ready(function () {
                $('#nickFieldL').tooltip({
                    trigger: 'manual'
                });
                //$("#nickField").tooltip('show');
            });

        </script>
    </head>
    <body>
        <div class="jumbotron">
            <div class="container" style="max-width:500px;">
                <h1>Log in </h1>
                <hr>
                <form onSubmit="return false;" class="form-horizontal register">

                    <div class="form-group" Id="nickGroupL">
                        <label for="NickFieldL" class="col-md-3 control-label">Nick or email:</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="Enter your nick or email"  Id="nickFieldL" autofocus
                                   data-toggle="tooltip" data-placement="right" data-original-title="Enter your nick or email">

                        </div> 
                    </div>

                    <div class="form-group" Id="passwordGroupL">
                        <label for="PasswordFieldL" class="col-sm-3 control-label">Password:</label>
                        <div class="col-sm-7 ">
                            <input type="password"  class="form-control" placeholder="Enter your secret password" Id="passwordFieldL">                           
                        </div>
                    </div>  

                    <button class="btn btn-primary btn-lg btn-block center-block" onclick="login()"> Log In!</button>
                </form>

            </div>



        </div>

    </body>
</html>