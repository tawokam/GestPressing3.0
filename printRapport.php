<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Print</title>
  <style>
      @media print{
          #btnn{display:none}
          @page { margin: 0; } body { margin: 0; padding: 0; } .page { page-break-after: always; position: relative; width: 100%; height: 100vh; } .page::before { content: ""; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: url('img/logo.jpg') no-repeat center center; background-size: cover; z-index: -1; }
      }
  </style>
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
 <link rel="stylesheet" href="style.css">
</head>
<body>
  <button class="btn btn-primary" onclick="window.print()" id="btnn"> <i class="bi bi-printer text-light"></i> Imprimer</button>

  <div style="background-image:url('img/logo.jpg');background-size:cover;background-repeat:repeat;width:95%;margin:0 auto;text-align:center" id="contentPrintRapport" class="page">

  </div>
   <script src="script.js"></script> 
</body>
</html>
  