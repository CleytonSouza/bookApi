<?php

namespace bookapi\dal;

class Book {
	public $conn;
	public function insert($obj){
		try{
			$sth = $thid->$conn->prepare("insert into book(name,isbn) values (:name,:isbn)");
			$sth->bindvalue(":name",$obj->name);
			$sth->bindvalue(":isbn",$obj->isbn);
			$result = $sth->execute();

			$afect = $result->rowcount();

			if($afect > 0){
				return "Dado inserido com sucesso.";
			}
			else{
				return "Falha na insercao";
			}

		}catch(Exception $e){
			return "Erro ao inserir novo book => ".$e->getMessage();			
		}
		
	}

	public function delete($obj){
		try{
			$sth = $thid->$conn->prepare("delete from book where book_id = :id");
			$sth->bindvalue(":id", $obj->id);
			$result = $sth->execute();
			$afect = $result->rowcount();

			if($afect > 0){
				return "Dado apagado com sucesso.";
			}
			else{
				return "Falha ao apagar";
			}

		}catch(Exception $e){
			return "Erro ao apagar book => ".$e->getMessage();			
		}
	}

	public function update($obj){
		try{
			$sth = $thid->$conn->prepare("update book set book_name = :name where book_id = :id");
			$sth->bindvalue(":name",$obj->name);
			$sth->bindvalue(":id",$obj->id);
			$result = $sth->execute();
			$afect = $result->rowcount();

			if($afect > 0){
				return "Dado alterado com sucesso.";
			}
			else{
				return "Falha ao alterar book";
			}

		}catch(Exception $e){
			return "Erro ao alterar book => ".$e->getMessage();			
		}
		
	}

	public function find(){
		try{
			$sth = $thid->$conn->prepare("select * from book where book_id = :id ");
			$sth->execute();
			$sth->bindvalue(":id",$obj->id);
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		}catch(Exception $e){
			return $e->getMessage();
		}		
		return $result ;	
	}

	public function all(){
		try{
			$sth = $thid->$conn->prepare("select * from book ");
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);

		}catch(Exception $e){
			return $e->getMessage();	
		}		
		return $result ;		

	}
}