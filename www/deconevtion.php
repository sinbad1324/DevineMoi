<?php
session_start();
include_once "Include/Database.php" ;
global $db;
$QC = $db->prepare("UPDATE newusers SET Cokie_token = :cokietok WHERE Id = :urid ") ;
$QC->execute(["cokietok" => NULL ,
'urid'=> $_SESSION['Auth']]);
setcookie ("SeSouvenire", NULL,-1);
$_SESSION['Auth'] = null;
session_destroy();
header('Location: login.php') ;
?>
