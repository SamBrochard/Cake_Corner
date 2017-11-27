<?php 
require_once 'DatabaseModel.php';

class Rel_Art_CatModel extends DatabaseModel
{
    /**
     * @param $array
     */
    public function addRel($idArt,$idCat)
    {
        $sql = 'INSERT INTO `Rel_Art_Cat`(`IdArt`, `IdCat`) VALUES (?,?)';
        $param =array($idArt,$idCat);
        $this->executeSql($sql,$param);
    }

    public function delRelbyCat($idCat){
        $sql = 'DELETE FROM rel_art_cat WHERE IdCat = ?';
        $param =array($idCat);
        $this->executeSql($sql,$param);
    }

    public  function delRelbyArt ($idArt){
        $sql = 'DELETE FROM rel_art_cat WHERE IdArt = ?';
        $param =array($idArt);
        $this->executeSql($sql,$param);
    }
    /**
     * @return array
     */
    public function getRel()
    {
        $db = new DatabaseModel();
        $sql='SELECT * FROM Rel_Art_Cat';
        $rel = $db->query($sql);
        return $rel;
    }

    public function getRelOneArticle($idArt)
    {
        $db = new DatabaseModel();
        $sql = 'SELECT * FROM rel_Art_Cat WHERE IdArt =  ?';
        $array = [$idArt];
        $relCat = $db->query($sql,$array);
        return $relCat;
    }
    public function getRelOneCat($idCat)
    {
        $db = new DatabaseModel();
        $sql = 'SELECT IdArt FROM rel_Art_Cat WHERE IdCat =  ?';
        $array = [$idCat];
        $relArt = $db->query($sql,$array);
        return $relArt;
    }
}
