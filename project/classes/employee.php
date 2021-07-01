<?php
require_once '../database/database.php';
class Employee
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
    public function insert($emp_id, $emp_name, $gender, $dept_id, $work_type_id, $emp_type_id)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "INSERT INTO employee (emp_id, emp_name, gender, dept_id, work_type_id, emp_type_id) 
                                                            VALUES(:emp_id,:emp_name,:gender,:dept_id,:work_type_id,:emp_type_id)");
            $stmt->bindparam(":emp_id", $emp_id);
            $stmt->bindparam(":emp_name", $emp_name);
            $stmt->bindparam(":gender", $gender);
            $stmt->bindparam(":dept_id", $dept_id);
            $stmt->bindparam(":work_type_id", $work_type_id);
            $stmt->bindparam(":emp_type_id", $emp_type_id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($emp_id, $emp_name, $gender, $dept_id, $work_type_id, $emp_type_id)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "UPDATE employee 
            SET emp_name = :emp_name, 
                gender = :gender, 
                dept_id = :dept_id, 
                work_type_id = :work_type_id, 
                emp_type_id = :emp_type_id
            WHERE emp_id = :emp_id");
            $stmt->bindparam(":emp_id", $emp_id);
            $stmt->bindparam(":emp_name", $emp_name);
            $stmt->bindparam(":gender", $gender);
            $stmt->bindparam(":dept_id", $dept_id);
            $stmt->bindparam(":work_type_id", $work_type_id);
            $stmt->bindparam(":emp_type_id", $emp_type_id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($emp_id)
    {
        try {
            $stmt = $this->conn->prepare(
            /** @lang text */
            "DELETE FROM employee WHERE emp_id = :emp_id");
            $stmt->bindValue(":emp_id", $emp_id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
