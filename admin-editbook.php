<?php
require("dbConn.php");
session_start();

if (!$_SESSION['login']) {
    header("location: /qnumber/index.php");
    exit;
} else {
    $typeid = $_GET["typeid"];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขประเภท</title>

    <link rel="stylesheet" href="css/ss3.css">
    <link rel="stylesheet" href="/myqnumber/lib/bootstrap-5.0.1-dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">

    <link rel="shortcut icon" type="image/x-icon" href="img/ku-logo1.png" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300&family=Shadows+Into+Light&display=swap" rel="stylesheet">


    <style>
        body {
            background: linear-gradient(to right,
                    #164A41, #4D774E, #9DC88D);
            font-family: 'Sarabun', sans-serif;
        }
    </style>

</head>

<body>
    <!-- ส่วน Section -->
    <section class="min-vh-100">

        <!-- หัวบนสุด -->
        <header class="py-1 mb-3 border-bottom bg-light">
            <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">

                <a class="navbar-brand" href="#">
                    <span class="text-success fw-bold">KU </span><span class="fw-bold" style="color:OliveDrab;">SRC</span>
                </a>

                <div class="d-flex align-items-center justify-content-end">
                    <div class="flex-shrink-0 dropdown ">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">

                            <?php
                            echo '<img src="' . $_SESSION["user_image"] . '" class="rounded-circle img-responsive img-circle " width="32" height="32" /> &nbsp;';
                            echo  $_SESSION['user_first_name'];
                            ?>

                        </a>
                        <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i>
                                    สถานะ : <?php
                                            if ($_SESSION['statusfor'] == 'user') {
                                                echo "ผู้ใช้";
                                            }
                                            if ($_SESSION['statusfor'] == 'admin') {
                                                echo "แอดมิน";
                                            }
                                            ?>
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="logout.php" onclick="return confirm('คุณต้องการออกจากระบบใช่หรือไม่?')"><i class="fas fa-sign-out-alt me-2"></i>ออกจากระบบ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <!-- ล่างหัวบน -->
        <div class="container col-lg-9 p-3">
            <div class="ku-header p-1 pb-md-4 mx-auto text-center">
                <div class="display-5 fw-normal text-white">ระบบออกเลขหนังสือราชการ</div>
            </div>
        </div>

        <!-- แถบเมนู -->
        <div class="container col-lg-9 alert-secondary">
            <header class="p-3 mb-1 mt-1 border-bottom alert-secondary">
                <div class="container">
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li><a href="admin-home.php" class="nav-link px-2 link-secondary">หน้าแรก</a></li>
                        <li><a href="admin-form.php" class="nav-link px-2 link-dark">กรอกขอเลข</a></li>
                        <li><a href="admin-reform.php" class="nav-link px-2 link-dark">กรอกย้อนหลัง</a></li>
                        <div class="C_nav3">
                            <li><a href="admin-booktype.php" class="nav-link px-2 link-dark">ประเภทหนังสือ</a></li>
                        </div>
                        <li><a href="admin-users.php" class="nav-link px-2 link-dark">จัดการสมาชิก</a></li>
                    </ul>
                </div>
            </header>
        </div>

        <!-- เนื้อหา -->
        <div class="container col-lg-9 mb-3 bg-light p-3 pt-4 pb-4">

            <!-- การ์ด -->
            <div class="card ">
                <div class="card-header">
                    <h3>แก้ไขประเภทหนังสือ</h3>
                </div>
                <div class="card-body ps-4 pe-4">

                    <!-- ฟอร์ม2 -->
                    <form action="edit-book-update.php" method="POST" enctype="multipart/form-data">
                        <?php
                        $selectuser = "select * from type where TypeID = '" . $typeid . "'";
                        $reql = $db->query($selectuser);
                        $rowuser = $reql->fetch_assoc();
                        ?>

                        <input type="text" name="typeid" hidden value="<?php echo $rowuser["TypeID"]; ?>">

                        <div class="row g-3">
                            <div class="container">

                            </div>

                            <div class="container">
                                <div class="col-lg-12">
                                    <label for="Name">ชื่อประเภท :</label>
                                    <input type="text" class="form-control mt-1" id="Name" name="Name" value="<?php echo $rowuser["Name"]; ?>">
                                </div>
                            </div>

                            <div class="container">
                                <div class="col-lg-12">

                                    <label for="TypeNumber">เลข อว :</label>
                                    <input type="text" class="form-control mt-1" id="TypeNumber" name="TypeNumber" value="<?php echo $rowuser['TypeNumber']; ?>">
                                </div>
                            </div>

                            <div class="container">
                                <div class="col-lg-12">

                                    <label for="current_number">เลขเริ่มต้น :</label>
                                    <input type="number " class="form-control mt-1" id="current_number" name="current_number" value="<?php echo $rowuser['current_number']; ?>">
                                </div>
                            </div>

                            <div class="container mb-3">
                                <div class="col-lg-12">
                                    <label for="current_year">ปีปัจจุบัน :</label>
                                    <input type="text" class="form-control mt-1" id="current_year" name="current_year" value="<?php echo $rowuser['current_year']; ?>">

                                </div>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="row gy-3 mb-3">
                            <div class="d-flex col-12 justify-content-center">
                                <input type="submit" class="btn btn-success me-3" name="submit" value="ตกลง">
                                <a href="admin-booktype.php" class="btn btn-danger ms-3">ยกเลิก</a>
                            </div>
                        </div>

                    </form>

                </div>
                <div class="card-footer text-muted">

                </div>
            </div>



        </div>



        <!-- จบ Section -->
    </section>








    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="/myqnumber/lib/bootstrap-5.0.1-dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('.mydatatable').DataTable();
    </script>




</body>


<!-- FOOTER -->
<footer class="my-5 pt-4 container">
    <p class="float-end"><a class="FBtoT" href="#">Back to top</a></p>
    &copy; 2017–2021 Company, Inc. </>
</footer>

</html>