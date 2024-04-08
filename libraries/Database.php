<?php

class Database
{
    protected $pdo;
    protected $tableName;
    protected $query;
    protected $queryResult;

    public function __construct($server_host, $db_name, $username, $password)
    {
        try {
            $dsn = "mysql:host=$server_host;dbname=$db_name";
            $this->pdo = new PDO($dsn, $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit();
        }
    }

    public function insert($post)
    {
        $keys = " ";
        $values = " ";
        foreach (array_keys($post) as $key) {
            $keys .= $key . ', ';
            $values .= "'" . $post[$key] . "', ";
        }
        $keys = substr($keys, 0, -2) . ' ';
        $values = substr($values, 0, -2) . ' ';
        $this->query = "INSERT INTO " . $this->tableName . " ($keys) VALUES ($values)";
        return $this;
    }

    public function update($post)
    {
        $updateKeyandValue = '';
        $this->query = "UPDATE " . $this->tableName . " SET ";
        foreach (array_keys($post) as $key) {
            $updateKeyandValue .= $key . " = '" . $post[$key] . "', ";
        }
        $updateKeyandValue = substr($updateKeyandValue, 0, -2);
        $this->query .= $updateKeyandValue;
        return $this;
    }

    public function select()
    {
        $this->query = "SELECT * FROM " . $this->tableName;
        return $this;
    }

    public function delete()
    {
        $this->query = "DELETE FROM " . $this->tableName;
        return $this;
    }

    public function where($fieldName, $operator, $value)
    {
        if (strpos($this->query, "WHERE")) {
            $this->query .= " $fieldName $operator '$value'";
        } else {
            $this->query .= " WHERE $fieldName $operator '$value'";
        }
        return $this;
    }

    public function innerJoin($table, $column)
    {
        $this->query .= " INNER JOIN " . $table . " on " . $table . "." . "$column" . " = " . $this->tableName . "." . $column;
        return $this;
    }

    public function or()
    {
        $this->query .= " OR ";
        return $this;
    }

    public function and()
    {
        $this->query .= " AND ";
        return $this;
    }

    public function limit($count)
    {
        $this->query .= " LIMIT $count";
        return $this;
    }

    public function offset($count)
    {
        $this->query .= " OFFSET $count";
        return $this;
    }

    public function execute()
    {
        $statement = $this->pdo->prepare($this->query);
        $statement->execute();
        $this->queryResult = $statement->fetchAll(PDO::FETCH_ASSOC);
        $this->lastInsertId = $this->pdo->lastInsertId();
        return $this;
    }

    public function numRows()
    {
        return $this->queryResult ? count($this->queryResult) : false;
    }

    public function fetchAssoc()
    {
        return $this->queryResult ? current($this->queryResult) : false;
    }

    public function fetchAssocs()
    {
        return $this->queryResult;
    }
}