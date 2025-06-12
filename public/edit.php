<?php
session_start();
require_once 'db.php';

// セッションが開始されていない場合はログインページへリダイレクト
if (!isset($_SESSION['user_id'],$_GET['todo_id'])) {
    // セッションがない、またはToDo IDが指定されていない場合はログインページへリダイレクト
    header('Location: login.php');
    exit;
}

$todo_id = (int)$_GET['todo_id'];
// セッションのユーザーIDとToDo IDが一致するか確認

// ToDoの情報を取得
$stmt = $pdo->prepare('SELECT * FROM todos WHERE todo_id = ? AND user_id = ?');
$stmt->execute([$_GET['todo_id'], $_SESSION['user_id']]);
$todo = $stmt->fetch();

if (!$todo) {
    // ToDoが見つからない場合はエラーページへ
    exit('ToDoが見つかりません。');
}
?>

    <h2>ToDoの編集</h2>
    <form action="update.php" method="POST">
        <input type="hidden" name="todo_id" value="<?= $todo['todo_id'] ?>">
        <label>
            タイトル: <input type="text" name="title" value="<?= htmlspecialchars($todo['title']) ?>" required>
        </label><br>
        <label>
            説明: <textarea name="description" ><?= htmlspecialchars($todo['description']) ?></textarea>
        </label><br>
        <label>
            期限: <input type="date" name="due_date" value="<?= htmlspecialchars($todo['due_date']) ?>" required>
        </label><br>
        <input type="submit" value="更新">
    </form>
    <a href="dashboard.php">戻る</a>
</body>
</html>
