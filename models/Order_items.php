<?php

class Order_items extends Database
{
    public function __construct()
    {
        $this->tableName = 'order_items';
        parent::__construct(SERVER_HOST, DB_NAME, SERVER_USERNAME, SERVER_PASSWORD);
    }
}