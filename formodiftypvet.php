<?php
require('connect.php');
$ident = $_GET['ident'];
$se="SELECT * FROM typevetement where id_typevet='$ident'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
?>
                <input type="hidden" value="<?php echo $ident; ?>"  id="identtypvet">
                <tr><td><label for="nomatiere" class="form-label">Type de vêtement</label><br><input type="text" value="<?php echo $sele['nom_vet']?>"  id="newnomtypvewt" class="form-control"><br></td></tr>
                <tr><td><label for="nomatiere" class="form-label">Prix de lavage</label><br><input type="number" value="<?php echo $sele['prix_vet']?>"  id="newprixtypvet" class="form-control"><br></td></tr>
                
       
    <?php
    }
}
?>