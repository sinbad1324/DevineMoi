<?php 
session_start();
include "Include/Function.php";
include "Include/Database.php" ;
global $db;
$SaveLogin = SaveLogin();
$GameTable  = GameTable();

$Number = $_GET['Numero'];
$Code = $_GET['Code'];
if (!empty($Number) && !empty($Code) && !empty($_GET['start']) && $_GET['start'] == true ) {
 
    $q = $db->prepare("SELECT * FROM gameplayer WHERE Code = :code AND NumberGame = :num ");
    $q->execute([
        ':num' => $Number, // Utilise ':num' au lieu de ':Numero'
        ':code' => $Code,   // Utilise ':code' au lieu de ':Code'
    ]);
    
    if ($q->rowCount() > 0) {
        $result = $q->fetch();
        $req = $db->prepare("UPDATE gameplayer SET GameStarte = :str WHERE Code = :code ");
        $req->execute([
            ':code' => $Code,
            ':str'=> 'true',
            ]);
            $_SESSION['Chef'] = true;
            header("Location: InTheGame.php?Code=$Code");
    }


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
 $moi = new MOI();
 $moi->abonnement = "free";

 $moi->returnAbon();
 $requestDEL = $db->prepare("DELETE FROM newgame WHERE QuestionNumber < 4");
$requestDEL->execute();
?>

<h2>Bienvenue sur <span>DevineMOI</span> .</h2>
<?php
?>


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
