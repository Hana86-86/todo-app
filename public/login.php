<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'db.php';

// DB接続設定

$error = '';

if ($_SERVER['REQUEST_METHOD']=== 'POST'){
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';

 $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
 $stmt->execute([$email]);
 $user = $stmt->fetch();

if($user && $user['password'] === $password){
  $_SESSION['user_id'] = $user['user_id'];
  header('Location: dashboard.php');
  exit;
} else {
    $error = 'メールアドレスまたはパスワードが違います。';
}
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>ログイン</title>
</head>
<body>
    <h2>ログイン</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method= "POST" action= "login.php">
        <input type= "email" name= "email" placeholder= "メールアドレス" required>
        <input type= "password" name= "password" placeholder="パスワード" required>
        <button type= "submit">ログイン</button>
    </form>    
</body>
</html>
