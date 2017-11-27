<?php
/**
 * Created by PhpStorm.
 * User: samanthabrochard
 * Date: 14/11/2017
 * Time: 22:55
 */
require_once 'Model/ArticleModel.php';
require_once 'Model/CategoryModel.php';
require_once 'Model/Rel_Art_CatModel.php';

class ControllerProduct{
    private $article;
    private $category;
    private $rel_art_cat;

    public function __construct()
    {
       $this->article = new ArticleModel();
       $this->category = new CategoryModel();
       $this->rel_art_cat = new Rel_Art_CatModel();
    }

    public function articleId($idArt)
    {
        $article = $this->article->getOneArticle($idArt);
        $cats = $this->category->getLIstCat();
        $rels = $this->rel_art_cat->getRelOneArticle($idArt);
        $article ['cat'] = array();
        $i = 0;
        foreach ($rels as $rel) {
            foreach ($cats as $cat) {
                if ($rel['IdCat'] == $cat['IdCat']) {
                    $article['cat'][$i] = $cat['Name'];
                    $i++;
                }
            }
        }
        $view = new View("Product");
        $view->create(array('article' => $article));
    }
    
}
