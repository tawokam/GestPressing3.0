    <li><a class="dropdown-item" onclick="afficheuser('all')" style="cursor: pointer;">Tous les pressings</a></li>
<?php
require('connect.php');
    // récuperation de l'agence en local

    $ag = "SELECT id_agence,nom FROM agence ";
    if($age = $connec -> query($ag)){
        while($agen = $age -> fetch()){
            $agence = $agen['id_agence'];
            ?>
            <li><a class="dropdown-item" id="<?php echo $agence ?>" onclick="afficheuser(this.id)" style="cursor: pointer;"> <?php echo $agen['nom']?> </a></li>
            <?php
        }
    }
?>