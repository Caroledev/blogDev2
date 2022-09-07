<?php
    $namePage = "Create Article";
    $message = "";
    //import des ressources
    include './utils/bddConnect.php';
    include './utils/functions.php';
    include './model/article.php';
    include './view/view_header.php';
    include './view/view_navbar.php';
    include './view/view_create_article_code.php';
    //test 
    //test si le bouton est cliqué
    if(isset($_POST['submit'])){
        //test si les champs input sont remplis
        if(!empty($_POST['nom_art']) AND !empty($_POST['contenu_art']) AND
        !empty($_POST['date_art']) AND !empty($_POST['valeur_codeauto'])){
            //stocker les valeurs POST dans des variables
            $nomArticle = cleanInput($_POST['nom_art']);
            $contenuArticle = cleanInput($_POST['contenu_art']);
            $dateArticle = cleanInput($_POST['date_art']);
            $code = cleanInput($_POST['valeur_codeauto']);
            //récupération du code
            $exist = getCode($bdd, $code);
            //test si le code existe en bdd
            if(!empty($exist)){
                createArticle($bdd,$nomArticle, $contenuArticle, $dateArticle);
                //message de confirmation
                $message = "l'article $nomArticle à été ajouté en BDD";
            }
            else{
                $message = "le code n'est pas valide";
            }
        }
        //test si un ou plusieurs champs ne sont pas remplis
        else{
            $message = "Veuillez remplir les champs du formulaire";
        }
    }
    //test si le bouton n'est pas cliqué
    else{
        $message = "Pour ajouter un article veuillez cliquer sur ajouter";
    }
    //affichage des erreurs
    echo $message;
    include './view/view_footer.php';
?>