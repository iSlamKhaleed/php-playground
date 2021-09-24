<?php
    include_once '../includes/db_guys/db_users.php';

    if (isset($_GET['usernamecheck'])){
        echo UsernameExists($_GET['usernamecheck']);
    }

    if (isset($_GET['emailcheck'])){
        echo EmailExists($_GET['emailcheck']);
    }