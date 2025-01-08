<?php
require('connect.php');
$code=$_GET['code'];
$cookie=$_GET['cookie'];
$datesupp=date('Y-m-d');
$nbred=10;
$datetime = date('Y/m/d h:i:s');

$se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
   while ($sele = $sel -> fetch()) {
       $nomuser = $sele['nom_user'];
   }
}

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

//selection de la facture pour verifier si la facture a été enregistrer aujourd'hui
$sf="SELECT * FROM facture where code='$code' AND agence='$agence'";
if($sfa=$connec->query($sf)){
    while($sfac=$sfa->fetch()){
        $datenreg = "".$sfac['date_depot'];
        $date1 = new DateTime($datenreg);  
        $date2 = new DateTime($datesupp);
        $dif = $date1->diff($date2);
        $nbred = $dif -> days;
    }
}
if($nbred==0){
//suppression des habit de la facture dans la table commande
$dec="DELETE FROM commande where code='$code' AND agence='$agence'";
if($delc=$connec->query($dec)){
//suppression des habit de la facture dans la table depotvetement
$ded="DELETE FROM depotvetement where code='$code' AND agence='$agence'";
if($deld=$connec->query($ded)){
//suppression de la facture dans la table reglement
$der="DELETE FROM reglement where code='$code' AND agence='$agence'";
if($delr=$connec->query($der)){
    //selection et insertion de la facture dans la table facturesupprimer
    $sef="SELECT * FROM facture where code='$code' AND agence='$agence'";
    if($self=$connec->query($sef)){
        while($sf=$self->fetch()){
            $montotal=$sf['monttotal'];
            $avance=$sf['avance'];
            $reste=$sf['reste'];
            $codefs=$sf['code'];
            $date_depot=$sf['date_depot'];
            $in="INSERT INTO facturesupprimer values ('','$montotal','$avance','$reste','$codefs','$date_depot','$datesupp','$agence')";
            if($ins=$connec->exec($in)){
                     //suppression de la facture dans la table facture
                    $def="DELETE FROM facture where code='$code' AND agence='$agence'";
                    if($delf=$connec->query($def)){
                        //suppression dans la table versement
                        $suv = "DELETE FROM versement where code='$code' AND agence='$agence'";
                        if($supve = $connec->query($suv)){

                            $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Facture','Suppression','code facture:".$codefs.", Montant :".$montotal.", avance:".$avance.", reste:".$reste."')";
                            if($ins = $connec -> exec($in)){} 
                        }
                    }
            }
        }
    }
}
}
}
}else{
    echo 'non';
}
?>