<?php

/****************************************************************************************
 ******************* SYNCHRONISATION DE LA BD LOCAL AVEC LA BD EN LIGNE******************
 ****************************************************************************************
 ****************************AVERTISSEMENTS**********************************************
 ******* - LES AGENCES CREER LOCALEMENT DOIVENT EGALEMENT ETRE CREER EN LIGNE ***********
 *******   AVEC LES MEME INFORMATION (ID Y COMPRIS)**************************************
 ******* - LES TRANSACTIONS SONT UTILISEES POUR GARANTIR L'INTEGRITE DES DONNEES ********
 ******* - NE MODIFIER CE FICHIER QUANT CAS DE FORCE MAJEUR(UNIQUEMENT LE TECHNICIEN) ***
 ****************************************************************************************/
  // connexion à la base de données local
    $server      = "mysql:host=127.0.0.1";
    $bd          = "pressing2";
    $util        = "root";
    $mtp         = "";
    $conneclocal = new PDO("$server;dbname=$bd","$util","$mtp");


    // connexion à la base de données en ligne
    $server       = "mysql:host=localhost";
    $bd           = "pressingline";
    $util         = "root";
    $mtp          = "";
    $conneconline = new PDO("$server;dbname=$bd","$util","$mtp");
    
    $datetime = date('Y/m/d h:i:s');
    $cookie   = $_GET['cookie'];
    // récuperation de l'agence en local
    $ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
    if($age = $conneclocal -> query($ag)){
        while($agen = $age -> fetch()){
            $agence = $agen['id_agence'];
        }
    }

    
    // ENVOI DES SMS NON ENVOYES
    /* --------------------------------------------------------------------------------------------------------
    - les messages non envoyé et stocker dans une table sont a achaque synchronisation reenvoyé : si l'envoi  -
    -  est un succès, le message est suprrimer dans la table dans le cas contraire.                           -
    - un autre essaie d'envoi est lancé apres la prochaine synchronisation.                                   -
    - cette action est executer jusqu'a ce que tous les messages sont envoyés avec succès                     -
    --------------------------------------------------------------------------------------------------------- */

    require('../sendMessage.php');
    $se = "SELECT * from nosendsms WHERE agence='$agence'";
    if($sel =$conneclocal -> query($se)){
        while($sele = $sel -> fetch()){
            $pho     = $sele['phoneClient'];
            $sm      = $sele['message'];
            $ligne   = $sele['ligne'];
            $idcl    = $sele['client'];
            $facture = $sele['facture'];
            
            $scl = "SELECT nom_cl FROM client WHERE id_client='$idcl' AND agence='$agence'";
            if($dcli = $conneclocal -> query($scl)){
                while($sclie = $dcli -> fetch()){
                    $nomcl = $sclie['nom_cl'];
                }
            }

            $se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
            if($sel = $conneclocal -> query($se)){
                while ($sele = $sel -> fetch()) {
                    $nomuser = $sele['nom_user'];
                }
            }
            
            // verifions si le vetement est encore au pressing (si oui envoyer le message si non supprimer le message)
            $ve = "SELECT id_depot FROM depotvetement WHERE code='$facture' AND agence='$agence'";
            if($ver = $conneclocal -> query($ve)){
                $bre = $ver -> rowCount();
                if($bre == 0 ){
                    // suppression du message car le vetement a deja ete retirer
                    $de = "DELETE FROM nosendsms WHERE ligne='$ligne'";
                    if($del = $conneclocal -> query($de)){}else{throw new Exception();}
                }else{
                    // envoi du message car le vetement est toujours au pressing
                    $Result = sendBulkSms($pho, $sm);
                    if (is_array($Result) && isset($Result['status']) && $Result['status'] == 'pending') {
                        // le message a bien été envoyé
                        $de = "DELETE FROM nosendsms WHERE ligne='$ligne'";
                        if($del = $conneclocal -> query($de)){}else{throw new Exception();}
                        $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Message','Envoi de message','Envoi d\'un sms a :".$nomcl.", message:".$sm."','$agence')";
                        if($ins = $conneclocal -> exec($in)){}else{throw new Exception();}  
                    } else {/* message non envoyé(accune action necessaire)*/}
                }
            }
            
        }
    }



    $conneclocal  -> beginTransaction();
    $conneconline -> beginTransaction();
try {
  
    

    // Gestion des comptes utilisateur
    /* Après la creation d'un compte utilisateur(par l'administrateur), l'employer dois ce connecter pour la premier fois depuis la 
    base de données en ligne et apres connexion, ses informations sont automatiquement copier en local(la il peu se connecter sans connexion. ses données
    de connexion existe en local).
    Apres connexion, il modifi son mot de passe et afin de quarantire l'intégrité des données, son nouveau mot de passe va etre envoyer au serveur
    en ligne afin de mettre a jour son compte utilisateur*/
    
    $use = "SELECT * FROM comptes WHERE agence='$agence'";
    if($user = $conneclocal -> query($use)){
        while($users = $user -> fetch()){
            $mdp         = $users['mdp_user'];
            $login       = $users['login_user'];
            $statutlocal = $users['statut'];
    
            // verifier en ligne 
            $usligne = "SELECT * FROM comptes WHERE agence='$agence' AND mdp_user='$mdp'";
            if($useligne = $conneconline -> query($usligne)){
                $nbrUserLigne = $useligne -> rowCount();
                if($nbrUserLigne < 1){// l'utilisateur a modifier son mot de passe
                    $upuse = "UPDATE comptes SET mdp_user='$mdp' WHERE login_user='$login'";
                    if($upuser = $conneconline -> query($upuse)){}
                }else{
                    // si le statut de l'utilisateur a été modifier
                    while($userligne = $useligne -> fetch()){
                        $statutligne = $userligne['statut'];
                        if($statutlocal != $statutligne){echo 'yess';
                            $upuse = "UPDATE comptes SET statut='$statutligne' WHERE login_user='$login'";
                            if($upuser = $conneclocal -> query($upuse)){}
                        }
                    }
                }
            }
        }
    }

    // récuperation des cartes existant en ligne
    $cf = "SELECT * FROM cartefidelite INNER JOIN client on cartefidelite.id_client=client.id_client WHERE client.agence='$agence'";
    if($carte = $conneconline -> query($cf)){
        while($cartef = $carte -> fetch()){
            $idCF = $cartef['id_carte'];
            $idclient = $cartef['id_client'];
            $Pourcentage = $cartef['pourcentage'];
            $date_enreg = $cartef['date_enreg'];
            $montantRed = $cartef['montantReduit'];
            $agenceCl = $cartef['agence'];
        
            // vérification de l'existance de la carte en local(si le client a été enregistrer dans le pressing)
            $vecf = "SELECT * FROM cartefidelite WHERE id_carte='$idCF'";
            if($vercf = $conneclocal -> query($vecf)){
                if ($vercf -> rowCount() == 0){
                    $incf = "INSERT INTO cartefidelite VALUES('$idCF','$idclient','$Pourcentage','$date_enreg','$montantRed','$agenceCl')";
                    $conneclocal -> exec($incf);
                }else
                {

                    // remonter les données en ligne (ca veut dire que le client a consommer sa reduction)

                    // le solde et le pourcentage en ligne doit toujours etre supérieur ou égal au solde en local
                  /*   if($Pourcentage )
                    while($cartefCl = $vercf -> fetch()){
                        $idCFL        = $cartefCl['id_carte'];
                        $idclientL    = $cartefCl['id_client'];
                        $PourcentageL = $cartefCl['pourcentage'];
                        $date_enregL  = $cartefCl['date_enreg'];
                        $montantRedL  = $cartefCl['montantRed'];
                        $agenceL      = $cartefCl['agence'];

                        if($PourcentageL != $Pourcentage && $montantRedL != $montantRed){
                            $upCF = "UPDATE cartefidelite SET pourcentage='$PourcentageL',montantRed='$montantRedL' WHERE id_carte='$idCFL'";
                            $conneconline -> query($upCF);
                        }
                    } */
                }
            }
        }
    }

    // vérification si une carte a été recharge(si oui inserer les données de recharge dans la table rechargecf et mettre a jour la table cartefidelite)


    

    // copie de la carte en local(si elle n'existe pas en local)

    //tableau contenant toutes les tables dont les données vont etre extrait
    $tables = array(
       // array('cartefidelite','id_carte'),
        array('client', 'id_client'),
        array('cloturecaisse', 'id_clot'),
        array('commande', 'id_cmd'),
       // array('comptes','id_compte'),
        array('depense', 'id_depense'),
        array('depotvetement', 'id_depot'),
        array('facture', 'id_facture'),
        array('facturesupprimer', 'id_factsupp'),
        array('gestse', 'id_ligne'),
      //  array('rechargecf','id_rech'),
        array('reglement', 'id_reg'),
        array('sortivetement', 'id_sort'),
        array('typedepense', 'id_dep'),
        array('typeverseargent', 'id_typevera'),
        array('typevetement', 'id_typevet'),
        array('verseargent', 'id_vera'),
        array('versement', 'id_verse'),
        array('message', 'ligne'),
        array('dispovetement', 'id_depot'),
        array('backvetement', 'ligne')
    );

    for($i = 0; $i < count($tables);$i++)
    {
        // supression des données de la table en ligne
        $de = "DELETE FROM ".$tables[$i][0]." WHERE agence='$agence'";//
        $del = $conneconline -> query($de);

        // Récupérer les colonnes de la table source
        $stmt = $conneclocal->query("SHOW COLUMNS FROM ".$tables[$i][0]);
        $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
        $columnsList = implode(", ", $columns);

        // Sélectionner les données de la table source
        $stmt = $conneclocal->query("SELECT $columnsList FROM ".$tables[$i][0]." WHERE agence='$agence'");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Préparer l'insertion dans la table cible
        $placeholders = implode(", ", array_fill(0, count($columns), '?'));
        $insertStmt = $conneconline->prepare("INSERT INTO ".$tables[$i][0]." ($columnsList) VALUES ($placeholders)");

        // Insérer les données
        foreach ($rows as $row) 
        {
            $insertStmt->execute(array_values($row));
        }
    }
    // Valider les transactions
    $conneconline->commit();
    $conneclocal->commit();
} catch (Exception $ex) 
{
    
    $conneconline->Rollback();
    $conneclocal->Rollback();
    echo 'Erreur serveur '.$ex;
}


?>