<?php

class Brands extends Database
{
    public function __construct()
    {
        $this->tableName = 'brands';
        parent::__construct(SERVER_HOST, DB_NAME, SERVER_USERNAME, SERVER_PASSWORD);
    }
}