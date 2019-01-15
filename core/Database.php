<?php

  class Database extends Controller {

    public $conn;

    public function __construct()
    {
        try
        {
            $this->conn = new PDO(DSN, USER, PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $this->conn;
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
            exit();
        }
    }

    public function insert($table, $params)
    {
        $args = '';

        // Get column names
        $result = $this->conn->prepare("DESCRIBE $table");
        $result->execute();
        $fields = $result->fetchAll(PDO::FETCH_COLUMN);

        // Remove the id (first element)
        array_shift($fields);

        // Make a string from the fields array
        $fields = implode(', ', $fields);

        // Loop through each param
        foreach($params as $key => $value)
        {
            $args .= ':' . $key . ', ';
            $binds[':' . $key] = $value;
        }

        // Remove the last comma
        $args = rtrim($args, ', ');

        // Generate the query
        $query = "INSERT INTO " . $table . "(" . $fields . ") VALUES (" . $args . ")";

        // Set the result
        $result = $this->conn->prepare($query);

        // Execute the bindings
        $result->execute($binds);
    }

    public function update($query, $value)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($value);
    }

    public function delete($query, $value)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($value);
    }

    public function fetch($query, $value)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute($value);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function fetch_all($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function fetch_obj($query)
    {
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_OBJ);

        return $data;
    }

  }
