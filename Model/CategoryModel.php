<?php
/**
 * Created by PhpStorm.
 * User: samanthabrochard
 * Date: 14/11/2017
 * Time: 18:49
 */


require_once 'DatabaseModel.php';

class CategoryModel extends DatabaseModel
{

	public function getLIstCat(){
    $sql = 'SELECT * FROM Category';
    $listCats = $this->query($sql);
    return  $listCats;
	}

	public function addCat($name){
        $sql = 'INSERT INTO category (Name) VALUES (?)';
        $param = array($name);
        $this->executeSql($sql,$param);
    }

    public function delCat($id){
	    $sql = 'DELETE FROM category WHERE category.IdCat = ?';
	    $param = array($id);
	    $this->executeSql($sql,$param);
    }

    public function editCat($name,$id){
        $sql = 'UPDATE category SET category.Name = ? WHERE category.IdCat = ?';
        $param = array($name,$id);
        $this->executeSql($sql,$param);
    }

    public function getOneCat($id){
        $sql = 'SELECT * FROM category WHERE category.IdCat = ? ';
        $param = array($id);
        $cat = $this -> queryOne($sql,$param);
        return $cat;
    }
}