<?php

class Connect
{
	
	public static function conectar()
	{
		try{

			$pdo = new PDO("mysql:dbname=crudvue; host=127.0.0.1","root","", array(PDO::MYSQL_ATTR_INIT_COMMAND=>("SET NAMES utf8")));

			return $pdo;
		}catch( PDOException $e){

			echo "error al conectar. =>".$e;
		}
	}
}
