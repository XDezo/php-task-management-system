<?php
require './../connection/database.php';
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container d-flex justify-content-center" style="height: 100vh; align-items: center">
    <form action="#" method="post" style="width: 500px">
        <h3 class="text-center my-3">Login to continue...</h3>
        <?php
        if (isset($_POST['login']) && isset($_POST['email']) && isset($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($email && $password) {
                $check_email_existence_query = "SELECT * FROM users WHERE email=?";
                $stmt = $conn->prepare($check_email_existence_query);
                $stmt->bind_param('s', $email);
                $stmt->execute();
                $result = $stmt->get_result();
                $user = $result->fetch_assoc();
                if ($user) {
                    if(password_verify($password,$user['password']))
                    {
                        $_SESSION['user']['email'] = $email;
                        $_SESSION['user']['id'] = $user['id'];
                        $_SESSION['user']['name'] = $user['name'];
                        echo '<div class="alert alert-success alert-dismissible fade show" role = "alert" >
                	            <strong> Logged in successfully, You will be redirected to your dashboard in few seconds!</strong>
                              </div >';
                        header('Refresh:2;url=./../admin');
                        exit;
                    }else{
                        echo '<div class="alert alert-danger alert-dismissible fade show" role = "alert" >
                	        <strong> Email or password don\'t match!</strong>
                          </div >';
                    }
                } else {
                    echo '<div class="alert alert-danger alert-dismissible fade show" role = "alert" >
                	        <strong> Email or password don\'t match!</strong>
                          </div >';
                }
            } else {
                echo '<div class="alert alert-danger alert-dismissible fade show" role = "alert" >
                	    <strong> All fields are required!</strong>
                      </div >';
            }
        }
        ?>
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email <b>*</b></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email...">
        </div>
        <div class="form-group mb-3">
            <label for="password" class="form-label">Password <b>*</b></label>
            <input type="password" class="form-control" id="password" name="password"
                   placeholder="Enter your password...">
        </div>
        <button type="submit" class="btn btn-primary" name="login">Login</button>
        <div class="my-3 text-center">
            <strong>Don't have an account? </strong><a href="register.php">Register</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>