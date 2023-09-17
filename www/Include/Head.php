<?php
$urlimg = "img/photo de profile";
if (isset($_FILES['PPFILE'])) {
    if ($_FILES['PPFILE']['error'] === UPLOAD_ERR_OK && $_FILES['PPFILE']['size'] <= 3000000) {
        $fileinfo = pathinfo($_FILES['PPFILE']['name']);
        $extension = strtolower($fileinfo['extension']);
        $lesextension = ['jpg', 'jpeg', 'png'];
        if (in_array($extension, $lesextension)) {
            $tmpfilef = $_FILES['PPFILE']['tmp_name'];
            $targetDir = 'img/';
            $ffname = uniqid() . '.' . $extension;
            $lechamin = $targetDir . $ffname;
            if (move_uploaded_file($tmpfilef, $lechamin)) {
                $urlimg = $lechamin;
                $q = $db->prepare("UPDATE newusers SET PP = :pp WHERE id = :monid ");
                $q->execute(
                    [
                        ":pp" => $urlimg,
                        ':monid' => $SaveLogin['Id'],
                    ]
                );

                $_SESSION["PP"] = $urlimg;
                
            } else {
                ETX("Erreur lors du déplacement du fichier.", "red");
            }
        } else {

        }
    } else {
        ETX("Erreur lors du téléchargement du fichier ou fichier trop volumineux.", " Red");
    }
}
?>
<?php
if ($SaveLogin && !empty($SaveLogin['PP'])) {
    $urlimg = $SaveLogin['PP'];
}

include_once("Include/mofication.php");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon site de essaye</title>
</head>

<body>
    <div class="head">
        <?php if ($SaveLogin == null) {
            ?>
            <a href="Sing.php" class="LS">Sing up</a><a href="Login.php" class="LS">Login</a>
            <?php
        } elseif ($SaveLogin != null) {
            if ($_SESSION['Auth'] == $SaveLogin['Id']) {
                ?>
                <div class="PP">
                    <img src="<?= $urlimg ?>" alt="">
                    <button class="btn" id="btn1">Profile</button>
                </div>
                <div class="profile" id="profile">
                    <a href="deconevtion.php" class="deco">Déconnection</a>
                    <button class="mld" id="mld">Modifie les donnée</button>
                    <p class="infop"> Username:
                        <?= $SaveLogin["usernam"] ?>
                    </p>
                    <p class="infop"> Email:
                        <?= $SaveLogin["email"] ?>
                    </p>
                    <p class="infop"> Password: *****</p>
                    <p class="infop"> Age:
                        <?= $SaveLogin["age"] ?>
                    </p>
                    <form action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="PPFILE" class="PPFILE" accept=".jpg,.jpeg,.png" style="        display: block;
                                    position: relative;
                                      top : -70px ;
                                      left:120px;
                                      color : white;
                                   
                            ">
                        <input type="submit" value="Enregistré" style="
                                  position: relative;
                                      top : -65px ;
                                      left:140px;
                            ">
                    </form>

                    <div class="PP2" id="PP2">
                        <img src="<?= $urlimg ?>" alt="">
                    </div>
                </div>
                <div class="mlp" id="mlp">
                    <h1 class="titre">Modification</h1>
                    <button class="backmld" id="backmld">↩</button>
                    <form action="" method="post">
                        <input type="text" name="user" placeholder="Username" class="MDinput"><br />
                        <input type="email" name="mail" placeholder="Email" class="MDinput"><br />
                        <input type="password" name="pass" placeholder="Password" class="MDinput"><br />
                        <input type="password" name="cpass" placeholder="ConfirmePassword" class="MDinput"><br />
                        <input type="submit" name="modifié" value="modifié" class="modifiéinput"><br />

                    </form>
                </div>
                <style>
                    div.PP {
                        position: absolute;
                        top: 20px;
                        right: 100px;
                        margin: 0;
                        padding: 0;
                        width: 80px;
                        height: 80px;
                        border: none;
                        border-radius: 100%;
                        box-shadow: none;
                        background-color: black;

                    }

                    .PP img {
                        border-radius: 100%;
                        width: 80px;
                        height: 80px;
                        position: relative;

                    }

                    .PP button.btn {
                        display: inline-block;
                        text-decoration: underline;
                        cursor: pointer;
                        border-radius: 10px;
                        width: 80px;
                        border: none;
                        height: 20px;
                        text-align: center;
                        position: relative;
                        top: 85px;
                        font-size: 20px;
                        color: rgb(179, 179, 179);
                        background-color: rgb(53, 95, 193);
                        position: absolute;
                        right: 0.1px;
                        visibility: visible;
                        /* Utilisez "visible" à la place de "hidden" pour rendre le bouton visible */
                    }

                    #profile {
                        visibility: hidden;
                        background-color: white;
                        z-index: 1;
                        display: block;
                        float: right;
                        width: 350px;
                        height: 550px;
                        position: relative;
                        right: 20px;
                        opacity: 0;
                        top: 160px;
                        border: solid black 2px;
                        border-radius: 10px;
                        box-shadow: 0 0 0 #000000, -10px 10px 10px rgb(0, 0, 0);
                        padding: 0;
                    }

                    #backmld {
                        position: relative;
                        top: -20px;
                        left: 10px;
                        border: none;
                        font-size: 35px;
                        background-color: white;
                        cursor: pointer;
                    }

                    .MDinput {
                        background-color: white;
                        width: 300px;
                        height: 40px;
                        margin: 5px;
                        position: relative;
                        top: 70px;
                        left: 10px;
                        border-left: none;
                        border-right: none;
                        border-top: none;
                        border-bottom: solid blue 2px;
                        text-align: bottom;
                    }

                    .modifiéinput {
                        display: inline-block;
                        position: relative;
                        top: 170px;
                        left: 110px;
                        padding: 10px 25px;
                        font-size: 25px;
                        border: solid black 2px;
                        border-radius: 10px;
                        background-color: white;
                    }

                    .titre {
                        color: black;
                        margin: 0;
                        position: relative;
                        top: 80px;
                        left: 80px;
                        text-decoration: underline;
                    }

                    #mlp {
                        background-color: white;
                        z-index: 1;
                        display: block;
                        float: right;
                        width: 350px;
                        height: 550px;
                        position: relative;
                        right: 20px;
                        opacity: 0;
                        top: 160px;
                        border: solid black 2px;
                        background-color: white;
                        border-radius: 10px;
                        box-shadow: 0 0 0 #000000, -10px 10px 10px rgb(0, 0, 0);
                        visibility: hidden;
                    }

                    #PP2 {
                        border-radius: 100%;
                        width: 80px;
                        height: 80px;
                        position: relative;
                        left: 40%;
                        top: -200px;
                    }

                    #PP2 img {
                        border-radius: 100%;
                        width: 80px;
                        height: 80px;
                    }

                    @keyframes move {
                        0% {
                            transform: translateX(-120);
                            opacity: 1;
                        }

                        100% {
                            transform: translateX(20);
                            opacity: 1;                         visibility: visible;
                        }
                    }

                    @keyframes back {
                        70% {
                            transform: translateX(-100px);
                            opacity: 0;
                        }

                        100% {
                            transform: translateX(20px);
                            opacity: 0;                         visibility: hidden;

                        }
                    }

                    div.move {
                        animation: move 1s forwards;
                    }

                    div.back {
                        animation: back 1s forwards;
                    }


                    @keyframes move2 {
                        0% {
                            transform: translateX(-120);
                            opacity: 1;
                        }

                        100% {
                            transform: translateX(355px);
                            opacity: 1;                         visibility: hidden;

                        }
                    }

                    @keyframes back2 {
                        70% {
                            transform: translateX(-100px);
                            opacity: 0;
                        }

                        100% {
                            transform: translateX(0px);
                            opacity: 0;                        visibility: visible;}

                    }

                    div.move2 {
                        animation: move2 1s forwards;
                    }

                    div.back2 {
                        animation: back2 1s forwards;
                    }
                </style>


            <?php
            }
        }
        ?>

        <style>
            .infop {
                position: relative;
                top: 200px;
                left: 20px;
                font-size: 20px;
            }

            .mld {
                position: absolute;
                left: 20px;
                top: 410px;
                border: none;
                display: inline-block;
                padding: 0px 0px;
                text-decoration: underline;
                background-color: white;
                font-size: 15px;
                border-radius: 0px;
                cursor: pointer;
                color: black;
            }

            .deco {
                cursor: pointer;
                position: absolute;

                left: 28%;
                top: 86%;
                text-decoration: none;
                display: inline-block;
                border: solid black 2px;
                padding: 15px 25px;
                border-radius: 9px;
                font-size: 20px;
                color: black;
            }

            body {
                margin: 0;
            }

            div.head {

                background-color: rgb(53, 95, 193);
                width: 100%;
                height: 140px;
                text-align: left;
                position: relative;
                top: -30px;
            }

            a.LS {
                padding: 20px 30px;
                background-attachment: fixed;
                background-color: rgb(9, 52, 152);
                text-align: center;
                color: white;
                font-size: 25px;
                text-decoration: none;
                position: relative;
                top: 50px;
                left: 70%;
                margin: 5px;
            }

            a.forget {
                text-align: center;
                color: black;
                text-decoration: none;
                position: relative;
                top: 325px;
                left: 47%;
                font-size: 20px;
                margin: 0;
            }


            a:hover {
                text-decoration: none;
            }

            h1 {
                color: white;
                position: relative;
                bottom: -20px;
                left: 40px;
            }

            h2 {
                color: white;
                position: relative;
                bottom: -30px;
                left: 40px;
            }


            input.input {
                height: 50px;
                width: 600px;
                border-top: none;
                border-left: none;
                border-right: none;
                margin-top: 10px;
                border-color: blue;
                position: relative;
                top: 120px;
                left: 15%;
            }

            .Submit {
                background-color: blue;
                color: white;
                border: none;
                font-weight: bold;
                cursor: pointer;
                margin-top: 20px;
                padding: 10px 70px;
                position: relative;
                top: 150px;
                left: 220px;
            }


            Legend {
                font: 3em sans-serif;
                position: relative;
                top: 100px;
                left: 220px;
            }

            input.checkbox {
                display: inline-block;
                width: 20px;
                height: 20px;
                vertical-align: middle;
                text-indent: -9999px;
                position: relative;
                top: 75px;
                left: 220px;
                border: solid black;

            }

            #write {
                border: none;
            }

            input.input:active {
                border: blue solid;
            }

            span {
                text-decoration: underline;
                font-size: 28px;
            }

            .QuelJeux {
                height:2000px;
               overflow: auto;
                display: Grid;
                width: 100%;
                position: relative;
                bottom:970px;
                padding: 0;
                grid-template-columns: 0.3fr 0.3fr 0.3fr 0.3fr;
            }

            .BOX {
                text-align: center;
                width: 300px;
                height: 300px;
                background-color: white;
                border: solid black 3px;
                border-radius: 30px;
                position: relative;
                left: 50px;
            }
         
        </style>


        <script>
            const button = document.getElementById('btn1');
            const div = document.getElementById('profile');

            button.addEventListener('click', function () {
                if (div.classList.contains('move')) {
                    div.classList.remove('move');
                    div.classList.add('back');
                } else {
                    div.classList.remove('back');
                    div.classList.add('move');
                }
            });

            const button2 = document.getElementById('mld');
            const div2 = document.getElementById('mlp');

            button2.addEventListener('click', function () {
                if (div2.classList.contains('move2')) {
                    div2.classList.remove('move2');
                    div2.classList.add('back2');
                } else {
                    div2.classList.remove('back2');
                    div2.classList.add('move2');
                }
            });

            const button3 = document.getElementById('backmld');

            button3.addEventListener('click', function () {
                if (div2.classList.contains('move2')) {
                    div2.classList.remove('move2');
                    div2.classList.add('back2');
                }
            });

        </script>