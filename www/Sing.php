<?php
include "Include/Function.php";
include "Include/Database.php" ;
global $db;
$SaveLogin = SaveLogin();
if (!empty($SaveLogin)){
    header('Location: MonCompte.php') ;
}
$Erorrs = [];
if(isset($_POST["Submit"])) {
    extract($_POST);
    if(empty($Username) || !preg_match('/^[A-Za-z0-9_]+$/', $Username)) {
        $Erorrs['Username'] = "Vous ne pouvez pas utiliser ce Nom" . "</br>" ;
    }else {
        $q = $db->prepare("SELECT usernam FROM newusers WHERE usernam = :usernam ");
       $req =  $q->execute(["usernam" => $Username]);
       if ($q->rowCount() > 0) {
        // username already exists
        $Erorrs['Username'] = "Ce User existe deja";
        }
    }

    if (empty($email) || !filter_var($email , FILTER_VALIDATE_EMAIL)) {
       $Erorrs['email'] = "Votre email ne fonction pas essayer un autre svp!"."</br>";
    }
    else{ 
        $q = $db->prepare("SELECT email FROM newusers WHERE email = :email ");
        $req =  $q->execute(["email" => $email]);
        if ($q->rowCount() > 0) {
         // username already exists
         $Erorrs['Username'] = "Ce eamil n'est pas valide ";
         }
    }

    if (empty($age) || $age <= 15 ){
          $Erorrs['age'] = "Votre age n'est pas validé" . "</br>";
    }

    if(empty($password) || $password != $password_Confirme  ){
        $Erorrs['pass'] = 'Les mots de passe doivent être ident' ;
    }else {
    }

    if(empty($Erorrs)){
        $q = $db -> prepare("INSERT INTO newusers SET usernam = ? , email = ? , password = ? , email_token = ? , age = ? , password_token = NULL ");
        $token = TokenFunc(60);
        $password_hashed = password_hash($password, PASSWORD_BCRYPT, ['cost' => 15]);
        $q->execute([
            $Username ,
            $email    ,
            $password_hashed,
            $token ,
            $age 
        ]);
     $id = $db->lastInsertId();
     
     $headermail = ["From" => "dodmoha@gmail.com"];
     $Suject = "Confirmation de votre compte" ;
     $text = "Bonjour Madame/Monsieur, veuillez cliquer sur le lien ci-dessous pour vérifier votre adresse e-mail : ".$email."\n\nLe lien : http://localhost/ConfirmeEmail.php?id=".$id."&token=".$token;
     mail($email, $Suject , $text , $headermail );
     header('Location: login.php') ;

    }else {
        foreach ($Erorrs as $i => $v){
            Ecrir( $v , "red");
    }
   }
}
?>


<?php include "Include/Head.php" ;?>
<h1>Sing</h1>
<style>
    a.Sing { 
        padding: 20px  30px;
        background-attachment: fixed;
        background-color: rgb(9, 52, 152);
        text-align: center;
        color : white;
        font-size :40px ;
        text-decoration: none;
    }
</style>

<form action="" method = "post">
<Legend>Sing Up</Legend>
<input type="text" name ="Username" placeholder="Username" class = "input"  required></br>
<input type="email" name ="email" placeholder="Email" class = "input"  required ></br>
<input type="password" name ="password" placeholder="Password"  class = "input"  required ></br>
<input type="password" name ="password_Confirme" placeholder="Confirme password"  class = "input"  required ></br>
<input type="number" name ="age" placeholder="Age" class = "input"  required ></br>
<input type="submit" name ="Submit" class = "Submit" ></br>

</form>


<?php include "Include/Footer.php" ;?>

