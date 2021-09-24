<?php
include_once 'db_guys/db_categories.php';
?>
<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="index.php" method="GET">
            <div class="input-group">
                <input name="search" type="text" class="form-control" value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
    </div>
    <div class="well">
        <div class="container-responsive">
            <div class="row">
                <h4 class="m-5"><?php echo isset($_SESSION['user_firstname']) ? 'Welcome ' . $_SESSION['user_firstname'] . ' ' . $_SESSION['user_lastname'] : 'Log in' ?></h4>
                <?php if (!isset($_SESSION['username'])) { ?>
                    <form action="login.php" method="POST" id="frmLgn">
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
            <div class="row text-center">
                <?php if (isset($_SESSION['username'])) { ?>
                    <a href="newpost.php"><button class="btn btn-primary m-5">New post</button></a>
                    <a href="?logout=1"><button class="btn btn-primary m-5">Logout</button></a>
                <?php } else { ?>
                    <a href="registration.php"><button class="btn btn-primary float-rt m-5">Register new user</button></a>
                    <button class="btn btn-primary float-rt m-5" onclick="login();">Login</button>
                <?php } ?>
            </div>
        </div>
        <!-- /.input-group -->
    </div>
    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <ul class="list-unstyled">
                <?php SideBarCategories() ?>
            </ul>
        </div>
    </div>

    <!-- Side Widget Well -->
    <div class="well">
        <h4>Side Widget Well</h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    </div>

</div>


</div>

<?php
function SideBarCategories()
{
    foreach (GetCategories() as $c) {
        echo '<li class="col-lg-6"><a href="category.php?id=' . $c['cat_id'] . '">' . $c['cat_title'] . '</a></li>';
    }
}
?>

<script src="js/sidebar.js" type="text/javascript"></script>