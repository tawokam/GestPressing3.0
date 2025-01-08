<?php
require('connect.php');
echo '<select class="form-select" id="choixenregdep"><option value="">Type de depense</option>';
$re="SELECT * FROM typedepense";
if($req=$connec->query($re)){
    while($reqe=$req->fetch()){
        ?>
     <option value="<?php echo $reqe['id_dep'] ?>"><?php echo $reqe['nom_dep'] ?></option>
        <?php
    }
}
echo '</select><br>';
?>