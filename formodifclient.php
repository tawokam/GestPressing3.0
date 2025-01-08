<?php
require('connect.php');
$ident=$_GET['ident'];
$se="SELECT * FROM client where id_client='$ident'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
?>
                <input type="hidden" value="<?php echo $ident; ?>"  id="ident">
                <tr><td><label for="newnomcl" class="form-label">Nom du client</label><input type="text" value="<?php echo $sele['nom_cl']?>"  id="newnomcl"  class="form-control"><br></td></tr>
                <tr><td><label for="newphonecl" class="form-label">Numéro de téléphone du client</label><br><input type="number" value="<?php echo $sele['telephone_cl']?>"  id="newphonecl"  class="form-control"><br></td></tr>
                
       
    <?php
    }
}