<?php
require('connect.php');
$codefact=$_GET['etat'];

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$re="SELECT *,count(id_reg) as nbre FROM reglement where code='$codefact' AND agence='$agence'";
if($req=$connec->query($re)){
   while($reqe=$req->fetch()){
       $nbre=$reqe['nbre'];
       $dette=$reqe['dette'];
       if($codefact==''){}
       else if($nbre<1){
           echo '<div style="color:blue">Facture encour...</div>';
       }else if($nbre>=1){
         if($dette=='NON'){
           echo '<div style="color:green">Facture réglé</div>';
       }elseif($dette=='OUI'){
        echo '<div style="color:red">Facture enregistrer comme dette</div>';
    }
   }
}
}
?>