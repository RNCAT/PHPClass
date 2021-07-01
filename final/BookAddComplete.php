<?php
require_once './classes/books.php';
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

if ($Books->insert($CategoryID, $AuthorID, $PublisherID, $BookName, $BookDescription, $BookPrice, $BookStatus, $BookISBN, $BookNumPages)) {
    $Books->redirect("BookList.php");
}
