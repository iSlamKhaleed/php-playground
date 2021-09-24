<?php
class IndexController
{
    public IndexModel $model;

    public function __construct(IndexModel $model)
    {
        $this->model = $model;
    }

    public function insertOrUpdateEntry()
    {
        $id = $_POST['id'];
        $details = $_POST['details'];
        //do some validation here;
        if ($id == -1)
            $this->model->insert($details);
        else
            $this->model->update($id, $details);
    }

    public function delete()
    {
        $id = $_GET['delete'];
        //do some validation
        $this->model->delete($id);
    }
}
