<?php
require('connect.php');
$ident=$_GET['ident'];
$se="SELECT * FROM typedepense where id_dep='$ident'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
?>
                <input type="hidden" value="<?php echo $ident; ?>"  id="identypdep">
                <tr><td><label for="newnomdep" class="form-label">Type de depense </label><br><input type="text" value="<?php echo $sele['nom_dep']?>"  id="newnomdep" class="form-control"><br></td></tr>
                         
       
    <?php
    }
}