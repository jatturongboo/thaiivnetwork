<?php
header('Content-Type: text/html; charset=utf-8');
session_start();

if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
  require("conf/config_mysqli.php");
  mysqli_set_charset($Connect,"utf8");
  (!empty($_POST['membertype']) ? $membertype = mysqli_real_escape_string($Connect, xss_cleaner($_POST['membertype'])) : $membertype = "");
  (!empty($_POST['memberid']) ? $memberid = mysqli_real_escape_string($Connect, xss_cleaner($_POST['memberid'])) : $memberid = "");
  (!empty($_POST['prefix']) ? $prefix = mysqli_real_escape_string($Connect, xss_cleaner($_POST['prefix'])) : $prefix = "");
  (!empty($_POST['firstname']) ? $firstname = mysqli_real_escape_string($Connect, xss_cleaner($_POST['firstname'])) : $firstname = "");
  (!empty($_POST['lastname']) ? $lastname = mysqli_real_escape_string($Connect, xss_cleaner($_POST['lastname'])) : $lastname = "");
  (!empty($_POST['certificate_id']) ? $certificate_id = mysqli_real_escape_string($Connect, xss_cleaner($_POST['certificate_id'])) : $certificate_id = "");
  (!empty($_POST['line_id']) ? $line_id = mysqli_real_escape_string($Connect, xss_cleaner($_POST['line_id'])) : $line_id = "");
  (!empty($_POST['workplace']) ? $workplace = mysqli_real_escape_string($Connect, xss_cleaner($_POST['workplace'])) : $workplace = "");
  (!empty($_POST['province']) ? $province = mysqli_real_escape_string($Connect, xss_cleaner($_POST['province'])) : $province = "");
  (!empty($_POST['phone']) ? $phone = mysqli_real_escape_string($Connect, xss_cleaner($_POST['phone'])) : $phone = "");
  (!empty($_POST['food']) ? $food = mysqli_real_escape_string($Connect, xss_cleaner($_POST['food'])) : $food = "");
  (!empty($_POST['invoice']) ? $invoice = mysqli_real_escape_string($Connect, xss_cleaner($_POST['invoice'])) : $invoice = "");
  (!empty($_POST['invoiceaddress']) ? $invoiceaddress = mysqli_real_escape_string($Connect, xss_cleaner($_POST['invoiceaddress'])) : $invoiceaddress = "");
  $created = date("Y-m-d H:i:s");
  $modified = date("Y-m-d H:i:s");
  $checkdatacuplicate  = checkdatacuplicate($memberid, $phone, $certificate_id);
  if($checkdatacuplicate > 0){
    $_SESSION['Message'] = 'ข้อมูลเลขที่สมาชิกหรือ เลขใบประกอบวิชาชีพ หรือเบอร์โทรศัพท์ ได้ลงทะเบียนแล้ว';
    $_SESSION['type']   = 'error';
    header('Location: register.php');
       exit();
  }else{

    $sql = "INSERT INTO registers (member_type, member_id, prefix, firstname, lastname, certificate_id, line_id, workplace, province, phone, food, receipt_by, invoice_address, status, created, modified) VALUES ( '".$membertype."', '".$memberid."', '".$prefix."', '".$firstname."', '".$lastname."', '".$certificate_id."', '".$line_id."', '".$workplace."', '".$province."', '".$phone."', '".$food."', '".$invoice."', '".$invoiceaddress."', '1', '".$created."', '".$modified."') ";

    $result = mysqli_query($Connect,$sql);
    if($result){
      $_SESSION['Message'] = 'บันทึกข้อมูลลงทะเบียนเรียบร้อยแล้ว';
      $_SESSION['type']   = 'success';
      header('Location: status.php');
         exit();
    }
  }

}else{
  header('Location: register.php');
     exit();
}

function checkdatacuplicate($memberid, $phone, $certificate_id) {
  require("conf/config_mysqli.php");
  $where = "";
  if(!empty($memberid)){
    $where .= " member_id = '".$memberid."'";
  }

  if(!empty($phone) && $where != ""){
    $where .= " or phone = '".$phone."'";
  }else if(!empty($phone) && $where == ""){
    $where .= " phone = '".$phone."'";
  }

  if(!empty($certificate_id) && $where != ""){
    $where .= " or certificate_id = '".$certificate_id."'";
  }else if(!empty($certificate_id) && $where == ""){
    $where .= " certificate_id = '".$certificate_id."'";
  }

  $sql = "SELECT * from registers where ".$where;
  $result = mysqli_query($Connect,$sql);
  $count = 0;
  if ($result->num_rows > 0) {
    $count = $result->num_rows;
  }
  $Connect->close();
  return $count;
}
// Cross Site Script  & Code Injection Sanitization
function xss_cleaner($input_str) {
    $return_str = str_replace( array('<',';','|','&','>',"'",'"',')','('), array('&lt;','&#58;','&#124;','&#38;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
    $return_str = str_ireplace( '%3Cscript', '', $return_str );
    return $return_str;
}
 ?>
