<?php 
session_start();
include "Include/Function.php";
include "Include/Database.php" ;
global $db;
$SaveLogin = SaveLogin();
$GameTable  = GameTable();

?>

<?php
$point = 0;
if (isset($_POST['Submit'])) {
  if (!empty($_POST['Code'])) {
      $code = $_POST['Code'];

      $trouve = $db->prepare("SELECT * FROM ngpp WHERE Player = ?");
      $trouve->execute([$SaveLogin["Id"]]);

      if ($trouve->rowCount() <= 0) {
          $q = $db->prepare("SELECT * FROM gameplayer WHERE Code = ?");
          $q->execute([$code]);

          if ($q->rowCount() > 0) {
              $resulte = $q->fetch();
              $req = $db->prepare("INSERT INTO ngpp SET GameName = :num , Code = :code ,Player = :Id ,Points = :points ");
              $req->execute([
                  'num' => $resulte['NumberGame'],
                  'code' =>  $code,
                  'Id' =>  $SaveLogin['Id'],
                  'points' =>   $point
              ]);

              header("Location: Prepatoire.php?Code=$code");
              exit; 
          } else {

              echo "Code invalide";
          }
      } else {
          $rien = $db->prepare("DELETE FROM ngpp WHERE Player = ?");
          $rien->execute([$SaveLogin["Id"]]);
          header("Location: JoinTheGame.php");
      }
  }
}



?>

<?php 
if ($SaveLogin == NULL) {
     header('Location: login.php') ; 
}
?>
<?php include "Include/Head.php";?>
<h1>Join a <span>DevineMOI</span></h1>

<?php if($SaveLogin != NULL){

?>

<h2>Bonjour bienvenue sur <span>DevineMOI</span> .</h2>
<?php include "Include/Nav.php";?>
<?php
$titre;
?>

<form action="" method="post">
    <input type="text" name="Code" class="code" id="input"  required placeholder="Put the code"><br>
    <input type="Submit" name="Submit" class="codeSubmit" value="Join">    
</form>

<style>
   #NavBtn{
    position: relative;
    left: 320px !important;
   }
   .code{
    border: solid black 2px;
    border-radius:10px ;
    width :180px;
    height: 70px;
    position: relative;
    font-size: 25px;
    top:-800px;
    left: 40%;
   }
   .codeSubmit{
    border: solid black 2px;
    border-radius:10px ;
  padding: 10px 40px;
    position: relative;
    font-size: 25px;
    top:-788px;
    left: 42.2%;
   }
</style>

<?php
}?>

