<?php 
session_start();
include "Include/Function.php";
include "Include/Database.php" ;
global $db;
$SaveLogin = SaveLogin();
$coloRandom = randomColor();
?>

<?php 
$DBC = false;
$TitrePage;
$NumbeerQuestion = 1 ;

if(isset($_GET['Numero'])){
    if ($_GET['Numero'] != 0 ) {
    $re = $db->prepare("SELECT * FROM newgame WHERE Createur = ? AND Number = ? ");
    $re->execute([$SaveLogin['Id'] , $_GET['Numero']]);
    if ($re->rowCount() > 0) {
       $resultas =  $re->fetch();
        $_SESSION["game"] = true;
        $_SESSION["gameID"] = $resultas['Number'];
        $_SESSION["resultasgametable"] = $resultas;
        $NumbeerQuestion = $resultas['QuestionNumber'] ;
        $TitrePage = $resultas['Titre'];
    }}
    else{
     $_SESSION["game"] = null;
     $_SESSION["gameID"] = null;
     $_SESSION["resultasgametable"] = null;
     $NumbeerQuestion = 1 ;
     $TitrePage = null;
    }
 }else{
    $_SESSION["game"] = null;
    $_SESSION["gameID"] = null;
    $_SESSION["resultasgametable"] = null;
    $NumbeerQuestion = 1 ;
    $TitrePage = null;
 }


if(isset($_POST["Submit"]) ){
    extract($_POST);
    if (!empty($Titre) && !empty($Question) && !empty($Reponse) && !empty($fake1) && !empty($fake2) && !empty($fake3) && !empty($TimToWait) && !empty($Reponse1) || !empty($Reponse2) || !empty($Reponse3) || !empty($Reponse4)){
        $TitrePage = $Titre;
        if (empty($Reponse1)) {
            $Reponse1 = 1;     
        }
        if (empty($Reponse2)) {
            $Reponse2 = 1;     
        }
        if (empty($Reponse3)) {
            $Reponse3 = 1;     
        }
        if (empty($Reponse4)) {
            $Reponse4 = 1;     
        }
        if ( empty($_SESSION["gameID"]) || empty($_SESSION["game"]) || $NumbeerQuestion == 1 ){
            $DBC = true; 
            $NumbeerQuestion = 2 ;
            $q = $db->prepare("INSERT INTO newgame SET Titre = ? , Question = ? , Reponse = ? , fake1 = ? , fake2 = ? , fake3 = ? , TimToWait = ?   , UserR1 = ? , UserR2 = ? , UserR3 = ? , UserR4 = ? , Createur = ? ,QuestionNumber = ? ");
            $q->execute([
                $Titre,
                $Question,
                $Reponse,
                $fake1,
                $fake2,
                $fake3,
                $TimToWait,
                $Reponse1,
                $Reponse2,
                $Reponse3,
                $Reponse4,
                $SaveLogin['Id'],
                $NumbeerQuestion,
            ]);
            $idgame = $db->lastInsertId();
            $_SESSION["gameID"] = $idgame; 
            $_SESSION["game"] = true; 
            header("Location: CreateDevine.php?Numero=$idgame");
            //header("Location: pagedesercour.php");
        }elseif(!empty($_SESSION["gameID"]) && !empty($_SESSION["game"]) && $NumbeerQuestion != 1 && $DBC == false ){
          $res =  $_SESSION["resultasgametable"];
          $GameID = $_SESSION['gameID'];
            $TitrePage = $Titre ;
            $NumbeerQuestion++ ; 
            $NQuestion = $res['Question'].",\;".$Question;
            $Nreponse = $res['Reponse'].",\;".$Reponse;
            $Nreponse1 = $res['fake1'].",\;".$fake1;
            $Nreponse2 = $res['fake2'].",\;".$fake2;
            $Nreponse3 = $res['fake3'].",\;".$fake3;
            $NWait = $res['TimToWait'].",\;".$TimToWait;
            $QRr1 = $res['UserR1'].",\;".$Reponse1;
            $QRr2 = $res['UserR2'].",\;".$Reponse2;
            $QRr3 = $res['UserR3'].",\;".$Reponse3;
            $QRr4 = $res['UserR4'].",\;".$Reponse4;
            $q = $db->prepare("UPDATE newgame SET Titre = :t , Question = :q , Reponse = :r1 , fake1 = :r2 , fake2 = :r3 , fake3 = :r4, QuestionNumber = :qr , TimToWait = :TTW , UserR1 = :UR1 , UserR4 = :UR4 , UserR3 = :UR3 , UserR2 = :UR2  WHERE Number = :id");
            $q->execute([
               ':id' => $GameID,
               ':t' => $TitrePage ,
               ':q' => $NQuestion ,
               ':r1' => $Nreponse ,
               ':r2' => $Nreponse1 ,
               ':r3' => $Nreponse2 ,
               ':r4' => $Nreponse3 ,
               ':qr' => $NumbeerQuestion ,
               ':TTW' => $NWait ,
               ':UR1' => $QRr1 ,
               ':UR2' => $QRr2 ,
               ':UR3' => $QRr3 ,
               ':UR4' => $QRr4 ,

            ]);
            header("Location: CreateDevine.php?Numero=$GameID");
            //header("Location: pagedesercour.php");
        }
  }

}else{
    echo "<script type='text/javascript'>alert(\"Veuillez remplir tous</script>";
}  

if (isset($_POST["Enregistré"])) {
    extract($_POST);
    if (!empty($Titre) && !empty($Question) && !empty($Reponse) && !empty($fake1) && !empty($fake2) && !empty($fake3) && !empty($NumberPoint) && !empty($TimToWait) && !empty($Reponse1) || !empty($Reponse2) || !empty($Reponse3) || !empty($Reponse4)){
        $TitrePage = $Titre;
        if (empty($Reponse1)) {
            $Reponse1 = 1;     
        }
        if (empty($Reponse2)) {
            $Reponse2 = 1;     
        }
        if (empty($Reponse3)) {
            $Reponse3 = 1;     
        }
        if (empty($Reponse4)) {
            $Reponse4 = 1;     
        }
        if(!empty($_SESSION["gameID"]) && !empty($_SESSION["game"]) && $NumbeerQuestion != 1 ){
            $res =  $_SESSION["resultasgametable"];
            $GameID = $_SESSION['gameID'];
              $TitrePage = $Titre ;
              $NumbeerQuestion++ ; 
              $NQuestion = $res['Question'].",\;".$Question;
              $Nreponse = $res['Reponse'].",\;".$Reponse;
              $Nreponse1 = $res['fake1'].",\;".$fake1;
              $Nreponse2 = $res['fake2'].",\;".$fake2;
              $Nreponse3 = $res['fake3'].",\;".$fake3;
              $NWait = $res['TimToWait'].",\;".$TimToWait;
              $QRr1 = $res['UserR1'].",\;".$Reponse1;
              $QRr2 = $res['UserR2'].",\;".$Reponse2;
              $QRr3 = $res['UserR3'].",\;".$Reponse3;
              $QRr4 = $res['UserR4'].",\;".$Reponse4;
              $q = $db->prepare("UPDATE newgame SET Titre = :t , Question = :q , Reponse = :r1 , fake1 = :r2 , fake2 = :r3 , fake3 = :r4, QuestionNumber = :qr , TimToWait = :TTW , UserR1 = :UR1 , UserR4 = :UR4 , UserR3 = :UR3 , UserR2 = :UR2  WHERE Number = :id");
              $q->execute([
                 ':id' => $GameID,
                 ':t' => $TitrePage ,
                 ':q' => $NQuestion ,
                 ':r1' => $Nreponse ,
                 ':r2' => $Nreponse1 ,
                 ':r3' => $Nreponse2 ,
                 ':r4' => $Nreponse3 ,
                 ':qr' => $NumbeerQuestion ,
                 ':TTW' => $NWait ,
                 ':UR1' => $QRr1 ,
                 ':UR2' => $QRr2 ,
                 ':UR3' => $QRr3 ,
                 ':UR4' => $QRr4 ,
  
              ]);
              header("Location: GameSetting.php");
            //header("Location: pagedesercour.php");
        }
    }    

}
?>


<?php 
if ($SaveLogin == NULL) {
     header('Location: login.php') ; 
}
?>

<?php include "Include/Head.php" ;?>
<h1>Creation</h1>
<?php if($SaveLogin != NULL){
 $moi = new MOI();
 $moi->abonnement = "free";
 $moi->returnAbon();
?>
<h2>Vouliez vous créé un nouveau <span>DevineMOI</span> .</h2>
<form action="" method="post">
    <?php
    $mewtitr ;
     if (!empty($TitrePage)) {
$mewtitr = $TitrePage;
    }else{$mewtitr = "";}?>
        <input type="text" name = "Titre" class="input" id="input"  required placeholder="Titre" value="<?=$mewtitr?>"></br>
        <legend class="legend" id="input" ><span>Question</span> : <?=$NumbeerQuestion?></legend></br>
        <input type="text" name = "Question" class="input" id="input" required placeholder="Question"></br>
        <input type="text" name = "Reponse" class="input" id="input" required  placeholder="Response 1"></br>
        <input type="text" name = "fake1" class="input" id="input" required  placeholder="Response 2"></br>
        <input type="text" name = "fake2" class="input" id="input" required placeholder="Response 3"></br>
        <input type="text" name = "fake3" class="input" id="input" required placeholder="Response 4"></br>
        <input type="number" name = "TimToWait" class="input" id="input" required placeholder="The waiting time to respond."></br>
        <input type="checkbox" name="Reponse1" class="check" id = "check" ></BR>
        <input type="checkbox" name="Reponse2" class="check" id = "check" ></BR>
        <input type="checkbox" name="Reponse3" class="check" id = "check" ></BR>
        <input type="checkbox" name="Reponse4" class="check" id = "check" ></BR>
        <label for="Reponse1" class="labelbox1" id="labelbox">Did you want Response number 1 to be an answer?</label></br>
        <label for="Reponse2" class="labelbox2" id="labelbox">Did you want Response number 2 to be an answer?</label></br>
        <label for="Reponse3" class="labelbox3" id="labelbox">Did you want Response number 3 to be an answer?</label></br>
        <label for="Reponse4" class="labelbox4" id="labelbox">Did you want Response number 4 to be an answer?</label></br>
        <input type="submit" name="Submit" class="Submit" id = "Submit" value = "Suivante"></BR>
        <?php if($NumbeerQuestion > 4){?>
        <input type="submit" name="Enregistré" class="Submit" id = "Submit2" value = "Enregistré"></BR>     
        <?php }?>

</form>

<?php
}else {
header("Location : login.php") ; 
}?>
<?php include "Include/Footer.php" ;?>
<style>

    .Submit {
        position: relative;
        top: -330px !important;
        left:80px !important;
    }
    .legend{
        font-size: 25px !important;
        left:80px !important;
        top:-280px;
        margin-top: 20px;

    }
    .input{
        position: relative;
        top: -300px !important;
        left:80px !important;
        width: 1000px !important;
    }
    #footer{
        position: relative;
        top: -140px !important;
    }
    .check{
        position: relative;
        bottom:280px;
        left: 75px;
        margin-top: 9px ;
        width: 20px;
        height: 20px;
    }
    .labelbox1{
        position: relative;
        bottom:400px;
         left: 110px;
    }
    .labelbox2{
        position: relative;
        bottom:386px;
         left: 110px;
    }
    .labelbox3{
        position: relative;
        bottom:372px;
         left: 110px;
    }
    .labelbox4{
        position: relative;
        bottom:358px;
         left: 110px;
    }
    #Submit2{
        width: 350px !important;
        font-size: 20px !important;
    }
</style>