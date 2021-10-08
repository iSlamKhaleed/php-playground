<?php
include_once 'config.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$loggedIn = false;

if ($username) {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    header('location:/encryption demo');
    return;
}

$username = $_SESSION['username'] ?? null;
$password = $_SESSION['password'] ?? null;

if ($username && $password) {
    $_SESSION = [];
    $stmt = $db->prepare('SELECT * FROM user WHERE username = ? AND password = AES_ENCRYPT(?, ?);');
    $stmt->execute([$username, $password, ENC_KEY]);
    $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $loggedIn = count($user) > 0;
    $message = $loggedIn ? 'Welcome ' . $user[0]['displayName'] : 'Error in username or password';
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encryption Demo</title>
</head>

<body>
    <ul>
        <li><a href="/encryption demo/register.php">Register</a></li>
    </ul>
    <br>
    <h1><?= $message ?? 'Log in now: ' ?></h1>
    <?php if (!$loggedIn) : ?>
        <form action="" method="POST">
            <input type="text" name="username" value="<?= $username ?>">
            <input type="password" name="password" value="<?= $password ?>">
            <input type="submit" value="Login">
        </form>
    <?php endif ?>
</body>

</html>