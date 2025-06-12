<?php
session_start();
require_once 'db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //バリデーション（未入力チェック）
    if (!$name || !$email || !$password) {
        $error = 'すべての項目を入力してください。';
    } else {
        //メールアドレスの重複チェック
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $error = 'このメールアドレスは既に登録されています。';
        } else {
            //ユーザーの登録
            $stmt = $pdo->prepare('INSERT INTO users (name, email, password) VALUES (?, ?, ?)');
            $stmt->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
            $success = '登録が完了しました。ログインしてください。';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <title>ユーザー登録</title>
</head>
<body>
    <h1>ユーザー登録</h1>

    <?php if ($error): ?>
        <p style="color:red;"><?php echo htmlspecialchars($error); ?></p>
        <P>既にアカウントをお持ちの方は<a href="login.php">ログインページへ</a></P>
        <?php endif; ?>
    
        <form method="POST">
            <label>名前: <input type="text" name="name" required></label><br>
            <label>メールアドレス: <input type="email" name="email" required></label><br>
            <label>パスワード: <input type="password" name="password" required></label><br>
            <input type="submit" value="登録">
        </form>
        </body>
        </html>