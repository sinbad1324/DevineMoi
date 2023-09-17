<?php 
session_start();
include "Include/Function.php";
include "Include/Database.php" ;
global $db;
$SaveLogin = SaveLogin();
$GameTable  = newGameTable();

?>

<?php 
if ($SaveLogin == NULL) {
     header('Location: login.php') ; 
}
?>
<?php include "Include/Head.php";?>
<h1>Acceuil</h1>

<?php if($SaveLogin != NULL){
 $moi = new MOI();
 $moi->abonnement = "free";

 $moi->returnAbon();
 $requestDEL = $db->prepare("DELETE FROM newgame WHERE QuestionNumber < 4");
$requestDEL->execute();
?>

<h2>Bonjour bienvenue sur <span>DevineMOI</span> .</h2>
<?php include "Include/Nav.php";?>
<?php
$titre;
?>

<div class = "QuelJeux">
     <?php
          if (!empty($GameTable)) {
          foreach ($GameTable as $row) {
          $titre =  $row['Titre'];
          ?>
          <div class = "BOX" id = "CreateDevin">
          <h1 id="Title"><?=$titre?></h1><br>
          <a href="PlayGame.php?Numero=<?=$row['Number']?>" calss = "ADDIMg" style = " width: 150px; height: 1500px;" >
          <img  src="img/PlayImg.png" alt="" style = "width:130px; height:70px; position:relative; left: 86px; top:220px;">
          </a>
          </div>
          <?php
               }    
          }
     ?>
</div>

<style>
         #Title  {
                font-size :38px !important ;
                color:black !important ;
                text-decoration: underline;
                position: relative;
                top:-10px;
                left:-1px;
            }
     p.pp{
     position: relative;
     top: 350px ;
     left : 250px;
     }
</style>

<?php
}?>
<?php include "Include/Footer.php" ;?>
