<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once './classes/user.php';
$objUser = new User();
include_once 'templates/header.php';
if (isset($_SESSION['username'])) {
    $objUser->redirect('pen_index.php');
}
if (isset($_POST["submit"])) {
    $username = strip_tags($_POST["username"]);
    $password = strip_tags($_POST["password"]);
    try {
        $sql = "SELECT * FROM users WHERE username = ?";
        $stmt = $objUser->runQuery($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if (password_verify($password, $user['password'])) {
            $username = $user['username'];
            $_SESSION['username'] = $username;
            $objUser->redirect('pen_index.php');
        } else {
            $objUser->redirect('index.php');
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}


?>

<body>
    <div class="container" style="margin-top: 10%;">
        <div class="row">
            <div class="col"></div>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="" method="post">
                            <h3 style="text-align: center; margin-bottom: 20px;">TUS CONTROL PEN</h3>
                            <div class="d-grid gap-1">
                                <label for="username">ชื่อผู้ใช้:</label>
                                <input type="text" name="username" id="username" autofocus required>
                            </div>
                            <div class="d-grid gap-1">
                                <label for="password">รหัสผ่าน:</label>
                                <input type="password" name="password" id="password" required>
                            </div><br>
                            <div class="d-grid gap-1">
                                <input type="submit" name="submit" value="เข้าสู่ระบบ" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </div>
</body>