<?php
require('connect.php');
$debu=$_GET['ddebucarte'];
$fin=$_GET['dfincarte'];
echo '<div style="font-size:25px;color:blue;font-weight:bold;text-align:center;margin-top:1%">GESTPRESSING RAPPORTS</div><div style="font-weight:bold;font-size:20px">Liste des cartes de fidélité</div>';
echo '<table style="width:100%;margin:auto;border:1px solid black;border-collapse:collapse"><tr><th style="text-align:center;border:1px solid black;">Nom du client</th><th style="text-align:center;border:1px solid black">Remise encour(%)</th><th style="text-align:center;border:1px solid black">Dernière recharge</th><th style="text-align:center;border:1px solid black">Somme des reduction(Fcfa)</th></tr>';
if($debu=='' || $fin==''){
    $se="SELECT cartefidelite.id_client,cartefidelite.pourcentage,cartefidelite.date_enreg,cartefidelite.montantReduit,client.id_client,client.nom_cl FROM cartefidelite inner join client on cartefidelite.id_client=client.id_client";
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            echo '<tr><tr><td style="text-align:center;border:1px solid black">'.$sele['nom_cl'].'</td><td style="text-align:center;border:1px solid black">'.$sele['pourcentage'].'</td><td style="text-align:center;border:1px solid black">'.$sele['date_enreg'].'</td><td style="text-align:center;border:1px solid black">'.$sele['montantReduit'].'</td></tr>';
    
        }
    }
}
?>