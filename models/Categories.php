<?php

class Categories extends Database
{
    public function __construct()
    {
        $this->tableName = 'categories';
        parent::__construct(SERVER_HOST, DB_NAME, SERVER_USERNAME, SERVER_PASSWORD);
    }
}