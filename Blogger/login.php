<?php
include_once 'includes/header.php';
include_once 'includes/nav.php';
include_once 'includes/db_guys/db_users.php';

if(isset($_SESSION['username']))
    header('location:./');
if (isset($_POST['username']))
    Login();
?>
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <h1 class="m-5"><?php echo isset($_SESSION['user_firstname']) ? 'Welcome ' . $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'] : 'Log in' ?></h1>
            <?php if (!isset($_SESSION['username'])) { ?>
                <form action="" method="POST" id="frmLgn">
                    <div class="form-group m-5">
                        <p class="error <?php echo isset($_GET['loginfailed']) ? '' : 'hidden' ?>" id="errEml">Wrong username or password</p>
                    </div>
                    <div class="form-group m-5">
                        <input name="username" id="username" type="text" class="form-control" placeholder="Enter your username" onblur="usernameBlur()">
                        <p class="error hidden" id="errUsrNm">This field is required</p>
                    </div>
                    <div class="form-group m-5">
                        <div class="input-group">
                            <input name="password" id="password" type="password" class="form-control" placeholder="Enter your password" onblur="passwordBlur()">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="button" id="btnShoPswrd" onclick="togglePassword()">👁</button>
                            </span>
                        </div>
                        <p class="error hidden" id="errPswrd">This field is required</p>
                    </div>
                </form>
            <?php } ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <div class="row text-center">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php if (isset($_SESSION['username'])) { ?>
                <a href="newpost.php"><button class="btn btn-primary m-5">New post</button></a>
                <a href="?logout=1"><button class="btn btn-primary m-5">Logout</button></a>
            <?php } else { ?>
                <button class="btn btn-primary btn-lg btn-block" onclick="login();">Login</button>
                <h4>Don't have an acccount?<a href="registration.php"> Create an account</a></h4>
            <?php } ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
    <?php
    include_once 'includes/footer.php';
    ?>
</div>
<?php
function Login()
{
    $user = GetUser($_POST['username'], $_POST['password']);
    if (!$user)
        header('location: ?loginfailed=true');
    else {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['user_email'] = $user['user_email'];
        $_SESSION['user_firstname'] = $user['user_firstname'];
        $_SESSION['user_lastname'] = $user['user_lastname'];
        $_SESSION['user_role'] = $user['user_role'];
        updateLastSeen($user['user_id']);
        header('location: ../admin/');
    }
}
?>
<script src="js/sidebar.js" type="text/javascript"></script>