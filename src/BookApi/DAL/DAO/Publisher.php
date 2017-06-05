<?php

namespace BookApi\DAL\DAO;

use BookApi\Model\Business;

class Publisher implements Persistable
{
    public function find(Business $Business)
    {
        $this->publisher_id = $Business->getId();

        $query = 'SELECT * FROM publisher WHERE publisher_id = :id';
        $read = $db->prepare($query);
        $read->bindValue(':id', $this->publisher_id, PDO::PARAM_INT);
        $read->execute();

        return $read->fetch(PDO::FETCH_OBJ);
    }

    public function all()
    {
        $this->publisher_id = $business->getId();

        $query = 'SELECT * FROM publisher';
        $read = $db->prepare($query);
        $delete->bindValue(':id', $this->publisher_id, PDO::PARAM_INT);
        $read->execute();

        return $read->fetch(PDO::FETCH_OBJ);
    }

    public function insert(Business $busines)
    {
        $this->nome = $business->getNome();

        try {
            $query = 'INSERT INTO publisher (name) VALUES (:nome)';

            $insert = $db->prepare($query);
            $insert->bindValue(':ǹome', $this->nome, PDO::PARAM_STR);
            return $insert->execute();
        } catch (PDOException $err) {
            return "Erro: " . $err->getMessage();
        }
    }

    public function delete(Business $busines)
    {
        $this->publisher_id = $business->getId();

        $query = 'DELETE FROM publisher WHERE publisher_id = :id';
        $delete = $db->prepare($query);
        $delete->bindValue(':id', $this->publisher_id, PDO::PARAM_INT);
        $delete->execute();

        return true;
    }

    public function update(Business $busines)
    {
        $this->nome = $nome;
        $this->publisher_id = $business->getId();

        try {
            $query = 'UPDATE publisher set name = :nome WHERE publisher_id = :id';

            $update = $db->prepare($query);
            $update->bindValue(':ǹome', $this->nome, PDO::PARAM_STR);
            return $update->execute();
        } catch (PDOException $err) {
            return "Erro: " . $err->getMessage();
        }
    }
}
