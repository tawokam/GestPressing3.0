<?php
require('connect.php');
$der=$_GET['ide'];
$sel="SELECT * FROM client where id_client='$der'";
if($sele=$connec->query($sel)){
    while($selec=$sele->fetch()){
        echo $selec['nom_cl'];
    }
}
?>