<?php
session_start();
include "Include/Function.php";
include "Include/Database.php" ;
global $db;


while (true) {
$Code = $_GET['Code'];
if ( !empty($Code) ) {
    $q = $db->prepare("SELECT * FROM gameplayer WHERE Code = :code AND GameStarte = :str ");
    $q->execute([
        ':code'   =>$Code,
        ':str'=>"true"
    ]);
    if ($q->rowCount() > 0) {
        header("Location: InTheGame.php?Code=$Code");
        $_SESSION['CanPlay'] = true;
        exit();
    }
    sleep(1);
}else{header("Location: GameSetting.php");}

}


?>