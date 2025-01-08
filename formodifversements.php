<?php
require('connect.php');
$ident=$_GET['ident'];

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$se="SELECT * FROM verseargent where id_vera='$ident' AND agence='$agence'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $ancientypvers = $sele['id_typevera'];
        $xchoix="selected";
?>
                <input type="hidden" value="<?php echo $ident; ?>"  id="idenversea">
                <tr><td><label for="typmatmatiere" class="form-label">Type de versement</label><br><select id="newtypva" class="form-select"><?php $n="SELECT * FROM typeverseargent";if($no=$connec->query($n)){while($not=$no->fetch()){ ?> <option value=<?php echo $not['id_typevera'] ?> <?php if($not['id_typevera'] == $ancientypvers){?> selected <?php } ?> ><?php echo $not['nom_versa'] ?></option> <?php }}?></select><br></td></tr>
                <tr><td><label for="typmatmatiere" class="form-label">Montant du versement</label><br><input type="text" value="<?php echo $sele['montant']?>"  id="newmontversa" class="form-control"><br></td></tr>
                 
       
    <?php
    }
}