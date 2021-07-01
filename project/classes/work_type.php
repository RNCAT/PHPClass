<?php
require_once '../database/database.php';
class WorkType
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
    public function insert($work_type_id, $work_type_name)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "INSERT INTO work_type (work_type_id, work_type_name) VALUES(:work_type_id,:work_type_name)");
            $stmt->bindparam(":work_type_id", $work_type_id);
            $stmt->bindparam(":work_type_name", $work_type_name);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($work_type_id, $work_type_name)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "UPDATE work_type SET work_type_name = :work_type_name WHERE work_type_id = :work_type_id");
            $stmt->bindparam(":work_type_id", $work_type_id);
            $stmt->bindparam(":work_type_name", $work_type_name);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($work_type_id)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "DELETE FROM work_type WHERE work_type_id = :work_type_id");
            $stmt->bindValue(":work_type_id", $work_type_id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
