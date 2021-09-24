<?php
include_once 'includes/header.php';
include_once '../includes/db_guys/db_categories.php';
include_once 'includes/nav.php';

$error = '';
if (isset($_POST['add_category']))
    $error = AddCategory();

if (isset($_GET['delete']))
    DeleteCategory();

$editCat = '';
if (isset($_GET['cat_title'])) {
    $editCat = $_GET['cat_title'];
    $_SESSION['edit_id'] = $_GET['edit'];
    $_SESSION['edit_title'] = $editCat;
}

if (isset($_POST['confirm_edit']))
    EditCategory();
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
                        <i class="fa fa-file"></i> Categories
                    </li>
                </ol>
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <form action="categories.php" method="POST">
                                <div class="form-group">
                                    <label for="cat_title"><?php echo $editCat == '' ? 'Add new category' : 'Edit Category' ?></label>
                                    <input type="text" class="form-control" name="cat_title" placeholder="Category name" value="<?php echo $editCat ?>">
                                    <p class="error <?php echo $error != '' ? 'visible' : 'hidden' ?>"><?php echo $error ?></p>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="<?php echo $editCat == '' ? 'add_category' : 'confirm_edit' ?>" value="<?php echo $editCat == '' ? 'Add ategory' : 'Update category' ?>">
                                </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <th scope="col">id</th>
                                    <th scope="col">Name</th>
                                    <th scope="col"></th>
                                    <th scope="col"></th>
                                </thead>
                                <tbody>
                                    <?php DisplayCategories() ?>
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<?php include_once 'includes/footer.php' ?>
<?php
function DisplayCategories()
{
    foreach (GetCategories() as $c) {
?>
        <tr>
            <th scope="row">
                <?php echo $c['cat_id'] ?>
            </th>
            <td>
                <?php echo $c['cat_title'] ?>
            </td>
            <td>
                <a href="categories.php?edit=<?php echo $c['cat_id'] ?>&cat_title=<?php echo $c['cat_title'] ?>">Edit</a>
            </td>
            <td>
                <a href="categories.php?delete=<?php echo $c['cat_id'] ?>">Delete</a>
            </td>
        </tr>
<?php
    }
}

function AddCategory()
{
    if (empty($_POST['cat_title']) || trim($_POST['cat_title']) == '')
        return 'Please enter category name first';

    if (CategoryExists(trim($_POST['cat_title'])) > 0)
        return 'Category already exists';

    InsertCategory(trim($_POST['cat_title']));
    return '';
}

function DeleteCategory()
{
    RemoveCategory($_GET['delete']);
}

function EditCategory(){

    if ($_SESSION['edit_title'] == $_POST['cat_title'])
        return;

    if (empty($_POST['cat_title']) || trim($_POST['cat_title']) == '')
        return 'Please enter category name first';

    if (CategoryExists(trim($_POST['cat_title'])) > 0)
        return 'Category already exists';

    UpdateCategory($_SESSION['edit_id'], $_POST['cat_title']);
    unset($_SESSION['edit_id']);
    unset($_SESSION['edit_title']);
}
?>