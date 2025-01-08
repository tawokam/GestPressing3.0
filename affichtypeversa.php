<?php
require('connect.php');
echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:12px;text-align: center;margin:0 auto;width:100%">
<thead class="table-dark bg-dark">
 <tr><th>Type</th><th colspan="2"> Action</th></tr>
 </thead>';
$se="SELECT * FROM typeverseargent";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
    ?>
        <tr><td ><?php echo $sele['nom_versa']?></td><td  id="<?php echo $sele['id_typevera']?>" onclick="ouvreformmodiftypversa(this.id)" style="cursor:pointer"> <i class="bi bi-pencil-fill text-warning"></i> </td><td id="<?php echo $sele['id_typevera']?>" onclick="xy=confirm('Veuillez cliqué sur Ok pour supprimer');if(xy){supptyveser(this.id)}else{}" style="cursor:pointer"> <i class="bi bi-trash3-fill text-danger"></i> </td></tr>
    <?php
    }
}
echo '</table>';
?>