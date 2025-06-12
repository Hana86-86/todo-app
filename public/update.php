<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'], $_POST['todo_id'])) {
    $todo_id = (int)$_POST['todo_id'];
    $title = $_POST['title'] ?? '';
    $description = $_POST['description'] ?? '';
    $due_date = $_POST['due_date'] ?? '';

    // ToDoの更新
    $stmt = $pdo->prepare(
        'UPDATE todos SET title = ?, description = ?, due_date = ? WHERE todo_id = ? AND user_id = ?'
    );
    $stmt->execute([$title, $description, $due_date, $todo_id, $_SESSION['user_id']]);
}
header('Location: dashboard.php');
exit;
?>