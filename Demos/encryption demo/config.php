<?php
session_start();
define('ENC_KEY',file_get_contents('C:\Users\iSlaa\Documents\Visual Studio 2019\Work Space\Php Playground\Demo\'sPrivateData\enkey.dat'));
$db = new PDO('mysql:host=localhost;dbname=encryption_demo','root','root');