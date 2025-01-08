<?php
require('connect.php');
$choix=$_POST['choix'];
$montv=$_POST['montv'];
$date=$_POST['date'];
$cookie=$_POST['cookie'];
$numrecu=$_POST['numrecu'];
$datetime = date('Y/m/d h:i:s');

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
$se = "SELECT nom_versa FROM typeverseargent WHERE id_typevera='$choix'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomtyp = $sele['nom_versa'];
    }
}

if($choix==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez selectionner le type de versement
</div>';
}else if($montv==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrer le montant du versement
</div>';
}else if($date==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrer la date de versement
</div>';  
}else{
$in="INSERT INTO verseargent values('','$choix','$montv','$date','$cookie','$numrecu','$agence')";
if($ins=$connec->exec($in)){
echo '<div class="alert alert-success" role="alert" style="font-size:12px">Versement enregistré</div>';  
$in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Versement','Insertion','type de versement::".$nomtyp.", montant versé:".$montv.", Numéro du reçu:".$numrecu.", date de versement:".$date."','$agence')";
if($ins = $connec -> exec($in)){}  
}else{
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Un problème est survenu veuillez recommancer
    </div>'; 

   
}
}
?>