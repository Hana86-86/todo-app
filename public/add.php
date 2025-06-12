<?php
session_start();
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])) {


    $title = $_POST['title']?? '';
    $description = $_POST['description']?? '';
    $due_date = $_POST['due_date']?? '';

    $stmt = $pdo->prepare(
        'INSERT INTO todos (user_id, title, description, due_date, is_done)
         VALUES (?, ?, ?, ?, 0)'
    );
    $stmt->execute([
        $_SESSION['user_id'],
        $title,
        $description,
        $due_date
    ]);
}

header('Location: dashboard.php');
exit;