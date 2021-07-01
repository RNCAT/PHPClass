<?php
require_once './classes/books.php';
require_once './templates/header.php';

$Books = new Book();
$sql = "SELECT BookId, BookName, AuthorName, CategoryName, PublisherName, BookStatus, IF(BookStatus = 1, 'ปกติ', 'เลิกจำหน่าย') AS BookStatusRes, BookDescription, BookPrice, BookNumPages, BookISBN FROM books b
        INNER JOIN categories c ON b.CategoryID = c.CategoryID
        INNER JOIN authors a ON b.AuthorID = a.AuthorID
        INNER JOIN publishers p ON b.PublisherID = p.PublisherID
        WHERE BookId = :BookId";

$stmt = $Books->runQuery($sql);
$stmt->bindparam(":BookId", $_GET['BookId']);
$stmt->execute();
$book = $stmt->fetch(PDO::FETCH_OBJ);

$sql = "SELECT CategoryID, CategoryName FROM categories";
$stmt = $Books->runQuery($sql);
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_OBJ);

$sql = "SELECT AuthorID, AuthorName FROM authors";
$stmt = $Books->runQuery($sql);
$stmt->execute();
$authors = $stmt->fetchAll(PDO::FETCH_OBJ);

$sql = "SELECT PublisherID, PublisherName FROM publishers";
$stmt = $Books->runQuery($sql);
$stmt->execute();
$publishers = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ข้อมูลหนังสือ</h5>
                    <form action="BookEditComplete.php" method="post">
                        <input type="hidden" class="form-control" name="BookId" value="<?= $_GET['BookId'] ?>">
                        <div class="mb-3">
                            <label for="BookName" class="form-label">ชื่อหนังสือ</label>
                            <input type="text" class="form-control" name="BookName" value="<?= $book->BookName ?>">
                        </div>
                        <div class="mb-3">
                            <label for="CategoryID" class="form-label">ประเภทหนังสือ</label>
                            <select class="form-select" name="CategoryID">
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?= $category->CategoryID ?>"><?= $category->CategoryName ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="AuthorID" class="form-label">ผู้แต่ง</label>
                            <select class="form-select" name="AuthorID">
                                <?php foreach ($authors as $author) { ?>
                                    <option value="<?= $author->AuthorID ?>"><?= $author->AuthorName ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="PublisherID" class="form-label">สำนักพิมพ์</label>
                            <select class="form-select" name="PublisherID">
                                <?php foreach ($publishers as $publisher) { ?>
                                    <option value="<?= $publisher->PublisherID ?>"><?= $publisher->PublisherName ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="BookDescription" class="form-label">คำอธิบาย</label>
                            <textarea class="form-control" name="BookDescription" rows="5"><?= $book->BookDescription ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="BookPrice" class="form-label">ราคา</label>
                            <input type="text" class="form-control" name="BookPrice" value="<?= $book->BookPrice ?>">
                        </div>
                        <div class="mb-3">
                            <label for="BookNumPages" class="form-label">จำนวนหน้า</label>
                            <input type="text" class="form-control" name="BookNumPages" value="<?= $book->BookNumPages ?>">
                        </div>
                        <div class="mb-3">
                            <label for="BookISBN" class="form-label">ISBN</label>
                            <input type="text" class="form-control" name="BookISBN" value="<?= $book->BookISBN ?>">
                        </div>
                        <div class="mb-3">
                            <label for="BookStatus" class="form-label">จำนวนหน้า</label>
                            <?php if ($book->BookStatus == 1) { ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="BookStatus" value="1" checked>
                                    <label class="form-check-label" for="BookStatus">ปกติ</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="BookStatus" value="0">
                                    <label class="form-check-label" for="BookStatus">เลิกจำหน่าย</label>
                                </div>
                            <?php } else { ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="BookStatus" value="1">
                                    <label class="form-check-label" for="BookStatus">ปกติ</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="BookStatus" value="0" checked>
                                    <label class="form-check-label" for="BookStatus">เลิกจำหน่าย</label>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="mb-3">
                            <input type="submit" class="btn btn-success" value="บันทึก">
                            <a href="BookList.php" class="btn btn-danger">ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>

</div>