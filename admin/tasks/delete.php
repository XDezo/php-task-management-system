<?php
require_once __DIR__ . '/../../middleware/authenticated.php';
require './../../connection/database.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user']['id'];
    if ($id && is_numeric($id)) {
        $get_task_query = "DELETE FROM tasks WHERE id=? AND user_id=?";
        $stmt = $conn->prepare($get_task_query);
        $stmt->bind_param('ii', $id,$user_id);
        if ($stmt->execute()) {
            $stmt->close();
            $conn->close();
            header('Location:./');
        } else {
            $stmt->close();
            $conn->close();
            header('Location:./');
        }
    } else {
        header('Location:./');
    }
} else {
    header('Location:./');
}
?>