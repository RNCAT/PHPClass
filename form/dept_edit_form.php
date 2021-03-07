<?php
include_once '../templates/header.php';
require_once '../classes/department.php';
$objDept = new Department();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_POST["submit"])) {
    $dept_id = strip_tags($_POST["dept_id"]);
    $dept_name = strip_tags($_POST["dept_name"]);

    if (isset($_POST["edit"])) {
        if ($objDept->update($dept_id, $dept_name)) {
            header('Location: .../table/department.php');
        }
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
                            <input type="hidden" name="edit" id="edit">
                            <h3 style="text-align: center;">แก้ไขแผนก</h3>
                            <div class="d-grid gap-1">
                                <label for="dept_id">รหัสแผนก:</label>
                                <input type="text" name="dept_id" id="dept_id" value="<?php echo $dept_id; ?>">
                            </div><br>
                            <div class="d-grid gap-1">
                                <label for="dept_name">ชื่อแผนก:</label>
                                <input type="text" name="dept_name" id="dept_name" value="<?php echo $dept_name; ?>">
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