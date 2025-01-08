<?php
require('connect.php');
$totalfact=$_POST['totalfact'];
$avance=$_POST['avancefact'];
$dated=0;
$dater=0;

$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$re="SELECT *,max(code) as maxcode from commande WHERE agence='$agence'";
if($req=$connec->query($re)){
    while($reqe=$req->fetch()){
        $code=$reqe['maxcode'];
        $che="SELECT *,count(id_facture) as nombre FROM facture where code='$code' AND agence='$agence'";
        if($cher=$connec->query($che)){
            while($cherc=$cher->fetch()){
                $nombre=$cherc['nombre'];
                if($nombre>=1){
                }else if($nombre<1){
                    //gestion des reduction 
                    $iclien=0;
                            $idcli="SELECT * FROM commande where code='$code' AND agence='$agence' group by code";
                            if($idclie=$connec->query($idcli)){
                                while($idclien=$idclie->fetch()){
                                    $iclien=$idclien['id_client'];
                                    $dated=$idclien['date_depot'];
                                    $dater=$idclien['date_retrait'];
                                    $rem="SELECT id_client,pourcentage,montantReduit FROM cartefidelite where id_client='$iclien'";
                                    if($remi=$connec->query($rem)){
                                        while($remis=$remi->fetch()){
                                        
                            $porcent=$remis['pourcentage'];
                            echo $porcent;
                                $monr=$remis['montantReduit'];
                                
                                $ko=(($totalfact*$porcent)/100);
                                $totalfact-=$ko;
                                $newm=$monr+$ko;
                                $remiup="UPDATE cartefidelite set pourcentage=0, montantReduit='$newm' where id_client='$iclien'";
                                if($updremi=$connec->query($remiup)){
                                }else{echo 'echec modif donnees';}
                                }
                            }
                            
                            
                        }
                    }
                    $reste=$totalfact-$avance;
                    $in="INSERT into facture values('','$totalfact','$avance','$reste','$code','$dated','$dater','$iclien','$agence')";
                    if($inser=$connec->exec($in)){
                        //insertion de l'avance dans la table versement
                        $ver="INSERT INTO versement values('','$code','$avance','$dated','$agence')";
                        if($vers=$connec->exec($ver)){}
                    }
                }
                }
            }
        }
    }
?>