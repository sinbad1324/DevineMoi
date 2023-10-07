<?php

$to = "Sinbad.ok@yahoo.com" ;
$tomoi = "mohammad.izdpn@eduge.ch" ;
$header = ["From" => "doddmoha@gmail.com"] ;
mail($tomoi , "salut" , "salue" ,$header) ;

$user = [
    'name' => 'John Doe',
    'email' => 'johndoe@example.com',
    'age' => 30
];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exemple</title>
</head>
<body>
    <!-- // <?php ?> --> 
    <?php foreach ($user as $value): ?>
        <?php echo $value . ': ' . '<br>'; ?>
    <?php endforeach; ?>
</body>
</html>

<?php
$a = 5;
$b = "5";

if ($a === $b) {
    echo "Les variables sont égales en valeur et en type." . "</br>";
} else {
    echo "Les variables sont différentes en valeur ou en type." . "</br>";
}

?>
 
 <?php 

function trouver($p) {
    $l ;
    foreach ($p as $key ) {
     if (array_key_exists("moi" , $key)) {
    if ($key["moi"]) {
        $l = true ;
    }
    else {
        $l = false ;
    }
    }
}
return $l;
}

$tableu = [
[
    "moi" => true ,
    "nom " => "moha" ,
],
["moi" => false ,
"nom " => "mohamad" ,],

["moi" => false ,
"nom232 " => "mohamad2" ,],
] ;

echo "c est = " . trouver($tableu) . "</br>" ;
//var_dump(trouver($tableu)); //    afficher le tableau avec la
if (trouver($tableu) == true )  {
    echo "true" ;
}else {
    echo "false" . "</br>" ;
}


 ?>

 <?php

$array = array('fruit' => 'pomme', 'couleur' => 'rouge', 'prix' => 2.50);
$output = print_r($array);
echo $output;

function tokenFunction($Value){
$caracter = "qwertzuiop13244657890ADSFGHJKLyxcvbnmQWERTZUIOPasdfghjklYXCVBNM" ;
return substr(str_shuffle(str_repeat($caracter , $Value)) , 0 , $Value);

}

$token = tokenFunction(100) ;

echo $token;

//include "database.php" ;

//global $db ;

//$q = $db-> prepare("INSERT INTO users(nom ,age,email,password)  VALUES(:nom , :age , :email , :password) ");
//$q-> execute([
  //  'nom' => "ois" ,
   //'age' => 12 ,
   //'email'=> "ios@gamil.com",
   //'password'=> "12344556543",
 
//]);
                                      //LIMIT 2 OU 3 OU 7  ex : $q =  $db->query("SELECT * FROM users" LIMIT 7)  affiche 7 utilisateur 
//$q =  $db->query("SELECT * FROM users" ) ;
//while ($user = $q -> fetch()) {

//?>
  <!--<h1>Salut M.// $user["nom"] ; ?></h1> -->
    <?php
//}
?>

<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="PPFILE" class="PPFILE">
    <input type="submit" value="Upload">
</form>

<?php
if (isset($_FILES['PPFILE'])) {
    $file = $_FILES['PPFILE'];
    echo "Nom du fichier : " . $file['name'] . "<br>";
    echo "Type du fichier : " . $file['type'] . "<br>";
    echo "Taille du fichier : " . $file['size'] . " octets <br>";
    echo "Emplacement temporaire du fichier : " . $file['tmp_name'] . "<br>";
    echo "Code d'erreur : " . $file['error'] . "<br>";
}



