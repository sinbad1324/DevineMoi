<?php 
session_start();
include "Include/Function.php";
include "Include/Database.php" ;
global $db;
$SaveLogin = SaveLogin();
?>

<?php include "Include/Head.php" ;?>
<h1>Forget your password</h1>
<?php
if (empty($_SESSION['forget'])) {
    if (!empty($_GET['id']) && !empty($_GET['token'])) {
        header('Location: Login.php') ;
    }
    if (isset($_POST['Submit'] )) {
        if (!empty($_POST['mailfo']) && filter_var($_POST['mailfo'] , FILTER_VALIDATE_EMAIL)) {
            $email = $_POST['mailfo'] ; 
            $q = $db->prepare("SELECT * FROM newusers WHERE email = ? AND password_token iS NULL ") ;
             $q->execute([$email]) ;    
            $resu = $q->fetch();
            if ($resu && $resu != null) {
            $id = $resu['Id'];
            $tokenfo = TokenFunc(100) ;
            $Q = $db->prepare("UPDATE newusers SET password_token = ? WHERE id = ?");
            $Q->execute([$tokenfo, $id]);            
            $headermail = ["From" => "dodmoha@gmail.com"];
            $text = "Bonjour Madame/Monsieur, veuillez cliquer sur le lien ci-dessous pour pouvoir  changer votre passeword. Email : ".$email."\n\nLe lien : http://localhost/Forget.php?id=".$id."&token=".$tokenfo;
            mail(  $email , "Make new password" , $text , $headermail) ;
           $_SESSION["forget"] = true;
            }else {
                echo "<p style='color :red'>Invalid Email or Password!</p>";
                header("Location: Login.php");
            }
        }
    }
    ?>
    <form action="" method="post">
        <input type="text" name="mailfo" placeholder="Email" class="input"></br>
        <input type="Submit" name="Submit" class="Submit"></br>
    </form>
<?php 
}elseif(!empty($_SESSION['forget']) && $_SESSION['forget'] == true ) {
    if (!empty($_GET['id']) && !empty($_GET['token'])) {
        $id = $_GET['id'];
        $token = $_GET['token'];
        $q = $db->prepare("SELECT * FROM newusers WHERE Id = ? AND password_token = ?");
        $q->execute([$id , $token]);
        $result = $q->fetch();
       if ($result && $result != false ) {
        if(isset($_POST['Submitpassword'])) {
            $pass =$_POST['password'];
            $cpass= $_POST['password_confi'];
            if(!empty($pass) && !empty($cpass) && $pass == $cpass){
                $hashedPassword = password_hash($pass ,  PASSWORD_BCRYPT, ['cost' => 15]);
                $E = $db->prepare("UPDATE newusers SET password = :hashedPassword, password_token = :passwoerdnewtoken, dt_password = NOW() WHERE Id = :id");
                $E->execute([
                    'hashedPassword' => $hashedPassword,
                    "passwoerdnewtoken" => NULL ,
                    'id' => $id
                ]);

                $_SESSION['forget'] = NULL;
                header('Location: Login.php') ;
            } 
        }
    }else {
        ETX("Votre token ou id n'est pas valid" , "red") ;

    }
        ?>
    <form action="" method="post">
        <input type="password" name="password" placeholder="New Password" class="input"></br>
        <input type="password" name="password_confi" placeholder="Confirme password" class="input"></br>
        <input type="Submit" name="Submitpassword" class="Submit"></br>
    </form>
        <?php
    }
}

?>

<?php include "Include/Footer.php" ;?>
