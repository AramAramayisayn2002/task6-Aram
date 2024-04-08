<?php

class Orders extends Database
{
    public function __construct()
    {
        $this->tableName = 'orders';
        parent::__construct(SERVER_HOST, DB_NAME, SERVER_USERNAME, SERVER_PASSWORD);
    }
}