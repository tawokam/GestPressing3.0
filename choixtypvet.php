<?php
require('connect.php');
$re="SELECT * FROM typevetement order by nom_vet asc";
?>
<select class="form-select" name="choixtypv" id="choixtypv" style="border: 0.5px solid gray;" onchange="prixlavage()"><option value="">Type de vetement</option>
<?php
if($req=$connec->query($re)){
    while($reqe=$req->fetch()){
        ?>
      <option value="<?php echo $reqe['id_typevet'] ?>"><?php echo $reqe['nom_vet'] ?></option>
      <?php
    }
}
echo '</select><br>';
?>