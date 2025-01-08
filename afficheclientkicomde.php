<?php
require('connect.php');
$critere = $_GET['crit'];
echo '<table class="table table-secondary table-bordered table-striped table-hover" style="font-size:12px;text-align: center;margin:0 auto;width:100%">
<thead class="table-dark">
 <tr><th>Nom du client</th><th>Numéro de téléphone</th></tr>
 </thead>';

 $ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}
if($critere==''){ 
$re="SELECT * FROM client ";
if($req=$connec->query($re)){
    while($reqe=$req->fetch()){
        ?>
       <tr style="cursor:pointer" id="<?php echo $reqe['id_client']?>" onmousemove="decoclient(this.id)" onclick="texte(this.id),nomclientdep(this.id)"><td ><?php echo $reqe['nom_cl']?></td><td><?php echo $reqe['telephone_cl']?></td></tr>
        <?php
    }
}
}else if($critere!=''){ 
    $re="SELECT * FROM client where nom_cl LIKE '%$critere%'";
    if($req=$connec->query($re)){
        while($reqe=$req->fetch()){
            ?>
           <tr style="cursor:pointer" id="<?php echo $reqe['id_client']?>" onmousemove="decoclient(this.id)" onclick="texte(this.id),nomclientdep(this.id)"><td><?php echo $reqe['nom_cl']?></td><td ><?php echo $reqe['telephone_cl']?></td></tr>
            <?php
        }
    }
    }
echo '</table>';
?>