<?php
class PageController extends Controller{
    
    function defaultAction(){
        $tmplt = new Template('default');
        $page = new Page();
        $page->findBy('id', $this->entityID);
        $tmplt->view('static-page', $page);
    }
}