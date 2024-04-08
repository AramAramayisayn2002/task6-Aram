<?php

class Products extends Database
{
    public function __construct()
    {
        $this->tableName = 'products';
        parent::__construct(SERVER_HOST, DB_NAME, SERVER_USERNAME, SERVER_PASSWORD);
    }
}