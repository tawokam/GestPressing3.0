<?php
    require('connect.php');
try {
    $connec -> beginTransaction();
    require('sendMessage.php');
    $now = date('Y/m/d');
    $msg = $_POST['msgallnow'];
    $cookie = $_POST['cookie'];
    $datetime = date('Y/m/d h:i:s');

    $ag = "SELECT id_agence FROM agence WHERE statut='activer'";
    if($age = $connec -> query($ag)){
        while($agen = $age -> fetch()){
            $pressing = $agen['id_agence'];
            
        }
    }

    $se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
      if($sel = $connec -> query($se)){
          while ($sele = $sel -> fetch()) {
              $nomuser = $sele['nom_user'];
          }
      }

    if($msg == '')
    {
        echo '<br/><div class="alert alert-secondary bg-danger text-light" role="alert" style="font-size:12px">
        Veuillez definir le message a envoyer aux clients
        </div>';
    }else
    {
    $attendu=0;

    $se="SELECT depotvetement.code,depotvetement.id_client,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet, client.telephone_cl FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet where depotvetement.date_retrait<'$now' AND depotvetement.agence='$pressing' order by depotvetement.code asc";

    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            $ph = $sele['telephone_cl'];
            $idcl = $sele['id_client']; 
            $phone = $sele['telephone_cl'];
            


                $Result = sendBulkSms($phone, $msg);
                if (is_array($Result) && isset($Result['status']) && $Result['status'] == 'pending') {
                    // le message a bien été envoyé
                    $in = "INSERT INTO message VALUES('','$msg','$ph','$idcl','$pressing','$cookie')";
                    if($ins = $connec -> exec($in)){}else{throw new Exception();}
                    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Message','Envoi de message en masse','Envoi aux clients pour informé que la date de retrait est depassé, sms:".$msg."','$pressing')";
                    if($ins = $connec -> exec($in)){}else{throw new Exception();}
                } else {
                    // il ya eu un probleme lors de l'envoi du SMS
                    function insertIntoNosendsms($connec, $idClient, $phoneCl, $message, $agence, $facture) {
                        try {
                            // Vérifiez l'existence de la table
                            $tableExists = $connec->query("SHOW TABLES LIKE 'nosendsms'")->rowCount() > 0;
                    
                            if ($tableExists) {
                                // Insérez les données dans la table
                                $in = "INSERT INTO nosendsms VALUES ('', :idClient, :phoneCl, :message, :facture, :agence)";
                                $stmt = $connec->prepare($in);
                                $stmt->bindParam(':idClient', $idClient);
                                $stmt->bindParam(':phoneCl', $phoneCl);
                                $stmt->bindParam(':message', $message);
                                $stmt->bindParam(':agence', $agence);
                                $stmt->bindParam(':facture', $facture);
                    
                                if ($stmt->execute()) {
                                   // echo "Données insérées avec succès !";
                                } else {
                                   // echo "Erreur lors de l'insertion des données.";
                                }
                            } else {
                               // echo "La table 'nosendsms' n'existe pas.";
                            }
                        } catch (Exception $ex) {
                            throw new Exception();
                        }
                    }
                    insertIntoNosendsms($connec, $idcl, $phone, $msg, $pressing, 0);
                }

            
        }
    }
    

}
$connec -> commit();
echo '<br/><div class="alert alert-secondary bg-success text-light" role="alert" style="font-size:12px">
Messages envoyés
</div>';
}  catch (Exception $ex) {
    $connec -> rollback();
    echo '<br/><div class="alert alert-danger bg-danger text-light" role="alert" style="font-size:12px">
        Erreur lors du traitement des données
    </div>';
 }




   
?>