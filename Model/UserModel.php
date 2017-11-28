<?php
require_once 'DatabaseModel.php';

class UserModel extends DatabaseModel
{


    public function getUser($login,$mdp){
        $sql = 'SELECT idUser FROM user WHERE login = ? AND password = ?';
        $param = array($login,$mdp);
        $result = $this->queryOne($sql,$param);
        return $result;
    }
}