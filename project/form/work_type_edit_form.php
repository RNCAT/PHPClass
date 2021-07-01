<?php
include_once '../templates/header.php';
require_once '../classes/work_type.php';
$objWorkType = new WorkType();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_POST["submit"])) {
    $work_type_id = strip_tags($_POST["work_type_id"]);
    $work_type_name = strip_tags($_POST["work_type_name"]);
    if (isset($_POST["edit"])) {
        if ($objWorkType->update($work_type_id, $work_type_name)) {
            header('Location: ../table/work_type.php');
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
                            <h3 style="text-align: center;">แก้ไขประเภทงาน</h3>
                            <div class="d-grid gap-1">
                                <label for="work_type_id">รหัสประเภทงาน:</label>
                                <input type="text" name="work_type_id" id="work_type_id" value="<?php echo $work_type_id; ?>">
                            </div><br>
                            <div class="d-grid gap-1">
                                <label for="work_type_name">ชื่อประเภทงาน:</label>
                                <input type="text" name="work_type_name" id="work_type_name" value="<?php echo $work_type_name; ?>">
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