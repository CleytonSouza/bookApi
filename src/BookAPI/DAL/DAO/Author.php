<?php

require_once "vendor/autoload.php";
namespace src\BookAPI\DAL;
//use resource\config;

Class Author {

    protected $con;

    public function insert($name){
        try{
            $con = new config();
            $stmt = $con->prepare("INSERT INTO author(author_id, name) VALUES(?, ?)");
            $stmt->bindParam(1,null);
            $stmt->bindParam(2,$name, PDO::PARAM_STR);
            return $stmt->execute();

        }catch (PDOExecption $e){
            return "Ocorreu um erro ao tentar executar esta ação:::" . . $e->getMessage();
        }
    }
    
    public function update($name, $id){
        try{
            $con = new config();
            $stmt = $con->prepare("UPDATE author set name=:name WHERE id=:id");
            $stmt->bindParam(":nome",$name, PDO::PARAM_STR);
            $stmt->bindParam(":id",$id, PDO::PARAM_STR);
            return $stmt->execute();
            
        }catch (PDOExecption $e) {
            return "Ocorreu um erro ao tentar executar esta ação:::" . . $e->getMessage();
        }
        
    }
    
    public function delete($id){
        try{
            $con = new config();
            $stmt = $con->prepare("DELETE FROM author WHERE id=:id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $affected_rows = $stmt->rowCount();
            
            if($affected_rows > 0 ){
                return "Dado deletado com sucesso";
            }else{
                return "Nao foi possivel excluir o dado, consulte seu DBA";   
            }
            
        } catch (PDOExecption $e){
            return "Ocorreu um erro ao tentar executar esta ação:::" . . $e->getMessage();
        }
    }
    
    public function find($search){
        try{
            $con = new config();
            $stmt = $con->prepare("SELECT * FROM author WHERE name = '".$search."'");
            $rows = $stmt->fetchObject( PDO::FETCH_OBJ );
            return $rows;
            
        } catch (PDOExecption $e){
            return "Ocorreu um erro ao tentar executar esta ação:::" . . $e->getMessage();
        }
    }
    
    public function all(){
        try{
            $con = new config();
            $stmt = $con->prepare("SELECT * FROM author");
            $rows = $stmt->fetchObject( PDO::FETCH_OBJ );
            return $rows;
            
        } catch (PDOExecption $e){
            return "Ocorreu um erro ao tentar executar esta ação:::" . . $e->getMessage();
        }
    }
    
}