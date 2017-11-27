<?php

require 'DatabaseModel.php';

class ArticleModel extends DatabaseModel
{
	function getArticle(){
    $sql = 'SELECT * FROM article ';
    $articles = $this->query($sql);
    return $articles;
	}

	function getOneArticle($id){
    $sql = 'SELECT NameArticle,Price,Description,Weight, Img1, Img2, Img3 FROM article  WHERE Id_article = ?';
    $array =[$id];
    $articles = $this->queryOne($sql,$array);
    return $articles;
	}

    function addArticle($name,$img1,$img2,$img3,$description,$weight,$price){
        $sql = 'INSERT INTO article (NameArticle, Img1, Img2, Img3, Description, Weight,Price) VALUES (?,?,?,?,?,?,?)';
        $param = array($name,$img1,$img2,$img3,$description,$weight,$price);
        $this->executeSql($sql,$param);

    }
    function editArticle($name,$img1,$img2,$img3,$description,$weight,$price,$idArt){
        $sql = 'UPDATE article SET NameArticle = ?,Img1 = ?,Img2 = ? ,Img3 = ? ,Description = ?,Weight= ?,Price =?
                WHERE Id_article = ?';
        $param = array($name,$img1,$img2,$img3,$description,$weight,$price,$idArt);
        $this->executeSql($sql,$param);

    }

    function deletArticle($params){
        $sql = 'DELETE FROM article WHERE Id_article = ?';
        $array = array($params);
        $this->executeSql($sql,$array);

    }


    function orderArticle($order){
        $sql = 'SELECT * FROM article ORDER BY '.$order.'';
        $articles = $this-> query($sql);
        if(count($articles) >= 1) {
            return $articles;
        }
        else{
            throw new Exception("Erreur lors du chargement de la page.");
        }
    }

    function articleResearch($term){
        $sql= 'SELECT NameArticle FROM article WHERE NameArticle LIKE %?%';
        $array = array($term);
        $name = $this->query($sql,$array);
        return $name;
    }

    function getIdArticle($name){
        $sql= 'SELECT Id_article FROM article WHERE NameArticle = ?';
        $array = array($name);
        $idArt = $this->queryOne($sql,$array);
        return $idArt;
    }
}