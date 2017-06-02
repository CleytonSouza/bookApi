<?php

/**
* 
*/
class Database 
{
  #Guada conexão PDO
  public $db;

	function __construct()
	{
	 # Informações sobre o banco de dados
    $servername = "bookApi";
    $username = "root";
    $password = "4linux";

   try {
          # Atribui o objeto PDO à variável
         self::$db = new PDO("mysql:host=$servername;dbname=myDB", $username, $password);
    
         self::$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         self::$db->exec('SET NAMES utf8');
    
        }
          catch(PDOException $e){
        
            die("Falha na conexao: " . $e->getMessage());
        }

	}

   
   public function conexao()
    {
        
        if (!self::$db)
        {
            new Database();
        }
        # Retorna a conexão.
        return self::$db;
    }




}
