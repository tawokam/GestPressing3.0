<?php
require('connect.php');
echo '<div class="alert alert-secondary bg-secondary text-light" style="font-size:13px;width:95%;margin:0 auto;text-align:left" role="alert">
       liste des messages envoyés
       </div><br/>';
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:95%">
<thead class="table-primary">
 <tr><th>N°</th><th>Nom du client</th><th>Numéro de téléphone</th><th>Message</th><th>expediteur</th><th>Pressing</th></tr>
 </thead>';
 
 $x = 1;  
$ne="SELECT * FROM message inner join client on message.id_client=client.id_client inner join agence on message.agence=agence.id_agence order by ligne desc";

if($nb=$connec->query($ne)){
    while($reqe=$nb->fetch()){
        ?>
        <tr><td><?php echo $x;?></td><td><?php echo $reqe['nom_cl']?></td><td ><?php echo $reqe['telephone_cl'] ?></td><td ><?php echo $reqe['message'] ?></td><td ><?php echo $reqe['user'] ?></td> <td ><?php echo $reqe['nom'] ?></td> </tr>
   <?php 
   $x++;
    }
    echo '</table>';
}

?>