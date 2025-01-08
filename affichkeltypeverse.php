<?php
require('connect.php');
$se="SELECT * FROM typeverseargent";
echo '<option value="">Tout les versements</option>';
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        ?>
    <option value="<?php echo $sele['id_typevera']?>"><?php echo $sele['nom_versa'] ?></option>
        <?php
    }
}
?>