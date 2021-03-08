<?php
require_once '../classes/employee.php';
require_once '../templates/header.php';
require_once '../templates/navbar.php';
if (!isset($_SESSION['username'])) {
    header('Location: ../index.php');
}
$objEmp = new Employee();
$sql = "SELECT * FROM employee e
            INNER JOIN department d ON e.dept_id = d.dept_id
            INNER JOIN work_type wt ON e.work_type_id = wt.work_type_id
            INNER JOIN emp_type et ON e.emp_type_id = et.emp_type_id";
$stmt = $objEmp->runQuery($sql);
$stmt->execute();
$employee = $stmt->fetchAll(PDO::FETCH_OBJ);

if (isset($_POST["submit"])) {
    if (isset($_POST['emp_id'])) {
        $objEmp->delete($_POST['emp_id']);
    }
    header('Location: employee.php');
}
?>

<div class="container" style="margin-top: 5%;">
    <div class="row">
        <div class="col-md-2 col-sm-1"></div>
        <div class="col-md-8 col-sm-1">
            <div class="card">
                <h2 style="text-align: center; margin: 20px;">พนักงาน</h2>
                <div class="card-body">
                    <table class="display" id="employee" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ชื่อพนักงาน</th>
                                <th scope="col">เพศ</th>
                                <th scope="col">แผนก</th>
                                <th scope="col">ประเภทงาน</th>
                                <th scope="col">ประเภทพนักงาน</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($employee as $employee) : ?>
                                <tr>
                                    <th scope="row"><?php echo $employee->emp_id ?></th>
                                    <td><?php echo $employee->emp_name ?></td>
                                    <td><?php if ($employee->gender == "m") {
                                            echo "ชาย";
                                        } else {
                                            echo "หญิง";
                                        } ?></td>
                                    <td><?php echo $employee->dept_name ?></td>
                                    <td><?php echo $employee->work_type_name ?></td>
                                    <td><?php echo $employee->emp_type ?></td>
                                    <td>
                                        <form method="post" action="../form/emp_edit_form.php" style="display: inline">
                                            <input type="text" id="emp_id" name="emp_id" value="<?php echo $employee->emp_id ?>" hidden>
                                            <input type="text" id="emp_name" name="emp_name" value="<?php echo $employee->emp_name ?>" hidden>
                                            <input type="text" id="gender" name="gender" value="<?php echo $employee->gender ?>" hidden>
                                            <input type="text" id="dept_id" name="dept_id" value="<?php echo $employee->dept_id ?>" hidden>
                                            <input type="text" id="work_type_id" name="work_type_id" value="<?php echo $employee->work_type_id ?>" hidden>
                                            <input type="text" id="emp_type_id" name="emp_type_id" value="<?php echo $employee->emp_type_id ?>" hidden>
                                            <input type="submit" name="submit" class="btn btn-warning" value="แก้ไข">
                                        </form>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delEmp<?php echo $employee->emp_id ?>">ลบ</button>

                                        <div class="modal fade" id="delEmp<?php echo $employee->emp_id ?>" tabindex="-1" aria-labelledby="delEmpLabel<?php echo $employee->emp_id ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="delEmpLabel<?php echo $employee->emp_id ?>">ลบข้อมูลพนักงาน <b><?php echo $employee->emp_name ?></b> ?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="post" action="" style="display: inline">
                                                            <input type="text" id="emp_id" name="emp_id" value="<?php echo $employee->emp_id ?>" hidden>
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
                    <a href="../form/emp_form.php" class="btn btn-outline-primary">เพิ่มพนักงาน</a>
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-1"></div>
    </div>
</div>



<script>
    $(document).ready(function() {
        $('#employee').DataTable()
    })
</script>