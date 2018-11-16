<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>ลงทะเบียน | ชมรมเครือข่ายพยาบาลผู้ให้สารน้ำแห่งประเทศไทย</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
        <meta name="description" content="ชมรมเครือข่ายพยาบาลผู้ให้สารน้ำแห่งประเทศไทย">
        <meta name="keywords" content="thaiivnetwork,IV,สารน้ำ,เครือข่ายพยาบาล,ชมรมเครือข่ายพยาบาลผู้ให้สารน้ำแห่งประเทศไทย">
        <meta name="author" content="ชมรมเครือข่ายพยาบาลผู้ให้สารน้ำแห่งประเทศไทย">
        <meta name="viewport" content="width=device-with, initial-scale=1, shrink-to-fit=no">
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
    </head>
    <body class="about-page">
        <?php include('element/header.php'); ?>
        <div class="page-header-overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <header class="entry-header">
                            <h1 class="header-title">ลงทะเบียน</h1>
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
                        <li>ลงทะเบียน</li>
                    </ul>
                </div>
                <!-- .breadcrumbs -->
            </div>
            <!-- .col -->
        </div>
        <!-- .row -->
        <div class="comments-form">
            <div class="comment-respond">
                <form name="register" method="post" action="register_save.php" class="comment-form">
                    <div class="row">
                        <div class="col col-lg-6 col-md-6  col-sm-12 col-xs-12">
                            <label class="radio-inline">
                                <input type="radio" value="สมาชิกชมรมฯ" name="membertype" checked>
                                สมาชิกชมรมฯ </label>
                            <label class="radio-inline">
                                <input type="radio" value="บุคคลทั่วไป" name="membertype">
                                บุคคลทั่วไป </label>
                        </div>
                        <!-- .col -->
                    </div>
                    <!-- .row -->
                    <div class="row">
                        <div class="col col-12">
                            <input type="text" name="memberid" autocomplete="off" maxlength="12" id="memberid" placeholder="เลขที่สมาชิก">
                        </div>
                        <!-- .col -->
                    </div>
                    <!-- .row -->
                    <div class="row">
                        <div class="col col-lg-2 col-md-12  col-sm-12 col-xs-12">
                            <select name="prefix" placeholder="คำนำหน้า" required>
                                <option value="">คำนำหน้า</option>
                                <option value="นาย">นาย</option>
                                <option value="นาง">นาง</option>
                                <option value="นางสาว">นางสาว</option>
                            </select>
                        </div>
                        <!-- .col -->
                        <div class="col col-lg-5 col-md-6  col-sm-12 col-xs-12">
                            <input type="text" name="firstname" autocomplete="off" placeholder="ชื่อ" required>
                        </div>
                        <!-- .col -->
                        <div class="col col-lg-5 col-md-6  col-sm-12 col-xs-12">
                            <input type="text" name="lastname" autocomplete="off" placeholder="นามสกุล" required>
                        </div>
                        <!-- .col -->
                    </div>
                    <!-- .row -->
                    <div class="row">
                        <div class="col col-lg-6 col-md-6  col-sm-12 col-xs-12">
                            <input type="text"  maxlength="12" autocomplete="off" name="certificate_id" placeholder="เลขใบประกอบวิชาชีพ">
                        </div>
                        <!-- .col -->
                        <div class="col col-lg-6 col-md-6  col-sm-12 col-xs-12">
                            <input type="text" name="line_id" autocomplete="off" placeholder="ID Line :เพื่อตรวจสอบความถูกต้องกรุณาระบุ ID Line ของผู้สมัคร">
                        </div>
                        <!-- .col -->
                    </div>
                    <div class="row">
                        <div class="col col-lg-8 col-md-6  col-sm-12 col-xs-12">
                            <input type="text" name="workplace" autocomplete="off" placeholder="สถานที่ทำงาน">
                        </div>
                        <!-- .col -->
                        <div class="col col-lg-4 col-md-6  col-sm-12 col-xs-12 autocomplete">
                            <input type="text" id="province" name="province" autocomplete="off" placeholder="จังหวัด" required>
                        </div>
                        <!-- .col -->
                    </div>
                    <!-- .row -->
                    <div class="row">
                        <div class="col col-lg-6 col-md-6  col-sm-12 col-xs-12">
                            <input type="text" name="phone" autocomplete="off" maxlength="10" placeholder="เบอร์โทรศัพท์ เช่น 0851234567" required>
                        </div>
                        <!-- .col -->
                        <div class="col col-lg-6 col-md-6  col-sm-12 col-xs-12">อาหาร :
                            <label class="radio-inline">
                                <input type="radio" value="ธรรมดา" name="food" checked>
                                ธรรมดา </label>
                            <label class="radio-inline">
                                <input type="radio" value="มังสวิรัติ" name="food">
                                มังสวิรัติ </label>
                            <label class="radio-inline">
                                <input type="radio" value="อิสลาม" name="food">
                                อิสลาม </label>
                        </div>
                        <!-- .col -->
                    </div>
                    <div class="row">
                        <div class="col col-12">ออกใบเสร็จในนาม</div>
                    </div>
                    <div class="row">
                        <div class="col col-lg-6 col-md-6  col-sm-12 col-xs-12">
                            <label class="radio-inline">
                                <input type="radio" value="ผู้สมัคร" id="personal" name="invoice" checked>
                                ผู้สมัคร </label>
                            <label class="radio-inline">
                                <input type="radio" value="หน่วยงาน" id="org" name="invoice">
                                หน่วยงาน </label>
                        </div>
                        <!-- .col -->
                    </div>
                    <!-- .row -->
                    <div class="row">
                        <div class="col col-12">
                            <textarea name="invoiceaddress" id="invoiceaddress"></textarea>
                        </div>
                        <!-- .col -->
                    </div>
                    <!-- .row -->
                    <div class="row">
                        <div class="col col-12 text-center">
                            <button style="submit" class="btn btn-primary">ลงทะเบียน</button>
                        </div>
                        <!-- .col -->
                    </div>
                    <!-- .row -->
                </form>
                <!-- .comment-form -->
            </div>
            <!-- .comment-respond -->
        </div>
        <!-- .comments-form -->
    </div>
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

    <?php include('element/Message.php'); ?>
    <script type='text/javascript'>
        var countries = ["กระบี่", "กรุงเทพมหานคร", "กาญจนบุรี", "กาฬสินธุ์", "กำแพงเพชร", "ขอนแก่น", "จันทบุรี", "ฉะเชิงเทรา", "ชลบุรี", "ชัยนาท", "ชัยภูมิ", "ชุมพร", "เชียงราย", "เชียงใหม่", "ตรัง", "ตราด", "ตาก", "นครนายก", "นครปฐม", "นครพนม", "นครราชสีมา", "นครศรีธรรมราช", "นครสวรรค์", "นนทบุรี", "นราธิวาส", "น่าน", "บุรีรัมย์", "บึงกาฬ", "ปทุมธานี", "ประจวบคีรีขันธ์", "ปราจีนบุรี", "ปัตตานี", "พระนครศรีอยุธยา", "พะเยา", "พังงา", "พัทลุง", "พิจิตร", "พิษณุโลก", "เพชรบุรี", "เพชรบูรณ์", "แพร่", "ภูเก็ต", "มหาสารคาม", "มุกดาหาร", "แม่ฮ่องสอน", "ยโสธร", "ยะลา", "ร้อยเอ็ด", "ระนอง", "ระยอง", "ราชบุรี", "ลพบุรี", "เลย", "ลำปาง", "ลำพูน", "ศรีสะเกษ", "สกลนคร", "สงขลา", "สตูล", "สมุทรปราการ", "สมุทรสงคราม", "สมุทรสาคร", "สระแก้ว", "สระบุรี", "สิงห์บุรี", "สุโขทัย", "สุพรรณบุรี", "สุราษฎร์ธานี", "สุรินทร์", "หนองคาย", "หนองบัวลำภู", "อ่างทอง", "อำนาจเจริญ", "อุดรธานี", "อุตรดิตถ์", "อุทัยธานี", "อุบลราชธานี"];

        autocomplete(document.getElementById("province"), countries);
        jQuery("#invoiceaddress").hide();
        jQuery(document).ready(function () {

            jQuery('input:radio[name="invoice"]').change(
                    function () {
                        if (this.checked && this.value == 'หน่วยงาน') {
                            jQuery("#invoiceaddress").show();
                            jQuery("#invoiceaddress").focus();
                        } else {
                            jQuery("#invoiceaddress").hide();
                        }
                    });

            jQuery('input:radio[name="membertype"]').change(
                    function () {
                        if (this.checked && this.value == 'บุคคลทั่วไป') {
                            jQuery("#memberid").hide();
                        } else {

                            jQuery("#memberid").show();
                            jQuery("#memberid").focus();
                        }
                    });
        });

    </script>
    <script type="text/javascript">
        $(window).on('load', function () {
            $(".se-pre-con").fadeOut("slow");
        });
    </script>
</body>
</html>
