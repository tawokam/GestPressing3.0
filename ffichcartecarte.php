<?php
//code permettant de masquer les erreur afficgher par le script php
error_reporting(E_ALL);
ini_set("display_errors",0);

require('connect.php');
$ddeb=$_GET['ddebu'];
$dfin=$_GET['dfin'];
$nome=$_GET['nom'];
echo '<div id="blockcarte">';
if($ddeb=='' || $dfin==''){
    $se="SELECT client.id_client,client.nom_cl,cartefidelite.id_client,cartefidelite.id_carte,cartefidelite.pourcentage,cartefidelite.date_enreg,cartefidelite.montantReduit,client.telephone_cl FROM cartefidelite inner join client on cartefidelite.id_client=client.id_client where nom_cl LIKE '$nome%'";
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            $nom=$sele['nom_cl'];
            $nomcoup = "$nom[0]$nom[1]$nom[2]$nom[3]$nom[4]...";

            ?>
                <div class="borcarte" id="<?php echo $sele['id_carte']?>" onclick="recharnomclcarte(this.id)"><table id="tabcarte"><tr><th><img src="./img/utilisateur (1).png" id="imguser"></th><th id="nomcarte"><div id="gernomlong"><?php echo $nomcoup ?></div></th></tr><tr><td class="contable" colspan="2" class="contable">Numéro de téléphone:<?php echo $sele['telephone_cl']?></td></tr><tr><td class="contab" colspan="2">Remise:<?php echo $sele['pourcentage']?> %</td></tr><tr><td colspan="2" class="contable">Somme des remises:<?php echo $sele['montantReduit']?> Fcfa<tr><td class="contab" colspan="2">Dernière recharge:<?php echo $sele['date_enreg']?></td></tr></table></div>
            <?php
        }
    }
}elseif($ddeb!='' && $dfin!=''){
    $se="SELECT client.id_client,client.nom_cl,cartefidelite.id_client,cartefidelite.id_carte,cartefidelite.pourcentage,cartefidelite.date_enreg,cartefidelite.montantReduit,client.telephone_cl FROM cartefidelite inner join client on cartefidelite.id_client=client.id_client where date_enreg between '$ddeb' AND '$dfin'";
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            $nom=$sele['nom_cl'];

            ?>
        <div class="borcarte" id="<?php echo $sele['id_carte']?>" onclick="recharnomclcarte(this.id)"><table id="tabcarte"><tr><th><img src="./img/utilisateur (1).png" id="imguser"></th><th id="nomcarte"><div id="gernomlong"><?php echo $nom ?></div></th></tr><tr><td class="contable" colspan="2" class="contable">Numéro de téléphone:<?php echo $sele['telephone_cl']?></td></tr><tr><td class="contab" colspan="2">Remise:<?php echo $sele['pourcentage']?> %</td></tr><tr><td colspan="2" class="contable">Somme des remises:<?php echo $sele['montantReduit']?> Fcfa<tr><td class="contab" colspan="2">Dernière recharge:<?php echo $sele['date_enreg']?></td></tr></table></div>
            <?php
        }
    }
}
echo '</div>';
?>