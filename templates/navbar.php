<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TUS CONTROL PEN</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../pen_index.php">หน้าแรก</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../table/employee.php">พนักงาน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../table/emp_type.php">ประเภทพนักงาน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../table/work_type.php">ประเภทงาน</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../table/department.php">แผนก</a>
                </li>
            </ul>
            <form class="d-flex">
                <a class="nav-link" style="color: white;">ชื่อผู้ใช้ : <?php echo $_SESSION['username'] ?></a>
                <a href="logout.php" class="btn btn-danger">ออกจากระบบ</a>
            </form>
        </div>
    </div>
</nav>