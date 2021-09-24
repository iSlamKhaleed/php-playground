<?php
echo 'hi from outside the server';

if (isset($_GET['submit']))
    echo 'submitted';

if (isset($_POST['name'])){
    foreach ($_POST as $v => $s){
        echo $v . ' ==> ' . $s;
    }
}