<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    require('connect.php');
    $id = $_GET['idcompte'];
    $se = "SELECT salaire,nom_user,agence From comptes WHERE id_compte='$id'";
    if($sel = $connec -> query($se)){while($sele = $sel -> fetch()){$salaire = $sele['salaire'];$user = $sele['nom_user'];$agence = $sele['agence'];}}
    ?>
    <br>             
    
    <h5 class="card-title">Enregistrer un paiement de salaire de <?php echo $user; ?></h5>
    <form class="row g-3">
        <div class="form-group col-md-6">
            <label for="inputFirstName">salaire du </label>
            <input type="date" name="datedebutpaie" id="datedebutpaie" class="form-control">
            <input type="hidden" name="agenceEmployer" id="agenceEmployer" value="<?php echo $agence; ?>">
        </div>

        <div class="form-group col-md-6">
            <label for="inputFirstName">Au </label>
            <input type="date" name="datefinpaie" id="datefinpaie" class="form-control">
        </div>

        <div class="form-group col-md-6">
            <label for="salaireEmpl">Salaire de l'employer</label>
            <input type="number" name="salaireEmpl" id="salaireEmpl" class="form-control" value="<?php echo $salaire;?>" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="salaireEmplMontverse">Montant versé</label>
            <input type="number" name="salaireEmplMontverse" id="salaireEmplMontverse" class="form-control" >
        </div></form>
        <div class="form-group col-md-12" style="text-align:center">   
            <button id="btnnewcompt" onclick="insertPaieEmploye('<?php echo $id; ?>')">Enregistrer</button>
        </div>
        <div class="form-group col-md-12" style="text-align:center">   
            <div id="responseRequest"></div>
        </div>
    </div>
<script src="script.js"></script>
</body>
</html>

           