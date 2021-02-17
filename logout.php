<?php
    session_start();
    session_destroy();
    setcookie("userIdCookie",$_SESSION["id"],time()-1);
    setcookie("userNameCookie",$_SESSION["userName"],time()-1);
    header("Location:index.php");
?>