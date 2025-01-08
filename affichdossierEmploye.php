<?php
require('connect.php');
$id = $_GET['idcompte'];
$se = "SELECT * From comptes inner join agence on comptes.agence=agence.id_agence WHERE id_compte='$id'";
if($sel = $connec -> query($se)){while($sele = $sel -> fetch()){

    // informations personnel 
    $nom         = $sele['nom_user'];
    $telephone   = $sele['telephone_user'];
    $datenaiss   = $sele['datenaiss'];
    $cni         = $sele['CNI']; 
    $pere        = $sele['pere'];
    $mere        = $sele['mere'];
    $diplome     = $sele['diplome'];
    $nationalite = $sele['nationalite'];

    $agence      = $sele['nom'];  
    $login       = $sele['login_user'];
    $statut      = $sele['statut'];
    $daterecrute = $sele['daterecrute'];
    $typecontrat = $sele['typecontrat'];
    $obligation  = $sele['obligation'];
    $poste       = $sele['poste'];
    $salaire     = $sele['salaire'];
}
}
?><br>
<div id="blockDossierUser"><br><br><br><br><br>
    <table style="width:100%;text-align:center">
         
        <tr style="font-weight:bold">
            <td >RCC : RC/BFM/2023/B/257</td>
            <td >NIU : M062318307272A</td>
        </tr>
        <tr style="font-weight:bold">
            <td > Tél : 695 416 801</td>
            <td >CAPITAL SOCIAL : 900.000 FRS</td>
        </tr>
        <tr>             
            <td colspan="2" style="font-size:10px;font-weight:bold">SITUE A BAFOUSSAM TOUGANG VILLAGE A CÔTÉ D’EXPRES UNION<br><br></td>
        </tr>
    </table><br>

    <h2 style="text-align:center">Dossier Employé</h2>
    <div style="background:blue;color:white;text-align:center;padding:3px 0px;font-size:12px;font-weight:bold">Informations personnelles de l'employé</div>
    <table>
        <tr>
            <td rowspan="5"><img src="./img/user.png" alt="" style="width: 100px;"></td>
        </tr>
        <tr>
            <td><strong>Nom </strong> : <?php echo $nom ;?> </td>
            <td>&nbsp;<strong>Nationalité </strong> : <?php echo $nationalite ;?> </td>
        </tr>
        <tr>
            <td><strong>Téléphone </strong> : <?php echo $telephone ;?> </td>
            <td>&nbsp;<strong>Diplome </strong> : <?php echo $diplome ;?> </td>
        </tr>
        <tr>
            <td><strong>Date de naissance </strong> : <?php echo $datenaiss ;?> </td>
            <td>&nbsp;<strong>Nom du père </strong> : <?php echo $pere ;?> </td>
        </tr>
        <tr>
            <td><strong>Numéro CNI </strong> : <?php echo $cni ;?> </td>
            <td>&nbsp;<strong>Nom de la mère </strong> : <?php echo $mere ;?> </td>
        </tr>
            
        </tr>
    </table><br>
    <div style="background:blue;color:white;text-align:center;padding:3px 0px;font-size:12px;font-weight:bold">Informations professionnelles de l'employé</div>       
    <table style="width:100%">
        
        <tr>
            <td style="width:50%"><strong>Pressing rattaché </strong> : <?php echo $agence ;?> </td>
            <td><strong>Login </strong> : <?php echo $login ;?> </td>
        </tr>
        <tr>
            <td><strong>Statut </strong> : <?php echo $statut ;?> </td>
            <td><strong>Recruté le </strong> : <?php echo $daterecrute ;?> </td>
        </tr>
        <tr>
            <td><strong>Type de contrat </strong> : <?php echo $typecontrat ;?> </td>
            <td style="width:50%"><strong>Obligation </strong> : <?php echo $obligation ;?> </td>
        </tr>
        <tr>
            <td><strong>Poste </strong> : <?php echo $poste ;?> </td>
            <td><strong>Salaire </strong> : <?php echo $salaire ;?> Fcfa</td>
        </tr>
            
        </tr>
    </table>  <br>   
    
    <!-- paiements -->
    <div style="background:blue;color:white;text-align:center;padding:3px 0px;font-size:12px;font-weight:bold">Journal des paiements</div> 
    <table border=1 style="width:100%;text-align:center;border-collapse:collapse">
        <tr>
            <th colspan='2' style="border:1px solid gray">Période</th>
            <th style="border:1px solid gray">Montant</th>
            <th style="border:1px solid gray">Enregistrer le</th>
        </tr>
        <tr>
        <?php
        $monTot = 0;
$se = "SELECT * From salaire WHERE user='$id' order by date_debut asc";
if($sel = $connec -> query($se)){
    while($sele = $sel -> fetch()){
        echo '<tr><td style="border:1px solid gray">'.$sele['date_debut'].'</td>';
        echo '<td style="border:1px solid gray">'.$sele['date_fin'].'</td>';
        echo '<td style="border:1px solid gray">'.$sele['montverse'].'</td>';
        echo '<td style="border:1px solid gray">'.$sele['date_save'].'</td></tr>';
        $monTot += $sele['montverse'];
    }
}
?>  <tr>
        <td colspan="3" style="border:1px solid gray"> <strong>Total des paiements : </strong></td>
        <td style="border:1px solid gray"> <strong style="color:blue"> <?php echo $monTot ;?> Fcfa</strong>  </td>
    </tr>
    </table>   
</div>   