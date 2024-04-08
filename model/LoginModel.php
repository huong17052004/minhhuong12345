<?php
//truy van du lieu 
require 'database/database.php';

//viet ham kt dang nhap cua ng dung 
//kiem tra tk dang nhap co ton taij trong database k 

function checkLoginUser($username,$password){
    //username va password la du lieu ng dung nhap tu form login 
    $db = connectionDb();  // co duoc ket noi tu database
    // viet cau lenh sql truy van 
    $sql = "SELECT a.*,u.`full_name`, u.`email`, u.`phone` FROM `accounts` AS a 
    INNER JOIN `users` AS u ON a.user_id = u.id 
    WHERE `username` = :user AND `password` = :pass AND a.`status` = 1 LIMIT 1";
    $statement =$db->prepare($sql); //kiem tra cau lenh sql
    $dataUser =[]; //mang rong chua thong tin ng dungg
if($statement){
    //kiem tra cac tham so truyen vao sql
    $statement->bindParam(':user', $username,PDO::PARAM_STR);
    $statement->bindParam(':pass', $password,PDO::PARAM_STR);

    // thuc thi cau lenh 
    if($statement->execute()){
        //kiemt tra xem tuy van sql co du lieu tra ve hay k 
        if($statement->rowCount() > 0 ){
            // co du lieu trong db lay du lieu do ra
            $dataUser=$statement ->fetch(PDO::FETCH_ASSOC);

        }
    }

   }
   disconnectDb($db);  // dong ket noi dattabase
   return $dataUser; // tra ve du lieu chua thong tin nguoi dung 
   

}
