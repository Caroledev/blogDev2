<?php
    //fonction qui retourne la liste des categories
    function getAllCategory($bdd){
        try {
            //stocker et évaluer la requête
            $req = $bdd->prepare("SELECT id_cat, nom_cat FROM 
            categorie ORDER BY nom_cat ASC");
            //exécuter la requête
            $req->execute();
            //stocker dans $data le résultat de la requête (tableau associatif)
            $data = $req->fetchAll(PDO::FETCH_ASSOC);
            //retourner le tableau associatif
            return $data;
        } 
        catch (Exception $e) 
        {
            //affichage d'une exception en cas d’erreur
            die('Erreur : '.$e->getMessage());
        }
    }
?>