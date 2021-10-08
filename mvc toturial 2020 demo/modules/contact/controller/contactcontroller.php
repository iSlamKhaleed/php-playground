<?php
session_start();

class ContactController extends Controller
{

    function runBeforeAction()
    {
        $tmplt = new Template('default');
        if (isset($_SESSION['submitted'])) {
            $page = new Page();
            $page->findBy('id', $this->entityID);
            $tmplt->view('static-page', $page);
            return false;
        }
        return true;
    }

    function defaultAction()
    {
        $tmplt = new Template('default');
        $page = new Page();
        $page->findBy('id', $this->entityID);
        $tmplt->view('contact', $page);
    }

    function submitAction()
    {
        //manage the entered message
        $tmplt = new Template('default');
        $_SESSION['submitted'] = true;
        $page = new Page();
        $page->findBy('id', $this->entityID);
        $tmplt->view('static-page', $page);
    }
}
