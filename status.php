<?php
session_start();
$status = '';
$id = '';
// echo '<pre>';
// print_r($_POST);
// echo '</pre>';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !isset($_POST['img'])) {

    require("conf/config_mysqli.php");
    (!empty($_POST['datatochek']) ? $datatochek = mysqli_real_escape_string($Connect, xss_cleaner($_POST['datatochek'])) : $datatochek = "");
    $result = checkdatacuplicate($datatochek);
    if ($result) {
        if ($result->num_rows > 0) {
            $dataResult = mysqli_fetch_array($result);
            $status = $dataResult['status'];
            $id = $dataResult['id'];
        } else {
            $status = '';
            $_SESSION['Message'] = 'ตรวจสอบไม่พบข้อมูล';
            $_SESSION['type'] = 'error';
        }
    } else {
        $status = '';
        $_SESSION['Message'] = 'ตรวจสอบไม่พบข้อมูล';
        $_SESSION['type'] = 'error';
    }
} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['img'])) {
    if (count($_POST)) {

        $img = explode('|', $_POST['img']);
        require("conf/config_mysqli.php");
        for ($i = 0; $i < count($img) - 1; $i++) {
            $database64 = $img[$i];
            $sql = "UPDATE registers SET image='" . $database64 . "' ,status=2 WHERE id= " . $_POST["id"];
            if (strpos($img[$i], 'data:image/jpeg;base64,') === 0) {
                $database64 = $img[$i] = str_replace('data:image/jpeg;base64,', '', $img[$i]);
                $ext = '.jpg';
            }
            if (strpos($img[$i], 'data:image/png;base64,') === 0) {
                $database64 = $img[$i] = str_replace('data:image/png;base64,', '', $img[$i]);
                $ext = '.png';
            }
            $img[$i] = str_replace(' ', '+', $img[$i]);
            $data = base64_decode($img[$i]);
            $file = 'uploads/img' . date("YmdHis") . '_' . $i . $ext;


            $result = $Connect->query($sql);

            if ($result) {
                $_SESSION['Message'] = 'อัพโหลดรูปภาพสำเร็จแล้ว';
                $_SESSION['type'] = 'success';
            } else {
                $_SESSION['Message'] = 'ไม่สามารถอัพโหลดรูปภาพได้';
                $_SESSION['type'] = 'error';
            }$Connect->close();

            file_put_contents($file, $data);
        }
    }
}

function checkdatacuplicate($datatochek) {
    require("conf/config_mysqli.php");
    $sql = "SELECT * from registers where member_id = '" . $datatochek . "' or phone = '" . $datatochek . "' or certificate_id = '" . $datatochek . "'";
    $result = $Connect->query($sql);
    $count = 0;
    if ($result->num_rows > 0) {
        $Connect->close();
        return $result;
    }
    $Connect->close();
}

// Cross Site Script  & Code Injection Sanitization
function xss_cleaner($input_str) {
    $return_str = str_replace(array('<', ';', '|', '&', '>', "'", '"', ')', '('), array('&lt;', '&#58;', '&#124;', '&#38;', '&gt;', '&apos;', '&#x22;', '&#x29;', '&#x28;'), $input_str);
    $return_str = str_ireplace('%3Cscript', '', $return_str);
    return $return_str;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ตรวจสอบสถานะ | ชมรมเครือข่ายพยาบาลผู้ให้สารน้ำแห่งประเทศไทย</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <meta name="description" content="ชมรมเครือข่ายพยาบาลผู้ให้สารน้ำแห่งประเทศไทย">
        <meta name="keywords" content="thaiivnetwork,IV,สารน้ำ,เครือข่ายพยาบาล,ชมรมเครือข่ายพยาบาลผู้ให้สารน้ำแห่งประเทศไทย">
        <meta name="author" content="ชมรมเครือข่ายพยาบาลผู้ให้สารน้ำแห่งประเทศไทย">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <!-- FontAwesome CSS -->
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <!-- ElegantFonts CSS -->
        <link rel="stylesheet" href="css/elegant-fonts.css">
        <!-- themify-icons CSS -->
        <link rel="stylesheet" href="css/themify-icons.css">
        <!-- Swiper CSS -->
        <link rel="stylesheet" href="css/swiper.min.css">
        <!-- Styles -->
        <link rel="stylesheet" href="css/style.css">
        <!-- Progress -->
        <link rel="stylesheet" href="css/progress.css">
    </head>
    <body class="about-page">
<?php include('element/header.php'); ?>
        <div class="page-header-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <header class="entry-header">
                            <h1 class="header-title">ตรวจสอบสถานะ</h1>
                        </header>
                        <!-- .entry-header -->
                    </div>
                    <!-- .col -->
                </div>
                <!-- .row -->
            </div>
            <!-- .container -->
        </div>
        <!-- .page-header-overlay -->
    </div>
    <!-- .page-header -->
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumbs">
                    <ul class="flex flex-wrap align-items-center p-0 m-0">
                        <li><a href="#"><i class="fa fa-home"></i> หน้าหลัก</a></li>
                        <li>ตรวจสอบสถานะ</li>
                    </ul>
                </div>
                <!-- .breadcrumbs -->
            </div>
            <!-- .col -->
        </div>
        <!-- .row -->
        <div class="comments-form">
            <div class="comment-respond">
                <form name="checkstatus" id="checkstatus" action="" method="post" class="comment-form">
                    กรุณาระบุเบอร์โทรศัพท์ เลขที่สมาชิก หรือเลขใบประกอบวิชาชีพ ให้ถูกต้องเพื่อตรวจสอบสถานะการชำระเงิน
                    <div class="row">
                        <div class="col col-12">
                            <div class="col col-lg-6 col-md-6  col-sm-12 col-xs-12  text-center">
                                <input type="text" name="datatochek" autocomplete="off" placeholder="เบอร์โทรศัพท์ เลขที่สมาชิก หรือเลขใบประกอบวิชาชีพ">
                            </div>
                            <div class="col col-lg-6 col-md-6  col-sm-12 col-xs-12 text-center">
                                <button type="button" onclick="move()" class="btn btn-success" style="margin-top: 20px;padding: 15px 30px;">ตรวจสอบ</button>
                            </div>
                        </div>
                    </div>
                </form>
                <!-- .comment-form -->
            </div>
            <!-- .comment-respond -->
        </div>
        <!-- .comments-form -->
        <div class="row">
            <div class="col-12">
                <div id="myProgress">
                    <div id="myBar"></div>
                </div>
            </div>
        </div>
<?php if ($status != '') { ?>
            <div class="row">
                <div class="col-12">
                    <div class="progressed">
    <?php
    if ($status == 1) {
        echo '<div class="circle done">';
        echo '<span class="label">&#10003;</span>';
        echo '<span class="title">ลงทะบียน</span>';
        echo '</div>';
        echo '<span class="bar done"></span>';
        echo '<div class="circle active">';
        echo '<span class="label">2</span>';
        echo '<span class="title">ชำระเงิน</span>';
        echo '</div>';
        echo '<span class="bar"></span>';
        echo '<div class="circle">';
        echo '<span class="label">3</span>';
        echo '<span class="title">ตรวจสอบ</span>';
        echo '</div>';
        echo '<span class="bar"></span>';
        echo '<div class="circle">';
        echo '<span class="label">4</span>';
        echo '<span class="title">เรียบร้อย</span>';
        echo '</div>';
        ?>

                            <!-- .row -->
                            <div class="comments-form">
                                <div class="comment-respond text-left">
                                    เลือกไฟล์รูปภาพ png หรือ jpg เท่านั้น แล้วคลิกปุ่มอัพโหลดเพื่อส่งหลักฐานการชาระเงิน
                                    <div class="row">
                                        <div class="col col-12">
                                            <div class="col col-lg-6 col-md-6  col-sm-12 col-xs-12  text-center">
                                                <input id="inp_files" name="payslip" type="file" required>

                                            </div>
                                            <div class="col col-lg-6 col-md-6  col-sm-12 col-xs-12 text-center">
                                                <form method="post" action="">
                                                    <input id="inp_img" name="img" type="hidden" value="">
                                                    <input id="reg_id" name="id" type="hidden" value="<?= $id ?>">
                                                    <button id="bt_save" type="submit" class="btn btn-success" style="margin-top: 20px;padding: 15px 30px;">อัพโหลด</button>
                                                </form>

                                            </div>
                                        </div>
                                    </div>


                                    <!-- .comment-form -->
                                </div>
                                <!-- .comment-respond -->
                            </div>
                            <!-- .comments-form -->

        <?php
    } elseif ($status == 2) {
        echo '<div class="circle done">';
        echo '<span class="label">&#10003;</span>';
        echo '<span class="title">ลงทะบียน</span>';
        echo '</div>';
        echo '<span class="bar done"></span>';
        echo '<div class="circle done">';
        echo '<span class="label">&#10003;</span>';
        echo '<span class="title">ชำระเงิน</span>';
        echo '</div>';
        echo '<span class="bar done"></span>';
        echo '<div class="circle active">';
        echo '<span class="label">3</span>';
        echo '<span class="title">ตรวจสอบ</span>';
        echo '</div>';
        echo '<span class="bar"></span>';
        echo '<div class="circle">';
        echo '<span class="label">4</span>';
        echo '<span class="title">เรียบร้อย</span>';
        echo '</div>';
    } elseif ($status == 3) {
        echo '<div class="circle done">';
        echo '<span class="label">&#10003;</span>';
        echo '<span class="title">ลงทะบียน</span>';
        echo '</div>';
        echo '<span class="bar done"></span>';
        echo '<div class="circle done">';
        echo '<span class="label">&#10003;</span>';
        echo '<span class="title">ชำระเงิน</span>';
        echo '</div>';
        echo '<span class="bar done"></span>';
        echo '<div class="circle done">';
        echo '<span class="label">3</span>';
        echo '<span class="title">ตรวจสอบ</span>';
        echo '</div>';
        echo '<span class="bar done"></span>';
        echo '<div class="circle done">';
        echo '<span class="label">4</span>';
        echo '<span class="title">เรียบร้อย</span>';
        echo '</div>';
    }
    ?>
                    </div>
                </div>
            </div>
        </div>
<?php } ?>
    <!-- .container -->
    <div class="clients-logo">
        <div class="container">
            <div class="row">
                <div class="col-12 flex flex-wrap justify-content-center align-items-center">
                    <div class="logo-wrap"> <a href="http://www.thainurse.org"> <img src="images/nurse-logo.png" alt=""> </a> </div>
                    <!-- .logo-wrap -->
                    <div class="logo-wrap"> <a href="https://www.tnmc.or.th"> <img src="images/tnmc-logo.png" alt=""> </a> </div>
                    <!-- .logo-wrap -->
                </div>
                <!-- .col -->
            </div>
            <!-- .row -->
        </div>
        <!-- .container -->
    </div>
    <!-- .site-footer -->
<?php include('element/footer.php'); ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script type='text/javascript' src='js/custom.js'></script>
    <script type='text/javascript' src='js/swiper.min.js'></script>
    <script type='text/javascript' src='js/masonry.pkgd.min.js'></script>
    <script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
    <script type='text/javascript' src='js/pogress.js'></script>
<?php include('element/Message.php'); ?>
    <script>
                             jQuery(document).ready(function ($) {
                                 jQuery("#myBar").hide();
                             });

                             function move() {
                                 var checkstatus = document.forms["checkstatus"]["datatochek"].value;

                                 if (checkstatus != '') {
                                     jQuery("#myBar").fadeIn();
                                     var elem = document.getElementById("myBar");
                                     var width = 10;
                                     var id = setInterval(frame, 10);
                                     function frame() {
                                         if (width >= 100) {
                                             clearInterval(id);
                                             $("#checkstatus").submit();
                                         } else {
                                             width++;
                                             elem.style.width = width + '%';
                                             elem.innerHTML = width * 1 + '%';
                                         }
                                     }
                                 } else {
                                     swal({
                                         text: "กรุณาระบุเบอร์โทรศัพท์ เลขที่สมาชิก หรือเลขใบประกอบวิชาชีพ ให้ถูกต้องเพื่อตรวจสอบสถานะการชำระเงิน",
                                         icon: "info",
                                         timer: 3000
                                     });
                                 }
                             }
    </script>

    <script>
        function fileChange(e) {
            document.getElementById('inp_img').value = '';

            for (var i = 0; i < e.target.files.length; i++) {

                var file = e.target.files[i];

                if (file.type == "image/jpeg" || file.type == "image/png") {

                    var reader = new FileReader();
                    reader.onload = function (readerEvent) {

                        var image = new Image();
                        image.onload = function (imageEvent) {

                            var max_size = 600;
                            var w = image.width;
                            var h = image.height;

                            if (w > h) {
                                if (w > max_size) {
                                    h *= max_size / w;
                                    w = max_size; }
                            } else {
                                if (h > max_size) {
                                    w *= max_size / h;
                                    h = max_size;
                                }
                            }

                            var canvas = document.createElement('canvas');
                            canvas.width = w;
                            canvas.height = h;
                            canvas.getContext('2d').drawImage(image, 0, 0, w, h);
                            if (file.type == "image/jpeg") {
                                var dataURL = canvas.toDataURL("image/jpeg", 1.0);
                            } else {
                                var dataURL = canvas.toDataURL("image/png");
                            }
                            document.getElementById('inp_img').value += dataURL + '|';
                        }
                        image.src = readerEvent.target.result;
                    }
                    reader.readAsDataURL(file);
                } else {
                    document.getElementById('inp_files').value = '';
                    alert('Please only select images in JPG- or PNG-format.');
                    return false;
                }
            }

        }

        document.getElementById('inp_files').addEventListener('change', fileChange, false);

    </script>
</body>
</html>
