<?php

class Admin extends Database
{
    public function __construct()
    {
        $this->tableName = 'admin';
        parent::__construct(SERVER_HOST, DB_NAME, SERVER_USERNAME, SERVER_PASSWORD);
    }
}