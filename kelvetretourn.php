<?php
require('connect.php');
$connec -> beginTransaction();
try {
    $cookie    = $_POST['cookie'];
    $codevet   = $_POST['codevet'];
    $qte       = $_POST['qte'];
    $motifBack = $_POST['motifBack'];
    $date      = date('Y/m/d'); 

    if($codevet == ''){
        echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
            Aucun vetement sélectionner
        </div>';
    }
    else if($qte == ''){
        echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
           Quelle quantité est retournée ?
        </div>';
    }
    else if($motifBack == ''){
        echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
           Entrer le motif du renvoi
        </div>';
    }else
    {
         // récuperation de l'agence en local
        $agence = 0;
        $ag = "SELECT * FROM agence WHERE statut = 'activer'";
        if($age = $connec -> query($ag)){
            while($agen = $age -> fetch()){
                $agence      = $agen['id_agence'];
                $Nomagence   = $agen['nom'];
                $Phoneagence = $agen['telephone'];
            }
        }

        $se="SELECT * FROM sortivetement WHERE id_sort='$codevet'";
        if($sel=$connec->query($se)){
            while($sele=$sel->fetch()){
                $idClient        = $sele['id_client'];
                $idTypevet       = $sele['id_typevet'];
                $qte_dep         = $sele['quantite_sort'];
                $description_dep = $sele['description_sort'];
                $montaverse      = $sele['montaverse'];
                $monttotal       = $sele['monttotal'];
                $date_depot      = $sele['date_depot'];
                $date_retrait    = $sele['date_retrait'];
                $utilisateur     = $cookie;
                $date_enreg      = $date;
                $code            = $sele['code'];
                $agence          = $agence; 

                // inserer les donnees dans la table BackVetement
                $inback = "INSERT INTO BackVetement VALUES('','$idClient','$idTypevet','$codevet','$qte','$motifBack','$cookie','$date_enreg','$code','$agence')";
                $connec -> exec($inback);

                // insertion dans la table depotvet (elle pourra etre retirer depuis l'interface sorti vet)
                $indep = "INSERT INTO depotvetement VALUES('','$idClient','$idTypevet','$qte','$description_dep','0','0','$date','$date','$cookie','$date','$code','$agence')";
                $connec -> exec($indep);
                
            }
        }

        $connec -> commit();
        echo '<br/><div class="alert alert-success" role="alert" style="font-size:12px">
                Vetement retourné avec succès
            </div>';
    }
   
} catch (Exception $ex) {
    $connec -> rollback();
    echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
    Erreur lors du retour. Reéssayer svp'.$ex.'
</div>';
}


?>