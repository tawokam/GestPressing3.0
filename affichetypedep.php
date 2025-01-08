<?php
require('connect.php');
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:100%">
<thead class="table-dark">
 <tr><th>Nom de la dépense</th><th colspan="2">Action</th></tr>
 </thead>';
$se="SELECT * FROM typedepense";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        ?>
  <tr><td ><?php echo $sele['nom_dep']; ?></td><td id="<?php echo $sele['id_dep'] ?>" onclick="ouvreformmodiftypdep(this.id)" style="cursor:pointer"> <i class="bi bi-pencil-fill text-warning"></i> </td><td id="<?php echo $sele['id_dep'] ?>" onclick="xy=confirm('Veuillez confirmer la suppression en cliquant sur le bouton OK');if(xy){suptypedep(this.id)}" style="cursor:pointer"><i class="bi bi-trash3-fill text-danger"></i></td></tr>
        <?php
    }
}
echo '</table>';
?>