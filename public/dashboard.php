<?php
session_start();
require_once 'db.php';
// セッションが開始されていない場合はログインページへリダイレクト


if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// ユーザー情報を取得
$stmt = $pdo->prepare('SELECT * FROM users WHERE user_id = ?');
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">

    <title>ダッシュボード</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1>ようこそ、<?= htmlspecialchars($user['name']) ?> さん！</h1>
    <p>Mail: <?= htmlspecialchars($user['email']) ?></p>

    <!--ユーザーのToDo一覧-->
    <h2>あなたのToDoリスト</h2>
    <ul>
    <?php
    $stmt = $pdo->prepare('SELECT * FROM todos WHERE user_id = ? ORDER BY created_at DESC');
    $stmt->execute([$_SESSION['user_id']]);
    $todos = $stmt->fetchAll();

    foreach ($todos as $todo) {
    $is_done = (int) $todo['is_done'];
    echo '<li class="todo-item">';
    echo '<div class="todo-content">';
    echo '<strong>' . htmlspecialchars($todo['title']) . '</strong><br>';
    echo '期限: ' . htmlspecialchars($todo['due_date']) . '<br>';
    echo '説明: ' . htmlspecialchars($todo['description']) . '<br>';
    echo '</div>';

    echo '<div class="todo-buttons">';
    echo '<form action="toggle.php" method="POST">';
    echo '<input type="hidden" name="todo_id" value="' . $todo['todo_id'] . '">';
    echo '<input type="submit" value="' . ($is_done ? '未完了にする' : '完了にする') . '">';
    echo '</form>';

    echo '<form action="edit.php" method="GET">';
    echo '<input type="hidden" name="todo_id" value="' . $todo['todo_id'] . '">';
    echo '<input type="submit" value="編集">';
    echo '</form>';


    echo '<form action="delete.php" method="POST" onsubmit="return confirm(\'本当に削除しますか？\');">';
    echo '<input type="hidden" name="todo_id" value="' . $todo['todo_id'] . '">';
    echo '<input type="submit" value="削除">';
    echo '</form>';

echo '</div>';
echo '</li>';
}
?>
    </ul>
    <h2>新しいToDoを追加</h2>
    <form action="add.php"method= "POST" >
        <label >
            タイトル: <input type="text" name="title" required>
        </label><br>
        <label >
            説明: <textarea name="description" rows="3"></textarea>
        </label><br>
        <label >
            期限: <input type="date" name="due_date" required>
        </label><br>
        <input type="submit" value="追加する">
    </form>
</body>
</html>
