<?php
require("dbConn.php");
session_start();
date_default_timezone_set("Asia/Bangkok");

if (!$_SESSION['login']) {
    header("location: /myqnumber/login.php");
    exit;
} else {
    $staruserid = $_GET["userid"];
    $_SESSION["userid"] = $staruserid;
    $year = (date("Y") + 543);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลสมาชิก</title>

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
                        <li><a href="admin-booktype.php" class="nav-link px-2 link-dark">ประเภทหนังสือ</a></li>
                        <div class="C_nav3">
                            <li><a href="admin-users.php" class="nav-link px-2 link-dark">จัดการสมาชิก</a></li>
                        </div>
                    </ul>
                </div>
            </header>
        </div>

        <!-- เนื้อหา -->
        <div class="container col-lg-9 mb-3 bg-light p-3 pt-4 pb-4">

            <!-- การ์ด -->
            <div class="card ">
                <div class="card-header">
                    <h3>แก้ไขข้อมูลสมาชิก</h3>
                </div>
                <div class="card-body ps-4 pe-4">

                    <!-- ฟอร์ม -->

                    <form class="needs-validation" action="admin-edituser-update.php" method="POST">
                        <div class="row g-3">
                            <?php
                            $selectuser = "select * from user where UserID = $staruserid";
                            $reql = $db->query($selectuser);
                            $rowuser = $reql->fetch_assoc();
                            $fullname = $rowuser["Name"];
                            $lastname = $rowuser["Surname"];
                            $email = $rowuser["Email"];
                            $phone = $rowuser["Phone"];
                            $status_user = $rowuser["Status"];

                            $selecttypeuse = "select TypeUseID from permission where UserID = $staruserid ";
                            $reqltype = $db->query($selecttypeuse);

                            $listusetype = array('');
                            while ($rowtypeuse = $reqltype->fetch_assoc()) {
                                array_push($listusetype, $rowtypeuse['TypeUseID']);
                            }


                            ?>
                            <div class="container">

                            </div>
                            <div class="container">

                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">ชื่อ</label>
                                    <input type="text" class="form-control" name="Name" id="firstName" value="<?php echo $fullname; ?>">
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">นามสกุล</label>
                                <input type="text" class="form-control" name="Surname" id="lastName" value="<?php echo $lastname; ?>">
                                <div class="invalid-feedback">
                                    Valid last name is required.
                                </div>
                            </div>


                            <div class="col-12">
                                <label for="email" class="form-label">Email </label>
                                <input type="email" class="form-control" name="Email" id="email" value="<?php echo $email; ?>" readonly>
                                <div class="invalid-feedback">
                                    Please enter a valid email address.
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="address" class="form-label">เบอร์โทรศัพท์</label>
                                <input type="text" class="form-control" name="Phone" id="address" value="<?php echo $phone; ?>" value="<?php echo $phone; ?>">
                                <div class="invalid-feedback">
                                    Please enter your phone number.
                                </div>
                            </div>

                        </div>

                        <hr class="my-4">

                        <h5 class="mb-3">สถานะ </h5>

                        <?php if ($status_user == 'admin') { ?>
                            <label class="container">
                                <input type="radio" class="btn-check" name="radio1" id="radio1" autocomplete="off" value="admin" checked="checked">
                                <label id="label1" class="btn btn-outline-success" for="radio1">Admin</label>

                                <input type="radio" class="btn-check" name="radio2" id="radio2" autocomplete="off" value="user">
                                <label id="label2" class="btn btn-outline-danger text-center " for="radio2"> <span class="p-1">User</span> </label>
                            </label><br>
                        <?php } else {
                        ?>
                            <input type="radio" class="btn-check" name="radio1" id="radio1" value="admin" autocomplete="off">
                            <label id="label1" class="btn btn-outline-success" for="radio1">Admin</label>

                            <input type="radio" class="btn-check" name="radio2" id="radio2" value="user" autocomplete="off" checked="checked">
                            <label id="label2" class="btn btn-outline-danger text-center " for="radio2"> <span class="p-1">User</span> </label>
                            </label><br>
                        <?php } ?>

                        <hr class="my-4">

                        <h5 class="mb-3">สิทธ์ประเภท</h5>
                        <?php
                        $selectuser = "select * from user where UserID = '" . $staruserid . "'";
                        $reql = $db->query($selectuser);
                        $rowuser = $reql->fetch_assoc();
                        $rowstatus = $rowuser['Status'];

                        if ($rowstatus == 'admin') {
                            echo '<div class="form-check" id="form-check" style="display:none">';
                        } else {
                            echo '<div class="form-check" id="form-check">';
                        }
                        ?>
                        <?php
                        $namearr = array('');
                        $typearr = array('');
                        $selectuser = "select * from type where Status= 1";
                        $reql = $db->query($selectuser);

                        while ($row = mysqli_fetch_array($reql)) {
                            array_push($namearr, $row['Name']);
                            array_push($typearr, $row['TypeID']);
                        }
                        $nameadd = count($namearr);
                        $checkbook = 1;
                        $start = 1;
                        while ($start < $nameadd) {
                            if (in_array($typearr[$start], $listusetype)) { ?>
                                <input class="form-check-input" type="checkbox" id="chk<?php echo $typearr[$start]; ?>" name="chk<?php echo $typearr[$start]; ?>" value="<?php echo $typearr[$start]; ?>" checked="checked">
                                <label class="form-check-label ps-1" for="flexCheckDefault"></label>
                            <?php echo $namearr[$start] . "<br>   ";
                            } else {
                            ?>
                                <input class="form-check-input" type="checkbox" id="chk<?php echo $typearr[$start]; ?>" name="chk<?php echo $typearr[$start]; ?>" value="<?php echo $typearr[$start]; ?>">
                                <label class="form-check-label ps-1" for="flexCheckDefault"></label>
                        <?php echo $namearr[$start] . "<br>   ";
                            }
                            $start += 1;
                        }
                        ?>
                </div>

                <hr class="my-4">

                <div class="row gy-3 mb-3">
                    <div class="d-flex col-12 justify-content-center">

                        <button class="btn btn-success me-3" type="submit">ตกลง</button>
                        <a href="admin-users.php" class="btn btn-danger ms-3">ยกเลิก</a>

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




    <!-- ส่วน Modal -->
    <div class="modal fade" id="view-detailModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">รายละเอียดเอกสาร</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" value="">

                    <label for="num">เลขเอกสาร</label>
                    <input type="text" name="num" id="num"><br>

                    <label for="sentname">ชื่อผู้ส่ง</label>
                    <input type="text" name="sentname" id="sentname"><br>

                    <label for="resvname">ชื่อผู้รับ</label>
                    <input type="text" name="resvname" id="resvname"><br>

                    <label for="text">เรื่อง</label>
                    <input type="text" name="text" id="text"><br>

                    <label for="status">สถานะ</label>
                    <input type="text" name="status" id="status"><br>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <script>
        var modal = document.getElementById("form-check");
        var label1 = document.getElementById("label1");
        var label2 = document.getElementById("label2");

        var radio1 = document.getElementById("radio1");
        var radio2 = document.getElementById("radio2");
        radio1.onclick = function() {
            radio1.checked = true;
            radio2.checked = false;
            modal.style.display = "none";
        }

        radio2.onclick = function() {
            radio1.checked = false;
            radio2.checked = true;
            modal.style.display = "block";
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="/myqnumber/lib/bootstrap-5.0.1-dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $('.mydatatable').DataTable();
    </script>

    <script type="text/javascript" src="viewmodal.js"></script>


</body>


<!-- FOOTER -->
<footer class="my-5 pt-4 container">
    <p class="float-end"><a class="FBtoT" href="#">Back to top</a></p>
    &copy; 2017–2021 Company, Inc. </>
</footer>

</html>