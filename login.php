<?php
    session_start(); 
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <title>Login Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="login-style.css">
</head>


<body> 
    <div class="container h-100">
        <div class="row h-100">
            <div class="col-sm-7 col-md-6 col-lg-4 align-self-center mx-auto">
                <div id="login-block">
                    <div class="card text-center login-card">
                        <div class="card-body">
                            <h3 class="card-title p-2">Login</h3>
                            <hr>
                            <form class="form p-2" method="GET" action="process-login.php">
                                <div class="form-group row">
                                    <label for="username" class="col-form-label col-sm-4">Username</label>
                                    <div class="col-8">
                                        <input type="text" class="form-control" id="username" placeholder="username" name="username">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
                            </form>
                        </div>

                    </div>
                    <div id="login-attempt" class="p-3 mx-auto">
                        <?php
                            if(isset($_SESSION['username']) && $_SESSION['username'] == "invalid"){
                                echo '<p id="error-message"> Please enter a valid login </p>';
                            } 
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div> 

    

</body>

</html>