<?php
require('connect.php');
$nomvet=$_POST['nomvet'];
$prixvet=$_POST['prixvet'];
$cookie=$_POST['cookie'];
$datetime = date('Y/m/d h:i:s');

// récuperation de l'agence en local
$agence = 0;
$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nom = $sele['nom_user'];
    }
}

if($nomvet==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez le nom du vêtement
</div>';
}else if($prixvet==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez le prix de lavage du vêtement
</div>';
}else if($agence == 0){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    aucun pressing activé. Veuillez activer un pressing
</div>';
}
else{
    

$se="SELECT *,count(id_typevet) as nbre FROM typevetement where nom_vet='$nomvet'";
if($sel=$connec->query($se)){
    while($selec=$sel->fetch()){
      $nbre=$selec['nbre'];
      if($nbre>=1){
          echo '<br/><div class="alert alert-warning" role="alert" style="font-size:12px">
          Ce vêtement a déjà été créé
      </div>';
      }else if($nbre<1){
          $re="INSERT INTO typevetement values('','$nomvet','$prixvet','$agence')";
          if($req=$connec->query($re)){
            echo '<div class="alert alert-success" role="alert" style="font-size:12px">Vêtement créer avec succès</div>';
            // inserer la suppression des les operations
            $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nom','Type de vetement','Insertion','nom:".$nomvet.", prix:".$prixvet."','$agence')";
            if($ins = $connec -> exec($in)){} 
        }

      }
    }
}
}
?>