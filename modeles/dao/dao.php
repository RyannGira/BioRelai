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

class StationDAO{

    public static function lire(station $station){
        $sql = "select * from STATION where NUMS='". $station->getNum() ."'" ;
        $station = DBConnex::getInstance()->queryFetchFirstRow($sql);
        return $station;
    }

    public static function lesStations(){
        $result = array();
        $sql = "select * from STATION order by NOMS " ;
        $liste = DBConnex::getInstance()->queryFetchAll($sql);
        if(!empty($liste)){
            foreach($liste as $station){

                $uneStation = new station($station['NUMS']);
                $uneStation->hydrate($station);
                $result[] = $uneStation;
            }
        }
        return $result;
    }

    public static function rechercher($nom){
        $result = array();
        $sql = "select NUMS, NOMS, CAPACITES from station where NOMS LIKE '" . $nom . "%' order by NOMS";
        $liste = DBConnex::getInstance()->queryFetchAll($sql);
        if(!empty($liste)){
            foreach($liste as $station){
                $uneStation = new station($station['NUMS']);
                $uneStation->hydrate($station);
                $result[] = $uneStation;
            }
        }
        return $result;
    }
}

Class AbonneDAO{
  /*
creation des requetes suivante nécessaire :
  - insertion d'un nouvel abonnée
  - modification des donnée d'un abonnée
  - suppression d'un abonnée
récupéré md5 de championnat afin d'enregistrer le code choisi
par l'abonné de façon crypté 
  */
    public static function verification(abonne $abonne){
        $sql = "select CODEACCES from ABONNE where CODEACCES = '" . $abonne->getCodeAcces() . "' and  CODESECRET =  '" . $_POST['mdp'] ."'";
        $login = DBConnex::getInstance()->queryFetchFirstRow($sql);
        if(empty($login)){
            return null;
        }
        return $login[0];
    }

    public static function verifEmprunt(abonne $abonne){
        $sql = "select NOM, PRENOM from ABONNE WHERE CODEACCES ='" . $abonne->getCodeAcces() . "'and CODESECRET = '" . $_POST['codeSecret'] . "'" ;
        $login = DBConnex::getInstance()->queryFetchFirstRow($sql);
        if(empty($login)){
            return null;
        }
        return $login[0];
    }
}

class PlotDAO{


    public static function lire(plot $plot){
        $sql = "select * from PLOT where NUM='" . $plot->getNum() ."'";
        $plot = DBConnex::getInstance()->queryFetchFirstRow($sql);
        return $plot;
    }

    public static function lesPlots(){
        $result = array();
        $sql = "select * from PLOT order by NUM" ;
        $liste = DBConnex::getInstance()->queryFetchAll($sql);
        if(!empty($liste)){
            foreach($liste as $plot){
                $uneStation = new plot($plot['numPlot'],$plot['nomStation'] );
                $uneStation->hydrate($plot);
                $result[] = $uneStation;
            }
        }
        return $result;
    }

}

class VeloDAO{

    public static function lire(velo $velo){
        $sql = "select * from VELO where NUMV='" . $velo->getNum() ."'";
        $velo = DBConnex::getInstance()->queryFetchAll($sql);
        return $velo;
    }

    public static function lesVelos(){
        $result = array();
        $sql = "select * from VELO order by NUMV" ;
        $liste = DBConnex::getInstance()->queryFetchAll($sql);
        if(!empty($liste)){
            foreach($liste as $velo){
                $unVelo = new velo($velo['NUMV']);
                $unVelo->hydrate($velo);
                $result[] = $unVelo;
            }
        }
        return $result;
    }

    public static function emprunterVelo(velo $velo){
        $sql = "ALTER TABLE ";
    }
}
