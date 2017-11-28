<?php
require_once 'Controller/Router.php';
session_start();

$routeur = new Router();

    if ($_SESSION['mod'] == 'dev'){
        $routeur->routerRequestdev();
    }
    else {
        $routeur->routerRequestcostumer();
    }


