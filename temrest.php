<?php 
require('connect.php');
$go="SELECT *,datediff(date_fin,date_debut) as temps FROM gestse";
if($goi=$connec->query($go)){
  while($goit=$goi->fetch()){
    $dat=date('Y/m/d');
     $tem=$goit['temps'];
        echo $tem;
}
}
?>
