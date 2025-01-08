<?php
require('connectConnexion.php');
require('connectOnLine.php');
$numero=htmlspecialchars($_POST['telephoneconnect']);
$mdp=htmlspecialchars(md5($_POST['mdpconnect']));
$pressing=htmlspecialchars($_POST['pressing']);

 if($numero==''){
     echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
     Veuillez entrez votre login
</div>';
 }else if($mdp==''){
     echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
     VeUillez entrez votre mot de passe
</div>';

 }else if($pressing==''){
     echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">
     Aucun pressing sélectionné
</div>';
 }
 else{
$re="SELECT *,count(id_compte) as nbre FROM comptes where login_user='$numero' AND mdp_user='$mdp'";
if($req=$connec->query($re)){
    while($reqe=$req->fetch()){
        $nbre=$reqe['nbre'];$statut=$reqe['statut'];
        if($nbre==1 && $statut=='Activer'){
            $typeCompte = $reqe['typecompte'];
           
            // Créer un cookie avec des options supplémentaires
            setcookie("typecompte", $typeCompte, time() + (86400 * 30), "/", "", true, false);
            setcookie("adminLocal", $typeCompte, time() + (86400 * 30), "/", "", true, false);// permet de distinguer un admin meme en mode local

            echo '<div class="alert alert-success" role="alert" style="font-size:12px">Ouverture du logiciel dans quelque seconde</div>';
            // activation du pressing sélectionné
            $up = "UPDATE agence SET statut='desactiver'";
            if($upp = $connec -> query($up) ){$up2="UPDATE agence SET statut='activer' WHERE id_agence='$pressing'";$upp2=$connec -> query($up2); }
        }else if($nbre<1){
            
            // pas d'utilisateur en local verifier en ligne
            $rel="SELECT *,count(id_compte) as nbre FROM comptes where login_user='$numero' AND mdp_user='$mdp'";
            if($reql=$connecLine->query($rel)){
                while($reqel=$reql->fetch()){
                    $nbrel=$reqel['nbre'];$statutl=$reqel['statut'];
                    if($nbrel==1 && $statutl=='Activer'){
                        $typeCompte = $reqe['typecompte'];

                        // se rassurer que le pressing sélectionner en ligne est en local
                        $sia = "SELECT id_agence FROM agence WHERE id_agence='$pressing'";
                        if($siag = $connec -> query($sia)){
                            $nbrAg = $siag -> rowCount();
                            if($nbrAg == 0){
                                echo '<div class="alert alert-danger" role="alert" style="font-size:12px">Veuillez sélectionner le pressing auquel vous êtes rattaché.</div>';
                            }else{
                                // Créer un cookie avec des options supplémentaires
                                setcookie("typecompte", $typeCompte, time() + (86400 * 30), "/", "", true, false);
                                setcookie("adminLocal", $typeCompte, time() + (86400 * 30), "/", "", true, false);// permet de distinguer un admin meme en mode local
                                echo '<div class="alert alert-success" role="alert" style="font-size:12px">Ouverture du logiciel dans quelque seconde</div>';
                                // activation du pressing sélectionné
                                $up = "UPDATE agence SET statut='desactiver'";
                                if($upp = $connecLine -> query($up) ){$up2="UPDATE agence SET statut='activer' WHERE id_agence='$pressing'";$upp2=$connecLine -> query($up2); }

                                // récuperation des données du compte en ligne pour le stocker en local
                                // Récupérer les colonnes de la table source
                                $stmt = $connecLine->query("SHOW COLUMNS FROM comptes");
                                $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
                                $columnsList = implode(", ", $columns);

                                // Sélectionner les données de la table source
                                $stmt = $connecLine->query("SELECT $columnsList FROM comptes WHERE login_user='$numero' AND mdp_user='$mdp'");
                                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                // Préparer l'insertion dans la table cible
                                $placeholders = implode(", ", array_fill(0, count($columns), '?'));
                                $insertStmt = $connec->prepare("INSERT INTO comptes ($columnsList) VALUES ($placeholders)");

                                // Insérer les données
                                foreach ($rows as $row) {
                                $insertStmt->execute(array_values($row));
                                }
                            }
                        }

                        
                    }else if($nbrel<1){ 

                        echo '<br/><div class="alert alert-danger" role="alert" style="font-size:12px">Echec. Login ou mot de passe incorrect
                    </div>';
                    }else if($nbrel==1 && $statutl=='Desactiver'){
                        echo '<br/><div class="alert alert-warning" role="alert" style="font-size:12px">
                        Votre compte a été désactivé
                        </div>';
                    }
                }
            }
        }else if($nbre==1 && $statut=='Desactiver'){
            echo '<br/><div class="alert alert-warning" role="alert" style="font-size:12px">
            Votre compte a été désactivé
       </div>';
        }
    }
}
 }
?>