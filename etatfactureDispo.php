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

$re="SELECT *,count(id_depot) as nbre FROM Dispovetement where code='$codefact' AND agence='$agence'";
if($req=$connec->query($re)){
   while($reqe=$req->fetch()){
       $nbre=$reqe['nbre'];
       if($codefact==''){}
       else if($nbre<1){
           echo '<div style="color:red">Vetements non disponible</div>'; // si le message de retour est modifier la fonction js etatfactureDispo doit etre modifiée
       }else if($nbre>=1){
        
           echo '<div style="color:green">Vetements disponible</div>';  // si le message de retour est modifier la fonction js etatfactureDispo doit etre modifiée
   }
}
}
?>