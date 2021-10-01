<?php

$mysql = new PDO('mysql:host=localhost;port=3306;dbname=dynv6simulator', 'root', 'root');
$mysql->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

$zone = filter_input(INPUT_GET, 'hostname', FILTER_SANITIZE_STRING);
$ipv4 = filter_input(INPUT_GET, 'ipv4', FILTER_SANITIZE_STRING);
$token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);


if (!$token)
    die('UNAUTHORIZED: No token provided');
if (!$zone)
    die('ZONE ERROR: No zone provided');
if (!$ipv4)
    die('IP ERROR: No IP provided');

$stmt = $mysql->prepare('SELECT * FROM token WHERE token = ?');
$stmt->execute([$token]);

if ($stmt->rowCount() < 1)
    die('UNAUTHORIZED: Invalid token provided');


$stmt = $mysql->prepare('SELECT * FROM zone WHERE name = ?');
$stmt->execute([$zone]);

if ($stmt->rowCount() < 1)
    die('ZONE ERROR: Invalid zone provided');

$thezone = $stmt->fetchAll()[0];

if ($thezone['ip'] == $ipv4)
    die('Zone is up to date');

$stmt = $mysql->prepare('UPDATE zone SET ip = ? WHERE name = ?');
$stmt->execute([$ipv4,$zone]);
die('Zone updated');
