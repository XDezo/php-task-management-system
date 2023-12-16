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
                        <strong>Manage Tasks</strong>
                        <a href="./create.php" class="btn btn-sm btn-primary float-end">Add Task</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Title</td>
                                    <td>Time</td>
                                    <td>Actions</td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $user_id = $_SESSION['user']['id'];
                                $select_query = "SELECT * FROM tasks WHERE user_id = $user_id ORDER BY id DESC";
                                $select_result = mysqli_query($conn, $select_query);
                                $tasks = $select_result->fetch_all(MYSQLI_ASSOC);
                                $conn->close();
                                $i = 1;
                                foreach ($tasks as $task) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $task['title'];?></td>
                                        <td><?php echo $task['time'];?></td>
                                        <td>
                                            <a href="./edit.php?id=<?php echo $task['id'];?>" class="btn btn-sm btn-primary">Edit</a>
                                            <a onclick="return confirm('Are you sure you want to delete this task?')" href="./delete.php?id=<?php echo $task['id'];?>"
                                               class="btn btn-sm btn-danger">Delete</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
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