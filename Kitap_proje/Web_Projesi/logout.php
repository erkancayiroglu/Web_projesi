<?php 


session_start();
session_destroy();// hafızdaki bütüm sessionları siler.

header('Location:login.php');

?>