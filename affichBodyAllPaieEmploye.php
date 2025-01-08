<?php
require('connect.php');
$datedebut = $_GET['datedebut'];
$datefin = $_GET['datefin'];


echo '<tr>
            <th colspan="2" style="border:1px solid gray">Période</th>
            <th style="border:1px solid gray">Employé</th>
            <th style="border:1px solid gray">Montant</th>
            <th style="border:1px solid gray">Enregistrer le</th>
        </tr>';
       

if($datedebut != '' && $datefin != '')
{
    $monTot = 0;
    $se = "SELECT * From salaire inner join comptes on salaire.user=comptes.id_compte WHERE date_debut >= '$datedebut' AND date_fin <= '$datefin' order by date_debut asc";
    if($sel = $connec -> query($se)){
        while($sele = $sel -> fetch()){
            echo '<tr id="'.$sele['ligne'].'" onclick="var x = confirm(\'Confirmez la suppression en cliquant sur OK\');if(x == true){DropPaieEmploye(this.id);}"><td style="border:1px solid gray">'.$sele['date_debut'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['date_fin'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['nom_user'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['montverse'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['date_save'].'</td></tr>';
            $monTot += $sele['montverse'];
        }
    }
}else if($datedebut != '' && $datefin == '')
{
    $monTot = 0;
    $se = "SELECT * From salaire inner join comptes on salaire.user=comptes.id_compte WHERE date_debut >= '$datedebut' order by date_debut asc";
    if($sel = $connec -> query($se)){
        while($sele = $sel -> fetch()){
            echo '<tr id="'.$sele['ligne'].'" onclick="var x = confirm(\'Confirmez la suppression en cliquant sur OK\');if(x == true){DropPaieEmploye(this.id);}" style="cursor:pointer"><td style="border:1px solid gray">'.$sele['date_debut'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['date_fin'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['nom_user'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['montverse'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['date_save'].'</td></tr>';
            $monTot += $sele['montverse'];
        }
    }
}else if($datedebut == '' && $datefin != '')
{
    $monTot = 0;
    $se = "SELECT * From salaire inner join comptes on salaire.user=comptes.id_compte WHERE date_fin <= '$datefin' order by date_debut asc";
    if($sel = $connec -> query($se)){
        while($sele = $sel -> fetch()){
            echo '<tr id="'.$sele['ligne'].'" onclick="var x = confirm(\'Confirmez la suppression en cliquant sur OK\');if(x == true){DropPaieEmploye(this.id);}" style="cursor:pointer"><td style="border:1px solid gray">'.$sele['date_debut'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['date_fin'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['nom_user'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['montverse'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['date_save'].'</td></tr>';
            $monTot += $sele['montverse'];
        }
    }
}else if($datedebut == '' && $datefin == '')
{
    $monTot = 0;
    $se = "SELECT * From salaire inner join comptes on salaire.user=comptes.id_compte order by date_debut asc";
    if($sel = $connec -> query($se)){
        while($sele = $sel -> fetch()){
            echo '<tr id="'.$sele['ligne'].'" onclick="var x = confirm(\'Confirmez la suppression en cliquant sur OK\');if(x == true){DropPaieEmploye(this.id);}" style="cursor:pointer"><td style="border:1px solid gray">'.$sele['date_debut'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['date_fin'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['nom_user'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['montverse'].'</td>';
            echo '<td style="border:1px solid gray">'.$sele['date_save'].'</td></tr>';
            $monTot += $sele['montverse'];
        }
    }
}

echo '  <tr>
        <td style="border:1px solid gray" colspan="3"> <strong>Total des paiements : </strong></td>
        <td style="border:1px solid gray" colspan="2"> <strong style="color:blue">'.$monTot.' Fcfa</strong>  </td>
    </tr>';
?>  