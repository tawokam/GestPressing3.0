<?php
require('connect.php');
//recuperation de mes variable transmis via la technologie ajax
$codeclient  = $_POST['codeclient'];
$qte         = $_POST['qte'];
$choixtypv   = $_POST['choixtypv'];
$descript    = $_POST['descript'];
$datedepot   = $_POST['datedepot'];
$dateretrait = $_POST['dateretrait'];
$cookie      = $_POST['cookie'];
$prixvet     = $_POST['prixvet'];
$date_enreg  = date('Y/m/d');
$time        = date('H:i:s');
if($qte == ''){$qte = 0;}
if($prixvet == ''){$prixvet = 0;}
$montotal    = $prixvet*$qte;

 $agence = 0;
 $ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}
 if($codeclient==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez selectionner un client
</div>';
}
 else if($choixtypv==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez selectionner le type de vêtement
</div>';
}
 else if($qte==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrer la quantité du type de vetement
</div>';
}
 else if($descript==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez décrire le vêtement(couleur,marque,...)
</div>';
}
 else if($datedepot==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrer la date de dépot du vêtement
</div>';
}
 else if($dateretrait==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrer la date de retrait du vêtement
</div>';
}
 else if($prixvet==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrer le prix unitaire de lavage du vêtement
</div>';
}else if($agence == 0){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    aucun pressing activé. Veuillez activer un pressing
</div>';
}
 else{
     $re="INSERT INTO commande values('','$codeclient','$choixtypv','$qte','$descript','$prixvet','$montotal','$datedepot','$dateretrait','$cookie','$date_enreg','0','$agence','$time')";
     if($req=$connec->exec($re)){
        echo '<div class="alert alert-success" role="alert" style="font-size:12px">vêtement enregistrer</div>';
     }
 }
?>