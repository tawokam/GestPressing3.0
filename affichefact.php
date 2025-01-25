
<?php
require('connect.php');
$mtota=$_GET['mtota'];

// fonction de traitement de date
function dateEnFrancais($date) {
    // Définir le fuseau horaire
    date_default_timezone_set('Europe/Paris');
    
    // Convertir la date en timestamp
    $timestamp = strtotime($date);
    
    // Tableau des jours de la semaine en français
    $joursSemaine = array('dimanche', 'lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi');
    
    // Tableau des mois en français
    $mois = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    
    // Récupérer le jour de la semaine et le mois
    $jourSemaine = $joursSemaine[date('w', $timestamp)];
    $jour = date('d', $timestamp);
    $mois = $mois[date('n', $timestamp) - 1];
    $annee = date('Y', $timestamp);
    
    // Retourner la date formatée
    return "$jourSemaine $jour $mois $annee";
}

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT * FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence    = $agen['id_agence'];
        $nomagence = $agen['nom'];
    }
}
//recuperation du plus grande code(qui est le code du nouveau depot)
$code="SELECT *,max(code) as maxcode FROM commande WHERE agence='$agence'";
if($codes=$connec->query($code)){
    while($coder=$codes->fetch()){
        $mcode=$coder['maxcode'];
        $nom="SELECT commande.utilisateur,commande.id_client,commande.heure,commande.date_depot,commande.date_retrait,client.id_client,client.nom_cl,client.telephone_cl,commande.code FROM commande inner join client on commande.id_client=client.id_client where commande.code='$mcode' AND commande.agence='$agence' group by client.nom_cl";
        if($nome=$connec->query($nom)){
            while($date=$nome->fetch()){
                ?>

               <!--  ENTETE DE LA FACTURE -->
                 <table border=1 style="font-family:arial">
                    <tr>
                        <td>
                            <table  style="font-size:12px;font-weight:bold">
                                <tr>
                                    <td style="text-align:left;padding:10px">
                                        <img src="img/logo.png" alt="Logo" style="width: 140px;"><br><br>
                                        <h4 style="font-size:14px;text-align:center">Notre Expertise à votre Service</h4>
                                        <h3 style="font-size:16px;text-align:center">OUEST-CAMEROUN</h3>
                                    </td>
                                    <td style="text-align:left;font-size:13px;">
                                        <div>Star Pressing</div>
                                        <div>Nettoyage à sec et blanchisserie</div>
                                        <div><?php echo $nomagence;?></div>
                                        <div>Direction : 695-41-68-01 / 675-11-46-79</div>
                                        <div>RC N° : RCC : RC/BFM/2023/B/257 / NIU : M062318307272A</div>
                                    </td>
                                </tr>
                                <tr >
                                    <td colspan="2" style="font-size:14px;text-align:center">Ouvert du lundi à samedi de 7h30 à 18h30</td>
                                </tr>
                            </table>
                        </td>
                        <td style="text-align:left;font-size:13px;border-left:1px solid black;width:45%;padding:10px">
                            <div><span style="font-weight:bold;"> Client :</span> <?php echo $date['nom_cl']?></div>
                            <div><span style="font-weight:bold;"> Contact :</span> <?php echo $date['telephone_cl']?></div><br>
                            <div><span style="font-weight:bold;">Habits déposés le :</span><?php echo dateEnFrancais($date['date_depot']); ?> à <?php echo $date['heure']; ?></div>
                            <div><span style="font-weight:bold;"> Date de retrait :</span> <?php echo dateEnFrancais($date['date_retrait']); ?></div><br>
                            <div><span style="font-weight:bold;"> Numéra facture/Etiquette :</span><?php echo $mcode ?></div>
                            <div><span style="font-weight:bold;"> Receptioniste :</span><?php echo$date['utilisateur'] ?></div>
                        </td>
                    </tr>
                 </table>
              
                <?php
            }
        }
        //affichage des habits deposé et leur caracteristique
        $lig = 1;
        echo '<table border=1 style="width:100%;text-align:center"><tr><th style="border:1px solid black">N°</th><th style="border:1px solid black">Designations</th><th style="border:1px solid black;width:70px">Qtes</th><th style="border:1px solid black;width:100px">PU</th><th style="border:1px solid black;width:100px">Montant</th></tr>';
        $to="SELECT commande.id_typevet,commande.quantite_cmd,commande.description_cmd,commande.montaverse,commande.monttotal,typevetement.id_typevet,typevetement.nom_vet,commande.code FROM commande inner join typevetement on commande.id_typevet=typevetement.id_typevet where commande.code='$mcode' AND commande.agence='$agence'";
        if($tou=$connec->query($to)){
            while($tout=$tou->fetch()){
                ?>
                <tr><td style="border:1px solid black"><?php echo $lig ?></td><td style="border:1px solid black;text-align:left;padding-left:10px"><?php echo $tout['nom_vet'].'('.$tout['description_cmd'].')'; ?></td><td style="border:1px solid black"><?php echo $tout['quantite_cmd'] ?></td><td style="border:1px solid black"><?php echo $tout['montaverse'] ?></td><td style="border:1px solid black"><?php echo $tout['monttotal'] ?></td>
                <?php
                $lig++;
            }
        }
        
        //affiche du montant a payer, de l'avance et du reste a payer
        $so="SELECT * from facture where code='$mcode' AND agence='$agence'";
        if($som=$connec->query($so)){
            while($some=$som->fetch()){

                ?>
                <tr style="border:1px solid black">
                    <td colspan="2">

                    </td>
                    <td colspan="2" style="text-align:left;padding-left:20px">
                       Total
                    </td>
                    <td style="border:1px solid black">
                        <?php echo $mtota ?>
                    </td>
                </tr>
                <tr style="border:1px solid black">
                    <td colspan="2">

                    </td>
                    <td colspan="2" style="text-align:left;padding-left:20px">
                       Remise
                    </td>
                    <td style="border:1px solid black">
                        0
                    </td>
                </tr>
                <tr style="border:1px solid black">
                    <td colspan="2">

                    </td>
                    <td colspan="2" style="text-align:left;padding-left:20px">
                       Avance
                    </td>
                    <td style="border:1px solid black">
                        <?php echo $some['avance']?>
                    </td>
                </tr>
                <tr style="border:1px solid black">
                    <td colspan="2">

                    </td>
                    <td colspan="2" style="text-align:left;padding-left:20px">
                       Dette
                    </td>
                    <td style="border:1px solid black">
                        0
                    </td>
                </tr>
                <tr style="border:1px solid black">
                    <td colspan="2">

                    </td>
                    <td colspan="2" style="text-align:left;padding-left:20px;font-weight:bold">
                       Montant à payer
                    </td>
                    <td style="border:1px solid black">
                        <?php echo $some['reste'] ?>
                    </td>
                </tr>
                
                <?php

            }
        }
        echo '</table>';
        //affiche le type de lavage
        $typelavag = '';
        $typl = "SELECT * FROM typelavage where codefact='$mcode' AND agence='$agence'";
        if($typla = $connec -> query($typl)){
            while($typlav = $typla -> fetch()){
                $typelavag = $typlav['typelavage'];
            }
        }
        //affichage du nombre d'habit
        $affinbre="SELECT *,sum(quantite_cmd) as qte FROM commande where commande.code='$mcode' AND agence='$agence'";
        if($affin=$connec->query($affinbre)){
            while($anbre=$affin->fetch()){
                /* echo '<div style="font-weight:bold">Nombre de vetements déposé: '.$anbre['qte'].', '.$typelavag.'</div>'; */
            }
        }
    }

}
?>
</div>
<br>
<!-- Signature et informations d'avertissements -->
 <table >
    <tr>
        <td style="vertical-align:top">
            <table>
                <tr>
                     <th style="border:1px solid black;padding:10px 40px 30px 10px">Client</th>
                     <th style="border:1px solid black;padding:10px 40px 30px 10px">Receptioniste</th>
                </tr>
            </table>
        </td>
        <td style="text-align:left;font-size:12px">
            <strong style="margin-left:10px"><u>Conditions générales:</u></strong>
            <ol type="1">
                <li>Les retraits partiels des linges sont interdits.</li>
                <li>Les retraits se font uniquement sur présentation du ticket de facturation.</li>
                <li>Nous ne sommes pas responsables des vêtements abandonnés plus de 30 jours après le dépôt dans nos boutiques.</li>
                <li>En cas de perte ou de dommage du linge, la maison rembourse 10 fois le prix auquel le linge a été facturé.</li>
                <li>Boucles, boutons, fermetures et autres décorations sur les vêtements sont sans garantie.</li>
            </ol>
        </td>
    </tr>
 </table>
