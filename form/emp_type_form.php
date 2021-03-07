<?php
include_once '../templates/header.php';
require_once '../classes/emp_type.php';
$objEmpType = new EmpType();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_POST["submit"])) {
    $emp_type_id = strip_tags($_POST["emp_type_id"]);
    $emp_type = strip_tags($_POST["emp_type"]);
    if ($objEmpType->insert($emp_type_id, $emp_type)) {
        header('Location: ../table/emp_type.php');
    }
}
?>

<body>
    <div class="container" style="margin-top: 10%">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <h3 style="text-align: center;">เพิ่มประเภทพนักงาน</h3>
                            <div class="d-grid gap-1">
                                <label for="emp_type_id">รหัสประเภทพนักงาน:</label>
                                <input type="text" name="emp_type_id" id="emp_type_id">
                            </div><br>
                            <div class="d-grid gap-1">
                                <label for="emp_type">ชื่อประเภทพนักงาน:</label>
                                <input type="text" name="emp_type" id="emp_type">
                            </div><br>
                            <div class="d-grid gap-1">
                                <input type="submit" name="submit" value="เพิ่มข้อมูล" class="btn btn-primary btn-block">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>