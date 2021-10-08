<?php
include_once 'config.php';

$username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
$display = filter_input(INPUT_POST, 'display', FILTER_SANITIZE_STRING);

if ($username) {
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    $_SESSION['display'] = $display;
    header('location:/encryption demo/register.php');
    return;
}

$username = $_SESSION['username'] ?? null;
$password = $_SESSION['password'] ?? null;
$display = $_SESSION['display'] ?? null;

if ($username && $password && $display) {
    $_SESSION = [];
    $stmt = $db->prepare('INSERT INTO user VALUES (null, ?, AES_ENCRYPT(?, ?), ?)');
    $stmt->execute([$username, $password, ENC_KEY, $display]);
    $message = 'Account created successfully';
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register for encryption demo</title>
</head>

<body>
    <h1><?= $message ?? 'Already a user? ' ?><a href="/encryption demo"> Login now</a></h1>
    <form action="" method="post">
        <input type="text" name="username" value="<?= $username ?>">
        <input type="password" name="password" value="<?= $password ?>">
        <input type="text" name="display" value="<?= $display ?>">
        <input type="submit" name="Register">
    </form>
</body>

</html>