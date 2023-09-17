<?php 
session_start();
include "Include/Function.php";
include "Include/Database.php" ;
global $db;
$SaveLogin = SaveLogin();
if (empty($_SESSION['CanPlay']) && empty($_SESSION['Chef']) ){
     header("Location: JoinTheGame.php");
 }
?>
<?php
if (!empty($_GET['Code'])) {
     $q = $db->prepare("SELECT * FROM gameplayer WHERE Code = ? "); 
     $q->execute([$_GET['Code']]);
     if ($q->rowCount() > 0) {
         $Qresulte = $q->fetch();
         $req= $db->prepare("SELECT * FROM newgame WHERE Number = ? "); 
         $req->execute([$Qresulte['NumberGame']]);
         if ($req->rowCount() > 0) {
           $REQresulet = $req->fetch();
           $_SESSION["TheGame"] = $REQresulet;
         }
     }
}

$Titre;
$Question;
$Reponse1;
$Reponse2;
$Reponse3;
$Reponse4;
$Tim;
$R1;
$R2;
$R3;
$R4;
$QuestionNumber;
if (!empty($_SESSION["TheGame"])) {
     $result = $_SESSION["TheGame"];
     $Titre= $result['Titre'];
     $Question = explode(",\;" , $result['Question']);
     $Reponse1 = explode(",\;" , $result['Reponse']);
     $Reponse2 = explode(",\;" , $result['fake1']);
     $Reponse3 = explode(",\;" , $result['fake2']);
     $Reponse4 = explode(",\;" , $result['fake3']);
     $Tim = explode(",\;" , $result['TimToWait']);
     $R1 = explode(",\;" , $result['UserR1']);
     $R2 = explode(",\;" , $result['UserR2']);
     $R3 = explode(",\;" , $result['UserR3']);
     $R4 = explode(",\;" , $result['UserR4']);
     $QuestionNumber = $result['QuestionNumber']- 1;
}
?>

<?php 

if ($SaveLogin == NULL) {
     header('Location: login.php') ; 
}
?>
<?php include "Include/Head.php";?>
<h1>DevineMOI</h1>

<?php if($SaveLogin != NULL){

?>

<h2>Bienvenue sur <span>DevineMOI</span> .</h2>
<?php
$howmuchgui = false;
?>

<?php

$Titre = "Titre du jeu"; // Remplace par le titre approprié


?>

<div id="gameContainer">
  <h1 id="gameTitle">Titre</h1>
  <h2 id="question">Question :</h2>
  <form id="choicesForm" action="" method="post" class = "frommmm">
    <input type="submit" class="choix" id="choix1" value="2f2kfmfnjwfnwfnkwfjn"><br>
    <input type="submit" class="choix" id="choix2" value="Choix 2"><br>
    <input type="submit" class="choix" id="choix3" value="Choix 3"><br>
    <input type="submit" class="choix" id="choix4" value="Choix 4"><br>
  </form>
</div>


<style>
     .GameTitre {
          color: black;
     }
     .Question{
          color: black;
     }
     #Title  
     {
          left:-1px;
          font-size :38px !important ;
          color:black !important ;
          text-decoration: underline;
          position: relative;
          top:-10px;
     }
     p.pp{
     position: relative;
     top: 350px ;
     left : 250px;
     }
     #gameTitle {
          background:orange!important;
          margin: 0;
          width: 700px;
          height: 50px;
          color: black;
          text-align: center;
          text-decoration: underline;
          position: relative;
          top:40px;
          left: 340px;
     }
     #question{
          margin: 0;
          width: 700px;
          height: 80px;
          color: black;
          text-align: left;
          text-decoration: none;
          position: relative;
          top:80px;
          left: 340px;
     }
     .choix{
          display: inline-block;
          width: 200px;
          height: 80px;
          position: relative;
          left: 450px;
          top: 160px;
          border: none;
          font-size: 25px;
          color: white;
     }
  #choix1{
     position: relative;
     left: 700px;
     background-color: blue;
      }
      #choix2{
     position: relative;
     top: 80px;
     background-color: green;
      }
      #choix4{
     position: relative;
     top: 80px;
     left: 700px;
     background-color: yellow;
     
      }
      #choix3{
     background-color: red; 
      }
</style>

<?php
}?>
