<?php
require('connectConnexion.php');
$cookie           = $_POST['cookie'];
$AncienPasse      = $_POST['AncienPasse'];
$newPass          = $_POST['newPass'];
$confirmPass      = $_POST['confirmPass'];
$AncienPasseCrypt = md5($_POST['AncienPasse']);
$newPassCrypt     = md5($_POST['newPass']);

if($AncienPasse == ''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    veuillez entrer votre mot de passe
    </div>';
}else if($newPass == ''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    veuillez entrer le nouveau mot de passe
</div>';
}else if($confirmPass == ''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    veuillez confirmer le nouveau mot de passe
</div>';
}else if($confirmPass != $newPass){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Le nouveau mot de passe et la confirmation du mot de passe doivent être identiques.
</div>';
}else{
    $se = "SELECT * FROM comptes WHERE login_user='$cookie' AND mdp_user='$AncienPasseCrypt'";
    if($sel = $connec -> query($se)){
        $present = $sel -> rowCount();
        if($present < 1){
            echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
            données non valide. 
        </div>';
        }else{
            $up = "UPDATE comptes set mdp_user='$newPassCrypt' WHERE login_user='$cookie'";
            if($upd = $connec -> query($up)){
                echo '<br/><div class="alert alert-success" role="alert" style="font-size:12px">
                Mot de passe modifier avec succès
                </div>';
            }
        }
    }
}

?>