<?php
include_once '../templates/header.php';
require_once '../classes/employee.php';
$objUser = new Employee();

if (!isset($_SESSION['username'])) {
    header('Location: index.php');
}

if (isset($_POST["submit"])) {
    $emp_id = strip_tags($_POST["emp_id"]);
    $emp_name = strip_tags($_POST["emp_name"]);
    $gender = strip_tags($_POST["gender"]);
    $dept_id = strip_tags($_POST["dept_id"]);
    $work_type_id = strip_tags($_POST["work_type_id"]);
    $emp_type_id = strip_tags($_POST["emp_type_id"]);
    if (isset($_POST["edit"])) {
        if ($objUser->update($emp_id, $emp_name, $gender, $dept_id, $work_type_id, $emp_type_id)) {
            header('Location: ../table/employee.php');
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
                            <h3 style="text-align: center;">แก้ไขข้อมูลพนักงาน</h3>
                            <input type="text" name="emp_id" id="emp_id" value="<?php echo $emp_id; ?>" hidden>
                            <div class="d-grid gap-1">
                                <label for="emp_name">ชื่อพนักงาน:</label>
                                <input type="text" name="emp_name" id="emp_name" value="<?php echo $emp_name; ?>" autofocus>
                            </div><br>
                            <label for="gender">เพศ:</label>

                            <div class="form-check">
                                <label class="form-check-label" for="genderM">ชาย</label>
                                <input class="form-check-input" type="radio" name="gender" id="genderM" value="m" <?php if ($gender == "m") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label" for="genderF">หญิง</label>
                                <input class="form-check-input" type="radio" name="gender" id="genderF" value="f" <?php if ($gender == "f") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                            </div><br>
                            <label for="dept_id">รหัสแผนก:</label>
                            <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="dept_id">
                                <?php
                                $sql = "SELECT dept_id, dept_name FROM department";
                                $stmt = $objUser->runQuery($sql);
                                $stmt->execute();
                                $dept = $stmt->fetchAll(PDO::FETCH_OBJ);
                                foreach ($dept as $dept) :
                                ?>
                                    <option value="<?php echo $dept->dept_id . '"' ?> <?php if ($dept->dept_id == $dept_id) {
                                                                                            echo "selected";
                                                                                        } ?> <?php echo '>' . $dept->dept_name ?></option>
                        <?php endforeach; ?>
                        </select><br>
                        <label for=" work_type_id">work_type_id:</label>
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="work_type_id">
                                            <?php
                                            $sql = "SELECT work_type_id, work_type_name FROM work_type";
                                            $stmt = $objUser->runQuery($sql);
                                            $stmt->execute();
                                            $work = $stmt->fetchAll(PDO::FETCH_OBJ);
                                            foreach ($work as $work) :
                                            ?>
                                                <option value="<?php echo $work->work_type_id . '"' ?> <?php if ($work->work_type_id == $work_type_id) {
                                                                                                            echo "selected";
                                                                                                        } ?> <?php echo '>' .  $work->work_type_name; ?></option>
                        <?php endforeach; ?>
                        </select><br>
                        <label for=" emp_type_id">emp_type_id:</label>
                                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="emp_type_id">
                                                        <?php
                                                        $sql = "SELECT emp_type_id, emp_type FROM emp_type";
                                                        $stmt = $objUser->runQuery($sql);
                                                        $stmt->execute();
                                                        $emp = $stmt->fetchAll(PDO::FETCH_OBJ);
                                                        foreach ($emp as $emp) :
                                                        ?>
                                                            <option value="<?php echo $emp->emp_type_id . '"' ?> <?php if ($emp->emp_type_id == $emp_type_id) {
                                                                                                                        echo "selected";
                                                                                                                    } ?> <?php echo '>' . $emp->emp_type; ?></option>
                            <?php endforeach; ?>
                        </select><br>
                        <div class=" d-grid gap-1">
                                                                <input type="submit" name="submit" value="แก้ไขข้อมูล" class="btn btn-primary btn-block">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
    </div>
</body>