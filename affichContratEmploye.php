<?php
require('connect.php');
$idcompte    = $_GET['idcompte'];
$date        = date('Y/m/d');
$AnneeEncour = date('Y', strtotime($date));
$se = "SELECT * FROM comptes WHERE id_compte='$idcompte'";
if($sel = $connec -> query($se)){
    while($sele = $sel -> fetch()){
        $nom         = $sele['nom_user'];
        $datenaiss   = $sele['datenaiss'];
        $anneeNaiss  = date('Y', strtotime($datenaiss)); 
        $age         = $AnneeEncour - $anneeNaiss;
        $cni         = $sele['CNI'];
        $pere        = $sele['pere'];
        $mere        = $sele['mere'];
        $diplome     = $sele['diplome'];
        $nationalite = $sele['nationalite'];
        $poste       = $sele['poste'];
        $typecontrat = $sele['typecontrat'];
        $obligation  = $sele['obligation'];
        ?><br><br><br><br><br><br>
        <div style="text-align:left">
             <h5 style="text-align:center">CONTRAT DE TRAVAIL</h5>
            <div style="display:flex"><div style="width:50px;">Entre:</div>&nbsp; <div style="width:calc(100% - 50px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px">GROUPE STAR.SARL</div></div>
            <div style="width:100%;border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"></div>
            <div style="display:flex"><div style="width:80px;">Adresse :</div>&nbsp;<div style="width:calc(100% - 80px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px">BAFOUSSAM TOUGANG VILLAGE A CÔTÉ D’EXPRES UNION</div> </div>
            <div style="display:flex"><div style="width:155px;">N° d'immatriculation :</div>&nbsp;<div style="width:calc(100% - 155px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"></div></div>
            <div style="display:flex"><div style="width:140px;">Activité Principale :</div>&nbsp;<div style="width:calc(100% - 140px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px">Néttoyage et maintenance des vetements et des textiles</div></div>
            <div style="display:flex"><div style="width:120px;">Représenté par :</div><div style="width:calc(100% - 120px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"></div></div>
            <div style="display:flex"><div style="width:165px;">Agissant en qualité de :</div><div style="width:calc(100% - 165px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"></div></div>
            <div>D'une part,</div><br>
            <div style="display:flex">
                <div style="width:90px;">Et Mr/Mme</div><div style="width:calc(50% - 90px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"><?php echo $nom;?></div> 
                <div style="width:60px;">&nbsp;Agé de</div><div style="width:calc(15% - 60px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"><?php echo $age;?> ans</div>
                <div style="width:70px;">&nbsp;N° CNI :</div><div style="width:calc(35% - 60px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"><?php echo $cni;?></div></div>
            <div style="display:flex">
                <div style="width:60px;">Fils de</div><div style="width:calc(50% - 60px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"><?php echo $pere;?>&nbsp;</div>   
                <div style="width:50px;">&nbsp;et de </div><div style="width:calc(50% - 50px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"><?php echo $mere;?>&nbsp;</div>   
            </div>
            <div style="display:flex"><div style="width:125px;">Diplome obtenu : </div><div style="width:calc(100% - 125px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"><?php echo $diplome;?></div></div>
            <div style="display:flex">
                <div style="width:125px;">De Nationalité : </div>
                <div style="width:calc(100% - 125px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"><?php echo $nationalite;?>&nbsp;</div>
                <div style="width:100px;">d'autre part</div>
            </div><br>
            <div><u><strong>Il a été convenu et arreté se qui suit :</strong></u></div>
            <div style="display:flex">
                <div style="width:50px;">Mr(2)</div>
                <div style="width:calc(40% - 50px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"></div>
                <div style="width:220px;">&nbsp;S'engage à employer Mr/Mme</div>
                <div style="width:calc(60% - 220px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px">&nbsp;<?php echo $nom;?></div>
            </div>
            <div style="display:flex">
                <div style="width:220px;">Dans son service en qualité de</div> 
                <div style="width:calc(100% - 220px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px">&nbsp;<?php echo $poste;?></div>   
            </div>
            <div>Dans le respect au réglement intérieur conformément au code du Travail.</div>
            <div style="display:flex">
                <div style="width:70px">Mr/Mme&nbsp;</div>
                <div style="width:calc(100% - 400px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px">&nbsp;<?php echo $nom;?>&nbsp;</div> 
                <div style="width:330px">accepte d'exercer son activité professionnelle.</div> 
            </div>
            <div style="display:flex"><div style="width:190px">Le contrat à une durée de&nbsp;</div><div style="width:calc(100% - 190px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px">&nbsp;<?php echo $typecontrat;?></div></div>
            <div style="display:flex">
                <div style="width:100px">Obligations :&nbsp;</div> 
                <div style="width:calc(100% - 100px);border-bottom:2px dotted rgba(128, 128, 128, 0.808);height:20px"><?php echo $obligation;?>&nbsp;</div> 
            </div><br><br>
            <div style="text-align:right">Fait à ..................................... le ......................................</div><br><br>
            <table style="width:100%">
                <tr>
                    <td>Lu et approuvé <br> <?php echo $nom;?></td>
                    <td>SIGNATURE</td>
                    <td>Employeur</td>
                </tr>
            </table>
        </div>
           
        <?php
    }
}
?>