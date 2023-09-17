<?php 
session_start();
include "Include/Function.php";
include "Include/Database.php" ;
global $db;
$SaveLogin = SaveLogin();
$GameTable  = GameTable();

?>

<?php 
if ($SaveLogin == NULL) {
     header('Location: login.php') ; 
}
?>

<?php include "Include/Head.php" ;?>
<h1>Setting</h1>
<?php if($SaveLogin != NULL){

?>
<h2>Bonjour bienvenue sur <span>GameSetting</span> .</h2>
<?php include "Include/Nav.php";?>

<?php
$titre;
$requestDEL = $db->prepare("DELETE FROM newgame WHERE Createur = :id AND QuestionNumber < 4");
$requestDEL->execute(array(':id' => $SaveLogin['Id']));
?>

<div class = "QuelJeux">
     <div class = "BOX" id = "CreateDevin">
          <a href="CreateDevine.php?Numero=0" calss = "ADDIMg" style = " width: 150px; height: 1500px;" >
               <img  src="img/add.jpg" alt="" style = "width:150px; height:150px; position:relative; top:22%;">
          </a>
     </div>
     <?php
  
     if (!empty($GameTable)) {
     foreach ($GameTable as $row) {
         $titre =  $row['Titre'];
         ?>
     <div class = "BOX" id = "CreateDevin">
     <h1 id="Title"><?=$titre?></h1>
     <a href="PlayGame.php?Numero=<?=$row['Number']?>" calss = "ADDIMg" style = " width: 150px; height: 1500px;" >
     <img  src="img/PlayImg.png" alt="" style = "width:110px; height:70px; position:relative; left: 86px; top:220px;">
     </a>
     <a href="CreateDevine.php?Numero=<?=$row['Number']?>" calss = "ADDIMg" style = "width: 150px; height: 1500px;" >
     <img  src="img/SettingImg.jpg" alt="" style = "width:70px; height:70px; position:relative; left: -146px; top:220px; color: dimgray;">
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
</style>
<?php
}?>
<?php include "Include/Footer.php" ;?>