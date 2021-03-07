<?php
require_once '../database/database.php';
class Department
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }
    public function runQuery($sql)
    {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
    public function redirect($url)
    {
        header("Location: $url");
    }
    public function insert($dept_id, $dept_name)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "INSERT INTO department (dept_id, dept_name) VALUES(:dept_id,:dept_name)");
            $stmt->bindparam(":dept_id", $dept_id);
            $stmt->bindparam(":dept_name", $dept_name);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($dept_id, $dept_name)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "UPDATE department SET dept_name = :dept_name WHERE dept_id = :dept_id");
            $stmt->bindparam(":dept_id", $dept_id);
            $stmt->bindparam(":dept_name", $dept_name);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($dept_id)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "DELETE FROM department WHERE dept_id = :dept_id");
            $stmt->bindValue(":dept_id", $dept_id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
