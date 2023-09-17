<?php 
include "Include/Function.php";
include "Include/Database.php" ;
global $db;
$SaveLogin = SaveLogin();
if (!empty($SaveLogin) && $SaveLogin){
    header('Location: MonCompte.php') ;
}

if (isset($_POST['Submit'])) {
    extract($_POST);
    if (!empty($Username) && !empty($password)) {
        $q = $db->prepare("SELECT * FROM newusers WHERE ( usernam = :Username OR email = :Username) AND dt_email IS NOT NULL ");
        $q->execute(['Username' => $_POST["Username"]]);
        $result=$q->fetch();
        if ($result == NULL) {
             ETX("CE COMPTE NE EXISTE PAS ENCORE" , "red") ;
        }elseif(password_verify($password , $result["password"])){
            ETX("C'est tout bom" , "green") ;
            $_SESSION["Auth"] = $result['Id'];
            if (!empty($_POST['checkbox']) && $result['Cokie_token'] == NULL) {
                $cookietoken = TokenFunc(100);
                setcookie ("SeSouvenire", $cookietoken, time() +60*60*24 * 31);

                $QC = $db->prepare("UPDATE newusers SET Cokie_token = :cokietok WHERE Id = :urid ") ;
                $QC->execute(["cokietok" => $cookietoken ,
             'urid'=> $result['Id']]);
            }
            header('Location: MonCompte.php') ;
        }else {
            ETX("Sois le motdepasse est faux/sois le mail" , "red") ;
        }
    }
}

?>

<?php include "Include/Head.php" ;?>
<h1>Login</h1>
<style>
a.Login { padding: 20px  30px;
    background-attachment: fixed;
    background-color: rgb(9, 52, 152);
    text-align: center;
color : white;
font-size :40px ;
text-decoration: none;}
  
  label.label {
    display: block;
position: relative;
    top:53px;
    left : 250px ;     
  }
</style>
<a href="Forget.php" class = "forget">forget password</a>
<form action="" method = "post">
<Legend>Login</Legend>
<input type="text" name ="Username" placeholder="Username" class = "input" ></br>
<input type="password" name ="password" placeholder="Password"  class = "input"  ></br>
<input type="Submit" name ="Submit"   class = "Submit"  ></br>
<input type="checkbox" name ="checkbox"   class = "checkbox"   > <label for="checkbox"  class = "label">Se souvenire de moi.</label></br>

</form>


<?php include "Include/Footer.php" ;?>