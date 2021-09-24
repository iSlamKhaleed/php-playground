<?php include_once 'includes/header.php' ?>
<?php include_once '../includes/db_guys/db_users.php' ?>
<?php include_once 'includes/nav.php' ?>

<?php
$accountAdded = false;

if (isset($_POST['userName']))
    $accountAdded = AddUser();

?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Blank Page
                    <small>Subheading</small>
                </h1>
                <ol class="breadcrumb">
                    <li>
                        <i class="fa fa-dashboard"></i> <a href="index.html">Dashboard</a>
                    </li>
                    <li class="active">
                        <i class="fa fa-file"></i> Blank Page
                    </li>
                </ol>
            </div>
        </div>
        <!-- /.row -->
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <form action="" method="POST" enctype="multipart/form-data" id="frmCreateUser">
                        <div class="form-group form-row p-5">
                            <label for="userName" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="userName" id="userName">
                                <div id="usernamefeedback" class="form-inline"></div>
                                <p class="error hidden" id="errUsrnm">Please enter a valid username</p>
                            </div>
                        </div>
                        <div class="form-group form-row p-5">
                            <label for="password" class="col-sm-2 col-form-label">Password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="password" id="password">
                                <p class="error hidden" id="errPswrd">Please enter a valid password</p>
                            </div>
                        </div>
                        <div class="form-group form-row p-5">
                            <label for="confPassword" class="col-sm-2 col-form-label">Confirm password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="confPassword" id="confPassword">
                                <p class="error hidden" id="errCnfPswrd">Please enter a matching password</p>
                            </div>
                        </div>
                        <div class="form-group form-row p-5">
                            <label for="firstName" class="col-sm-2 col-form-label">Firstname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="firstName" id="firstName">
                                <p class="error hidden" id="errFrstNm">Please enter a valid firstname</p>
                            </div>
                        </div>
                        <div class="form-group form-row p-5">
                            <label for="lastName" class="col-sm-2 col-form-label">Lastname</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="lastName" id="lastName">
                                <p class="error hidden" id="errLstNm">Please enter a valid lastname</p>
                            </div>
                        </div>
                        <div class="form-group form-row p-5">
                            <label for="email" class="col-sm-2 col-form-label">Email address</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email" id="email">
                                <div id="emailfeedback" class="form-inline"></div>
                                <p class="error hidden" id="errEml">Please enter a valid email</p>
                            </div>
                        </div>
                        <div class="form-group form-row p-5">
                            <label for="role" class="col-sm-2 col-form-label">Role</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="role">
                                    <option value="regular">Regular</option>
                                    <option value="admin">Admin</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group form-row p-5">
                            <label for="profilePic" class="col-sm-2 col-form-label">Profile picture</label>
                            <div class="col-sm-10">
                                <input type="file" class="form-control" name="profilePic"">
                            </div>
                        </div>
                    </form>
                </div>
                <div class=" col-3">
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col">
                                <Button id="btnCreateUser" class="btn btn-primary mt-5">Add user</Button>
                                <p id="lblResult" class="success <?php echo $accountAdded ? '' : 'hidden' ?>">Account has been submitted successfully</p>
                            </div>
                        </div>
                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->
        <script src="js/create_user.js"></script>

        <?php
        include_once 'includes/footer.php';

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
                $_POST['role']
            );
            return true;
        }
        ?>