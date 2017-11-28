<?php

/**
** on appelle tout les controlleurs
*/
require 'ControllerHome.php';
require 'ControllerAbout.php';
require 'ControllerProduct.php';
require 'ControllerAdmin.php';
//require_once 'View/View.php';

/*
** on regarde dans le fichier Config quel mode doit être lancé
** évite de faire un connection avec mp
*/

class Router {

    private $ctrHome;
    private $ctrAbout;
    private $ctrProduct;
    private $ctrAdmin;

    public function __construct() {
        $this->ctrHome = new ControllerHome();
        $this->ctrAbout = new ControllerAbout();
        $this->ctrProduct = new ControllerProduct();
        $this->ctrAdmin = new ControllerAdmin();
    }

    // Recherche un paramètre dans un tableau
    private function getParameter($array, $name) {
        if (isset($array[$name])) {
            return $array[$name];
        }
        else {
            throw new Exception("Paramètre '$name' absent");
        }
    }

    public function routerRequestcostumer() {
    try {
        if (isset($_GET['action'])) {
            if ($_GET['action'] == 'product') {
                if (!empty($_GET['id'])) {
                    $idarticleId= intval($this->getParameter($_GET,'id'));
                    if ($idarticleId != 0){
                        $this->ctrProduct->articleId($idarticleId);
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
            elseif (isset($_POST['order'])) {
                $order = $this->getParameter($_POST,'order');
                $this->ctrHome->homeOrder($order);
            }
            elseif (isset($_POST['filter'])) {
                $filter = $this->getParameter($_POST ,'filter');
                $this->ctrHome->homeFilter($filter);
            }
            elseif ($_GET['action']== 'research'){
                $term= $this->getParameter($_GET,term);
                $this->ctrHome->homeResearch($term);
            }
            elseif ($_GET['action']== 'connect'){
                $login = $this->getParameter($_POST,'login');
                $mdp = $this->getParameter($_POST,'mdp');
                $this->ctrHome->connect($login,$mdp);
            }
            else{

                throw new Exception("Action non valide");
            }     
        }
        else{
           $this->ctrHome->home();
        }

        }
        catch (Exception $e) {
            $msgError = $e->getMessage();
            require 'View/viewError.phtml';
        }
    }

    public function routerRequestdev(){
        try {
            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'addArt') {
                    //test le formulaire
                    $action = $this->getParameter($_POST,'action');
                    // recuperation des données
                    $name = $this->getParameter($_POST,'name');
                    $img1 = $_FILES['img1']['name'];
                    $img2 = $_FILES['img2']['name'];
                    $img3 = $_FILES['img1']['name'];
                    $description = $this->getParameter($_POST,'description');
                    $weight = $this->getParameter($_POST,'weight');
                    $price = $this->getParameter($_POST,'price');
                    $file1 = $_FILES['img1']['tmp_name'];
                    $file2 = $_FILES['img2']['tmp_name'];
                    $file3 = $_FILES['img3']['tmp_name'];
                    if (isset($_POST['IdCat'])){
                        $cat = $this->getParameter($_POST,'IdCat');
                    }
                    else{
                        $cat = NULL;
                    }
                    // cas du formulaire d'ajout d'un nouvel article
                    if($action == 'add'){
                        $this->ctrAdmin->addProduct($name,$img1,$img2,$img3,$description,$weight,$price,$cat,$file1,$file2,$file3);
                    }
                    // modification d'un article
                    elseif ($action == 'edit'){
                        $id = $this->getParameter($_POST,'art');
                        $this->ctrAdmin->editProduct($name,$img1,$img2,$img3,$description,$weight,$price,$cat,$file1,$file2,$file3,$id);
                    }
                }
                // formulaire catégorie ajout
                elseif($_GET['action'] == 'addCat') {
                    $actionCat =$this->getParameter($_POST,'actionCat');
                    if($actionCat == 'addCat'){
                        $cat = $this->getParameter($_POST, 'nameCat');
                        $this->ctrAdmin->newCat($cat);
                        //modifcation d'une catégorie
                    }elseif ($actionCat == 'editCat'){
                        $id =$this->getParameter($_POST,'cat');
                        $name =$this->getParameter($_POST,'nameCat');
                        $this->ctrAdmin->changeCat($name,$id);
                    }
                }
                // chargement du formulaire à partir d'un article sélectionné
                elseif ($_GET['action'] == 'editFormArt'){
                    $id =$this->getParameter($_POST,'idArt');
                    $this->ctrAdmin->editformArt($id);
                }
                // chargement du formulaire à partir d'une catégorie sélectionnée
                elseif ($_GET['action'] == 'editFormCat'){
                    $id =$this->getParameter($_POST,'listcat');
                    $this->ctrAdmin->editFormCat($id);
                }
                //suppression
                elseif ($_GET['action']== 'delArt'){
                    $id = $this->getParameter($_POST,'idArt');
                    $this->ctrAdmin->delProduct($id);
                }
                elseif($_GET['action'] == 'delCat') {
                    $id =$this->getParameter($_POST,'catlist');
                    $this->ctrAdmin->delCat($id);
                }
                elseif ($_GET['action']='deconect'){
                    $this->ctrAdmin->deconect();
                }

            }else{
                $this->ctrAdmin->homeAdmin();
            }


        }
        catch (Exception $e) {
            $msgError = $e->getMessage();
            require 'View/viewError.phtml';
        }

        }

}

