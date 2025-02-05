<?php
 require('connect.php');
try {
    $connec -> beginTransaction();
    require('sendMessage.php');
    echo sendBulkSms('', '');
    $now = date('Y/m/d');
    $codeclsms = $_POST['codeclsms'];
    $cookie = $_POST['cookie'];
    $smsCl = $_POST['smsCl'];
    $datetime = date('Y/m/d h:i:s');

    if($smsCl == '')
    {
        echo '<br/><div class="alert alert-secondary bg-danger text-light" role="alert" style="font-size:12px">
          Veuillez definir le message a envoyer aux clients
        </div>';
    }
    else
    {
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
            
            $se="SELECT id_client, telephone_cl,nom_cl FROM client where id_client='$codeclsms'";

            if($sel=$connec->query($se)){
                while($sele=$sel->fetch()){
                    $ph = $sele['telephone_cl'];
                    $nomcl = $sele['nom_cl'];
                    $idcl = $sele['id_client']; 
                    $phone = $sele['telephone_cl'];
                    
                        $Result = sendBulkSms($phone, $smsCl);
                        if (is_array($Result) && isset($Result['status']) && $Result['status'] == 'pending') {
                            // le message a bien été envoyé
                            $in = "INSERT INTO message VALUES('','$smsCl','$ph','$idcl','$pressing','$cookie')";
                            if($ins = $connec -> exec($in)){}else{throw new Exception();}
                            $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Message','Envoi de message','Envoi d\'un sms a :".$nomcl.", message:".$smsCl."','$pressing')";
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
                                    throw new   Exception();
                                }
                            }
                            insertIntoNosendsms($connec, $idcl, $phone, $smsCl, $pressing, 0);
                        }    
                    }
                }else{
                    throw new Exception();
             }
        
            
            
    }
   
$connec -> commit();
echo '<br/><div class="alert alert-secondary bg-success text-light" role="alert" style="font-size:12px">
Messages envoyés
</div>';
}  catch (Exception $ex) {
    $connec ->  rollback();
    echo '<br/><div class="alert alert-danger bg-danger text-light" role="alert" style="font-size:12px">
        Erreur lors du traitement des données
    </div>';
 }




   
?>