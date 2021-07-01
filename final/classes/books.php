<?php
require_once './config/database.php';

class Book
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

    public function insert($CategoryID, $AuthorID, $PublisherID, $BookName, $BookDescription, $BookPrice, $BookStatus, $BookISBN, $BookNumPages)
    {
        try {
            $stmt = $this->conn->prepare(
                /** @lang text */
                "INSERT INTO books (CategoryID, AuthorID, PublisherID, BookName, BookDescription, BookPrice, BookStatus, BookISBN, BookNumPages) 
                                                            VALUES(:CategoryID,:AuthorID,:PublisherID,:BookName,:BookDescription,:BookPrice, :BookStatus, :BookISBN, :BookNumPages)"
            );
            $stmt->bindparam(":CategoryID", $CategoryID);
            $stmt->bindparam(":AuthorID", $AuthorID);
            $stmt->bindparam(":PublisherID", $PublisherID);
            $stmt->bindparam(":BookName", $BookName);
            $stmt->bindparam(":BookDescription", $BookDescription);
            $stmt->bindparam(":BookPrice", $BookPrice);
            $stmt->bindparam(":BookStatus", $BookStatus);
            $stmt->bindparam(":BookISBN", $BookISBN);
            $stmt->bindparam(":BookNumPages", $BookNumPages);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function update($CategoryID, $AuthorID, $PublisherID, $BookName, $BookDescription, $BookPrice, $BookStatus, $BookISBN, $BookNumPages, $BookId)
    {
        try {
            $stmt = $this->conn->prepare(
                /** @lang text */
                "UPDATE books 
                SET CategoryID = :CategoryID, 
                    AuthorID = :AuthorID, 
                    PublisherID = :PublisherID, 
                    BookName = :BookName, 
                    BookDescription = :BookDescription,
                    BookPrice = :BookPrice,
                    BookStatus = :BookStatus,
                    BookISBN = :BookISBN,
                    BookNumPages = :BookNumPages
                WHERE BookId = :BookId"
            );
            $stmt->bindparam(":CategoryID", $CategoryID);
            $stmt->bindparam(":AuthorID", $AuthorID);
            $stmt->bindparam(":PublisherID", $PublisherID);
            $stmt->bindparam(":BookName", $BookName);
            $stmt->bindparam(":BookDescription", $BookDescription);
            $stmt->bindparam(":BookPrice", $BookPrice);
            $stmt->bindparam(":BookStatus", $BookStatus);
            $stmt->bindparam(":BookISBN", $BookISBN);
            $stmt->bindparam(":BookNumPages", $BookNumPages);
            $stmt->bindparam(":BookId", $BookId);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function delete($BookId)
    {
        try {
            $stmt = $this->conn->prepare(
                /** @lang text */
                "DELETE FROM books WHERE BookId = :BookId"
            );
            $stmt->bindValue(":BookId", $BookId);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
