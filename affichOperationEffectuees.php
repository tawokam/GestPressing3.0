<?php
require('connect.php');
$dated=$_GET['datedebut'];
$datef=$_GET['datefin'];
$total=0;

if($dated=='' || $datef==''){
    echo '<div style="text-align:center"><h3>Opérations effectuées dans le logiciel</h3></div>';
}else if($dated!='' && $datef!=''){
    echo '<div style="text-align:center"><h3>Opérations effectuées du '.$dated.' Au '.$datef.'</h3></div>';
}

echo '<table class="table table-succes table-bordered table-striped table-hover" style="font-size:14px;text-align: center;margin:0 auto;width:100%;border-collapse:collapse" border=1>
<thead class="table-primary">
 <tr><th>N°</th><th>Date et Heure</th><th>Nom utilisateur</th><th>Pressing</th><th>Formulaire</th><th>Action effectuer</th><th>Informations</th></tr>
 </thead>';
 $n = 1;
if($dated=='' || $datef==''){

    $se="SELECT * FROM operationseffectuees inner join agence on operationseffectuees.agence=agence.id_agence order by ligne desc";
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            ?>
       <tr><td ><?php echo $n;?></td><td ><?php echo $sele['dateheure'] ?></td><td ><?php echo $sele['users'] ?></td><td ><?php echo $sele['nom'] ?></td><td ><?php echo $sele['formulaire'] ?></td><td ><?php echo $sele['action'] ?></td><td style="width:20%"><?php echo $sele['valeurSaissie'] ?></td></tr>
            <?php
            $n++;
        }
    }

}else if($dated!='' && $datef!=''){
  
    $se="SELECT * FROM operationseffectuees inner join agence on operationseffectuees.agence=agence.id_agence  where DATE(dateheure) between '$dated' AND '$datef' order by ligne desc";
   
    if($sel=$connec->query($se)){
        while($sele=$sel->fetch()){
            ?>
       <tr><td><?php echo $n;?></td><td ><?php echo $sele['dateheure'] ?></td><td ><?php echo $sele['users'] ?></td><td ><?php echo $sele['nom'] ?></td><td><?php echo $sele['formulaire'] ?></td><td><?php echo $sele['action'] ?></td><td><?php echo $sele['valeurSaissie'] ?></td></tr>
            <?php
            $n++;
        }
    }
   
}
echo '</table>';

?>