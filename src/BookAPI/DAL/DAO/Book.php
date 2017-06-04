<?php

namespace BookAPI\DAL\DAO;

use BookAPI\DAL\DAO\Persistable;
use BookAPI\DAL\DAO\Factory;


/***
*Classe de perssitencia do Book
*/
class Book  implements Persistable {
	protected $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function insert($obj){
		try{
			$this->$db->beginTransaction();
			$sth = $this->$db->prepare("insert into book(book_id,name,isbn,fk_publisher_id) values (0,:name,:isbn,:fk_publisher_id)");
			$sth->bindvalue(":name",$obj->name);
			$sth->bindvalue(":isbn",$obj->isbn);
			$sth->bindvalue(":fk_publisher_id",$obj->fk_publisher_id);
			$result = $sth->execute();

			$obj->book_id = $result->lastInsertId(); 

			$afect = $result->rowcount();

			$this->$db->commit();


			return $obj;


			

		}catch(Exception $e){
			$this->$db->rollback();
			return "Erro ao inserir novo book => ".$e->getMessage();			
		}
		
	}

	public function delete($obj){
		try{
			$this->$db->beginTransaction();

			$sth = $this->$db->prepare("delete from book where book_id = :id");
			$sth->bindvalue(":id", $obj->id);
			$result = $sth->execute();
			$afect = $result->rowcount();	

			return $obj;		
			
			$this->$db->commit();			

		}catch(Exception $e){
			$this->$db->rollback();
			return "Erro ao apagar book => ".$e->getMessage();			
		}
	}

	public function update($obj){
		try{
			$this->$db->beginTransaction();
			$sth = $this->$db->prepare("update book set name = :name, isbn = :isnb, fk_publisher_id = :fk_publisher_id where book_id = :id");
			$sth->bindvalue(":name",$obj->name);
			$sth->bindvalue(":id",$obj->id);
			$sth->bindvalue(":isbn",$obj->isbn);
			$sth->bindvalue(":fk_publisher_id",$obj->fk_publisher_id);
			$result = $sth->execute();
			$afect = $result->rowcount();
			
			$this->$db->commit();

			return $obj;

		}catch(Exception $e){
			return "Erro ao alterar book => ".$e->getMessage();			
		}
		
	}

	public function find($obj){
		try{
			$sth = $this->$db->prepare("select book_id,name,isbn,fk_publisher_id from book where book_id = :id ");
			$sth->bindvalue(":id",$obj->id);
			$sth->execute();
			
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);

			$obj->book_id = $result['book_id'];
			$obj->name = $result['name'];
			$obj->isbn = $result['isbn'];
			$obj->fk_publisher_id = $result['fk_publisher_id'];

			return $obj;

		}catch(Exception $e){
			return $e->getMessage();
		}		
		return $result ;	
	}

	public function all(){
		try{
			$sth = $this->$db->prepare("select book_id,name,isbn,fk_publisher_id from book ");
			$sth->execute();
			$result = $sth->fetchAll(PDO::FETCH_ASSOC);

			return $result;

		}catch(Exception $e){
			return $e->getMessage();	
		}		
				

	}
}