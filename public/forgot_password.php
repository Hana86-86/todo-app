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
    <h2>パスワード再設定</h2>
    <form method="GET" action="reset_password.php">
        <label>登録済みのメールアドレスを入力してください:</label><br>
        <input type="email" name="email" required><br>
        <input type="submit" value="再設定ページへ">
    </form>
</body>
</html>