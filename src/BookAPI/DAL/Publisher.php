<?php

// require_once "conexao.php";
require_once "vendor/autoload.php";
namespace src\BookAPI\DAL

class Publisher implements Persistable
{
	
	protected $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function find(Business $busines)
	{
		$this->publisher_id = $business->getId();

		$query = 'SELECT * FROM nomedatabela WHERE publisher_id = :id';
		$read = $db->prepare($query);
		$read->bindValue(':id', $this->publisher_id, PDO::PARAM_INT);
		$read->execute();

		return $read->fetch(PDO::FETCH_OBJ);
	}

	public function all()
	{
		$this->publisher_id = $business->getId();

		$query = 'SELECT * FROM nomedatabela';
		$read = $db->prepare($query);
		$delete->bindValue(':id', $this->publisher_id, PDO::PARAM_INT);
		$read->execute();

		return $read->fetch(PDO::FETCH_OBJ);
	}

	public function insert(Business $busines)
	{
		$this->nome = $business->getNome();

		try
		{
			$query = 'INSERT INTO nometabela (nome) VALUES (:nome)';

			$insert = $db->prepare($query);
			$insert->bindValue(':ǹome', $this->nome, PDO::PARAM_STR);
			return $insert->execute();
		} catch(PDOException $err){
			return "Erro: " . $err->getMessage();
		}

	}

	public function destroy(Business $busines)
	{
		$this->publisher_id = $business->getId();

		$query = 'DELETE FROM nomedatabela WHERE publisher_id = :id';
		$delete = $db->prepare($query);
		$delete->bindValue(':id', $this->publisher_id, PDO::PARAM_INT);
		$delete->execute();

		return true;
	}

	public function update(Business $busines)
	{
		$this->nome = $nome;
		$this->publisher_id = $business->getId();

		try
		{
			$query = 'UPDATE nomedatabela set nome = :nome WHERE id = :id';

			$update = $db->prepare($query);
			$update->bindValue(':ǹome', $this->nome, PDO::PARAM_STR);
			return $update->execute();
		} catch(PDOException $err){
			return "Erro: " . $err->getMessage();
		}
	}
}