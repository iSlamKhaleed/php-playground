<?php
define('ROOT_PATH', 'C:/Users/iSlaa/Documents/Visual Studio 2019/Work Space/Php Playground/mvc toturial 2020 demo/');
define('VIEW_PATH', ROOT_PATH . 'view/');

include ROOT_PATH . 'src/controller.php';
include ROOT_PATH . 'src/template.php';
include ROOT_PATH . 'src/database.php';
include ROOT_PATH . 'src/entity.php';
include ROOT_PATH . 'src/router.php';
include ROOT_PATH . 'modules/page/model/page.php';

$section = $_GET['section'] ?? $_POST['section'] ?? 'home';
// $action = $_GET['action'] ?? $_POST['action'] ?? 'default';

// if ($section === 'about-us') {

//     include ROOT_PATH . 'controller/aboutusPage.php';
//     $aboutPg = new AboutController();
//     $aboutPg->runAction($action);
// } else if ($section === 'contact') {

//     include ROOT_PATH . 'controller/contactPage.php';
//     $cntctPg = new ContactController();
//     $cntctPg->runAction($action);
// } else {

//     include ROOT_PATH . 'controller/homePage.php';
//     $homPg = new HomePageController();
//     $homPg->runAction($action);
// }

$router = new Router();
if (!$router->findBy('pretty_url', $section)) {
    include VIEW_PATH . 'status-pages/404.html';
    return;
}

define('MODULE_PATH', ROOT_PATH . 'modules/' . $router->module . '/');

include MODULE_PATH . 'controller/' . $router->module . 'controller.php';

if ($router->module === 'page') {

    $page = new PageController();
    $page->setEntityID($router->entity_id);
    $page->runAction($router->action);
} else if ($router->module === 'contact') {

    $page = new ContactController();
    $page->setEntityID($router->entity_id);
    $page->runAction($router->action);
}
