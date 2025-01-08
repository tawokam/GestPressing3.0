<?php
require('connect.php');
$deb=$_GET['ddebu'];
$fin=$_GET['dfin'];
echo '<table><tr><th>Nom du client'
if($deb=='' || $fin==''){

    $se=" SELECT facture.code,commande.code,commande.id_client,client.id_client,facture.monttotal,sum(monttotal) as somme FROM commande inner join facture on commande.code=facture.code inner join client on commande.id_client=client.id_client where commande.id_client='7'";
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            ?>
          
            <?php
        }
    }
}
?>