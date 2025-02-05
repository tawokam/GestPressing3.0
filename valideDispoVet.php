<?php
require('connect.php');
$connec -> beginTransaction();
try {
    require('sendMessage.php');
    $codefact = $_GET['codefact'];
    $cookie   = $_GET['cookie'];
    $date     = date('Y/m/d');

    // récuperation de l'agence en local
    $agence = 0;
    $ag = "SELECT * FROM agence WHERE statut = 'activer'";
    if($age = $connec -> query($ag)){
        while($agen = $age -> fetch()){
            $agence      = $agen['id_agence'];
            $Nomagence   = $agen['nom'];
            $Phoneagence = $agen['telephone'];
        }
    }

    // copie des vetement de la facture et insertion dans la table Dispovetement
    $re="SELECT * FROM depotvetement where depotvetement.code='$codefact' AND depotvetement.agence='$agence'";
    if($req = $connec -> query($re)){
        while($reqe = $req -> fetch()){

            $idClient        = $reqe['id_client'];
            $idTypevet       = $reqe['id_typevet'];
            $qte_dep         = $reqe['quantite_dep'];
            $description_dep = $reqe['description_dep'];
            $montaverse      = $reqe['montaverse'];
            $monttotal       = $reqe['monttotal'];
            $date_depot      = $reqe['date_depot'];
            $date_retrait    = $reqe['date_retrait'];
            $utilisateur     = $cookie;
            $date_enreg      = $date;
            $code            = $reqe['code'];
            $agence          = $agence;

            // insertion dans la table Dispovetement
            $in = "INSERT INTO Dispovetement VALUES('','$idClient','$idTypevet','$qte_dep','$description_dep','$montaverse','$monttotal','$date_depot','$date_retrait','$utilisateur','$date_enreg','$code','$agence')";
            $connec -> exec($in);
        }
    }

    // Envoi du SMS au client
    $cl = "SELECT * FROM facture inner join client on facture.id_client = client.id_client WHERE facture.code='$codefact' AND facture.agence='$agence' AND facture.id_client='$idClient'";
    if($cli = $connec -> query($cl)){
        while($clien = $cli -> fetch()){
            $montfact = $clien['monttotal'];
            $avance   = $clien['avance'];
            $reste    = $clien['reste'];
            $phoneCl  = $clien['telephone_cl'];
            
            $message = "Chère client(e) vos vetements portant le numéro de facture ".$codefact." sont disponibles.Avance:".$avance.",Reste:".$reste.".Contacter le ".$Phoneagence." (".$Nomagence.") pour plus d'informations";
            $Result = sendBulkSms($phoneCl, $message);
            if (is_array($Result) && isset($Result['status']) && $Result['status'] == 'pending') {
                echo 1; // le message a bien été envoyé
                $in = "INSERT INTO message VALUES('','$message','$phoneCl','$idClient','$agence','$cookie')";
                if($ins = $connec -> exec($in)){}else{throw new Exception();}
            } else {
                // il ya eu un probleme lors de l'envoi du SMS
                function insertIntoNosendsms($connec, $idClient, $phoneCl, $message, $agence, $facture) {
                    try {
                        // Vérifiez l'existence de la table
                        $tableExists = $connec->query("SHOW TABLES LIKE 'nosendsms'")->rowCount() > 0;
                
                        if ($tableExists) {
                            // Insérez les données dans la table
                            $in = "INSERT INTO nosendsms VALUES ('', :idClient, :phoneCl, :message,:facture, :agence)";
                            $stmt = $connec->prepare($in);
                            $stmt->bindParam(':idClient', $idClient);
                            $stmt->bindParam(':phoneCl', $phoneCl);
                            $stmt->bindParam(':message', $message);
                            $stmt->bindParam(':agence', $agence);
                            $stmt->bindParam(':facture', $facture);
                
                            if ($stmt->execute()) {
                                echo "Données insérées avec succès !";
                            } else {
                                echo "Erreur lors de l'insertion des données.";
                            }
                        } else {
                            echo "La table 'nosendsms' n'existe pas.";
                        }
                    } catch (Exception $ex) {
                        echo 'Exception : ' . $ex->getMessage();
                    }
                }
                insertIntoNosendsms($connec, $idClient, $phoneCl, $message, $agence, $codefact);
                
            }
        }
    }

    $connec -> commit();
} catch (Exception $ex) {
    $connec -> rollback();
    echo 'non'.$ex;
}

?>