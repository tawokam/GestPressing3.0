
<table id="tabtelfact" style="text-align:center;width:100%;font-size:12px">
                        <tr> <td style="text-align:center" colspan="2">
                            
                            <figure style="display:block">  
                            <img src="img/logo.png" style="width:100px" alt="logo">  
                            </figure>
                        </td></tr>
                    <tr>
                       
                        <td colspan="2" class="recuNomEntreprise" style="font-weight:bold;color:blue;font-size:17px;text-align:center">GROUPE STAR.SARL</td>
                    </tr>         
                    <tr style="font-weight:bold">
                        <td >RCC : RC/BFM/2023/B/257</td>
                        <td >NIU : M062318307272A</td>
                    </tr>
                    <tr style="font-weight:bold">
                        <td > Tél : 695 416 801</td>
                        <td >CAPITAL SOCIAL : 900.000 FRS</td>
                    </tr>
                    <tr>             
                        <td colspan="2" style="font-size:10px;font-weight:bold">SITUE A BAFOUSSAM TOUGANG VILLAGE A CÔTÉ D’EXPRES UNION<br><br></td>
                    </tr>
                    </table>
                    <div id="infofact">
<?php
require('connect.php');
$mtota=$_GET['mtota'];

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}
//recuperation du plus grande code(qui est le code du nouveau depot)
$code="SELECT *,max(code) as maxcode FROM commande WHERE agence='$agence'";
if($codes=$connec->query($code)){
    while($coder=$codes->fetch()){
        $mcode=$coder['maxcode'];
        $nom="SELECT commande.utilisateur,commande.id_client,commande.date_depot,commande.date_retrait,client.id_client,client.nom_cl,commande.code FROM commande inner join client on commande.id_client=client.id_client where commande.code='$mcode' AND commande.agence='$agence' group by client.nom_cl";
        if($nome=$connec->query($nom)){
            while($date=$nome->fetch()){
                ?>
                <div style="text-align:center">
                <table  style="width:100%;text-align:center"><tr><th>Doit Mr/Mme</th><th>Habits déposés le</th><th>Habits a rétiré le</th><th>Facture N°</th></tr>
                <tr><td><?php echo $date['nom_cl']?></td><td><?php echo $date['date_depot']?></td><td><?php echo $date['date_retrait']?></td><td><?php echo $mcode ?></td></tr>
                </table></div>
                <div>vendeur/caissière:<?php echo$date['utilisateur'] ?></div>
                <?php
            }
        }
        //affichage des habits deposé et leur caracteristique
        echo '<table style="width:100%;text-align:center"><tr><th>Nom du vetement</th><th>Description</th><th>Prix Unitaire</th><th>Quantité</th><th>Montant total</th></tr>';
        $to="SELECT commande.id_typevet,commande.quantite_cmd,commande.description_cmd,commande.montaverse,commande.monttotal,typevetement.id_typevet,typevetement.nom_vet,commande.code FROM commande inner join typevetement on commande.id_typevet=typevetement.id_typevet where commande.code='$mcode' AND commande.agence='$agence'";
        if($tou=$connec->query($to)){
            while($tout=$tou->fetch()){
                ?>
                <tr><td><?php echo $tout['nom_vet'] ?></td><td><?php echo $tout['description_cmd'] ?></td><td><?php echo $tout['montaverse'] ?></td><td><?php echo $tout['quantite_cmd'] ?></td><td><?php echo $tout['monttotal'] ?></td>
                <?php
            }
        }
        echo '</table>';
        //affiche du montant a payer, de l'avance et du reste a payer
        $so="SELECT * from facture where code='$mcode' AND agence='$agence'";
        if($som=$connec->query($so)){
            while($some=$som->fetch()){

                ?>
                <div>Totaux:<?php echo $mtota ?>Fcfa&nbsp; &nbsp; Montant net a payer: <?php echo $some['monttotal'] ?>Fcfa &nbsp; &nbsp;Montant versé: <?php echo $some['avance']?>Fcfa  &nbsp; &nbsp; Reste:<?php echo $some['reste'] ?>Fcfa</div>
                <?php

            }
        }
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
                echo '<div style="font-weight:bold">Nombre de vetements déposé: '.$anbre['qte'].', '.$typelavag.'</div>';
            }
        }
    }

}
?>
</div>
                    <div style="text-align:left">
                        <strong>NB:</strong>
                        -la maison se désengage de toute réclamation sur facture non informatisée, sauf en cas de force majeure(coupure de lumière)<br>
                        -boucle, fermeture et autres ne sont pas garantis<br>
                        -passé le delai de 30 jours la maison n'est pas responsable des vetements confiés<br>
                        -bien vouloir vous munir de votre facture informatisé avant <!-- onclick="javascript:imprime_bloc('Facture de GESTPRESSING','blockimprim');" -->
                    </div>