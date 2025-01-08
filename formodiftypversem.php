<?php
require('connect.php');
$ident=$_GET['ident'];
$se="SELECT * FROM typeverseargent where id_typevera='$ident'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
?>
                <input type="hidden" value="<?php echo $ident; ?>"  id="identypversa">
               <tr><td><label for="newtypversa" class="form-label">Type de versement</label><br><input type="text" value="<?php echo $sele['nom_versa']?>"  id="newtypversa" class="form-control"><br></td></tr>
                 
       
    <?php
    }
}