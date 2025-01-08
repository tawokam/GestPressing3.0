<?php
require('connect.php');

?><br>
<div id="blockDossierUser"><br><br><br><br><br>
    <table style="width:100%;text-align:center">
         
        <tr style="font-weight:bold">
            <td >RCC : RC/BFM/2023/B/257</td>
            <td >NIU : M062318307272A</td>
        </tr>
        <tr style="font-weight:bold">
            <td > Tél : 695 416 801</td>
            <td >CAPITAL SOCIAL : 900.000 FRS</td>
        </tr>
        <tr>             
            <td colspan="2" style="font-size:10px;font-weight:bold">SITUE A BAFOUSSAM TOUGANG VILLAGE A CÔTÉ D’EXPRES UNION<br><br></td>
        </tr>
    </table><br>

    <h2 style="text-align:center">Fiche de paie des employés </h2>
    
    <div style="display:flex;justify-content:center">
        <div style="text-align:center">Paiement du <input type="date" id="datedebutAllfiche" onchange="affichBodyAllPaieEmploye()" class="dateSalary" style="border:none"></div>
        <div style="text-align:center">&nbsp;&nbsp; Au &nbsp;&nbsp;<input type="date" id="datefinAllfiche" onchange="affichBodyAllPaieEmploye()" class="dateSalary" style="border:none"></div>
    </div><br>
    
    <table border=1 style="width:100%;text-align:center;border-collapse:collapse" id="contentAllPaiement">
        
    </table>   
</div>   