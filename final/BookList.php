<?php
require_once './classes/books.php';
require_once './templates/header.php';

$Books = new Book();
$sql = "SELECT BookId, BookName, AuthorName, CategoryName, PublisherName, BookPrice, IF(BookStatus = 1, 'ปกติ', 'เลิกจำหน่าย') AS BookStatus   FROM books b
        INNER JOIN categories c ON b.CategoryID = c.CategoryID
        INNER JOIN authors a ON b.AuthorID = a.AuthorID
        INNER JOIN publishers p ON b.PublisherID = p.PublisherID
        ORDER BY b.BookId";
$stmt = $Books->runQuery($sql);
$stmt->execute();
$books = $stmt->fetchAll(PDO::FETCH_OBJ);

?>

<div class="container">
    <div class="row">
        <div class="col"></div>
        <div class="col-10">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">ข้อมูลหนังสือ</h5>
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="BookAdd.php" class="btn btn-outline-primary" style="margin: 5px;">เพิ่มหนังสือ</a>
                    </div>
                    <table class="table">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">ชื่อหนังสือ</th>
                                <th scope="col">ผู้แต่ง</th>
                                <th scope="col">ประเภทหนังสือ</th>
                                <th scope="col">สำนักพิมพ์</th>
                                <th scope="col">ราคา</th>
                                <th scope="col">สถานะการขาย</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($books as $book) { ?>
                                <tr>
                                    <th scope="row"><?= $book->BookName ?></th>
                                    <td><?= $book->AuthorName ?></td>
                                    <td><?= $book->CategoryName ?></td>
                                    <td><?= $book->PublisherName ?></td>
                                    <td><?= $book->BookPrice ?></td>
                                    <td><?= $book->BookStatus ?></td>
                                    <td><a href="BookEdit.php?BookId=<?= $book->BookId ?>" class="btn btn-outline-warning">แก้ไข</a></td>
                                    <td><button class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#del<?= $book->BookId ?>">ลบ</button></td>

                                    <div class="modal fade" id="del<?= $book->BookId ?>" tabindex="-1" aria-labelledby="delLabel<?= $book->BookId ?>" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="delLabel<?= $book->BookId ?>">ลบข้อมูลหนังสือ <b style="color: red;"><?= $book->BookName ?></b> ?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="BookDelete.php?BookId=<?= $book->BookId ?>" class="btn btn-outline-danger">ลบ</a>
                                                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">ยกเลิก</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>

</div>