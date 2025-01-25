<?php

try{

  if(require("connect.php")){
    $cookie = $_GET['cookie'];
    
        $se = "SELECT * FROM comptes WHERE login_user = '$cookie'";
        if($sel = $connec -> query($se)){ // éxecution de la requete sur le serveur
             $nbre = $sel -> rowCount(); // nombre de ligne renvoyer
            
                if($nbre == 0){
                    $data = array(
                        "statut" => 300,
                        "Message" => "Utilisateur non identifier"
                    );
                }
                else
                { 
                    while ($sele = $sel -> fetch()) {
                        $photo = "";
                        if($sele['photo'] == ''){
                            $photo = "no";
                        }else{
                            $photo = $sele['photo'];
                        }
                    $data = array(
                        "statut"     => 200,                      
                        "profilUser" => $photo,
                        "posteUser"  => $sele['poste'],
                        "phoneUser"  => $sele['telephone_user'],
                        "nomUser"    => $sele['nom_user'],
                        "neeUser"    => $sele['datenaiss'],
                        "contrat"    => $sele['typecontrat'],
                        "diplome"    => $sele['diplome']
                    );
                }
             }
            
            }    
        }
        else
        { // une erreur est survenu lors de l'execution de la requete (code 300 et plus)
            $data = array(
              "statut" => 300,
              "Message" => "Nous avons rencontrés un problème serveur"
            );
        }  
        // Convertir le tableau en JSON
        $json_data = json_encode($data);
                            
        // renvoi le json
        echo $json_data;
}
catch(Exception $e){ // un problème est survenu lors de l'execution du script (code 400 et plus)
  $e -> getMessage();
  $data = array(
    "statut" => 300,
    "Message" => "Nous avons rencontrés un problème serveur".$ex
  );  
  // Convertir le tableau en JSON
  $json_data = json_encode($data);
                    
  // renvoi le json
  echo $json_data;
}
?>