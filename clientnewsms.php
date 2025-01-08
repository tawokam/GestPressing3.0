<?php
require('connect.php');
$nom=$_GET['nom'];
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:12px;text-align: center;margin:0 auto;width:100%">
<thead class="table-dark bg-dark">
 <tr><th>Nom du client</th><th>Numéro de téléphone</th></tr>
 </thead>';

if($nom==''){
    $se="SELECT * FROM client";
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            ?>
     <tr id="<?php echo $sele['id_client'] ?>" onclick="kelclsms(this.id),btnClick()" style="cursor:pointer"><td ><?php echo $sele['nom_cl']?></td><td ><?php echo $sele['telephone_cl']?></td></tr>
            <?php
        }
    }
}else if($nom!=''){
    $se="SELECT * FROM client where nom_cl LIKE '$nom%'";
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            ?>
     <tr id="<?php echo $sele['id_client'] ?>" onclick="kelclsms(this.id),btnClick()" style="cursor:pointer"><td><?php echo $sele['nom_cl']?></td><td ><?php echo $sele['telephone_cl']?></td></tr>
            <?php
        }
    }
}
echo '</table>';
?>