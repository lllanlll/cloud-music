<?php
    header("Content-type:text/html;charset=utf-8;");
    $username = $_POST['username'];
    $password = $_POST['password'];
    $conn = new mysqli('localhost','root','', 'cloudmusic');
    if ($conn->connect_error){
        echo '数据库连接失败！';
        exit(0);
    }else{
        if ($username == ''){
            echo '<script>alert("请输入用户名！");history.go(-1);</script>';
            exit(0);
        }
        if ($password == ''){
            echo '<script>alert("请输入密码！");history.go(-1);</script>';
            exit(0);
        }
        $sql = "select username,password from userinfo where username = '$_POST[username]' and password = '$_POST[password]'";
        $result = $conn->query($sql);
        $number = mysqli_num_rows($result);
        if ($number) {
            header("Location:http://localhost:8000/cloud-music/pages/main.html?username=$username");
            echo '<script>window.location="../pages/main.html";</script>';
        } else {
            echo '<script>alert("用户名或密码错误！");history.go(-1);</script>';
        }
    }
    
?>