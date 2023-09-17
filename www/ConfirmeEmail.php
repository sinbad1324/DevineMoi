<?php

if (empty($_GET['id']) && empty($_GET['token'])){
  die ("Error : Invalid Request.") ;
  header('Location: Sing.php') ;
}
$id = $_GET['id'] ;
$token = $_GET['token'];

include "Include/Database.php" ;
global $db;
$Q = $db->prepare("SELECT * FROM newusers WHERE id = ?") ;
$Q->execute([$id]);
$user = $Q->fetch();
session_start();

if ($user && $user["email_token"] == $token )
{
  $q = $db->prepare("UPDATE newusers SET email_token = NULL, dt_email = NOW() WHERE id = ?");
  $q->execute([$id]);
   // $_SESSION["Auth"] = $user['Id'] ;
  header('Location: MonCompte.php') ;
    exit() ;

}else{
  session_destroy();
    echo "<h1>Invalid Token</h1>" ;
   header('Location: Sing.php') ;
}
//verify token here...

?>