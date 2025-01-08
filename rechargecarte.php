<?php
require('connect.php');
$ident=$_GET['ident'];
$se="SELECT client.id_client,client.nom_cl,cartefidelite.id_client,cartefidelite.id_carte FROM cartefidelite inner join client on cartefidelite.id_client=client.id_client where id_carte='$ident'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        echo $sele['nom_cl'];
    }
}
?>