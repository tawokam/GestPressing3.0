<?php

try {
    require('connect.php');
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
                    $phone = '+237'.$sele['telephone_cl'];
                    
                    $in = "INSERT INTO message VALUES('','$smsCl','$ph','$idcl','$pressing','$cookie')";
                    if($ins = $connec -> exec($in)){sendBulkSms($phone, $smsCl);}else{ throw new Exception();}
                }
            }
            $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Message','Envoi de message','Envoi d\'un sms a :".$nomcl.", message:".$smsCl."','$pressing')";
            if($ins = $connec -> exec($in)){}  
            echo '<br/><div class="alert alert-secondary bg-success text-light" role="alert" style="font-size:12px">
            Messages envoyés
            </div>';
    }
   

}  catch (Exception $ex) {
    echo 'Error ';
 }




   
?>