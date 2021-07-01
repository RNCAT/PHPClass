<?php
require_once './classes/books.php';
$Books = new Book();

$BookId = strip_tags($_GET["BookId"]);

if ($Books->delete($BookId)) {
    $Books->redirect("BookList.php");
}
