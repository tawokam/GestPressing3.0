<?php
require('connect.php');
echo '<option value="">Type de versement</option>';
$se="SELECT * FROM typeverseargent";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        ?>
        <option value="<?php echo $sele['id_typevera']?>"><?php echo $sele['nom_versa'] ?></option>
            <?php
    }
}
?>