<?php
header("Content-type: text/html; charset=utf-8");
$username = $_POST['username'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];
$telephone = $_POST['telephone'];
if ($username == '') {
  echo '<script>alert("请输入用户名!");history.go(-1);</script>';
  exit(0);
}
if (strlen($username) > 20) {
  echo '<script>alert("用户名要 < 20位!");history.go(-1);</script>';
  exit(0);
}
if ($password == '') {
  echo '<script>alert("请输入密码");history.go(-1);</script>';
  exit(0);
}
if (strlen($password) >= 20 || strlen($password) <= 6) {
  echo '<script>alert("密码要在6-20位");history.go(-1);</script>';
  exit(0);
}
if ($password != $repassword) {
  echo '<script>alert("密码与确认密码应该一致");history.go(-1);</script>';
  exit(0);
}
if ($password == $repassword) {
  $conn = new mysqli('localhost', 'root', '', 'cloudmusic');
  if ($conn->connect_error) {
    echo '数据库连接失败！';
    exit(0);
  } else {
    $sqluser = "select username from userinfo where username = '$_POST[username]'";
    $sqlphone = "select telephone from userinfo where telephone = '$_POST[telephone]'";
    $resultuser = $conn->query($sqluser);
    $resultphone = $conn->query($sqlphone);
    $numberuser = mysqli_num_rows($resultuser);
    $numberphone = mysqli_num_rows($resultphone);
    if ($numberuser) {
      echo '<script>alert("用户名已经存在");history.go(-1);</script>';
    } else if($numberphone) {
      echo '<script>alert("手机号已经被注册");history.go(-1);</script>';
    } else {
      $sql_insert = "insert into userinfo (username,password,telephone) values('$_POST[username]','$_POST[password]','$_POST[telephone]')";
      $res_insert = $conn->query($sql_insert);
      if ($res_insert) {
        echo '<script>window.location="../pages/login.html";</script>';
      } else {
        echo "<script>alert('系统繁忙，请稍候！');</script>";
      }
    }
  }
} else {
  echo "<script>alert('提交未成功！'); history.go(-1);</script>";
}
