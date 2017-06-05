<?php

namespace BookApi\DAL\DAO;

use BookApi\Model\Business;

class Book implements Persistable
{
    /**
     * @return \PDO
     */
    protected function getConnection()
    {
       return (new Factory())->createConnection();
    }

    /**
     * @param Business $business
     * @return Business
     */
    public function insert(Business $business)
    {
        $connection = $this->getConnection();
        try{
            $statement = $connection->prepare(
                'INSERT INTO book("book_id","isbn","name","fk_publisher_id") VALUES ( ?,?,?,?)'
            );

            $data = $business->toArray();

            $statement->bindParam(1,NULL);
            $statement->bindParam(2,$data['isbn'],\PDO::PARAM_STR);
            $statement->bindParam(3,$data['name'],\PDO::PARAM_STR);
            $statement->bindParam(4,$data['publisher'],\PDO::PARAM_INT);
            $statement->execute();

        }catch(\PDOException $exception){
            throw new \BadMethodCallException($exception->getMessage(),500);
        }
    }

    public function update(Business $business)
    {
        // TODO: Implement update() method.
    }

    public function delete(Business $business)
    {
        // TODO: Implement delete() method.
    }

    public function find(Business $business)
    {
        // TODO: Implement find() method.
    }

    public function all()
    {
       return array();
    }

    /*
    public function insert($obj)
    {
        try {
            $this->$db->beginTransaction();
            $sth = $this->$db->prepare("insert into book(book_id,name,isbn,fk_publisher_id) values (0,:name,:isbn,:fk_publisher_id)");
            $sth->bindvalue(":name", $obj->name);
            $sth->bindvalue(":isbn", $obj->isbn);
            $sth->bindvalue(":fk_publisher_id", $obj->fk_publisher_id);
            $result = $sth->execute();

            $obj->book_id = $result->lastInsertId();

            $afect = $result->rowcount();

            $this->$db->commit();


            return $obj;
        } catch (Exception $e) {
            $this->$db->rollback();
            return "Erro ao inserir novo book => ".$e->getMessage();
        }
    }

    public function delete($obj)
    {
        try {
            $this->$db->beginTransaction();

            $sth = $this->$db->prepare("delete from book where book_id = :id");
            $sth->bindvalue(":id", $obj->id);
            $result = $sth->execute();
            $afect = $result->rowcount();

            return $obj;

            $this->$db->commit();
        } catch (Exception $e) {
            $this->$db->rollback();
            return "Erro ao apagar book => ".$e->getMessage();
        }
    }

    public function update($obj)
    {
        try {
            $this->$db->beginTransaction();
            $sth = $this->$db->prepare("update book set name = :name, isbn = :isnb, fk_publisher_id = :fk_publisher_id where book_id = :id");
            $sth->bindvalue(":name", $obj->name);
            $sth->bindvalue(":id", $obj->id);
            $sth->bindvalue(":isbn", $obj->isbn);
            $sth->bindvalue(":fk_publisher_id", $obj->fk_publisher_id);
            $result = $sth->execute();
            $afect = $result->rowcount();

            $this->$db->commit();

            return $obj;
        } catch (Exception $e) {
            return "Erro ao alterar book => ".$e->getMessage();
        }
    }

    public function find($obj)
    {
        try {
            $sth = $this->$db->prepare("select book_id,name,isbn,fk_publisher_id from book where book_id = :id ");
            $sth->bindvalue(":id", $obj->id);
            $sth->execute();

            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            $obj->book_id = $result['book_id'];
            $obj->name = $result['name'];
            $obj->isbn = $result['isbn'];
            $obj->fk_publisher_id = $result['fk_publisher_id'];

            return $obj;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $result ;
    }

    public function all()
    {
        try {
            $sth = $this->$db->prepare("select book_id,name,isbn,fk_publisher_id from book ");
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);

            return $result;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    */

}
