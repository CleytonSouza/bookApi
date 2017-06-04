<?php

namespace BookApi\DAL\DAO;

use BookApi\Model\Business;

interface Persistable
{
    public function insert(Business $business);

    public function update(Business $business);

    public function delete(Business $business);

    public function find(Business $business);

    public function all();
}
