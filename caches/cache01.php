<?php
    require "../functions.php";
    $hash = "";
    if(isset($_GET['username'])){
        $username = $_GET['username'];
    }
    if(isset($_GET['password'])){
        $password = $_GET['password'];
        if($password.length>8){
            $hash = password_hash($password,PASSWORD_DEFAULT);
            echo "";
        }
    }
    if(strlen($hash)<20){
        unset($hash);
        $hashWorked = false;
    }else{
        $hashWorked = true;
    }

    if(!$hashWorked){
        echo "did not work";
        echo $hash;
    }else{
        echo $hash;
    }
?>