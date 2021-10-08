<?php
class Template
{
    private $layout;

    public function __construct($layout)
    {
        $this->layout = $layout;
    }

    function view($template, $page = null)
    {
        include VIEW_PATH . 'layout/' . $this->layout . '.html';
    }
}
