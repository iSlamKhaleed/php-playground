<?php
include_once 'db.php';

function GetUsers()
{
    global $mysql;
    return mysqli_fetch_all(mysqli_query($mysql, 'SELECT * FROM users
    ORDER BY user_id DESC;'), MYSQLI_ASSOC);
}

function DeleteUser($userID)
{
    global $mysql;

    $stmt = mysqli_prepare($mysql, 'DELETE FROM users WHERE user_id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $userID);
    mysqli_stmt_execute($stmt);
}

function InsertUser($username, $firstname, $lastname, $email, $password, $profilepic, $role)
{
    global $mysql;

    $stmt = mysqli_prepare($mysql, 'INSERT INTO users 
        (username, user_password, user_firstname, user_lastname, user_email, user_image, user_role) 
        VALUES (?, ?, ?, ?, ?, ?, ?)');
    mysqli_stmt_bind_param($stmt, 'sssssss', $username, $password, $firstname, $lastname, $email, $profilepic, $role);
    mysqli_stmt_execute($stmt);
}

function AlterUserRole($userID, $newRole)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'UPDATE users SET user_role = ? WHERE user_id = ?');
    mysqli_stmt_bind_param($stmt, 'si', $newRole, $userID);
    mysqli_stmt_execute($stmt);
}

function GetUser($username, $password)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'SELECT * FROM users WHERE username = ? AND user_password = ?');
    mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
    mysqli_stmt_execute($stmt);
    $res = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    if (count($res) < 1)
        return false;
    else
        return $res[0];
}

function updateLastSeen($userID)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'UPDATE users SET last_seen = ? WHERE user_id = ?');
    $date = date('Y/m/d H:i:s');
    mysqli_stmt_bind_param($stmt, 'si', $date, $userID);
    mysqli_stmt_execute($stmt);
}

function UsernameExists($username)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'SELECT * FROM users WHERE username = ?');
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    return mysqli_stmt_num_rows($stmt) > 0;
}

function EmailExists($email)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'SELECT * FROM users WHERE user_email = ?');
    mysqli_stmt_bind_param($stmt, 's', $email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_store_result($stmt);
    return mysqli_stmt_num_rows($stmt) > 0;
}

function GetUserData(int $userId)
{
    global $mysql;
    $stmt = mysqli_prepare($mysql, 'SELECT username, user_firstname, user_lastname, user_email, last_seen, user_role
        FROM users WHERE user_id = ?');
    mysqli_stmt_bind_param($stmt, 'i', $userId);
    mysqli_stmt_execute($stmt);
    $res = mysqli_fetch_all(mysqli_stmt_get_result($stmt), MYSQLI_ASSOC);
    return count($res) > 0 ? $res[0] : false;
}
