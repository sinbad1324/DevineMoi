<?php function Ecrir($arg  , $alert) {
    ?>
    <div id = "write"   style = "background-color: <?= $alert?>; 
    text-align: left;
    padding : 5px ;
    position: relative;
    margin:0px;

    ">
        <pre style = "color:white ;
            position: relative;
            top:-30px;     
        " ></pre><?= print_r($arg , true) ?></pre>
        </div>
    <?php
}

function SaveLogin() {
  include_once "Database.php";
  global $db;
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }

  if (!empty($_SESSION['Auth']) && $_SESSION['Auth'] != null) {
      $q = $db->prepare("SELECT * FROM newusers WHERE id = ?");
      $q->execute([$_SESSION['Auth']]);
      $result = $q->fetch();
      if (!empty($result) && $result != 0) {
      return $result;
      }
  } elseif (!empty($_COOKIE['SeSouvenire'])) {
      $q = $db->prepare("SELECT * FROM newusers WHERE Cokie_token = ?");
      $q->execute([$_COOKIE['SeSouvenire']]);
      $result = $q->fetch();

      if (!empty($result) && $result) {
          if (session_status() == PHP_SESSION_NONE) {
              session_start();
          }
          $_SESSION['Auth'] = $result['Id'];
          return $result;
      }
  }

  return null;
}

function GameTable()
{
    include_once "Database.php";
    global $db;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $q = $db->prepare("SELECT * FROM newgame WHERE Createur = ?");
$q->execute([$_SESSION['Auth']]);
if ($q->rowCount()>0){
     $resultas = $q->fetchAll(PDO::FETCH_ASSOC);
     if (!empty($resultas))
     $_SESSION['Resulte'] = $resultas;
        return   $resultas; 
     }elseif (empty($resultas)) {
          $_SESSION['Resulte'] = null; 
          return   null; 
     }

}



function newGameTable(){
    include_once "Database.php";
    global $db;
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    $q = $db->prepare("SELECT * FROM newgame ");
$q->execute([]);
if ($q->rowCount()>0){
     $resultas = $q->fetchAll(PDO::FETCH_ASSOC);
     if (!empty($resultas))
        return   $resultas; 
     }elseif (empty($resultas)) {
          $_SESSION['Resulte'] = null; 
          return   null; 
     }
}

function FindPlayer( $Code , $Number){
    include_once "Database.php";
    global $db;
    $q = $db->prepare("SELECT * FROM ngpp WHERE Code = :code AND GameName = :numbe");
    $q->execute([
        ":code"=> $Code,
        ':numbe' =>$Number
    ]);
    if ($q->rowCount()>0 ) {
        $resultas = $q->fetchAll(PDO::FETCH_ASSOC);
        if (!empty($resultas)){
            echo "il y a"."<br>" ;
            return   $resultas; 
        }elseif (empty($resultas)) {
            echo "il y a pas " ;
            return   null; 
      }
   }
}

function findcode($Table , $qui , $value){
    include_once "Database.php";
    global $db;
    $q = $db->prepare("SELECT * FROM $Table WHERE $qui = :val ");
    $q->execute([":val" => $value]);
    if ($q->rowCount() == 0){
      return true;
    }elseif($q->rowCount() > 0){
        return false;
      }
}

function MakeCodeGame($Value){
  $Code = "0123456789";
  return substr(str_shuffle(str_repeat($Code , $Value)) ,0 ,$Value);
}
function ETX($arg , $alert) {
    ?>
    <div id = "write"   style = "background-color: <?= $alert?>; 
    text-align: left;
    padding : 5px ;
    position: relative;
    top:150px;
    margin:0px;
    ">
        <pre style = "color:white ;
            position: relative;
            top:-30px;     
        " ></pre><?=  $arg ?></pre>
        </div>
    <?php
}


function TokenFunc($Value)
    {
        $abcd = "1qay2wsx3edc4rfv5tgb6zhn7ujm8ik9ol0pQWERTZUIOPLKJHGFDSAYCXVCBVBNM";
        return substr(str_shuffle(str_repeat($abcd , $Value)) ,0 ,$Value);
}

class MOI {
    public $user;
    public $id;
    public $mail;
    public $abonnement;
    public $age;

    private function free() {
    }

    private function mini() {
    }

    private function normal() {
    }

    private function premium() {
    }

    public function returnAbon() {
        $abo = $this->abonnement;
        if ($abo == "free") {
            return $this->free();
        } elseif ($abo == "mini") {
            return $this->mini();
        } elseif ($abo == "normal") {
            return $this->normal();
        } elseif ($abo == "premium") {
            return $this->premium();
        }
    }
}

class NewGame {
        public $Titre ;
        public $Createur;
        public $Qestions;
        public $Rep1;
        public $Rep2;
        public $Rep3;
        public $Rep4;
        public $Point;

}

function ValuerNull($R , $r2 , $r3 , $r4){
    if (empty($R)) {
        $R = 1;     
    }
    if (empty($r2)) {
        $r2 = 1;     
    }
    if (empty($r3)) {
        $r3 = 1;     
    }
    if (empty($r4)) {
        $r4 = 1;     
    }
}
function randomColor()
{
    $colors=array("red","blue", "green". "yellow");
     shuffle( $colors );
    return   $colors;
}


 // use PHPMailer\PHPMailer\PHPMailer;
 // use PHPMailer\PHPMailer\SMTP;
 // use PHPMailer\PHPMailer\Exception;

  //require './PHPMailer/src/Exception.php' ;
  //require './PHPMailer/src/SMTP.php' ;
  //require './PHPMailer/src/PHPMailer.php' ;

 // function envoi_mail($from_email , $from_name ,$Subject ,$message )
 // {
  //   $mail = new PHPMailer()
   // $mail->isSMTP();
   // $mail->SMTPDebug = 0 ;
   // $mail->SMTPSecure = 'ssl' ;
   // $mail->HOST = "smtp.gmail.com";
   // $mail->SMTPAuth = true ;
   /// $mail->Username = "doddmoham@gamil.com" ;
  //  $mail->Password = "doddmoham@gamil.com" ;
  //  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
  //  $mail->Port = 465;

 //   $mail->setFrom($from_email , $from_name) ;
 //   $mail->addAddress('doddmoham@gamil.com' , 'moi') ;
 //   $mail->isHTML(true) ;
 //  $mail->Subject = $Subject ;
 //   $mail->Body = $message ;
 //   $mail->setLanguage('fr' , '/optinal/path/to/language/directory/');

 //   if (!$mail->send()) {
 //       return false ;
 //   }else{
 //       return true ;
 //   }

 // }


  //envoi_mail("")


?>
