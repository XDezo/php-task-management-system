<?php
require_once __DIR__ . '/../../middleware/authenticated.php';
require './../../connection/database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>XDezo Academy </title>
    <?php include './../layouts/header.php' ?>
</head>

<body class="with-welcome-text">
<div class="container-scroller">
    <?php include './../layouts/navbar.php' ?>
    <div class="container-fluid page-body-wrapper">
        <?php include './../layouts/sidebar.php' ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="card">
                    <div class="card-header">
                        <strong>Add Task</strong>
                        <a href="./" class="btn btn-sm btn-primary float-end">Manage Tasks</a>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_POST['save']) && isset($_POST['title']) && isset($_POST['description']) && isset($_POST['time'])) {
                            $title = $_POST['title'];
                            $description = $_POST['description'];
                            $time = $_POST['time'];

                            if ($title && $description && $time) {
                                $insert_query = "INSERT INTO tasks(title,description,time,user_id) VALUES(?,?,?,?)";
                                $stmt = $conn->prepare($insert_query);
                                $stmt->bind_param('sssi', $title, $description, $time, $_SESSION['user']['id']);
                                if ($stmt->execute()) {
                                    $stmt->close();
                                    $conn->close();
                                    echo '<div class="alert alert-success alert-dismissible fade show" role = "alert" >
                                            <strong> Task added successfully!</strong>
                                          </div >';
                                    ?>
                                    <script>
                                        window.location.href = './index.php';
                                    </script>
                                    <?php
                                } else {
                                    $stmt->close();
                                    $conn->close();
                                    echo '<div class="alert alert-danger alert-dismissible fade show" role = "alert" >
                                            <strong> Task insertion failed . Please try again!</strong>
                                          </div >';
                                }
                            } else {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role = "alert" >
                                            <strong> All fields are required!</strong>
                                          </div >';
                            }
                        }
                        ?>
                        <form action="#" method="post">
                            <div class="form-group mb-3">
                                <label for="title" class="form-label">Title <b>*</b></label>
                                <input type="text" class="form-control" id="title" name="title">
                            </div>
                            <div class="form-group mb-3">
                                <label for="time" class="form-label">Time <b>*</b></label>
                                <input type="datetime-local" class="form-control" id="time" name="time">
                            </div>
                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description <b>*</b></label>
                                <textarea class="form-control h-100" id="description" name="description"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" name="save">Save Task</button>
                        </form>
                    </div>
                </div>
            </div>
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">XDezo Academy</span>
                    <span class="float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Made for educational purpose.</span>
                </div>
            </footer>
        </div>
    </div>
</div>
<?php include './../layouts/footer.php' ?>
</body>

</html>