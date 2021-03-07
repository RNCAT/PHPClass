<?php
require_once '../classes/emp_type.php';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}
$objEmpType = new EmpType();
$sql = "SELECT * FROM emp_type";
$stmt = $objEmpType->runQuery($sql);
$stmt->execute();
$emp_type = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST["submit"])) {
    if (isset($_POST['emp_type_id'])) {
        $objEmpType->delete($_POST['emp_type_id']);
    }
    header('Location: emp_type.php');
}
?>

<div class="container" style="margin-top: 10%;">
    <div class="row">
        <div class="col-md-3 col-sm-1"></div>
        <div class="col-md-6 col-sm-1">
            <div class="card">
                <h2 style="text-align: center; margin: 20px;">ประเภทพนักงาน</h2>
                <div class="card-body">
                    <table class="display" id="emptype" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ชื่อประเภทพนักงาน</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($emp_type as $emp_type) : ?>
                                <tr>
                                    <th scope="row"><?php echo $emp_type->emp_type_id ?></th>
                                    <td><?php echo $emp_type->emp_type ?></td>
                                    <td>
                                        <form method="post" action="../form/emp_type_edit_form.php" style="display: inline">
                                            <input type="text" id="emp_type_id" name="emp_type_id" value="<?php echo $emp_type->emp_type_id ?>" hidden>
                                            <input type="text" id="emp_type" name="emp_type" value="<?php echo $emp_type->emp_type ?>" hidden>
                                            <input type="submit" name="submit" class="btn btn-warning" value="แก้ไข">
                                        </form>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delEmpType<?php echo $emp_type->emp_type_id ?>">ลบ</button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="delEmpType<?php echo $emp_type->emp_type_id ?>" tabindex="-1" aria-labelledby="delEmpTypeLabel<?php echo $emp_type->emp_type_id ?>" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="delEmpTypeLabel<?php echo $emp_type->emp_type_id ?>">ลบข้อมูลประเภทพนักงาน <b><?php echo $emp_type->emp_type ?></b> ?</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-footer">
                                                <form method="post" action="" style="display: inline">
                                                    <input type="text" id="emp_type_id" name="emp_type_id" value="<?php echo $emp_type->emp_type_id ?>" hidden>
                                                    <input type="submit" name="submit" class="btn btn-danger" value="ลบ">
                                                </form>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="../form/emp_type_form.php" class="btn btn-outline-primary">เพิ่มประเภทพนักงาน</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-1"></div>
    </div>
</div>





<script>
    $(document).ready(function() {
        $('#emptype').DataTable()
    })
</script>