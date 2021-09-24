<?php include_once 'includes/header.php' ?>
<!-- Navigation -->
<?php include_once 'includes/nav.php' ?>
<?php include_once '../includes/db_guys/db_users.php' ?>

<?php
if (isset($_GET['delete']))
    DeleteUser($_GET['delete']);
if (isset($_POST['change_user_role']))
    ChangeUserRole();

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
        <div class="row">
            <table class="table table-striped table-hover">
                <thead>
                    <th scope="col">id</th>
                    <th scope="col">Username</th>
                    <th scope="col">Firstname</th>
                    <th scope="col">Lastname</th>
                    <th scope="col">Email</th>
                    <th scope="col">Image</th>
                    <th scope="col">Date added</th>
                    <th scope="col">Last seen</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </thead>
                <tbody>
                    <?php DisplayUsers() ?>
                </tbody>
            </table>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->
<?php include_once 'includes/footer.php';

function DisplayUsers()
{
    foreach (GetUsers() as $u) {
?>
        <tr>
            <td scope="row"><?php echo $u['user_id'] ?></td>
            <td><?php echo $u['username'] ?></td>
            <td><?php echo $u['user_firstname'] ?></td>
            <td><?php echo $u['user_lastname'] ?></td>
            <td><?php echo $u['user_email'] ?></td>
            <td>
                <img width="150" class="img-responsive" src="<?php echo $u['user_image'] ?>">
                <?php echo $u['user_image'] ?>
            </td>
            <td><?php echo $u['date_added'] ?></td>
            <td><?php echo $u['last_seen'] ?></td>
            <td>
                <select class="form-control" userid="<?php echo $u['user_id'] ?>" onchange="changeUserRole(this)">
                    <option value="admin" <?php echo $u['user_role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    <option value="regular" <?php echo $u['user_role'] == 'regular' ? 'selected' : '' ?>>Regular</option>
                </select>
            </td>
            <td><a class="error" href="users.php?delete=<?php echo $u['user_id'] ?>">Delete</a></td>
        </tr>
<?php
    }
}

function ChangeUserRole()
{
    AlterUserRole($_POST['change_user_role'], $_POST['role']);
}


?>
<script src="js/users.js"></script>