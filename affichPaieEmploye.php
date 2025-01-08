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

    <h2 style="text-align:center">Fiche de paie de l'employé  <?php echo $nom ;?> </h2>
    <div style="display:flex; justify-content:space-around">
        <div><strong>Salaire mensuel : <span style="color:blue"> <?php echo $salaire ;?> FCFA</span></strong> </div>
        <div><strong>Salaire Annuel : <span style="color:blue"> <?php echo $salaire*12 ;?> FCFA</span></strong> </div>
    </div><br>
    <div style="display:flex;justify-content:center"><input type="hidden" id="idCompGest" value="<?php echo $id?>">
        <div style="text-align:center">Paiement du <input type="date" id="datedebutfiche" onchange="affichBodyPaieEmploye()" class="dateSalary" style="border:none"></div>
        <div style="text-align:center">&nbsp;&nbsp; Au &nbsp;&nbsp;<input type="date" id="datefinfiche" onchange="affichBodyPaieEmploye()" class="dateSalary" style="border:none"></div>
    </div><br>
    
    
    <!-- paiements -->
    <div style="background:blue;color:white;text-align:center;padding:3px 0px;font-size:12px;font-weight:bold">Journal des paiements</div> 
    <table border=1 style="width:100%;text-align:center;border-collapse:collapse" id="contentPaiement">
        
    </table>   
</div>   
