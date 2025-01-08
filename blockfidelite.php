<?php
require('connect.php');
$cookie=$_GET['cook'];
$se="SELECT * FROM comptes where login_user='$cookie'";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch()){
        $le=$sele['typecompte'];
        if($le=='admin'){echo 'oui';}else if($le=='simple'){echo 'non';}
    }
}
?>