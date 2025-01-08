<?php
require('connect.php');
$choix=$_GET['choix'];
$re="SELECT * FROM typevetement where id_typevet='$choix'";
if($req=$connec->query($re)){
    while($reqe=$req->fetch()){
     echo $reqe['prix_vet'];
    }
}
?>