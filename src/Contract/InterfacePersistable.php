<?php


 interface InterfacePersistable
{
    public function insert();
    public function update();
    public function destroy();
    public function find();
    public function all();
    
}