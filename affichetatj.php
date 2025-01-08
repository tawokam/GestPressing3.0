<?php
require('connect.php');
$dat=$_GET['dat'];


$ag = "SELECT id_agence FROM agence WHERE statut = 'activer'";
if($age = $connec -> query($ag)){
    while($agen = $age -> fetch()){
        $agence = $agen['id_agence'];
    }
}
echo '<table id="tousom" style="text-align:left;font-weight:bold;color:blue;font-size:20px">';
//affichage de la somme total des entree en caisse
$soe="SELECT *,sum(montantv) as montT FROM versement where date_verse='$dat' AND agence='$agence'";
IF($some=$connec->query($soe)){
    while($somme=$some->fetch()){
        $montt=$somme['montT'];
        echo '<tr><td>Somme des entrées: <span id="somentre">'.$somme['montT'].'</span> Fcfa</td></tr>';
        
        //affiche des versements de la journéee
        $montverse = 0;
        $ve = "SELECT *,sum(montant) as montversement FROM verseargent where date_vera='$dat' AND agence='$agence'";
        if($ver = $connec -> query($ve)){
            while($vers = $ver -> fetch()){
             $montverse = $vers['montversement'];
          echo '<tr><td>Somme des versements: <span id="somverse">'.$montverse.'</span> Fcfa</td></tr>';

            }
        }
        
        //affichage des depenses de la journée
        $sodep="SELECT *,sum(montant) as montdep FROM depense where date_enreg='$dat' AND agence='$agence'";
        if($somdep=$connec->query($sodep)){
            while($sommdep=$somdep->fetch()){
                $montdep=$sommdep['montdep'];
                echo '<tr><td>Somme des depenses: <span id="somdep">'.$sommdep['montdep'].'</span> Fcfa</td></tr>';
                //calcul de la somme exact en caisse
                $net=$montt-($montdep+$montverse);
                echo '<tr><td>Montant net en caisse: <span id="montnet">'.$net.'</span> Fcfa</td></tr>';
            }
        
        }
        }
    }
echo '</table><br>';
?>