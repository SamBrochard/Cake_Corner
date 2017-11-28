<?php
/**
 * Created by PhpStorm.
 * User: samanthabrochard
 * Date: 15/11/2017
 * Time: 01:18
 */

require_once 'Model/ArticleModel.php';
require_once 'Model/CategoryModel.php';
require_once 'Model/Rel_Art_CatModel.php';
require_once 'Model/UserModel.php';

/**
* 
*/
class ControllerHome
{
    private $article;
    private $category;
    private $rel_art_cat;
    private $user;

    public function __construct()
    {
       $this->article = new ArticleModel();
       $this->category = new CategoryModel();
       $this->rel_art_cat = new Rel_Art_CatModel();
       $this->user = new UserModel();
    }

/**
 * créer la page d'accueil
 */

     public function home(){
        $arts = $this->article->getArticle();
        $cats = $this->category->getLIstCat();
        $rels = $this->rel_art_cat->getRel();
        $articles = array();
        foreach ($arts as $art){
            $art['cat'] = array();
            $i=0;
            foreach ($rels as $rel){
                if($art['Id_article'] == $rel['IdArt']){
                    foreach ($cats as $cat){
                        if($rel['IdCat'] == $cat['IdCat']) {
                            $art['cat'][$i] = $cat['Name'];
                            $i++;
                        }
                    }
                }
            }
            $articles [] = $art;
        }
        $view = new View("Home");
        $view->create(array('articles' => $articles,'cats'=>$cats,'rels'=>$rels));
    }

    private function articleFilter($valueFilter){
        $arts = $this->article->getArticle();
        $rels = $this->rel_art_cat->getRelOneCat($valueFilter);
        $articlesFilter = array();
        foreach ($arts as $art){
            foreach ($rels as $rel){
                if($art['Id_article'] == $rel['IdArt']){
                    $articlesFilter[] = $art;
                }
            }
        }
       // var_dump($articlesFilter);
        return $articlesFilter;
    }
     public function homeFilter($valueFilter){
        $cats = $this->category->getLIstCat();
        $rels = $this->rel_art_cat->getRel();
        $arts =$this->articleFilter($valueFilter);
        $articles = array();
         foreach ($arts as $art){
             $art['cat'] = array();
             $i=0;
             foreach ($rels as $rel){
                 if($art['Id_article'] == $rel['IdArt']){
                     foreach ($cats as $cat){
                         if($rel['IdCat'] == $cat['IdCat']) {
                             $art['cat'][$i] = $cat['Name'];
                             $i++;
                         }
                     }
                 }
             }
             $articles [] = $art;
         }
         echo $data = json_encode(array('articles' => $articles,'cats'=>$cats,'rels'=>$rels));
        //$view = new View("Home");
        //$view->create(array('articles' => $arts,'cats'=>$cats,'rels'=>$rels));
    }

     function homeOrder($nameOrder){
        $arts = $this->article->orderArticle($nameOrder);
        $cats = $this->category->getLIstCat();
        $rels = $this->rel_art_cat->getRel();
        $articles = array();
        foreach ($arts as $art){
            $art['cat'] = array();
            $i=0;
            foreach ($rels as $rel){
                if($art['Id_article'] == $rel['IdArt']){
                    foreach ($cats as $cat){
                        if($rel['IdCat'] == $cat['IdCat']) {
                            $art['cat'][$i] = $cat['Name'];
                            $i++;
                        }
                    }
                }
            }
            $articles [] = $art;
        }
        echo $data = json_encode(array('articles' => $articles,'cats'=>$cats,'rels'=>$rels));
       // $view = new View("Home");
       // $view->create(array('articles' => $arts,'cats'=>$cats,'rels'=>$rels));
    }

    function homeResearch($term){
         $name = $this->article->articleResearch($term);
         echo $result= json_encode(array('name'=>$name));
    }

    function connect($login,$mdp){
        $user = $this->user->getUser($login,$mdp);
        if ($user == true){
            $_SESSION['mod']= 'dev';
        }
        header('Location:index.php');
    }
}

