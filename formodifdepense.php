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
$se="SELECT * FROM depense where id_depense='$ident' AND agence='$agence'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $ancientypdep = $sele['id_dep'];
        $xchoix="selected";
?>
                <input type="hidden" value="<?php echo $ident; ?>"  id="idendep">
                <tr><td> <label for="newtypdepenses" class="form-label">Type de depense</label><br><select id="newtypdepenses" class="form-select"><?php $n="SELECT * FROM typedepense";if($no=$connec->query($n)){while($not=$no->fetch()){ ?> <option value=<?php echo $not['id_dep'] ?> <?php if($not['id_dep'] == $ancientypdep){?> selected <?php } ?> ><?php echo $not['nom_dep'] ?></option> <?php }}?></select><br></td></tr>
                <tr><td> <label for="newmotif" class="form-label">Motif de la depense</label><br><input type="text" value="<?php echo $sele['motif']?>"  id="newmotif"  class="form-control"><br></td></tr>
                <tr><td> <label for="newmontdep" class="form-label">Montant de la dépense</label><br><input type="text" value="<?php echo $sele['montant']?>"  id="newmontdep"  class="form-control"><br></td></tr>
                 
       
    <?php
    }
}