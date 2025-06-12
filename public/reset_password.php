<?php
require_once 'db.php';

$email = $_GET['email'] ?? '';
$stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
$stmt->execute([$email]);
$user = $stmt->fetch();
if (!$user) {
    echo "このメールアドレスは登録されていません。";
    exit;
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>パスワード再設定</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
</head>
<body>
    <h1 class="title">ToDo</h1>
    <h2>新しいパスワードを設定</h2>
    <form method="POST" action="update_password.php">
        <input type="hidden" name="email" value="<?= htmlspecialchars($email) ?>">
        <label>新しいパスワード:</label><br>
        <input type="password" name="password" required><br>
        <input type="submit" value="再設定する">
    </form>
</body>
</html>