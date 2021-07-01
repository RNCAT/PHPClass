<?php
require_once '../database/database.php';
class EmpType
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
    public function insert($emp_type_id, $emp_type)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "INSERT INTO emp_type (emp_type_id, emp_type) VALUES(:emp_type_id,:emp_type)");
            $stmt->bindparam(":emp_type_id", $emp_type_id);
            $stmt->bindparam(":emp_type", $emp_type);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($emp_type_id, $emp_type)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "UPDATE emp_type SET emp_type = :emp_type WHERE emp_type_id = :emp_type_id");
            $stmt->bindparam(":emp_type_id", $emp_type_id);
            $stmt->bindparam(":emp_type", $emp_type);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($emp_type_id)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "DELETE FROM emp_type WHERE emp_type_id = :emp_type_id");
            $stmt->bindValue(":emp_type_id", $emp_type_id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
