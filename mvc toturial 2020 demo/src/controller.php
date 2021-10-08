<?php
class Controller
{
    protected int $entityID;

    function runAction($action)
    {

        if (method_exists($this, 'runBeforeAction') && !$this->runBeforeAction())
            return;

        $action = !$action || empty($action) ? 'defaultAction' : $action . 'Action';
        if (method_exists($this, $action))
            $this->$action();
        else
            include VIEW_PATH . 'status-pages/404.html';
    }

    public function setEntityID(int $id)
    {
        $this->entityID = $id;
    }
}
