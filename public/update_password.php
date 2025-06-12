<?php
require_once 'db.php';

$email = $_POST['email'] ?? '';
$new_password = $_POST['password'] ?? '';

if ($email && $new_password) {
    $stmt = $pdo->prepare('UPDATE users SET password = ? WHERE email = ?');
    $stmt->execute([password_hash($new_password, PASSWORD_DEFAULT), $email]);
    echo "パスワードを更新しました。<a href='login.php'>ログインへ</a>";
} else {
    echo "情報が正しくありません。";
}
?>