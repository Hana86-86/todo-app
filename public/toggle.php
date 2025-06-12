<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['todo_id'])) {
    $todo_id= (int) $_POST['todo_id'];

    $stmt = $pdo->prepare('SELECT is_done FROM todos WHERE todo_id = ?');
    $stmt->execute([$todo_id]);
    $todo = $stmt->fetch();

    if ($todo) {
        $new_status = ((int)$todo['is_done'] === 1) ? 0 : 1;
        $update = $pdo->prepare('UPDATE todos SET is_done = ? WHERE todo_id = ?');
        $update->execute([$new_status, $todo_id]);
    }
}
header('Location: dashboard.php');



exit;
?>