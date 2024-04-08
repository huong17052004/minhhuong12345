<?php
require 'model/LoginModel.php'; //import model
//m = teb cua ham nam trong file controleer trong thu muc controller
$m = trim($_GET['m'] ?? 'index');//controleer mac dinh la index
$m = strtolower($m); //viet thuong tat ca cac ten ham
switch($m){
    case 'index':
        index();
    break;
    case 'handle';
        handleLogin();
    break;
    case 'logout':
        handleLogout();
        break;
    default:
        index();
    break;
}


function handleLogout(){
    if(isset($_POST['btnLogout'])){
        //huy cac session
        session_destroy();
        //quay ve trang dang nhap
        header("Location:index.php");
    }
}

function handleLogin(){
    //ktra nguoi dung bam submit?
    if(isset($_POST['btnLogin'])){
        $username = trim($_POST['username'] ?? null);
        $username = strip_tags($username);

        $password = trim($_POST['password'] ?? null);
        $password = strip_tags($password);

        $userInfo = checkLoginUser($username, $password);
 
        if(!empty($userInfo)){
            //tk ko toon tai
            // luu thong tin nguoi dung vafo session
            $_SESSION['username'] = $userInfo['username'];
            $_SESSION['fullname'] = $userInfo['full_name'];
            $_SESSION['email'] = $userInfo['email'];
            $_SESSION['idUser'] = $userInfo['user_id'];
            $_SESSION['roleId'] = $userInfo['role_id'];
            $_SESSION['idAccount'] = $userInfo['id'];
            //cho vao trang quarn tri
            header("Location:index.php?c=dashboard");

        }else{
            // tk k toon tai
            // ql dang nhap
            header("Location:index.php?state=error");
        }

        $userInfo = checkLoginUser($username,$password);
        echo "<pre>";
        print_r($userInfo);
    }
}

function index(){
    if(isLoginUser()){
        header("Location:index.php?c=dashboard");
        exit();
    }
    require "view/login/index_view.php";
}


