<?php 
session_start();
include "Include/Function.php";
include "Include/Database.php" ;
global $db;
$SaveLogin = SaveLogin();
?>

<?php 
$grandmot = [
    'fdp',
    'salop',
    'ntm',
    'ntp',
    'pd',
    'gay',
    'merde',
    'nique ta mere',
    'nic tas mere',
    'nik tas mere',
    'Con',
    'conne',
    'Débile',
    'stupide',
    'idiot',
    'idiote',
    'bête',
    'putain de merde',
    'vieux putois',
    'sale chien',
    'chien paresseux',
    'Connard',
    'connasse',
    'Salope ',
    'Nigger',
    'sourdine',
    'Salaud ',
    'enfoiré',
    'enfoirée',
    'Enculé(e)',
   'fils de pute',
   'fille de pute',
   'tg',
   'ftg',
   'ta gueule'

];
if(isset($_POST['EnvoyerMS'])){
    extract($_POST);
    $contiendesgrandmot = true;
    if (!empty($name) && !empty($nom) && !empty($mail) && filter_var($mail , FILTER_VALIDATE_EMAIL)) {
        // Envoi du message
        if(!empty($Message)) {
            foreach ($grandmot as $grosMot) {
                if (strpos($Message, $grosMot) !== false) {
                    ETX("Le message contient un gros mot".$index."." , "Red");
                    $contiendesgrandmot = false;
                    break;
                 }
           }
           if ($contiendesgrandmot == true) {
            $headermail = ["From" => "dodmoha@gmail.com"];
            $Suject = "Contacte : ".$mail." !" ;
            mail("doddmoha@gmail.com" ,$Suject, $Message."
            Mon mail c'est (".$mail.")"  , $headermail );
           }
        }else{
            ETX("Vous ne pouvez pas envyer ce message" , "Red");
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
<H1>Contactez-nous</H1>
<?php if($SaveLogin != NULL){
?>

<form action="" method = "post">
    <input type="text" name = "name" class = "input" id = "name" placeholder= "Votre premon" require><br>
    <input type="text" name = "nom" class = "input" id = "nom" placeholder= "Votre nom" require><br>
    <input type="email" name = "mail" class = "input" id = "mail" placeholder= "Votre email" require><br>
    <textarea rows ="5" cols ="40" placeholder= "Votre message"  name = "Message" class = "mess" require></textarea><br>
    <input type="Submit" value = "Envoyer" class = "Submit" name = "EnvoyerMS">
</form>

<?php
}?>
<?php include "Include/Nav.php";?>

<style>
   .input {
    margin:10px;
    position: relative;
    top: 210px!important;
   }

   .Submit{
    position: relative;
    left:255px;
    top:195px;
   }
   .mess {
    position:relative;
    top:210px;
    font-family: "Gill Sans", sans-serif;
    left:255px;
    width: 602px;
    height: 100px;
   }

   #NavBtn{
        position: relative;
        bottom: 1430px !important;
        left: 309px !important ;
       
    }
    nav{
   
      position: relative;
      top: -259px;
    }
</style>
<?php //include "Include/Footer.php" ;?>