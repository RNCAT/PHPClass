<?php
session_start();
// if (!isset($_SESSION['username'])) {
//     header('Location: index.php');
// }
header('Content-Type: application/json');
include_once './classes/user.php';
$objUser1 = new User();
$stmt = $objUser1->runQuery('SELECT dept_name, COUNT(dept_name) AS count_dept FROM employee INNER JOIN department ON employee.dept_id = department.dept_id GROUP BY employee.dept_id');
$stmt->execute();
$employee = $stmt->fetchAll(PDO::FETCH_OBJ);
$data = array();

foreach ($employee as $employee) {
    $data[] = $employee;
}
echo json_encode($data,  JSON_UNESCAPED_UNICODE);
