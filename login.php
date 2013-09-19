<?php
    session_start();

    if ($_SESSION["attendance_login"]) {
        // User not logged in, redirect to login page
        Header("Location: attendance.php");
    }
?>

<!DOCTYPE html>
    <html lang="en">
        <head>
            <title>AAIV Attendance</title>
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <!-- Bootstrap -->
            <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
            <link href="css/style.css" rel="stylesheet" media="screen">
            <script src="http://code.jquery.com/jquery.js"></script>
            <script src="js/bootstrap.min.js"></script>

            <script>
                $(document).ready(function() {
                    $("#loginButton").click(function(event){
                        event.preventDefault();
                        submitLogin();
                    });
                });
            </script>
        </head>
        
        <body>
            <div class="row vertical">
                <div class="col-lg-4 col-lg-offset-4">
                    <div class="container">
                        <form class="form-horizontal well">
                            
                            <div id="usernameFG" class="form-group verticalSpace2">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <input type="text" class="form-control" id="inputUser" placeholder="username..">
                                </div>
                            </div>

                            <div id="passwordFG" class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <input type="password" class="form-control" id="inputPassword" placeholder="password..">
                                </div>
                            </div>

                            <div id="selectEventFG" class="form-group">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <select class="form-control">
                                        <option>select event..</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group verticalSpace3">
                                <div class="col-lg-10 col-lg-offset-1">
                                    <button id="loginButton" type="submit" class="btn btn-primary btn-block">Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div> 

        </body>
    </html>