<?php
require_once '../classes/department.php';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}

$objDept = new Department();
$sql = "SELECT * FROM department";
$stmt = $objDept->runQuery($sql);
$stmt->execute();
$department = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST["submit"])) {
    if (isset($_POST['dept_id'])) {
        $objDept->delete(2);
        header('Location: department.php');
    }
}
?>

<div class="container" style="margin-top: 10%;">
    <div class="row">
        <div class="col-md-3 col-sm-1"></div>
        <div class="col-md-6 col-sm-1">
            <div class="card">
                <h2 style="text-align: center; margin: 20px;">แผนก</h2>
                <div class="card-body">
                    <table class="display" id="department" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ชื่อแผนก</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($department as $department) : ?>
                                <tr>
                                    <th scope="row"><?php echo $department->dept_id ?></th>
                                    <td><?php echo $department->dept_name ?></td>
                                    <td>
                                        <form method="post" action="../form/dept_edit_form.php" style="display: inline">
                                            <input type="text" id="dept_id" name="dept_id" value="<?php echo $department->dept_id ?>" hidden>
                                            <input type="text" id="dept_name" name="dept_name" value="<?php echo $department->dept_name ?>" hidden>
                                            <input type="submit" name="submit" class="btn btn-warning" value="แก้ไข">

                                        </form>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delDept<?php echo $department->dept_id ?>">ลบ</button>

                                        <div class="modal fade" id="delDept<?php echo $department->dept_id ?>" tabindex="-1" aria-labelledby="delDeptLabel<?php echo $department->dept_id ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delDeptLabel<?php echo $department->dept_id ?>">ลบข้อมูลแผนก <?php echo $department->dept_name ?> ?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post" action="" style="display: inline">
                                                            <input type="text" name="dept_id" value="<?php echo $department->dept_id ?>" hidden>
                                                            <input type="submit" name="submit" class="btn btn-danger" value="ลบ">
                                                        </form>
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>


                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="../form/dept_form.php" class="btn btn-outline-primary">เพิ่มแผนก</a>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-1"></div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#department').DataTable()
    })
</script>