<?php
require 'Config/Config.php';
require_once 'Controller/Router.php';
session_start();
$_SESSION['mod'] =$mod;
$routeur = new Router();

    if ($mod == 'dev'){
        $routeur->routerRequestdev();
    }
    elseif($mod == 'prod') {
        $routeur->routerRequestcostumer();
    }
    else{

    }

/*
** fichier permettant de passer du mode développemnt à la prod

require_once 'Config/Config.php';

/**
** on appelle tout les controlleurs

require 'Controller/ControllerHome.php';
require 'Controller/ControllerAbout.php';
require 'Controller/ControllerAdmin.phpuire 'Controller/ControllerAddProduct.php';
require 'Controller/ControllerProduct.php';

/*
** on regarde dans le fichier Config quel mode doit être lancé
** évite de faire un connection avec mp


class Routeur {

    private function choosePath($mod){

        if ($mod == 'dev'){
            session_start();
            $_SESSION['mod'] = 'dev';
        }
        else{
            if (isset($_SESSION))
            {
                session_destroy();
            }
        }

    }

    private $ctrHome;
    private $ctrAbout;
    private $ctrEditProduct;
    private $ctrProduct;
    private $ctrAddProduct;

    public function __construct() {
        $this->ctrHome = new ControllerHome();
        $this->ctrAbout = new ControllerAbout();
        $this->ctrEditProduct = new ControllerAdmin();
        $this->ctrProduct = new ControllerProduct();
        $this->ctrAddProduct = new ControllerAddProduct();
    }

    public function routerRequest() {
    try {
        if (isset($_GET['action'])) {
            var_dump('test');
            if ($_GET['action'] == 'product') {
                if (!empty($_GET['id'])) {
                    $idarticle= intval($this->getParameter($_GET,'id'));
                    if ($idarticle != 0){
                        $this->ctrProduct->article($idarticle);
                    }
                    else
                        throw new Exception("Identifiant de l'article non valide");
                }
                else
                    throw new Exception("Identifiant de l'article non défini");
            }
            elseif ($_GET['action']=='about'){
                $this->ctrAbout->about();
            }
            elseif ($_GET['action'] == 'order') {
                $this->ctrHome->homeOrder($_POST['order']);
            }
            elseif ($_GET['action']=='editProduct') {
                $this->ctrEditProduct->edit();
            }
            elseif ($_POST['action'] == 'filter') {

            }
            elseif ($_POST['action'] == 'addarticle') {

            }
            elseif ($_POST['action'] == 'editarticle') {

            }
            else{

                throw new Exception("Action non valide");
            }
        }
        else{
            var_dump('hello');
           home();
        }

        }
        catch (Exception $e) {
            $msgError = $e->getMessage();
            require 'View/viewError.phtml';
        }
    }
     // Recherche un paramètre dans un tableau
    private function getParameter($array, $name) {
        if (isset($array[$name])) {
            return $array[$name];
        }
        else
            throw new Exception("Paramètre '$name' absent");
    }
}*/

