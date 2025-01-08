<?php
require('connect.php');
$se="SELECT * FROM agence";
echo '<option value="all">Tous les pressings</option>';
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        ?>
    <option value="<?php echo $sele['id_agence']?>"><?php echo $sele['nom'] ?></option>
        <?php
    }
}
?>