<?php
require_once('config.php');
$id_api = '170'; // Lấy ID API tại nhà cung cấp dịch vụ
$api_key = '45f834dffd80169d81d70c17e986ca95'; // Lấy API KEY tại nhà cung cấp dịch vụ
// vui lòng không để lộ api và link callback để bảo mật web



// vui lòng tự bọc hàm để bảo mật tránh bị tấn công XSS, SQL
$noidung = abs($_POST['noidung']);
$tien = abs($_POST['tien']);
$idapi = htmlspecialchars($_POST['idapi']);
$key = htmlspecialchars($_POST['api_key']);
$tranid =  htmlspecialchars($_POST['tranid']);

$check1 = md5($id_api.$api_key);
$check2 = md5($idapi.$key);
if($key != ''){
    if($check1 == $check2){
        // Thực hiện cộng tiền cho khách
        
   $thucnhan = $tien;
        $userconcac = $ketnoi->query("SELECT * FROM users WHERE `id` = '$noidung' ")->fetch_array();
    $ketnoi->query("UPDATE users SET `money` = `money` + '$thucnhan', `total_nap` = `total_nap` + '$thucnhan' WHERE `id` = '".$noidung."' ");
        $ketnoi->query("INSERT INTO `log` SET 
              `content` = 'Nạp MOMO thành công, thực nhận $thucnhan ',
              `createdate` = now(),
              `username` = '".$userconcac['username']."' ");
     // lịch sử 
      $ketnoi->query("INSERT INTO `momo` SET 
              `tranId` = '$tranid',
              `time` = now(),
              `amount` = '$thucnhan',
              `username` = '".$userconcac['username']."' ");
        
    }
}

