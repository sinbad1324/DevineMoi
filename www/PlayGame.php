<?php 
session_start();
include "Include/Function.php";
include "Include/Database.php" ;
global $db;
$SaveLogin = SaveLogin();
$coloRandom = randomColor();
$FindPlayer ;
?>

<?php 
$TitrePage;
if(!empty($_GET['Numero']) && empty($_GET['Code'])){
        $re = $db->prepare("SELECT * FROM newgame WHERE  Number = ? ");
        $re->execute([$_GET['Numero']]);
        if ($re->rowCount() > 0) {
            $number = $_GET['Numero'];
        $resultas =  $re->fetch();
        $codeGame = MakeCodeGame(6) ;
        $codeGametitre =  $codeGame ;
        $TableVerify = findcode("gameplayer" , "Code" , $codeGame);
         if ($TableVerify == true){
        $TitrePage = $resultas['Titre'];
        $dbplayer = $db->prepare("INSERT INTO gameplayer SET Code = :code , NumberGame = :numbe");
        $dbplayer -> execute([
            'code' => $codeGame,
            'numbe'=>$_GET['Numero'],
        ]);
        $_SESSION["Code"] = $codeGame ;
        $_SESSION["Number"] = $_GET['Numero'] ;
        header("Location: PlayGame.php?Code=$codeGame&Numero=$number");
      }elseif($TableVerify == false){
             header("Location: PlayGame.php?Numero=$number");

      }
        }
}elseif (empty($_GET['Numero']) && empty($_GET['Code']) ){ header("Location: GameSetting.php");}


$PlayerNumber = 1;
$codeGametitre = 0;
$FindPlayer = null; 
if (!empty($_SESSION["Number"]) && !empty($_SESSION["Code"])) {   
    $q = $db->prepare("SELECT * FROM ngpp WHERE Code = :code ");
    $q->execute([
        "code" => $_SESSION["Code"],
    ]);
    if ($q->rowCount() > 0) {
        $resultas = $q->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($resultas)) {
            $_SESSION['PlayersFind'] = $resultas;
        }
    }
    $codeGametitre = $_SESSION["Code"];
}


?>

<?php 
if ($SaveLogin == NULL) {
     header('Location: login.php') ; 
}
?>

<?php include "Include/Head.php" ;?>
<h1>DevineMOI</h1>
<?php if($SaveLogin != NULL){
$Code =  $_SESSION["Code"];
$Number =    $_SESSION["Number"];
?>
<h2>Vouliez vous jouez a  <span>DevineMOI</span> .</h2>

<h1 class="TheCode">Code: <span><?=$codeGametitre?></span></h1>
<div class = "Players">
    <p style="font-size: 25px !important; position: relative; top:-15px; left:10px;">Players :</p><br>
    <div class="Player">
    <p class = "PlayerNumber"><?=$PlayerNumber?></p>
    <div class="Profile"><img class="playerImg" src="<?=$SaveLogin['PP']?>" alt=""> <p class="playerName" style = "text-align: center!important;"><?=$SaveLogin['usernam']?></p></div>
    </div><br>
   <?php
    if (!empty(  $_SESSION['PlayersFind'])){
        $FindPlayer =   $_SESSION['PlayersFind'];
    foreach ($FindPlayer as $key) {
        $PlayerID = $key['Player'];
        $PlayerNumber++;
        $resqet = $db->prepare("SELECT * FROM newusers WHERE Id = ?");
        $resqet->execute([$PlayerID]);
        if ($resqet->rowCount() > 0){
            $result = $resqet->fetch();
        ?>
    <div class="Player">
    <p class = "PlayerNumber"><?=$PlayerNumber?></p>
    <div class="Profile"><img class="playerImg" src="<?=$result['PP']?>" alt=""> <p class="playerName" style = "text-align: center!important;"><?=$result['usernam']?></p></div>
    </div><br>
        <?php
        }
    }
    }
    ?> 
</div>;
<a href="StartGame.php?Numero=<?=$Number?>&Code=<?=$Code?>&start=true" class="Pla" style="width: 250px; height: 100px; position:relative; top:-150px; left:65px;">              
<img  src="img/PlayImg.png" alt="" style = "width:250px; height:100px; position:relative; top:-150px; left:65px;">
          </a>
<?php
}else {
header("Location : login.php") ; 
}?>
<style>


    .TheCode {
        border: solid black 2px;
       padding: 10px 50px !important ;
        border-radius: 10px ;
        width: 150px;
 
        color:orange;
        font-size: 36px;
       position: relative;
       top: 30%;
       left:130px ;
    }
    span {
        font-size: 36px !important;
    }
    .Players {
        max-width: 400px;
        border: solid black 2px;
        border-radius: 10px;
        overflow-x: auto !important; 
    overflow-y: hidden !important;       
     height: 400px;
        position: relative;
        top: -30%;
        left: 670px;
        padding: 0;
    }
    .Player {
        width: 100%;
        height: 70px;
        position: relative;
        top: -26px;
        margin-top: -34px;
        opacity: ;
    }
    .PlayerNumber {
        z-index: 1;
        text-decoration: dashed;
        text-align: center!important;
        font-size: 22px;
        color: black;
    position: relative;
    right: 170px;
    top: 13px;
    }
    .Profile{
        display: block;
        width: 50px;
        height: 50px;
        border-radius: 100%;
        position: absolute;
        bottom:18px;
        left: 320px;
    }
 .playerName{
    position:relative;
    top:-20px;
    left: -10px;
    font-size: 17px;
    text-decoration: underline;
    text-align: center !important;
 }
 .playerImg {
    display: block;
        width: 50px;
        height: 50px;
        border-radius: 100%;
 }
</style>