<?php
session_start();
// if (!isset($_SESSION['username'])) {
//     header('Location: index.php');
// }
header('Content-Type: application/json');
include_once './classes/user.php';
$objUser1 = new User();
$stmt = $objUser1->runQuery('SELECT work_type_name, COUNT(work_type_name) AS count_work FROM employee INNER JOIN work_type ON employee.work_type_id = work_type.work_type_id GROUP BY employee.work_type_id');
$stmt->execute();
$employee = $stmt->fetchAll(PDO::FETCH_OBJ);
$data = array();

foreach ($employee as $employee) {
    $data[] = $employee;
}
echo json_encode($data,  JSON_UNESCAPED_UNICODE);
