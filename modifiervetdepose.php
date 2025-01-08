<?php
require('connect.php');
$idevet=$_GET['idvet'];

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$se="SELECT commande.id_cmd,commande.montaverse,commande.quantite_cmd,commande.description_cmd,commande.date_depot,commande.id_typevet,commande.date_retrait,typevetement.id_typevet,typevetement.nom_vet FROM commande inner join typevetement on commande.id_typevet=typevetement.id_typevet where id_cmd='$idevet' AND commande.agence='$agence'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
?>


                <tr><td id="affichnomvet"><?php echo $sele['nom_vet'] ?></td></tr>
                <tr><td>Prix unitaire<br><input type="number" value="<?php echo $sele['montaverse']?>"  id="prixumodfi" class="form-control"></td></tr>
                <tr><td>quantite<br><input type="number" value="<?php echo $sele['quantite_cmd']?>"  id="qtemodfi" class="form-control"></td></tr>
                <tr><td>description<br><input type="text" value="<?php echo $sele['description_cmd']?>" id="descriptmodif" class="form-control"></td></tr>
                <tr><td>date dépot<br><input type="date" value="<?php echo $sele['date_depot']?>" id="datedepotmodif" class="form-control"></td></tr>
                <tr><td>date retrait<br><input type="date" value="<?php echo $sele['date_retrait']?>" id="dateretraitmodifr" class="form-control"></td></tr>
                <tr><td><input type="hidden" value="<?php echo $sele['id_cmd']?>" id="identcmd" class="inputnewcompt"></td></tr>
               
       
    <?php
    }
}