<?php
/**
 * Created by PhpStorm.
 * User: samanthabrochard
 * Date: 12/11/2017
 * Time: 18:51
 */

class DatabaseModel
{

    protected function getDb(){
        $db = new PDO('mysql:host=localhost;dbname=catalogue;charset=utf8','root', 'root', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
        return $db;
    }

    public function executeSql($sql, $values = array())
    {
        $db = $this->getDb();
        $query = $db->prepare($sql);
        $query->execute($values);


    }

    public function query($sql, array $criteria = array())
    {
        $db = $this->getDb();
        $query = $db->prepare($sql);

        $query->execute($criteria);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function queryOne($sql, array $criteria = array())
    {
        $db = $this->getDb();
        $query = $db->prepare($sql);

        $query->execute($criteria);

        return $query->fetch(PDO::FETCH_ASSOC);
    }


}