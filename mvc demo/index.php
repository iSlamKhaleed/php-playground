<?php
include 'indexcontroller.class.php';
include 'indexmodel.class.php';
include 'indexview.class.php';

$model = new IndexModel();
$view = new IndexView($model);
$controller = new IndexController($model);

if ((isset($_POST['submit'])))
    $controller->insertOrUpdateEntry();

if (isset($_GET['delete']))
    $controller->delete();

if (isset($_GET['edit']))
    $view->viewEdit();
?>

<table>
    <thead>
        <th>ID</th>
        <th>Details</th>
        <th>Edit</th>
        <th>Delete</th>
    </thead>
    <tbody>
        <?php $view->viewAllEntries() ?>
    </tbody>
</table>
<?php $view->getForm() ?>