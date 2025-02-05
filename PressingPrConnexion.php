
<?php
    require('connect.php');
    // récuperation de l'agence en local

    $ag = "SELECT id_agence,nom FROM agence";
    if($age = $connec -> query($ag)){
        while($agen = $age -> fetch()){
            $agence = $agen['id_agence'];
            ?>
            <option value="<?php echo $agen['id_agence']?>"><?php echo $agen['nom']?> </option> 
            <?php
        }
    }
?>