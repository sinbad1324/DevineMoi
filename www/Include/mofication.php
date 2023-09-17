<?php
if (isset($_POST['modifié'])){
    extract($_POST);
    if(!empty($user) &&  preg_match('/^[A-Za-z0-9_]+$/', $user) && $user != $SaveLogin['usernam']){
        $qq = $db->prepare("UPDATE newusers SET usernam = :u WHERE Id = :id");
       $qq->execute(["u" => $user , "id" => $SaveLogin['Id']]);
    }
    if(!empty($mail) &&  filter_var($mail , FILTER_VALIDATE_EMAIL) && $mail != $SaveLogin['email']){
        $qq = $db->prepare("UPDATE newusers SET email = :m WHERE Id = :id");
        $headermail = ["From" => "dodmoha@gmail.com"];
        $Suject = "Les modifications de votre compte" ;
        $text = "Chère Madame/Monsieur,\n\nNous avons le plaisir de vous informer que les modifications apportées à votre compte ont été enregistrées avec succès. Votre adresse e-mail a été mise à jour : ".$mail.".\n\nPour toute demande d'assistance ou pour plus d'informations, n'hésitez pas à nous contacter à l'adresse doddmoha@gmail.com.\n\nMerci de votre confiance et à bientôt !";
                mail($SaveLogin['email'], $Suject , $text , $headermail );
       $qq->execute(["m" => $mail , "id" => $SaveLogin['Id']]);
       mail($mail, $Suject , "Chère Madame/Monsieur,\n\nNous avons le plaisir de vous informer que les modifications apportées à votre compte ont été enregistrées avec succès."   ,$headermail);
    }
    if(!empty($pass)  && $pass == $cpass){
        $hashpass = password_hash($pass , PASSWORD_BCRYPT , ["cost" => 15]);
        $qq = $db->prepare("UPDATE newusers SET password = :p WHERE Id = :id");
       $qq->execute(["p" => $hashpass , "id" => $SaveLogin['Id']]);
    }
    header("Location : mofication.php");
}
?>