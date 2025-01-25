<?php
require('connect.php');
$nom=$_GET['nom'];
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:12px;text-align: center;margin:0 auto;width:100%">
<thead class="table-dark bg-dark">
 <tr><th>N° facture</th><th>nom client</th><th>type vet</th><th>description</th></tr>
 </thead>';


    $se="SELECT * FROM sortivetement inner join client on sortivetement.id_client=client.id_client inner join typevetement on sortivetement.id_typevet=typevetement.id_typevet WHERE sortivetement.code='$nom'";
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            ?>
     <tr id="<?php echo $sele['id_sort'] ?>" onclick="kelvetretourn(this.id),btnClick()" style="cursor:pointer"><td ><?php echo $nom?></td><td ><?php echo $sele['nom_cl']?></td><td ><?php echo $sele['nom_vet']?></td><td ><?php echo $sele['description_sort']?></td></tr>
            <?php
        }
    }

echo '</table>';
?>