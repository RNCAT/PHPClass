<?php
require_once './classes/books.php';
require_once './templates/header.php';

$Books = new Book();

$CategoryID = strip_tags($_POST["CategoryID"]);
$AuthorID = strip_tags($_POST["AuthorID"]);
$PublisherID = strip_tags($_POST["PublisherID"]);
$BookName = strip_tags($_POST["BookName"]);
$BookDescription = strip_tags($_POST["BookDescription"]);
$BookPrice = strip_tags($_POST["BookPrice"]);
$BookStatus = strip_tags($_POST["BookStatus"]);
$BookISBN = strip_tags($_POST["BookISBN"]);
$BookNumPages = strip_tags($_POST["BookNumPages"]);
$BookId = strip_tags($_POST["BookId"]);
$Books->update($CategoryID, $AuthorID, $PublisherID, $BookName, $BookDescription, $BookPrice, $BookStatus, $BookISBN, $BookNumPages, $BookId);

$sql = "SELECT BookId, BookName, AuthorName, CategoryName, PublisherName, BookStatus, IF(BookStatus = 1, 'ปกติ', 'เลิกจำหน่าย') AS BookStatusRes, BookDescription, BookPrice, BookNumPages, BookISBN FROM books b
    INNER JOIN categories c ON b.CategoryID = c.CategoryID
    INNER JOIN authors a ON b.AuthorID = a.AuthorID
    INNER JOIN publishers p ON b.PublisherID = p.PublisherID
    WHERE BookId = :BookId";
$stmt = $Books->runQuery($sql);
$stmt->bindparam(":BookId", $BookId);
$stmt->execute();
$book = $stmt->fetch(PDO::FETCH_OBJ);



?>

<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ข้อมูลหนังสือ</h5>
                    <form action="BookEditComplete.php" method="post">
                        <div class="mb-3">
                            <label class="form-label">ชื่อหนังสือ</label>
                            <input type="text" class="form-control" value="<?= $book->BookName ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ผู้แต่ง</label>
                            <input type="text" class="form-control" value="<?= $book->AuthorName ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ประเภทหนังสือ</label>
                            <input type="text" class="form-control" value="<?= $book->CategoryName ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">สำนักพิมพ์</label>
                            <input type="text" class="form-control" value="<?= $book->PublisherName ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">คำอธิบาย</label>
                            <textarea class="form-control" rows="5" readonly><?= $book->BookDescription ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ราคา</label>
                            <input type="text" class="form-control" value="<?= $book->BookPrice ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">สถานะการขาย</label>
                            <input type="text" class="form-control" value="<?= $book->BookStatusRes ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">ISBN</label>
                            <input type="text" class="form-control" value="<?= $book->BookISBN ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">จำนวนหน้า</label>
                            <input type="text" class="form-control" value="<?= $book->BookNumPages ?>" readonly>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</div>