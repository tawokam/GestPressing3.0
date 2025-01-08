<?php
require('connect.php');
$para=$_GET['para'];

$ne = "";
if($para == ''){
$ne="SELECT *,count(id_client) as nbrec FROM client inner join agence on client.agence=agence.id_agence ";
}else if($para != ''){
$ne="SELECT *,count(id_client) as nbrec FROM client inner join agence on client.agence=agence.id_agence where nom_cl LIKE '%$para%'";
}
if($nb=$connec->query($ne)){
    while($nbre=$nb->fetch()){
       echo '<div class="alert alert-secondary bg-secondary text-light" style="font-size:13px;width:95%;margin:0 auto;text-align:left" role="alert">
       '.$nbre['nbrec'].' client(s) enregistré(s). Cliquez sur le nom d\'un client pour avoir toutes les factures du client 
       </div><br/>';
    }
    echo '</table>';
}

echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:95%">
<thead class="table-primary">
 <tr><th>N°</th><th>Nom du client</th><th>Numéro de téléphone</th><th>date d\'enregistrement</th><th>pressing</th><th colspan="2">Action</th></tr>
 </thead>';
$x = 1;
if($para!=''){
    $re="SELECT * FROM client inner join agence on client.agence=agence.id_agence where nom_cl LIKE '%$para%' order by nom_cl";
    if($req=$connec->query($re)){
        while($reqe=$req->fetch()){
            ?>
     <tr ><td><?php echo $x;?></td><td style="cursor:pointer" id="<?php echo $reqe['id_client']?>" onclick="fact1client(this.id)"><?php echo $reqe['nom_cl'] ?></td><td ><?php echo $reqe['telephone_cl'] ?></td><td ><?php echo $reqe['date_inscription'] ?></td><td ><?php echo $reqe['nom'] ?></td><td id="<?php echo $reqe['id_client'] ?>" onclick="ouvreformmodifclient(this.id)" style="cursor:pointer"><i class="bi bi-pencil-fill text-warning"></i> Modifier</td><td id="<?php echo $reqe['id_client'] ?>" onclick="xy=confirm('la suppresion du client nommé <?php echo $reqe['nom_cl'] ?> entrainera la disparition de toutes les données rattachées à ce client. Si vous souhaitez réellement effacer ce client, cliquez sur le bouton OK');if(xy){suppclient(this.id)}else{}" style="cursor:pointer"><i class="bi bi-trash3-fill text-danger"></i> Effacer</td></tr>
<?php 
$x++;       
}
    }
}else if($para==''){
    $re="SELECT * FROM client inner join agence on client.agence=agence.id_agence order by nom_cl";
    if($req=$connec->query($re)){
        while($reqe=$req->fetch()){
            ?>
     <tr><td><?php echo $x;?></td><td  style="cursor:pointer" id="<?php echo $reqe['id_client']?>" onclick="fact1client(this.id)"><?php echo $reqe['nom_cl'] ?></td><td ><?php echo $reqe['telephone_cl'] ?></td><td ><?php echo $reqe['date_inscription'] ?></td><td ><?php echo $reqe['nom'] ?></td><td  id="<?php echo $reqe['id_client'] ?>" onclick="ouvreformmodifclient(this.id)" style="cursor:pointer"><i class="bi bi-pencil-fill text-warning"></i> Modifier</td><td id="<?php echo $reqe['id_client'] ?>" onclick="xy=confirm('la suppresion du client nommè <?php echo $reqe['nom_cl'] ?> entrainera la disparition de toutes les données rattachées à ce client. Si vous souhaitez réellement effacer ce client, cliquez sur le bouton OK');if(xy){suppclient(this.id)}else{}" style="cursor:pointer"><i class="bi bi-trash3-fill text-danger"></i> Effacer</td></tr>
<?php 
$x++;       
}
    }
}
echo '</table>';
?>