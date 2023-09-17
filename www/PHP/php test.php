<?php session_start()?>
<?php
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

 ?>


<?php 

$tableUsers = [

    [
    "name" => "MOha" ,
    "email" => "yo@exemple.com",
    "password" =>  '1234',
    ],

    [
        "name" => "MOhammad" ,
        "email" => "u@exemple.com",
        "password" =>  '1234',
        ],
        
        [
            "name" => "miki" ,
            "email" => "M@exemple.com",
            "password" =>  '1234',
            ],
            [
                "name" => "makaka" ,
                "email" => "kaka@exemple.com",
                "password" =>  '1234',
                ],

                [
                    "name" => "me" ,
                    "email" => "moi@exemple.com",
                    "password" =>  '1234',
                    ],
                

];




if (isset($_FILES['PPFILE']))  {
    echo "daadwq" ;
}
echo "daadwq" ;

?>




<form action="" method = "post" enctype="multipart/form-data" >

<input type="file" name = "PPFILE"  class = "PPFILE"  >
</form>