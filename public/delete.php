<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'], $_POST['todo_id'])) {
    $todo_id = (int)$_POST['todo_id'];

    // ToDoの削除
    $stmt = $pdo->prepare('DELETE FROM todos WHERE todo_id = ? AND user_id = ?');
    $stmt->execute([$todo_id, $_SESSION['user_id']]);
}
header('Location: dashboard.php');
exit;
?>