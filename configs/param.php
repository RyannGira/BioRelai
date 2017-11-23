<?php
//D�finition des variables de connexion
class Param {
	// si la connexion ne fonctionne pas, c'est normal, j'ai pull mes params sans faire expres
	// et je taff sur mac os......................
	public static $user = 'root';
	// mettre $pass=''
  public static $pass = 'root';
	// supprimer :8889 de $dsn car numero du port pour mac
	public static $dsn = 'mysql:host=127.0.0.1:8889;dbname=perrint_vlib;charset=utf8';
}
?>
