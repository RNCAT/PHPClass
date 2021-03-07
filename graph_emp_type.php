<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}
header('Content-Type: application/json');
include_once './classes/user.php';
$objUser1 = new User();
$stmt = $objUser1->runQuery('SELECT emp_type, COUNT(emp_type) AS count_work FROM employee INNER JOIN emp_type ON employee.emp_type_id = emp_type.emp_type_id GROUP BY employee.emp_type_id');
$stmt->execute();
$employee = $stmt->fetchAll(PDO::FETCH_OBJ);
$data = array();

foreach ($employee as $employee) {
    $data[] = $employee;
}
echo json_encode($data,  JSON_UNESCAPED_UNICODE);
