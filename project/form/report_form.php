<?php
ini_set("allow_url_fopen", 1);
ob_start();
require_once '../vendor/autoload.php';
require_once '../classes/employee.php';
$objEmp = new Employee();
$sql = "SELECT * FROM employee e
            INNER JOIN department d ON e.dept_id = d.dept_id
            INNER JOIN work_type wt ON e.work_type_id = wt.work_type_id
            INNER JOIN emp_type et ON e.emp_type_id = et.emp_type_id";
$stmt = $objEmp->runQuery($sql);
$stmt->execute();
$employee = $stmt->fetchAll(PDO::FETCH_OBJ);
?>
<!DOCTYPE html>
<html>

<head>
    <title>PDF</title>
    <link href="https://fonts.googleapis.com/css?family=Sarabun&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: sarabun;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
    </style>
</head>

<body>
    <div class="container" style="margin-top: 5%;">
        <h3 style="text-align: center; margin: 20px;">รายงานพนักงาน</h3>
        <table class="display" id="employee" style="width:100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ชื่อพนักงาน</th>
                    <th>เพศ</th>
                    <th>แผนก</th>
                    <th>ประเภทงาน</th>
                    <th>ประเภทพนักงาน</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employee as $employee) : ?>
                    <tr>
                        <th><?php echo $employee->emp_id ?></th>
                        <td><?php echo $employee->emp_name ?></td>
                        <td><?php if ($employee->gender == "m") {
                                echo "ชาย";
                            } else {
                                echo "หญิง";
                            } ?></td>
                        <td><?php echo $employee->dept_name ?></td>
                        <td><?php echo $employee->work_type_name ?></td>
                        <td><?php echo $employee->emp_type ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <?php
    $stmt = $objEmp->runQuery('SELECT COUNT(emp_id) AS emp_count FROM employee');
    $stmt->execute();
    $employee = $stmt->fetchColumn();
    ?>

    <p>พนักงาน : <b><?php echo $employee ?></b> คน</p>

    <?php
    $json = file_get_contents('http://localhost/tus-control_pen/graph_dept.php');
    $obj = json_decode($json);
    foreach ($obj as $obj) {
    ?>
        <p>แผนก <b><?php echo $obj->dept_name; ?></b> : <b><?php echo $obj->count_dept; ?></b> คน</p>
    <?php } ?>

    <?php
    $json = file_get_contents('http://localhost/tus-control_pen/graph_work_type.php');
    $obj = json_decode($json);
    foreach ($obj as $obj) {
    ?>
        <p>ประเภทงาน <b><?php echo $obj->work_type_name; ?></b> : <b><?php echo $obj->count_work; ?></b> คน</p>
    <?php } ?>

    <?php
    $json = file_get_contents('http://localhost/tus-control_pen/graph_emp_type.php');
    $obj = json_decode($json);
    foreach ($obj as $obj) {
    ?>
        <p>ประเภทพนักงาน <b><?php echo $obj->emp_type; ?></b> : <b><?php echo $obj->count_work; ?></b> คน</p>
    <?php } ?>

    <?php
    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];
    $mpdf = new \Mpdf\Mpdf([
        'fontDir' => array_merge($fontDirs, [
            '../fonts',
        ]),
        'fontdata' => $fontData + [
            'sarabun' => [
                'R' => 'Sarabun-Regular.ttf'
            ]
        ],
    ]);
    $html = ob_get_contents();

    ob_end_flush();
    ob_clean();
    $mpdf->WriteHTML($html);
    $mpdf->debug = true;
    $mpdf->Output();
    ?>