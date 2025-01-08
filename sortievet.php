<?php
require('connect.php');
$codefact=$_POST['codefact'];
$ident=$_POST['ident'];
$COOKIE=$_POST['cookie'];
$date=date('Y/m/d');
$datetime = date('Y/m/d h:i:s');

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$se = "SELECT nom_user FROM comptes WHERE login_user='$COOKIE'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nom = $sele['nom_user'];
    }
}

$re="SELECT * FROM depotvetement where id_depot='$ident' AND agence='$agence'";
if($req=$connec->query($re)){
    while($reqe=$req->fetch()){
        //recuperation de tout les information a inserer dans la table sortivetement
        $id_cl=$reqe['id_client'];$id_typvet=$reqe['id_typevet'];$qte=$reqe['quantite_dep'];$descript=$reqe['description_dep'];
        $montaverse=$reqe['montaverse'];$montotal=$reqe['monttotal'];$dateDepot=$reqe['date_depot'];$dateRetrait=$reqe['date_retrait'];
        $code=$reqe['code'];$identcmd=$reqe['id_depot'];
        //verification si la facture a ete regle ou enregistrer comme dette avant la sortie d'un vetement
        $ve="SELECT *,count(id_reg) as nbre FROM reglement where code='$codefact' AND agence='$agence'";
        if($ver=$connec->query($ve)){
            while($veri=$ver->fetch()){
                $nbre=$veri['nbre'];
                if($nbre<1){
                    echo 'non';
                }else if($nbre>=1){
                           //insertion de ces données récuperé dans la table sortivetement
                      $in="INSERT INTO sortivetement values('','$id_cl','$id_typvet','$qte','$descript','$montaverse','$montotal','$dateDepot','$dateRetrait','$COOKIE','$date','$code','$identcmd','$agence')";
                      if($inser=$connec->exec($in)){
                          $sup="DELETE FROM depotvetement where id_depot='$ident' AND agence='$agence'";
                          if($supp=$connec->query($sup)){
                                // inserer la suppression des les operations
                                $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom',' code facture:".$codefact.", Sortie vetement','Insertion','quantité:".$qte.", description:".$descript.", montant a versé:".$montaverse.", montant total:".$montotal.", date depot:".$dateDepot.", date retrait:".$dateRetrait."','$agence')";
                                if($ins = $connec -> exec($in)){} 
                          }
                      }
                }
            }
        }


    }
}
?>