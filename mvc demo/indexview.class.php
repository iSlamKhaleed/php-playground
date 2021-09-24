<?php
class IndexView
{
    public IndexModel $model;
    public $editDetails;
    public $edit;

    public function __construct(IndexModel $model)
    {
        $this->model = $model;
        $this->editDetails = '';
        $this->edit = false;
    }

    public function viewAllEntries()
    {
        foreach ($this->model->getAllEntries() as $e) {
?>
            <tr>
                <td><?php echo $e['id'] ?></td>
                <td><?php echo $e['details'] ?></td>
                <td><a href="?edit=<?php echo $e['id'] ?>">Edit</a></td>
                <td><a href="?delete=<?php echo $e['id'] ?>">Delete</a></td>
            </tr>
        <?php
        }
    }

    public function viewEdit()
    {
        $this->edit = true;
        $this->editDetails = $this->model->getEntry($_GET['edit'])['details'];
    }

    public function getForm()
    {
        ?>
        <form action="index.php" method="POST">
            <input type="hidden" name="id" value="<?php echo isset($_GET['edit']) ? $_GET['edit'] : -1 ?>">
            <input type="text" name="details" value="<?php echo $this->editDetails ?>">
            <input type="submit" name="submit">
        </form>
<?php
    }
}
