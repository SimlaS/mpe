<?php
include_once "models/Page_Data.class.php";
include_once "Klasy/OCI.php";
//przypisanie danych do modelu
$pageData = new Page_Data();
$pageData->title = "Komentarze do zasilen";
$db = new OCI(); 

$navigationClicked = isset($_GET['option']);
if ($navigationClicked){
    $controller = $_GET['option'];
}else{
    $controller = "main";
}
$pathToController = "controllers/$controller.php";
$pageData->content .= include_once $pathToController;

$redirectToMotal = isset($_GET['modal']);
if($redirectToMotal){
    //nie aplikuj załączników
    $page = include_once "views/templates/page.php";
}else{
    $pageData->addCss("css/bootstrap.min.css");
    //$pageData->addCss("css/plugins/bootstrap-table.min.css");
    $pageData->addCss("font-awesome/css/font-awesome.min.css");
    $pageData->addCss("css/plugins/bootstrap-chosen.css");
    $pageData->addCss("css/admin.css"); 
    $pageData->addScript("js/jquery.min.js");
    $pageData->addScript("js/bootstrap.min.js");
    $pageData->addScript("js/plugins/chosen.jquery.min.js");
    //$pageData->addScript("js/plugins/bootstrap-table.min.js");
    ///$pageData->addScript("js/plugins/bootstrap-table-pl-PL.min.js");
    $pageData->addScript("js/admin.js");
    
    //generowanie strony
    $page = include_once "views/templates/page.php";
    //header('Content-Type: text/html; charset=windows-1250');
}

$db->close();
echo $page;