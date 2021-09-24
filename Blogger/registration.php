<?php include "includes/header.php"; ?>

<?php include_once 'includes/db_guys/db_users.php' ?>

<?php
$accountAdded = false;

if (isset($_POST['userName']))
    $accountAdded = AddUser();

?>
<!-- Navigation -->

<?php include "includes/nav.php"; ?>


<!-- Page Content -->
<div class="container">

    <div class="row">
        <div class="col-xs-10">
            <div class="form-wrap">
                <h1>Register</h1>
                <form action="" method="POST" enctype="multipart/form-data" id="frmCreateUser">
                    <div class="form-group form-row p-5">
                        <label for="profilePic" class="col-sm-3 col-form-label">Username</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="userName" id="userName">
                            <div id="usernamefeedback" class="form-inline"></div>
                            <p class="error hidden" id="errUsrnm">Please enter a valid username</p>
                        </div>
                    </div>
                    <div class="form-group form-row p-5">
                        <label for="profilePic" class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="password" id="password">
                            <p class="error hidden" id="errPswrd">Please enter a valid password</p>
                        </div>
                    </div>
                    <div class="form-group form-row p-5">
                        <label for="profilePic" class="col-sm-3 col-form-label">Confirm password</label>
                        <div class="col-sm-9">
                            <input type="password" class="form-control" name="confPassword" id="confPassword">
                            <p class="error hidden" id="errCnfPswrd">Please enter a matching password</p>
                        </div>
                    </div>
                    <div class="form-group form-row p-5">
                        <label for="profilePic" class="col-sm-3 col-form-label">Firstname</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="firstName" id="firstName">
                            <p class="error hidden" id="errFrstNm">Please enter a valid firstname</p>
                        </div>
                    </div>
                    <div class="form-group form-row p-5">
                        <label for="profilePic" class="col-sm-3 col-form-label">Lastname</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="lastName" id="lastName"">
                            <p class="error hidden" id="errLstNm">Please enter a valid lastname</p>
                        </div>
                    </div>
                    <div class="form-group form-row p-5">
                        <label for="profilePic" class="col-sm-3 col-form-label">Email address</label>
                        <div class="col-sm-9">
                            <input type="email" class="form-control" name="email" id="email">
                            <div id="emailfeedback" class="form-inline"></div>
                            <p class="error hidden" id="errEml">Please enter a valid email address</p>
                        </div>
                    </div>
                    <div class="form-group form-row p-5">
                        <label for="profilePic" class="col-sm-3 col-form-label">Profile picture</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" name="profilePic">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class=" row text-center m-5">
                            <div class="col-sx-10">
                                <Button id="btnCreateUser" class="btn btn-primary btn-lg btn-block mt-5">Register</Button>
                                <p id="lblResult" class="success <?php echo $accountAdded ? '' : 'hidden' ?>">Account created<a href="login.php"> login here.</a></p>
                            </div>
                        </div>
                    </div>
                    <?php include "includes/footer.php";

                    function AddUser()
                    {
                        $imgPath = '/media/' . $_FILES['profilePic']['name'];
                        move_uploaded_file($_FILES['profilePic']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imgPath);
                        InsertUser(
                            $_POST['userName'],
                            $_POST['firstName'],
                            $_POST['lastName'],
                            $_POST['email'],
                            $_POST['password'],
                            $imgPath,
                            'regular'
                        );
                        return true;
                    }
                    ?>
                    <script src="admin/js/create_user.js"></script>