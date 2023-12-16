<?php
require './../connection/database.php'; ?>
<!doctype html>
<html lang="en">
<head>
    <title>Register</title>
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
        <h3 class="text-center my-3">Register yourself...</h3>
        <?php
        if (isset($_POST['register']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($name && $email && $password && $confirm_password) {
                if($password === $confirm_password) {
                    $check_email_existence_query = "SELECT * FROM users WHERE email=?";
                    $stmt = $conn->prepare($check_email_existence_query);
                    $stmt->bind_param('s', $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $user = $result->fetch_assoc();
                    if (!$user) {
                        $password = password_hash($password, PASSWORD_BCRYPT);
                        $insert_query = "INSERT INTO users(name,email,password) VALUES(?,?,?)";
                        $stmt = $conn->prepare($insert_query);
                        $stmt->bind_param('sss', $name, $email, $password);
                        if ($stmt->execute()) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role = "alert" >
                	            <strong> Registered successfully, You will be redirected to login in few seconds!</strong>
                              </div >';
                            header('Refresh:2;url=./');
                            exit;
                        } else {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role = "alert" >
                	            <strong> Error registering, please try again!</strong>
                              </div >';
                        }
                    } else {
                        echo '<div class="alert alert-danger alert-dismissible fade show" role = "alert" >
                	        <strong> Email already exists!</strong>
                          </div >';
                    }
                }else{
                    echo '<div class="alert alert-danger alert-dismissible fade show" role = "alert" >
                	        <strong> Password don\'t match!</strong>
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
            <label for="name" class="form-label">Name <b>*</b></label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name...">
        </div>
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email <b>*</b></label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email...">
        </div>
        <div class="form-group mb-3">
            <label for="password" class="form-label">Password <b>*</b></label>
            <input type="password" class="form-control" id="password" name="password"
                   placeholder="Enter your password...">
        </div>
        <div class="form-group mb-3">
            <label for="confirm_password" class="form-label">Confirm Password <b>*</b></label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password"
                   placeholder="Re enter your password...">
        </div>
        <button type="submit" class="btn btn-primary" name="register">Register</button>
        <div class="my-3 text-center">
            <strong>Already registered? </strong><a href="index.php">Login</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>