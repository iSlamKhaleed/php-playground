<?php
session_start();
$firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
$lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);

if ($firstname || $lastname) {
    $_SESSION['firstname'] = $_POST['firstname'];
    $_SESSION['lastname'] = $_POST['lastname'];
    header('location:AvoidingResubmissionAndUsingFlashMessgaes.php');
    return;
}

$firstname = $_SESSION['firstname'] ?? null;
$lastname = $_SESSION['lastname'] ?? null;

unset($_SESSION['firstname']);
unset($_SESSION['lastname']);
?>
<pre><br><br><br><br><br></pre>
<h1> Hi <?= $firstname . ' ' . $lastname ?></h1>

<form action="" method="post">
    <input type="text" name="firstname" value="<?= $firstname ?>">
    <br>
    <input type="text" name="lastname" value="<?= $lastname ?>">
    <br>
    <input type="submit" value="Okay">
</form>