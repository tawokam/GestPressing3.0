<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print</title>
  <style>
      @media print{
          #btnn{display:none}
          
      }
  </style>
<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
 <link rel="stylesheet" href="style.css">
</head>
<body>
<button class="btn btn-primary" onclick="window.print()" id="btnn"> <i class="bi bi-printer text-light"></i> Imprimer</button>

  <div style="width:95%;margin:0 auto;text-align:center" id="contentPrintRapport" class="page">

  </div>
</body>
</html>
  