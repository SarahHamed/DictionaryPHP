<?php
    session_start();
    include_once "Users.php";
    $user=new Users();
    $user->Delete();
    $dir="Users/";
    $img=$_SESSION['id'];
    $fdir=$dir.$img.".jpg";
    unlink($fdir);
    session_destroy();
    setcookie("userIdCookie",$_SESSION["id"],time()-1);
    setcookie("userNameCookie",$_SESSION["userName"],time()-1);
    header("Location:index.php");
?>