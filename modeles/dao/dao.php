<?php
require_once 'configs/param.php';

class DBConnex extends PDO{

    private static $instance;

    public static function getInstance(){
        if ( !self::$instance ){
            self::$instance = new DBConnex();
        }
        return self::$instance;
    }

    function __construct(){
        try {
            parent::__construct(Param::$dsn ,Param::$user, Param::$pass);
        } catch (Exception $e) {
            echo $e->getMessage();
            die("Impossible de se connecter." );
        }
    }

    public function __destruct(){
        if(!is_null(self::$instance)){
            self::$instance = null;
        }
    }


    public function queryFetchAll($sql){
        $sth  =$this->query($sql);

        if ( $sth ){
            return $sth -> fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }


    public function queryFetchFirstRow($sql){
        $sth    = $this->query($sql);
        $result    = array();

        if ( $sth ){
            $result  = $sth -> fetch();
        }

        return $result;
    }


    public function insert($sql){
        if ( $this -> exec($sql) > 0 ){
            return 1;
            //$this->lastInsertId();
        }
        return false;
    }

    public function update($sql){
        return $this->exec($sql) ;
    }

    public function delete($sql){
        return $this->exec($sql) ;
    }
}

Class AdherentDAO{
    /*
     creation des requetes suivante nécessaire :
     - insertion d'un nouvel adherent
     - modification des donnée d'un adherent
     - suppression d'un adherent
     récupéré md5 afin d'enregistrer le code choisi
     par l'adherent de façon crypté
     */
    public static function verification(adherent $adherent){
        $sql = "select mail from adherent where mail = '" . $adherent->getMail() . "' and  password =  '" . $_POST['mdp'] ."'";
        $login = DBConnex::getInstance()->queryFetchFirstRow($sql);
        if(empty($login)){
            return null;
        }
        return $login[0];
    }
    
}


Class ProducteurDAO{
    /*
     creation des requetes suivante nécessaire :
     - insertion d'un nouveau producteur
     - modification des donnée d'un producteur
     - suppression d'un producteur
     récupéré md5 afin d'enregistrer le code choisi
     par l'adherent de façon crypté
     */
    public static function verification(producteur $producteur){
        $sql = "select mail from producteur where mail = '" . $producteur->getMail() . "' and  password =  '" . $_POST['mdp'] ."'";
        $login = DBConnex::getInstance()->queryFetchFirstRow($sql);
        if(empty($login)){
            return null;
        }
        return $login[0];
    }
    
}