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

if($user && password_verify($password, $user['password'])) {
  // パスワードが一致した場合、セッションにユーザーIDを保存
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
    <link rel="stylesheet" href="style.css">

</head>
<body>
    <h1 class="title">ToDo</h1>
    <div class="login-box">
    <h2>login</h2>
    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>
    <form method= "POST" action= "login.php">
        <input type= "email" name= "email" placeholder= "メールアドレス" required>
        <input type= "password" name= "password" placeholder="パスワード" required>
        <button type= "submit">login</button>
    </form>
    <p>ユーザー登録は <a href="register.php">こちら</a> から</p>
    <p><a href="forgot_password.php">パスワードをお忘れの方はこちら</a></p>

    </div>
</body>
</html>
