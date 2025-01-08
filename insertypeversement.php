<?php
require('connect.php');
$typeve = $_POST['type'];
$cookie = $_POST['cookie'];
$datetime = date('Y/m/d h:i:s');

$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}

$se = "SELECT nom_user FROM comptes WHERE login_user='$cookie'";
if($sel = $connec -> query($se)){
    while ($sele = $sel -> fetch()) {
        $nomuser = $sele['nom_user'];
    }
}

if($typeve==''){
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Veuillez entrez un type de versement
</div>';
}else if($typeve!=''){
    $se="SELECT *,count(id_typevera) as nbre FROM typeverseargent where nom_versa='$typeve'";
      if($sel=$connec->query($se)){
          while($sele=$sel->fetch()){
              $nbre=$sele['nbre'];
              if($nbre<1){
                $in="INSERT INTO typeverseargent values('','$typeve','$agence')";
                if($inse=$connec->exec($in)){
                    echo '<div class="alert alert-success" role="alert" style="font-size:12px">Type de versement enregistré</div>';

                    $in ="INSERT INTO operationseffectuees VALUES('','$datetime','$nomuser','Type de versement','Insertion','nom:".$typeve."','$agence')";
                        if($ins = $connec -> exec($in)){} 
                }
              }else if($nbre>=1){
                  echo '<br/><div class="alert alert-warning" role="alert" style="font-size:12px">
                  Ce type de versement éxiste déja
              </div>';
              }
          }
      }
}

?>