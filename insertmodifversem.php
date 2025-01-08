<?php
require('connect.php');
$newtypva     = $_POST['newtypva'];
$newmontversa = $_POST['newmontversa'];
$ident        = $_POST['ident'];
$cookie       = $_POST['cookie'];
$datetime     = date('Y/m/d h:i:s');

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomuser = $sele['nom_user'];
    }
}

$se = "SELECT nom_versa FROM typeverseargent WHERE id_typevera='$newtypva'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomtyp = $sele['nom_versa'];
    }
}

if($newmontversa==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrer le montant du versement
</div>';
}

else{ 
$up = "UPDATE verseargent SET id_typevera='$newtypva', montant='$newmontversa' WHERE id_vera='$ident' AND agence='$agence'";
if($upd=$connec->query($up)){
    echo '<br/><div class="alert alert-success" role="alert" style="font-size:12px">
    Modification effectuée
    </div>';

    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Versement','Modification','type de versement:".$nomtyp.", Montant:".$newmontversa."','$agence')";
    if($ins = $connec -> exec($in)){} 
}
}

?>