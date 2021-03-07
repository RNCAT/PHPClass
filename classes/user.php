<?php
require_once './database/database.php';
class User
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
    public function insert($username, $password)
    {
        try {
            $stmt = $this->conn->prepare(
                /** @lang text */
                "INSERT INTO user (username, password)"
            );
            $stmt->bindparam(":username", $username);
            $stmt->bindparam(":password", password_hash($password, PASSWORD_BCRYPT));
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($user_id, $username, $password)
    {
        try {
            $stmt = $this->conn->prepare(
                /** @lang text */
                "UPDATE user SET username = :username, password = :password WHERE user_id = :user_id"
            );
            $stmt->bindparam(":user_id", $user_id);
            $stmt->bindparam(":username", $username);
            $stmt->bindparam(":password", password_hash($password, PASSWORD_BCRYPT));
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($user_id)
    {
        try {
            $stmt = $this->conn->prepare(
                /** @lang text */
                "DELETE FROM user WHERE user_id = :user_id"
            );
            $stmt->bindValue(":user_id", $user_id);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
