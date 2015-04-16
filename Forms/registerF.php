<html>
    <head>
        <script>
            function check(str, page) {
                if (str.length == 0) {
                    return false;
                } else {
                    var xmlhttp = new XMLHttpRequest();
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            //alert(xmlhttp.responseText);
                            if (xmlhttp.responseText.trim() === "0") {
                                $("#" + page + "Field").tooltip('hide');
                                $("#" + page + "Group").attr("class", "form-group has-success");
                            } else {
                                $("#" + page + "Group").attr("class", "form-group has-error");
                                $("#" + page + "Field").attr('data-original-title', 'Nick is already taken, please, pick another one')
                                        .tooltip('fixTitle');
                                $("#" + page + "Field").tooltip('show');

                            }

                        }
                    }
                    xmlhttp.open("POST", 'AJAX/' + page + 'Check.php', true);
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send(page + "=" + str);
                }
            }
            
            function checkMail(){
                if (document.getElementById("emailField").value.toString().indexOf("@") === -1) {
                    $("#emailGroup").attr("class", "form-group has-error");
                    $("#emailField").attr('data-original-title', 'invalid email adress')
                                        .tooltip('fixTitle');
                                $("#emailField").tooltip('show');

                } else{
                    $("#emailGroup").attr("class", "form-group has-success");
                    $("#emailField").tooltip('hide');
                }
            }

            function registruj() {


                if (document.getElementById("emailField").value.toString().indexOf("@") === -1) {
                    $("#emailGroup").attr("class", "form-group has-error");
                    $("#emailField").attr('data-original-title', 'invalid email adress')
                                        .tooltip('fixTitle');
                                $("#emailField").tooltip('show');

                } else if (strlen(document.getElementById("emailField").value.toString()) < 1){
                    
                } 
                
        
        
        else {

                    //alert(document.getElementById("NickField").value + document.getElementById("EmailField").value);
                    var xmlhttp = new XMLHttpRequest();

                    xmlhttp.open("POST", 'AJAX/register.php', true);
                    xmlhttp.onreadystatechange = function () {
                        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                            //alert(xmlhttp.responseText);
                            setCookie("LifeUpCookie", xmlhttp.responseText, "100");
                            window.location.replace("main.php");

                        }
                    }
                    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xmlhttp.send("nick=" + document.getElementById("nickField").value + "&email=" + document.getElementById("emailField").value +
                            "&password=" + document.getElementById("passwordField").value);

                }
            }





            $(document).ready(function () {
                $('#nickField').tooltip({
                    trigger: 'manual'
                });
                //$("#nickField").tooltip('show');
            });

        </script>
    </head>
    <body>
        <div class="jumbotron">
            <div class="container" style="max-width:500px;">
                <h1>Sign Up</h1>
                <hr>
                <form onSubmit="return false;" class="form-horizontal register">

                    <div class="form-group" Id="nickGroup">
                        <label for="NickField" class="col-md-3 control-label">Nick:</label>

                        <div class="col-sm-7">
                            <input type="text" class="form-control" placeholder="Enter name like Indiana Evans" onkeyup="check(this.value, 'nick');" Id="nickField" autofocus
                                   data-toggle="tooltip" data-placement="right" data-original-title="Enter name like Indiana Evans">

                        </div> 
                    </div>

                    <div class="form-group" Id="emailGroup">
                        <label for="EmailField" class="col-sm-3 control-label">Email:</label>
                        <div class="col-sm-7 ">
                            <input type="email" class="form-control" placeholder="Enter email" onkeyup="check(this.value, 'email');checkMail();" Id="emailField">
                        </div> 
                    </div>

                    <div class="form-group" Id="passwordGroup">
                        <label for="PasswordField" class="col-sm-3 control-label">Password:</label>
                        <div class="col-sm-7 ">
                            <input type="password"  class="form-control" placeholder="Enter your secret password" Id="passwordField">                           
                        </div>
                    </div>  

                    <button class="btn btn-primary btn-lg btn-block center-block" onclick="registruj()"> Register</button>
                </form>

            </div>



        </div>

    </body>
</html>