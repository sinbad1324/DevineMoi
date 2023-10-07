<?php
session_start();
include "Include/Function.php";
include "Include/Database.php";
global $db;
$SaveLogin = SaveLogin();
if (empty($_SESSION['CanPlay']) && empty($_SESSION['Chef'])) {
     header("Location: JoinTheGame.php");
}
?>
<?php
if (!empty($_GET['Code'])) {
     $q = $db->prepare("SELECT * FROM gameplayer WHERE Code = ? ");
     $q->execute([$_GET['Code']]);
     if ($q->rowCount() > 0) {
          $Qresulte = $q->fetch();
          $req = $db->prepare("SELECT * FROM newgame WHERE Number = ? ");
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
     $TitreTTT = $result['Titre'];
     $Question = explode(",\;", $result['Question']);
     $Reponse1 = explode(",\;", $result['Reponse']);
     $Reponse2 = explode(",\;", $result['fake1']);
     $Reponse3 = explode(",\;", $result['fake2']);
     $Reponse4 = explode(",\;", $result['fake3']);
     $Tim = explode(",\;", $result['TimToWait']);
     $R1 = explode(",\;", $result['UserR1']);
     $R2 = explode(",\;", $result['UserR2']);
     $R3 = explode(",\;", $result['UserR3']);
     $R4 = explode(",\;", $result['UserR4']);
     $QuestionNumber = $result['QuestionNumber'] - 1;
}
?>

<?php

if ($SaveLogin == NULL) {
     header('Location: login.php');
}
?>
<?php include "Include/Head.php"; ?>
<h1>DevineMOI</h1>

<?php if ($SaveLogin != NULL) {

     ?>

     <h2>Bienvenue sur <span>DevineMOI</span> .</h2>
     <?php
     $howmuchgui = false;
     ?>

     <?php

     ?>

     <div id="gameContainer">
          <h1 id="gameTitle">Titre</h1>
          <h2 id="question">Question :</h2>
          <div class="LesElement">
               <div class="ele" id="ele1" style=" margin-top: 50px; background-color: #f22222;"><img src="LogoIconen01.png"
                         alt="">
                    <p class="p">

                    </p>
               </div>
               <div class="ele" id="ele2" style=" margin-top: 50px; background-color: #002fff;"><img src="LogoIconen01.png"
                         alt="">
                    <p class="p"></p>
               </div>
               <div class="ele" id="ele3" style=" background-color: #ddf222;"><img src="LogoIconen01.png" alt="">
                    <p class="p"></p>
               </div>
               <div class="ele" id="ele4" style=" margin-bottom: 50px; background-color: #08fe00;"><img
                         src="LogoIconen01.png" alt="">
                    <p class="p"></p>
               </div>

          </div>
     </div>


     <style>
          .GameTitre {
               color: wheat;
          }

          .Question {
               color: black;
          }

          #Title {
               left: -1px;
               font-size: 38px !important;
               color: black !important;
               text-decoration: underline;
               position: relative;
               top: -10px;
          }

          p.pp {
               position: relative;
               top: 350px;
               left: 250px;
          }

          #gameTitle {
               background: orange !important;
               margin: 0;
               width: 700px;
               height: 50px;
               color: black;
               text-align: center;
               text-decoration: underline;
               position: relative;
               top: 40px;
               left: 340px;
          }

          #question {
               margin: 0;
               width: 700px;
               height: 80px;
               color: black;
               text-align: left;
               text-decoration: none;
               position: relative;
               top: 80px;
               left: 340px;
          }


          .LesElement {
               display: flex;
               position: relative;
               left: 15%;
               top: -200px;
               flex-wrap: wrap;
               align-items: start;
               justify-content: space-around;
               flex-direction: row;
               width: 70%;
               height: 70vh;
          }

          .ele {
               width: 31vw;
               height: 26vh;
               border: black solid 2px;
               border-radius: 10px;

          }

          img {
               display: block;
               position: absolute;
               width: 30px;
               position: relative;
               left: 4%;
               top: 5%;
               color: #002fff;
               float: left;
          }

          .ele:hover {
               transform: scale(1.04);
               cursor: pointer;
          }

          .p {
               font-size: fit-content;
               text-align: center;
               color: white;
               position: relative;
               word-wrap: break-word;
               top: 7%;
               max-width: 100%;
               max-height: 75%;
               height: 75%;
               min-width: 100%;
               overflow: hidden;
          }
     </style>


     <script>
          var Question = <?= json_encode($Question) ?>;
          var Titre = <?= json_encode($TitreTTT) ?>;
          console.log(Titre)
          var Reponse1 = <?= json_encode($Reponse1) ?>;
          var Reponse2 = <?= json_encode($Reponse2) ?>;
          var Reponse3 = <?= json_encode($Reponse3) ?>;
          var Reponse4 = <?= json_encode($Reponse4) ?>;
          var rv1 = <?= json_encode($R1) ?>;
          var rv2 = <?= json_encode($R2) ?>;
          var rv3 = <?= json_encode($R3) ?>;
          var rv4 = <?= json_encode($R4) ?>;
          var Tim = <?= json_encode($Tim) ?>;

          const TP = document.getElementById("gameTitle");
          const QP = document.getElementById("question");
          const EL1P = document.querySelector("#ele1 > .p");
          const EL2P = document.querySelector("#ele2 > .p");
          const EL3P = document.querySelector("#ele3 > .p");
          const EL4P = document.querySelector("#ele3 > .p");

          function afficher(i) {
               TP.textContent = Titre[i]
               QP.textContent = Question[i]
               EL1P.textContent = Reponse1[i]
               EL2P.textContent = Reponse2[i]
               EL3P.textContent = Reponse3[i]
               EL4P.textContent = Reponse4[i]

          }
          let i = 0;
          afficher(i)
          function BoucleGame(T, Func, INTID) {
               i++;
               Func(i)
               i >= T ? clearInterval(INTID) : null;
          }
          var intgame = setInterval(() => { BoucleGame(Question.length - 1, (i) => afficher(i), intgame) }, 30000)
     </script>

     <?php
} ?>