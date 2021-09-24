<?php
include_once '../includes/db_guys/db_comments.php';

if (isset($_POST['delete'])){
    DeleteComment($_POST['delete']);
    echo true;
}