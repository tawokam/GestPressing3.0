<?php

try {
 
    require('connectConnexion.php');
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
    
    $attendu=0;
    
    if($msg == '')
    {
        echo '<br/><div class="alert alert-secondary bg-danger text-light" role="alert" style="font-size:12px">
          Veuillez definir le message a envoyer aux clients
        </div>';
    }else
    {
        // nombre de message envoyer
        /*         $ni="SELECT depotvetement.code,depotvetement.id_client,count(depotvetement.id_client) as nbrel,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet where depotvetement.date_retrait='$now' AND depotvetement.agence='$pressing' order by depotvetement.code asc"; */
      
        // liste des client qui recevrons les messages
          $se="SELECT depotvetement.code,depotvetement.id_client,depotvetement.id_typevet,depotvetement.quantite_dep,depotvetement.description_dep,depotvetement.date_depot,depotvetement.date_retrait,client.id_client,client.telephone_cl,client.nom_cl,typevetement.id_typevet,typevetement.nom_vet FROM depotvetement inner join client on depotvetement.id_client=client.id_client inner join typevetement on depotvetement.id_typevet=typevetement.id_typevet where depotvetement.date_retrait='$now' AND depotvetement.agence='$pressing' order by depotvetement.code asc";
          if($sel=$connec->query($se)){
          $nb = $sel -> rowCount();
  
            while($sele=$sel->fetch()){
              $ph = $sele['telephone_cl'];
              $idcl = $sele['id_client']; 
              $phone = '+237'.$sele['telephone_cl'];
              
              $in = "INSERT INTO message VALUES('','$msg','$ph','$idcl','$pressing','$cookie')";
              if($ins = $connec -> exec($in)){sendBulkSms($phone, $msg);}else{ throw new Exception();}
                
            }
        }
        $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Message','Envoi de message en masse','Envoi aux clients pour rappelé le retrait, sms:".$msg."','$pressing')";
        if($ins = $connec -> exec($in)){}  
        echo '<br/><div class="alert alert-secondary bg-success text-light" role="alert" style="font-size:12px">
          Messages envoyés
        </div>';
    }
    
    
} catch (Exception $ex) {
   echo 'Error '.$ex;
}
?>