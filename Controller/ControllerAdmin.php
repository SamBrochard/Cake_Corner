<?php

require_once 'Model/ArticleModel.php';
require_once 'Model/CategoryModel.php';
require_once 'Model/Rel_Art_CatModel.php';
/**
* 
*/

class ControllerAdmin
{
	
	private $article;
    private $category;
    private $rel_art_cat;

    public function __construct()
    {
       $this->article = new ArticleModel();
       $this->category = new CategoryModel();
       $this->rel_art_cat = new Rel_Art_CatModel();
    }

    public function homeAdmin(){
        $cats = $this->category->getLIstCat();
        $arts = $this->article->getArticle();
    	$view = new View("Admin");
        $view->create(array('cats'=> $cats, 'articles'=>$arts));
    }

	public function editProduct($name,$img1,$img2,$img3,$description,$weight,$price,$idCats,$file1,$file2,$file3,$id){
		$arts = $this->article->editArticle($name,$img1,$img2,$img3,$description,$weight,$price,$id);
        $fileMove1=move_uploaded_file($file1,'img/'.$img1.'');
        $fileMove2=move_uploaded_file($file2,'img/'.$img2.'');
        $fileMove1=move_uploaded_file($file3,'img/'.$img3.'');
        $this->rel_art_cat->delRelbyArt($id);
        if ($idCats != NULL){
            foreach ($idCats as $idCat){
                $this->rel_art_cat->addRel($id,$idCat);
            }
        }
        $this->homeAdmin();
	}

	public function addProduct($name,$img1,$img2,$img3,$description,$weight,$price,$idCats,$file1,$file2,$file3){
        $this->article->addArticle($name,$img1,$img2,$img3,$description,$weight,$price);
        $fileMove1=move_uploaded_file($file1,'img/'.$img1.'');
        $fileMove2=move_uploaded_file($file2,'img/'.$img2.'');
        $fileMove1=move_uploaded_file($file3,'img/'.$img3.'');
	    $idArt =$this->article->getIdArticle($name);

	    if ($idCats != NULL){
            foreach ($idCats as $idCat){
                $this->rel_art_cat->addRel($idArt['Id_article'],$idCat);
            }
        }
        $this->homeAdmin();
    }

    public function delProduct($id){
	    $this->rel_art_cat->delRelbyArt($id);
	    $this->article->deletArticle($id);
        //$this->homeAdmin();
    }

    public function editFormArt($id){
        $article =$this->article->getOneArticle($id);
        $actionArt = 'edit';
        $rels = $this->rel_art_cat->getRelOneArticle($id);
        echo $data =json_encode(array('article'=>$article, 'actionArt'=>$actionArt,'rels'=>$rels));
    }

    public function editFormCat($id){
        $cat  = $this->category->getOneCat($id);
        $actionCat = "editCat";
        echo $data =json_encode(array('cat'=>$cat, 'actionCat'=>$actionCat));
    }

    public function newCat($param){
        $this->category->addCat($param);
        $this->homeAdmin();
    }

    public function changeCat($nameCat,$id){
        $this->category->editCat($nameCat,$id);
        $this->homeAdmin();
    }

    public function delCat($idcat){
        $this->category->delCat($idcat);
        $this->rel_art_cat->delRelbyCat($idcat);
    }

    public function deconect(){
        $_SESSION['mod'] = 'prod';
        header('Location:index.php');
    }
}