<?php
if(!function_exists('isLoginUser')){
    function isLoginUser(){
        $idUser = getSessionIdUser();// nam o file cammom.php
        $username = getSessionUsername();// nam o file cammom.php
        if(empty($idUser) || empty($username)){
            return false;
        }
        return true;
    }
}