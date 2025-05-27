<?php



session_start();


require_once '../config/Routes.php';
include '../app/controller/MainController.php';


$mainController = new MainController();
$mainController->actions();
