<?php
    $namePage = "Create User";
    $message = "";
    //import des ressources
    include './utils/bddConnect.php';
    include './utils/functions.php';
    include './model/utilisateur.php';
    include './view/view_header.php';
    include './view/view_navbar.php';
    include './view/view_create_user.php';
    //test 
    //test si le bouton est cliqué
    if(isset($_POST['submit'])){
        //test si les champs input sont remplis
        if(!empty($_POST['nom_util']) AND !empty($_POST['prenom_util']) AND
        !empty($_POST['mail_util']) AND !empty($_POST['password_util'])){
            //stocker les valeurs POST dans des variables
            $nom = cleanInput($_POST['nom_util']);
            $prenom = cleanInput($_POST['prenom_util']);
            $mail = cleanInput($_POST['mail_util']);
            //récupération du compte si il existe
            $exist = showUserByMail($bdd, $mail);
            //test si le compte existe
            if(empty($exist)){
                //test import d'un fichier (si il existe et si il à un nom)
                if(isset($_FILES['img_util']) AND $_FILES['img_util']['name']!=""){
                    //stockage des valeurs du fichier importé
                    $name = $_FILES['img_util']['name'];
                    $tmpName = $_FILES['img_util']['tmp_name'];
                    $size = $_FILES['img_util']['size'];
                    $error = $_FILES['img_util']['error'];
                    $emplacement = './asset/image/'.$name;
                    //appeler la fonction pour déplacer et renommer un fichier
                    move_uploaded_file($tmpName, $emplacement);
                }
                //test si aucune image
                else{
                    $emplacement = './asset/image/defaut.png';
                }
                //version bcrypt
                $password = password_hash(cleanInput($_POST['password_util']), PASSWORD_DEFAULT);
                //fonction ajouter un utilisateur en BDD
                createUserV3($bdd,$nom, $prenom, $mail, $password, $emplacement);
                //message de confirmation
                $message = "le compte $nom à été ajouté en BDD";
            }
            //test sinon le compte existe
            else{
                $message = "le compte existe déja";
            }
        }
        //test si un ou plusieurs champs ne sont pas remplis
        else{
            $message = "Veuillez remplir les champs du formulaire";
        }
    }
    //test si le bouton n'est pas cliqué
    else{
        $message = "Pour ajouter un utilisateur veuillez cliquer sur ajouter";
    }
    //affichage des erreurs
    echo $message;
    include './view/view_footer.php';
?>