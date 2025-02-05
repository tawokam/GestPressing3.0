<!--travail sur les differentes graphes du tableau de bord-->
<?php

$nowdate = strtotime(date('Y/m/d'));
$anne    = date("Y", $nowdate);
require('connect.php');
$m  = array();
$nb = array();
$se="SELECT *, date_format(date_depot, '%M') as mois, sum(monttotal) as montm FROM facture WHERE YEAR(date_depot)='$anne' group by date_format(date_depot, '%M') order by date_format(date_depot, '%m') asc";
if($sel=$connec->query($se)){
    while($sele = $sel->fetch()){
        $m[]  = $sele['mois'];
        $nb[] = $sele['montm'];
    
    }
       
 ?>
    <script type="text/javascript">
    function affichgraphedashbord(){ 
        var caissemois = document.getElementById("caissems");
        var myChart    = new Chart(caissemois, 
                                    { type: 'bar', 
                                        data: { labels: <?php echo json_encode($m); ?>, 
                                                datasets: [{ label: 'Desactivé le graphique', data: <?php echo json_encode($nb); ?>, backgroundColor: [ 'rgb(35, 180, 90)', 'rgb(180, 50, 169)', 'rgb(168, 27, 38)', 'rgba(70, 192, 192, 1)', 'rgba(195, 110, 255, 1)', 'rgba(255, 159, 64, 1)' ], borderColor: [ 'rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)' ], borderWidth: 0 }] 
                                        }, 
                                        options: {responsive: false, scales:{ yAxes: [{ ticks:{ beginAtZero:true }}]}} 
                        }); 
        affichgraphedashborddepense();
    }

    </script>
<?php
    $mdep  = array();
    $nbdep = array();
}

$se="SELECT *, date_format(date_enreg, '%M') as moisde, sum(montant) as montdep FROM depense WHERE YEAR(date_enreg)='$anne' group by date_format(date_enreg, '%M') order by date_format(date_enreg, '%m') asc";
if($sel=$connec->query($se)){
    while($sele=$sel->fetch())
    {
        $mdep[]  = $sele['moisde'];
        $nbdep[] = $sele['montdep'];
    }
 ?>
    <script type="text/javascript">
        function affichgraphedashborddepense(){ 
            var depnsegraph = document.getElementById("depnsegraph");
            var myChart = new Chart(depnsegraph, 
                                    { type: 'doughnut', zoom: {enabled: false}, data: { labels: <?php echo json_encode($mdep); ?>, 
                                        datasets: [{ label: 'Desactivé le graphique', data: <?php echo json_encode($nbdep); ?>, backgroundColor: [ 'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)' ], borderColor: [ 'rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)' ],fill:true, backgroundColor:['rgba(153, 102, 255, 1)','rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)','rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 159, 64, 1)' ], borderWidth: 0 }]}, 
                                
                                    options: {responsive: false, scales:{ yAxes: [{ ticks:{ beginAtZero:true }}]}} 
                                    },
                        );                                       
            affichgraphedashbordversebanq();
        }

    </script>

<?php
}

$mv   = array();
$nbve = array();

$ses="SELECT *, date_format(date_vera, '%M') as moisve, sum(montant) as montve FROM verseargent WHERE YEAR(date_vera)='$anne' group by date_format(date_vera, '%M') order by date_format(date_vera, '%m') asc";
if($sels=$connec->query($ses))
{
    while($seles=$sels->fetch())
    {
        $mv[]   = $seles['moisve'];
        $nbve[] = $seles['montve'];
    }
?>
    <script type="text/javascript">
        function affichgraphedashbordversebanq(){ 

            var versebanqgraph = document.getElementById("versebanqgraph");
            var myChart = new Chart(versebanqgraph,{ type: 'pie', data: { labels: <?php echo json_encode($mv); ?>,
                                                        datasets: [{ label: 'Desactivé le graphique', data: <?php echo json_encode($nbve); ?>, backgroundColor: [ 'rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)' ], hoverOffset:10, borderColor: [ 'rgba(255,99,132,1)', 'rgba(54, 162, 235, 1)', 'rgba(255, 206, 86, 1)', 'rgba(75, 192, 192, 1)', 'rgba(153, 102, 255, 1)', 'rgba(255, 159, 64, 1)' ], borderWidth: 0 }] }, 
                                                        options: {responsive: false, scales:{ yAxes: [{ ticks:{ beginAtZero:true }}]}} 
                                                    }
                                    ); 
            

        }  
 </script>
                                                         
<?php
}
if(isset($_COOKIE["typecompte"]))
{
    ?> 
    
<?php
}  
 ?>
<script type="text/javascript">
        //--- PWA
    if ('serviceWorker' in navigator) {  
         window.addEventListener('load', () => {  
            navigator.serviceWorker.register('service-worker.js').then((registration) => {  
                console.log('Service Worker enregistré avec succès:', registration);  
            }).catch((error) => {  
                console.log('Échec de l\'enregistrement du Service Worker:', error);  
            });  
        });  
    }

    //block de code permettant l'impression avec l'arrière plan
function imprime_blocbg(titre,objet)
{

    try {
/* 
             var element = document.getElementById(''+objet);
              // Sélectionne l'élément à capturer 
              var opt = { margin: 1, filename: 'page-content.pdf', image: { type: 'jpeg', quality: 0.98 }, html2canvas: { scale: 2, scrollX: 0, scrollY: 0, windowWidth: '100%', windowHeight: document.documentElement.scrollHeight }, jsPDF: { unit: 'in', format: 'A4', orientation: 'portrait' } }; 
              // Génère le PDF 
        html2pdf().from(element).set(opt).save(); 
        //window.print(); */
       //definition de la zone a imprimer
       /*  var zone=document.getElementById(objet).innerHTML;
        //overture du popup
        var fen=window.open("","","height=500,width=600,toolbar=0,menubar=0,scrollbars=1,resizable=1,status=0,location=0,left=30,top=10");
        //style du popup
     //   fen.document.body.style.color='#000000';
      //  fen.document.body.style.backgroundColor='#f00000';
        fen.document.body.style.padding="20px";
        fen.document.body.style.textAlign="center";
        fen.document.body.style.width="95%";
     //  fen.document.body.setAttributs('id', "Elprint");
       // fen.document.head.innerHTML += `<style>body{background-color:green}</style>`;
      //  document.getElementById('Elprint').style.backgroundImage = "url('img/logo1.svg')"; 
        fen.document.body.style.backgroundImage="url('img/logo1.svg')"; 
        //ajout des donnees a imprimer
        fen.document.title=titre;
        fen.document.body.innerHTML+=""+zone+"";
        //impression du popup
        fen.window.print();
        //fermeture du popup
        fen.window.close();
        return true;  */

             var element = document.getElementById(objet); 
              html2canvas(element, { windowWidth: element.scrollWidth, windowHeight: element.scrollHeight }).then(canvas => { var imgData = canvas.toDataURL('image/png'); var pdf = new jsPDF('p', 'mm', 'a4'); var imgWidth = 210; var pageHeight = 295; var imgHeight = canvas.height * imgWidth / canvas.width; var heightLeft = imgHeight; var position = 0; pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight); heightLeft -= pageHeight; while (heightLeft >= 0) { position = heightLeft - imgHeight; pdf.addPage(); pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight); heightLeft -= pageHeight; } pdf.save('content.pdf');
            });
    } catch (error) {
        console.log('error : '+error);
        
    }


  //  return true;
}

//recuperation des information de l'utilisateur connecté
function infoUserConnect(){ 
    
    let profilUser  = document.getElementById('profilUser');
    let posteUser   = document.getElementById('posteUser');
    let phoneUser   = document.getElementById('phoneUser');
    let nomUser     = document.getElementById('nomUser');
    let neeUser     = document.getElementById('neeUser');
    let contratUser = document.getElementById('contratUser');
    let diplomeUser = document.getElementById('diplomeUser');
    let cookie      = localStorage.getItem('login');
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        const JSONDATA = JSON.parse(xhr.responseText);
        
        if (JSONDATA.statut == 200) {
            posteUser.textContent   = ' : '+JSONDATA.posteUser;
            phoneUser.textContent   = ' : '+JSONDATA.phoneUser;
            nomUser.textContent     = ' : '+JSONDATA.nomUser;
            neeUser.textContent     = ' : '+JSONDATA.neeUser;
            contratUser.textContent = ' : '+JSONDATA.contrat;
            diplomeUser.textContent = ' : '+JSONDATA.diplome;
            if(JSONDATA.profilUser == 'no'){
                profilUser.src = 'img/administrator1.png';
                console.log('yes');
                
            }else{
                profilUser.src = 'img/'+JSONDATA.profilUser;
                console.log('no');
                
            }       
            
        } else {
            console.log('Erreur:', JSONDATA.Message);
        }
        
    }
   }
xhr.open('GET','infoUserConnect.php?cookie='+encodeURI(cookie));
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
</script>                                                       


<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Groupe Star</title>
        <meta charset="utf-8">  
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="description">
        <meta content="" name="keywords">

        <!-- Vendor CSS Files -->
        <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
        <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
        <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
        <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
        <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
        <link rel="manifest" href="manifest.json">
        <link rel="icon" type="image/png" href="img/Icon.png">
        <link rel="stylesheet" href="style.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

        <script src="./chart.js-3.9.1/package/dist/chart.min.js"></script>
        <script type="text/javascript">
            /* function PressingPrConnexion()
            {
                if(window.XMLHttpRequest){
                    //Mozilla, safari, IE7+...
                    xhr = new XMLHttpRequest();
                }else if(window.ActiveXObject){
                    //IE 6 et anterieur
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
                xhr.onreadystatechange = function (){
                    if(xhr.readyState == 4 && xhr.status == 200){console.log("sdsosfojkofofi");
                    let pressing = document.getElementById('pressingConnect');
                    pressing.innerHTML = xhr.responseText;
                    
                    //infoUserConnect(); 
                }}
                xhr.open('GET','PressingPrConnexion.php');
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send();
            } */
            
            // Fonction pour créer ou modifier un cookie
            function setCookie(name, value, days) 
            {
                var expires = "";
                if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
                }
                document.cookie = name + "=" + (value || "") + expires + "; path=/";
            }

            
            function changeMode(){
                var check = document.getElementById('flexSwitchCheckChecked');
                if (check.checked)
                { // mode online
                    setCookie("typecompte", "admin", 7);           
                }
                else
                { // mode offline
                    setCookie("typecompte", "simple", 7);               
                }
                window.location.href="index.php";


            }
           
        </script>

    </head> 
    <body onload="affichgraphedashbord(),acces(),affichblockfidel(),typepressingDette()">


        <!--bloc programme-->
        <!-- <div id="secur">
            <h1 style="color:blue;font-weight: bolder;font-style:italic">GESTPRESSING</h1>
            <h4>Impossible d'accéder au logiciel</h4>
            <h5>La licence d'utilisation du logiciel est expirée.<br>Veuillez contacter l'auteur du logiciel au 699-388-115 ou au 672-222-260<br>pour l'achat d'une nouvelle licence afin de continuer a profité des fonctionnalitées du logiciel </h5>
        </div> -->

        <!--formulaire de connexion au logiciel-->
        <div id="blockconnexion">
            <table id="tabconex" style="display:block;">

                <!-- formulaire de connexion-->
                <tr>
                    <td  id="td2connexion" colspan="2" style="">
                        <div style="visibility: hidden;">lorem40fhnddsmtrsus rtjnnnnnhjrswnhrt 5nruwtrdhbbergber ernnntybeth</div>
                        <div class="card" id="blocform" style="">
                            <div class="card-body" id="blocformulaire" style="width: 100%;">
                                <h3 class="card-title" style="color:blue;">Connexion</h3>
                                <table style="width: 100%;">
                                    <tr>
                                        <td >
                                            <select name="" id="pressingConnect" class="form-select">                                         
                                                <?php
                                                    require_once('connect.php');
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
                                            </select><br>
                                        </td>
                                    </tr>
                                    <tr> 
                                        <td>
                                            <div style="display:flex">
                                                <i class="bi bi-person text-dark va-middle" style="font-size:30px;vertical-align: middle;"></i>
                                                <input type="text" placeholder="Votre login" class="form-control" id="telephoneconnect" style="vertical-align: middle;">
                                            </div><br/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div style="display:flex">
                                                <img src="./img/oeil (1).png" id="imgmdp" onclick="imgmdps()">
                                                <input type="password" placeholder="Votre mot de passe" class="form-control" id="mdpconnect" >
                                            </div><br/>
                                        </td>
                                    </tr>
                                </table>
                                <button type="button" class="btn btn-primary" id="connexion" onclick="connecter(), acces ()" style="border-radius:7px">Connexion</button>
                                <div id="sms"></div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>

        <!-- creation d'une boite d'alert pour informer l'utilisateur-->
        <div id="blockalert" style="display:none">
            <div class="card" id="blockannonce">
                <div class="card-body">
                    <div id="td1annonce">Groupe star Alert</div>
                    <div id="messagealert"></div>
                    <div style="text-align: right;">
                        <button class="btn btn-primary" onclick="fermeannonce()">OK Compris</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- travaille sur l'interface principal-->
        <table id="menu">
            <tr>
                <td rowspan="2" id="menugauche">
                    <table id="tabimbriquer" class="nav-item">
                        <tr>
                            <td class="tdmenunom" style="height:100px"><br>
                                <strong id="nomlogic">
                                    <img src="./img/logo.png" style="vertical-align:middle;width:60px"> &nbsp;Groupe Star
                                </strong><br>
                                <strong id="">
                                    <?php $ag = "SELECT nom FROM agence WHERE statut = 'activer'";
                                        if($age = $connec -> query($ag)){
                                            while($agen = $age -> fetch()){
                                                echo $agen['nom'];
                                            }
                                        } 
                                    ?>
                                </strong><br><br>
                                <div style="justify-content: space-start;" id="ChangeMode">
                                    <div class="form-check form-switch d-flex justify-content-center align-items-center">
                                        <label class="form-check-label mr-2" for="flexSwitchCheckChecked">
                                            <strong>OffLine</strong>
                                        </label>
                                        <input class="form-check-input mx-2" type="checkbox" id="flexSwitchCheckChecked" <?php if(isset($_COOKIE['typecompte']) &&  $_COOKIE['typecompte'] == 'admin'){echo 'checked';} ?> onchange="changeMode()">

                                        <label class="form-check-label ml-2" for="flexSwitchCheckChecked">
                                            <strong>OnLine</strong>
                                        </label>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr id="tabbordmenu" onclick="selectmenu(this.id)">
                            <td class="tdmenu" onclick="afficheblock(gestdashbord),actudashbord()">&nbsp;&nbsp; 
                                <i class="bi bi-graph-up-arrow"></i> &nbsp;&nbsp; Tableau de bord
                            </td>
                        </tr>
                        <tr id="gestcompmenu" onclick="selectmenu(this.id)" style="visibility:hidden">
                            <td class="tdmenu" onclick="afficheuser('all'),afficheblock(affichecompt)">&nbsp;&nbsp; 
                                <i class="bi bi-person-lines-fill"></i> &nbsp;&nbsp; Gestion des comptes
                            </td>
                        </tr>
                        <tr id="gestclientmenu" onclick="selectmenu(this.id)">
                            <td class="tdmenu" onclick="afficheclient(),afficheblock(gestclient)">&nbsp;&nbsp; 
                                <i class="bi bi-people"></i> &nbsp;&nbsp; Gestion des clients
                            </td>
                        </tr>
                        <tr id="gestvetmenu" onclick="selectmenu(this.id)">
                            <td class="tdmenu" onclick="clientcom(),afficheblock(gestvetement)">&nbsp;&nbsp; 
                                <i class="bi bi-universal-access"></i> &nbsp;&nbsp; Gestion des vetements
                            </td>
                        </tr>
                        <tr id="geststockmenu" onclick="selectmenu(this.id)">
                            <td class="tdmenu" onclick="affichvetsortnow(),afficheblock(gestsortaujd)">&nbsp;&nbsp; 
                                <i class="bi bi-wallet-fill"></i> &nbsp;&nbsp; Gestion de stock
                            </td>
                        </tr>
                        <tr id="gestdepensemenu" onclick="selectmenu(this.id)">
                            <td class="tdmenu" onclick="affichtypdep(),afficheblock(gestdepense)">&nbsp;&nbsp; 
                                <i class="bi bi-graph-down-arrow"></i> &nbsp;&nbsp; Gestion des depenses
                            </td>
                        </tr>
                        <tr id="gestdettemenu" onclick="selectmenu(this.id)">
                            <td class="tdmenu" onclick="affichdetteCour(),afficheblock(gestdette)">&nbsp;&nbsp; 
                                <i class="bi bi-thunderbolt"></i> &nbsp;&nbsp; Gestion des dettes
                            </td>
                        </tr>
                        <tr id="gestversemenu" onclick="selectmenu(this.id)">
                            <td class="tdmenu" onclick="typevers(),afficheblock(gestersement)">&nbsp;&nbsp;
                                 <i class="bi bi-currency-dollar"></i> &nbsp;&nbsp; Versements
                            </td>
                        </tr>
                        <tr id="gestsuicaisemenu" onclick="selectmenu(this.id)">
                            <td class="tdmenu" onclick="typepressingCaisse(),afficheblock(gestcaisse)">&nbsp;&nbsp; 
                                <i class="bi bi-currency-exchange"></i> &nbsp;&nbsp; Suivi de caisse
                            </td>
                        </tr>
                        <tr id="gestmessagemenu" onclick="selectmenu(this.id)">
                            <td class="tdmenu" onclick="afficheMessageSend(),afficheblock(gestsms)">&nbsp;&nbsp; 
                                <i class="bi bi-chat-dots"></i> &nbsp;&nbsp; Message
                            </td>
                        </tr>
                        <tr id="gestcartefidelitemenu" onclick="selectmenu(this.id)" style="visibility:hidden">
                            <td class="tdmenu" id="fidelite" onclick="affcartefidel(),afficheblock(gestfidelitecl)">&nbsp;&nbsp; 
                                <i class="bi bi-credit-card-2-front"></i> &nbsp;&nbsp; Carte de fidélité
                            </td>
                        </tr>
                        <tr id="gestoperationmenu" onclick="selectmenu(this.id)" style="visibility:hidden">
                            <td class="tdmenu" id="Opera" onclick="affichOperationEffectuees(),afficheblock(operationEffect)">&nbsp;&nbsp; 
                                <i class="bi bi-credit-card-2-front"></i> &nbsp;&nbsp; Opérations Effectuées
                            </td>
                        </tr>
                        <tr id="rapportmenu" onclick="selectmenu(this.id)" style="visibility:hidden">
                            <td class="tdmenu" onclick="openrappo()">&nbsp;&nbsp; 
                                <i class="bi bi-clipboard-fill"></i> &nbsp;&nbsp; Rapports
                            </td>
                        </tr>
                        <tr id="deconnexionmenu" onclick="selectmenu(this.id)">
                            <td class="tdmenu" onclick="deconnexions()">&nbsp;&nbsp;
                                <i class="bi bi-x-circle"></i> &nbsp;&nbsp; Deconnexion
                            </td>
                        </tr>
                        <tr>
                            <td class="tdmenunom">
                                <strong >Powered by TechnoSoft</strong><br>copyright 2024. version 1.0
                            </td>
                        </tr>
                            
                    </table>
                </td>
                <td id="blockinfo" >

                    <!--creation de la zone d'affichage des compte-->
                    <div id="affichecompt" >
                        <div id="toutuser"></div>
                    </div>

                    <!--affiche l'interface des utilisateur et la liste des clients-->
                    <div id="gestclient" ><br/>
                        <button type="button" class="btn btn-success" onclick="afficheclient(),btnClick()"> 
                            <i class="bi bi-repeat"></i> Actualiser
                        </button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-primary" onclick="ouvrenewclient(),btnClick()">
                            <i class="bi bi-person-plus"></i> Ajouter un client
                        </button>&nbsp;&nbsp;&nbsp;
                        <input type="text" id="seachclient" placeholder="Nom du client" onkeyup="afficheclient()" style="border:0.5px solid gray"> 
                        <i class="bi bi-search" style="font-size:20px"></i>
                        <div id="toutclient"></div>
                    </div>

                    <!--affiche l'interface de gestion des message-->
                    <div id="gestsms" ><br/>
                        <button type="button" class="btn btn-success" onclick="afficheMessageSend(),btnClick()">
                            <i class="bi bi-repeat"></i> Actualiser
                        </button>&nbsp;&nbsp;&nbsp;
                        <button type="button" class="btn btn-success" onclick="document.getElementById('formnsendsmsCl').style.display='block';btnClick()">
                            <i class="bi bi-person-plus"></i> SMS à un client en particulier <br>
                        </button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <!-- <button type="button" class="btn btn-primary" onclick="document.getElementById('smsvetsortnow').style.display='block';btnClick()">
                            <i class="bi bi-person-plus"></i> SMS aux client qui recupère <br>leurs vetement aujourd'hui
                        </button>&nbsp;&nbsp;&nbsp; -->
                        <button type="button" class="btn btn-danger" onclick="document.getElementById('smsretraitDepasse').style.display='block';btnClick()">
                            <i class="bi bi-person-plus"></i> SMS aux client dont la date de  <br>retrait est dépassé
                        </button>&nbsp;&nbsp;&nbsp;
                        <div id="toutsms"></div>
                    </div>

                    <!--affiche l'interface de gestion des vetements-->
                    <div id="gestvetement" style="width:100%;height: 100vh;overflow:auto"><br>
                        <button class="btn btn-primary" onclick="ouvrenewclient(),btnClick()">
                            <i class="bi bi-plus-lg text-light"></i> Ajouter un client
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-secondary" onclick="ouvretypevet(),btnClick()">
                            <i class="bi bi-person-lines-fill text-light"></i> Type de vetement
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-success" onclick="affichtypevete(),btnClick()">
                            <i class="bi bi-receipt-cutoff text-light"></i> Liste des vetements
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-danger" onclick="reglefact(),btnClick()">
                            <i class="bi bi-box-arrow-in-left text-light"></i> Sortie vetement
                        </button>
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-warning" onclick="dispofact(),btnClick()" style="color:white">
                            <i class="bi bi-box-arrow-in-right text-light"></i> Disponibilitée
                        </button>
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-info" onclick="formretourvet(),btnClick()" style="color:white">
                            <i class="bi bi-box-arrow-in-right text-light"></i> Retour vetements
                        </button>

                        <!--gestion des depot de vetements-->
                        <div class="card" id="depotvet" >
                            <div class="card-body" >
                                <table id="tabnewcomande" style="width:100%;border-collapse:collapse;">
                                    <tr >
                                        <td rowspan="3" style="padding-left: 7px;padding-right:7px;padding-top:5px;width:50%;vertical-align:top;height:40vh;overflow-x:auto">
                                            <table style="width: 100%">
                                                <tr>
                                                    <td>
                                                        <input type="number" placeholder="code du client" readonly class="form-control" id="codeclient" style="border: 0.5px solid gray;">
                                                    </td>
                                                    <td>
                                                        <input type="text" placeholder="Nom du client" readonly class="form-control" id="nomclient" style="border: 0.5px solid gray;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><br>
                                                        <div id="keltypvet">liste des vetements</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <input type="number" class="form-control" placeholder="Quantité" id="qte" name="qte" style="border: 0.5px solid gray;">
                                                    </td>
                                                    <td>
                                                        <input type="number" placeholder="prix unitaire" class="form-control" id="prixvetement" style="border: 0.5px solid gray;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><br>
                                                        <input type="text" placeholder="description" class="form-control"  name="descript" id="descript" style="border: 0.5px solid gray;"><br>
                                                    </td>
                                                </tr>
                                                <tr style="font-size:12px">
                                                    <td>date dépot:<br>
                                                        <input type="date" class="form-control" name="datedepot" id="datedepot" style="border: 0.5px solid gray;">
                                                    </td>
                                                    <td>date retrait:<br>
                                                        <input type="date" class="form-control" id="dateretrait" name="dateretrait" style="border: 0.5px solid gray;">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"><br>
                                                        <select class="form-select" style="border: 0.5px solid gray;" id="typelavage">
                                                            <option value="simple lavage">Simple lavage</option>
                                                            <option value="lavage express">Lavage express</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2" style="height: 10px"></td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div id="tdfin">
                                                            <button class="btn btn-primary" onclick="depovetcmd(),btnClick()" id="btnvalidcmd">
                                                                <i class="bi bi-check-lg text-light"></i> Valider
                                                            </button>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button class="btn btn-success" onclick="affichehabitdepose('fin'),btnClick()" id="btnfinsaissi">
                                                            <i class="bi bi-send-plus-fill text-light"></i> Fin saissi
                                                        </button>
                                                    </td>
                                                </tr>
                                            </table>
                                            <div id="smsFormCmd"></div>
                                        </td>
                                        <td id="tdclientcmd" style="width:50%">
                                            <div id="listeclientcmd"></div>
                                        <td>
                                    </tr>
                                    <tr style="background: black;">
                                        <td>
                                            <input type="text" id="cherchecliencmd" onkeyup="clientcom()" placeholder="Rechercher un client" style="width: 50%;height:30px">
                                            <button class="btngestclient" onclick="clientcom(),btnClick()">Actualiser</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="affichvet" style="width:95%;overflow:auto;">depot vetement</div>
                                        </td>
                                    </tr>
                                    <tr style="background: black;color:white;">
                                        <td colspan="2" style="padding: 3px 0px;">Montant à payer:
                                            <span id="totalfact">0</span>Fcfa&nbsp;&nbsp;&nbsp;Avance;
                                            <input type="number" id="avancefact" style="width: 15%;">&nbsp;&nbsp;
                                            <button id="btngerfact" onclick="stockFactur(),btnClick()">Généré la facture</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--affiche l'interface de gestion des depenses-->
                    <div id="gestdepense"><br>
                        <button class="btn btn-success" onclick="ouvretypdep(),btnClick()">
                            <i class="bi bi-stack text-light"></i> Type de depense
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-info" onclick="ouvreformdep(),btnClick()">
                            <i class="bi bi-tablet-landscape text-dark"></i> Nouvel depense
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-secondary" onclick="affichdepenses(),btnClick()">
                            <i class="bi bi-receipt-cutoff text-light"></i> Liste des depenses
                        </button>&nbsp;&nbsp;&nbsp;
                        <select id="typePressingdepense" class="typePressing" style="border-radius:7px;" onchange="affichdepenses()"></select>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-primary" onclick="actulistdepensepressing(),btnClick()">
                            <i class="bi bi-receipt-cutoff text-light"></i> Actualiser
                        </button>
                                            
                        <!--afichage des types de depense et les depenses -->
                        <div id="depotv"><br>
                            <table id="tabnewcomande">
                                <tr>
                                    <td id="tdlisteDepense" >
                                        <div id="listeDepense" ></div>
                                    </td>
                                    <td id="groupDepense">
                                        <div id="listedep"></div>
                                    </td>
                                </tr>
                            </table>
                            <table style="width: 100%;color:blue;font-weight:bold">
                                <tr>
                                    <td>Depense entre le:</td>
                                    <td style="text-align:left">
                                        <input type="date" id="datedebudep" class="form-control" onchange="affichdepenses()">
                                    </td>
                                    <td> et le:</td>
                                    <td>
                                        <input type="date" id="datefindep" class="form-control" onchange="affichdepenses()">
                                    </td>
                                </tr>
                            </table>  
                        </div>
                    </div>

                    <!--affiche l'interface de gestion des versements-->
                    <div id="gestersement"><br>
                        <button class="btn btn-info" onclick="ouvretypeversea(),btnClick()">
                            <i class="bi bi-pip text-dark"></i> Type de versement
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-primary" onclick="ouvrenewverse(),selecttyveser()">
                            <i class="bi bi-plus-circle-dotted text-light"></i> Nouveau versement
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-secondary" onclick="affichetoutvesement(),btnClick()">
                            <i class="bi bi-card-text text-light"></i> Liste des versement
                        </button>&nbsp;&nbsp;&nbsp;
                        <select id="keltypeversea" style="border-radius:7px;" onchange="affichetoutvesement()"></select>&nbsp;&nbsp;&nbsp;
                        <select id="keppressingVersement" class="typePressing" style="border-radius:7px;" onchange="affichetoutvesement()"></select>
                                            
                        <!--afichage des types de versement et les versements -->
                        <div id="depotv"><br>
                            <table id="tabnewcomande">
                                <tr>
                                    <td id="tdlisteDepense">
                                        <div id="listversement" ></div>
                                    </td>
                                    <td id="groupDepense">
                                        <div id="listeversement" ></div>
                                    </td>
                                </tr>
                            </table>
                            <table style="color:blue;font-weight:bold;width:100%;text-align:center">
                                <tr >
                                    <td >Versements entre le:</td>
                                    <td>
                                        <input type="date" id="datedebuverse" class="form-control" onchange="affichetoutvesement()">
                                    </td> 
                                    <td> et le:</td>
                                    <td>
                                        <input type="date" id="datefinverse" class="form-control" onchange="affichetoutvesement()">
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!--affiche l'interface de gestion des dettes-->
                    <div id="gestdette"><br>
                        <button class="btn btn-primary" onclick="affichdetteCour(),btnClick()">
                            <i class="bi bi-repeat text-light"></i> Actualiser
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-danger" onclick="reglefact(),btnClick()">
                            <i class="bi bi-plus-square text-light"></i> Généré une dette
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-success" onclick="ouvreregdett(),btnClick()">
                            <i class="bi bi-check2-circle text-light"></i> Réglé une dette
                        </button>&nbsp;&nbsp;&nbsp;
                        <select id="typePressingdette" class="typePressing" style="border-radius:7px;" onchange="affichdetteCour()"></select>
                                        
                        <!--afichage des dette encour et les dette regle -->
                        <div id="depotv" style="height:90vh;overflow-x: auto;overflow-y:none"><br>
                            <form class="row g-3">
                                <div class="col-md-6 p-0">
                                    <div id="listedettecour"></div>
                                </div>
                                <div class="col-md-6 p-0">
                                    <div id="listedepregle"></div>
                                </div>
                            </form>
                            <table id="tabnewcomande" style="color:blue;font-weight:bold">
                                <tr >
                                    <td >Dette entre le:</td>
                                    <td>
                                        <input type="date" id="datedebudett" class="form-control" onchange="affichdetteCour()">
                                    </td>
                                    <td> et le:</td>
                                    <td>
                                        <input type="date" id="datefindett" class="form-control" onchange="affichdetteCour()">
                                    </td>
                                </tr>
                            </table>  
                        </div>
                    </div>

                    <!--affiche l'interface de suivi de caisse-->
                    <div id="gestcaisse"><br>
                        <button class="btn btn-success" onclick="actualiseentrecaisse(),affichclotcais()">
                            <i class="bi bi-repeat text-light"></i> Actualiser
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-primary" onclick="ouvreclotcaiss(),btnClick()">
                            <i class="bi bi-safe2 text-light"></i> Cloture de caisse
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-secondary" onclick="affichclotcais(),btnClick()">
                            <i class="bi bi-receipt text-light"></i> Liste des Clotures de caisse
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-warning" onclick="affichentrecaisse()">
                            <i class="bi bi-save2 text-dark"></i> Entrée en caisse
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-primary" onclick="javascript:imprime_bloc('GESTPRESSING RAPPORTS','listeetatcais');">
                            <i class="bi bi-printer text-light"></i> Imprimer
                        </button>&nbsp;&nbsp;&nbsp;
                        <select id="keppressingcaisse" class="typePressing" style="border-radius:7px;" onchange="affichclotcais()"></select>

                        <!--afichage des cloture de caisse -->
                        <div id="depotv"><br>
                            <table id="tabnewcomande">
                                <tr>
                                    <td id="tdlisteDette" colspan=2>
                                        <div id="listeetatcais" ></div>
                                    </td>
                                </tr>
                            </table>
                            <table style="width:100%;color:blue;font-weight:bold;text-align:center;border-bottom:1px solid gray"> 
                                <tr>
                                    <td >cloture de caisse du:</td>
                                    <td style="border-right:1px dashed gray">
                                        <input type="date" id="dateclotcais" style="width:140px" class="form-control" onchange="affichclotcais()" >
                                    </td>
                                    <td>Entrée en caisse du:</td>
                                    <td>
                                        <input type="date" id="dateentrecais" style="width:140px" class="form-control" onchange="affichentrecaisse()" >
                                    </td>
                                    <td> Au:</td>
                                    <td>
                                        <input type="date" id="dateentrecaisfin" style="width:140px" class="form-control" onchange="affichentrecaisse()" >
                                    </td>
                                    <td> Montant inferieur a:</td>
                                    <td>
                                        <input type="number" id="montInfcaiss" style="width:140px" class="form-control" onkeyup="affichentrecaisse()" >
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!--afichage les opérations effectuées -->
                    <div id="operationEffect"><br>
                    <div class="alert alert-primary" role="alert" style="font-size:12px;margin:0">Historique de toutes les opérations effectuées dans les différents pressings. Elle permet d'effectuer une vérification sur les données qui ont été manipulées, par qui et dans quel pressing.</div>
                        <table id="tabnewcomande">
                            <tr>
                                <td id="tdlisteDette" colspan=2>
                                    <div id="lisoperation" ></div>
                                </td>
                            </tr>
                        </table>
                        <table style="width:100%;color:blue;font-weight:bold;text-align:center;border-bottom:1px solid gray"> 
                            <tr>
                                <td >
                                    <button class="btn btn-primary" onclick="javascript:imprime_bloc('GESTPRESSING RAPPORTS','lisoperation');">Imprimer</button>
                                </td>
                                <td>Opérations du:</td>
                                <td>
                                    <input type="date" id="datedebutoperation" class="form-control" onchange="affichOperationEffectuees()" >
                                </td>
                                <td> Au:</td>
                                <td>
                                    <input type="date" id="datefinoperation" class="form-control" onchange="affichOperationEffectuees()" >
                                </td>
                            </tr>
                        </table>  
                    </div>
             <!--    </div> -->
                                            
                    <!--affiche l'interface de la gestion de la fidelite client-->
                    <div id="gestfidelitecl"><br>
                        <div style="text-align:center">
                            <button class="btn btn-primary" onclick="ouvrenewcart(),btnClick()">
                                <i class="bi bi-credit-card text-light"></i> Généré une carte fidélité
                            </button>&nbsp;&nbsp;&nbsp;
                            <button class="btn btn-success" onclick="actucartefidelite();btnClick()">
                                <i class="bi bi-repeat text-light"></i> Actualiser
                            </button>
                        </div>
                                            
                        <!--afichage des remise effectuer -->
                        <div id="depotv"><br>
                            <table id="tabnewcomande">
                                <tr>
                                    <td id="tdlisteDette" colspan="3">
                                        <div id="listecarte" ></div>
                                    </td>
                                </tr>
                            </table>
                            <table style="width:100%;color:blue;font-weight:bold">
                                <tr>
                                    <td >Carte recharger du:</td>
                                    <td>
                                        <input type="date" id="debutrecharcarte" class="form-control" onchange="affcartefidel()">
                                    </td>
                                    <td> au:</td>
                                    <td> 
                                        <input type="date" id="finrecharcarte" class="form-control" onchange="affcartefidel()">
                                    </td>
                                    <td>
                                        <input type="text" placeholder="Rechercher la carte d'un client par son nom" name="nomuser" onkeyup="affcartefidel()" id="nomclcarte" class="form-control" style="border:0.5px solid gray">
                                    </td>
                                </tr>
                            </table>  
                        </div>
                    </div>

                    <!--affiche l'interface des vetements que la date de sortie est atteint et/ou depassé-->
                    <div id="gestsortaujd"><br>
                    <div style="display:flex;flex-wrap:wrap">
                        <button class="btn btn-primary" onclick="affichvetpresent()">
                            <i class="bi bi-capslock text-light"></i> Vêtements présent
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-warning" onclick="affichvetsortnow()">
                            <i class="bi bi-capslock text-dark"></i> Sortie d'aujourd'hui
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-secondary" onclick="affichvetsortdepasse()">
                            <i class="bi bi-chevron-double-up text-light"></i> Date de sortie dépassé
                        </button>&nbsp;&nbsp;
                        <button class="btn btn-info" onclick="javascript:imprime_bloc('GESTPRESSING RAPPORTS','listestock');">
                            <i class="bi bi-printer text-dark"></i> Imprimer
                        </button>&nbsp;&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-success" onclick="actulistvetpresent()">
                            <i class="bi bi-repeat text-light"></i> Actualiser
                        </button>&nbsp;&nbsp;&nbsp;
                        <button class="btn btn-dark" onclick="affichvetAlaver()">
                            <i class="bi bi-repeat text-light"></i> Vêtements à nettoyer.
                        </button>&nbsp;&nbsp;&nbsp; <br>
                        <button class="btn btn-info dropdown-toggle" style="margin-bottom:1% ;" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="margin-bottom:1% ;">
                            <i class="bi bi-steam"></i>Pressings
                        </button>&nbsp;&nbsp;
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" id="listAgenceStock"></ul>
                    </div>
                        


                        <!-- id du pressing sélectionné -->
                        <input type="hidden" id="selectpressingStock" value="all">
                        <div id="depotv"><br>
                            <table id="tabnewcomande" style="border:0px">                                         
                                <tr>
                                    <td id="tdlisteDette" colspan="3">
                                        <div id="listestock" style="height: 80vh;"></div>
                                    </td>
                                </tr>
                                <tr >
                                    <td colspan="1" style="color:blue;font-weight:bold;text-align:right">Date dépôt vêtement supérieur ou égal au</td>
                                    <td colspan="2" style="text-align:left;padding-left:6px"> 
                                        <input type="date" id="datedepotvetstock" class="form-control" onchange="affichvetpresent()">
                                    </td>
                                </tr>
                            </table> 
                        </div>
                    </div>
                          <!--affiche le tableau de bord avec differents graphes-->
                                     <div id="gestdashbord">

                                        <div id="depotv">
                                            <table id="tabnewcomande">
                                                
                                                  <tr><td id="tdlisteDette" colspan="3"><div id="zonegraphdashbord" style="">
                                                  <div style="border-radius:6px;margin-left:3%;margin-top:3%;background:white;padding:15px 12px;text-align:left;font-size:13px;color:black;width:500px" class="card">
                                                  <div class="card-body" >
                                                    <h5 class="card-title text-primary" style="text-align:center">Utilisateur connecté</h5>
                                                    
                                                    <div style="display:flex">
                                                        <div style='width:150px;margin-right:10px'>
                                                            <img src="img/administrator1.png" alt="" id="profilUser" style="width:100%;height:150px;border-radius:50%;border:0.5px solid gray"><label for="fileimage" class="btn btn-primary" style="position:relative;margin-top:-46px;margin-left:116px;padding:5px">
                                                            <i class="bi bi-images text-light"></i>
                                                            </label>
                                                        <input type="file" accept=".jpg,.png" id="fileimage" onchange="UpdateProfilImg()" style="display:none">
                                                        </div>
                                                        <div>
                                                            <table style="font-size:14px;font-weight:verdana">
                                                                <tr >
                                                                    <td>Nom </td>
                                                                    <td><span id="nomUser" ></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Téléphone </td>
                                                                    <td><span id="phoneUser"></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Née le </td>
                                                                    <td><span id="neeUser"></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Type de contrat </td>
                                                                    <td ><span id="contratUser"></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Diplome </td>
                                                                    <td><span id="diplomeUser"></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Poste  </td>
                                                                    <td><span id="posteUser"></span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Mot de passe </td>
                                                                    <td><span class="text-primary" style="cursor:pointer" onclick="document.getElementById('formmodifpassword').style.display='block'"><i class="bi bi-pencil text-primary"></i> Modifier</span></td>
                                                                </tr>
                                                            </table>
                                                            
                                                        </div>
                                                    </div>
                                                   <!--  <div>
                                                        <button class="btn btn-primary" onclick="ouvrenewclient(),btnClick()">
                                                        <i class="bi bi-plus-lg text-light"></i>
                                                        </button>&nbsp;&nbsp;&nbsp;
                                                        <button class="btn btn-success" onclick="affichtypevete(),btnClick()">
                                                            <i class="bi bi-receipt-cutoff text-light"></i>
                                                        </button>
                                                    </div> -->

                                                    <!-- graphe des charges et depense lier -->
                                                    <div>

                                                    </div>
                                                    
                                                  </div>
                                                    <!-- <div style="color:gray;text-align:center;font-size:20px;font-style:italic"><strong>À propos de l'entreprise TechnoSoft </strong></div><br>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;L'entreprise <strong> TechnoSoft</strong> est spécialisée dans le développement des logiciels de bureau, applications web et mobiles, sites web, etc.

    Pour tout besoin d'informatisation de votre structure, n'hésitez pas à nous contacter au 699-388-115 ou au 672-222-260.

    Nos logiciels : <br> <br>

    •  <strong>TechnoSchool</strong> : Logiciel de gestion d'établissement scolaire(web, mobile, desktop) <br><br>

    •  <strong>Gestpressing</strong> : Logiciel de gestion des pressings <br><br>
    •  <strong>ChiefDom</strong> : Application mobile pour les chefferies et les ressortissants <br><br>

    •  <strong>TechnoCommerce</strong> : Logiciel de gestion des boutiques, magasins, supermarchés, etc. <br><br>
    •  <strong>Children People</strong> : Application mobile reservée aux orphelinats <br> --></div> <br>
                                                  <div style="border-radius:6px;margin-left:3%;margin-top:3%;background:white;padding:15px 12px;text-align:center;font-size:16px;color:gray">Representation des entrées de chaque mois</br><canvas id="caissems" style="height:300px;width:350px"></canvas></div>
                                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div style="border-radius:6px;margin-left:3%;margin-top:3%;background:white;padding:15px 12px;text-align:center;font-size:16px;color:gray">Representation des versements de chaque mois</br><canvas id="versebanqgraph" style="height:300px;width:350px"></canvas></div></br/><br>
                                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div style="border-radius:6px;margin-left:3%;margin-top:3%;background:white;padding:15px 12px;text-align:center;font-size:16px;color:gray">Representation des dépenses de chaque mois</br><canvas id="depnsegraph" style="height:300px;width:350px"></canvas></div>
                                                  </div>

                                                     </td></tr>
                                                      </table>  </div></div>
                                             <!--RAPPORTS GENERE PAR GESTPRESSING-->
          <!--Liste les vetements deposé pendant une periode-->
          <div id="rapportlistvetdepot" >
            <table id="tabnewcomande">         
                  <tr><td id="tdlisteDette" colspan="3"><iframe id="listevetentre" src="printRapport.php"></iframe></td></tr>
                  <tr id="trdepdate"><td >Vetements déposé du:<input type="date" id="debutrapvetdepot" class="depdate" onchange="rapportlistevet()"> au: <input type="date" id="finrapvetdepot" class="depdate" onchange="rapportlistevet()"></td><td><select id="keppressingRapportvetdepot" class="typePressing" style="border-radius:7px;" onchange="rapportlistevet()"></select></td><td></td></tr>
            </table> 
     </div>
      <!--Liste les vetements sortie pendant une periode-->
      <div id="rapportlistvetsort" >
        <table id="tabnewcomande">         
              <tr><td id="tdlisteDette" colspan="3"><iframe id="listevetsort" src="printRapport.php"></iframe></td></tr>
              <tr id="trdepdate"><td >Vetements sortie du:<input type="date" id="debutrapvetsort" class="depdate" onchange="rapportlistevetsort()"> au: <input type="date" id="finrapvetsort" class="depdate" onchange="rapportlistevetsort()"></td><td><select id="keppressingRapportvetsort" class="typePressing" style="border-radius:7px;" onchange="rapportlistevetsort()"></select></td><td></td></tr>
        </table> 
      </div>
      <!--Liste les vetements retourné-->
      <div id="rapportlistvetback" >
        <table id="tabnewcomande">         
              <tr><td id="tdlisteDette" colspan="3"><iframe id="listevetback" src="printRapport.php"></iframe></td></tr>
              <tr id="trdepdate"><td >Vetements retournés du:<input type="date" id="debutrapvetback" class="depdate" onchange="rapportlistevetback()"> au: <input type="date" id="finrapvetback" class="depdate" onchange="rapportlistevetback()"></td><td><select id="keppressingRapportvetback" class="typePressing" style="border-radius:7px;" onchange="rapportlistevetback()"></select></td><td></td></tr>
        </table> 
      </div>
       <!--Liste les depenses pendant une periode-->
       <div id="rapportlistdepense" >
        <table id="tabnewcomande">         
              <tr><td id="tdlisteDette" colspan="3"><iframe id="listedepenserap" src="printRapport.php" scrolling="yes"></iframe></td></tr>
              <tr id="trdepdate"><td >Depenses enregistrer du:<input type="date" id="debutrapdep" class="depdate" onchange="rapportlistedepense()"> au: <input type="date" id="finrapdep" class="depdate" onchange="rapportlistedepense()"></td><td><select id="keppressingRapportdepense" class="typePressing" style="border-radius:7px;" onchange="rapportlistedepense()"></select></td><td></td></tr>
        </table> 
 </div>
      <!--Liste des facture pendant une periode-->
      <div id="rapportlistfacture" >
        <table id="tabnewcomande">         
              <tr><td id="tdlisteDette" colspan="3"><iframe id="listefacturerap" src="printRapport.php"></iframe></td></tr>
              <tr id="trdepdate"><td >Facture généré du:<input type="date" id="debutrapfact" class="depdate" onchange="rapportlistefacture()"> au: <input type="date" id="finrapfact" class="depdate" onchange="rapportlistefacture()"></td><td><select id="keppressingRapportfacture" class="typePressing" style="border-radius:7px;" onchange="rapportlistefacture()"></select></td><td></td></tr>
        </table> 
 </div>
 <!--Liste des carte de fidélité pendant une periode-->
 <div id="rapportlistcartef" >
    <table id="tabnewcomande">         
          <tr><td id="tdlisteDette" colspan="2"><iframe id="listecartefrap" src="printRapport.php"></iframe></td></tr>
          <tr id="trdepdate"><td >Carte recharger du:<input type="date" id="debutrapcarte" class="depdate" onchange="rapportlistecarteF()"> au: <input type="date" id="finrapcarte" class="depdate" onchange="rapportlistecarteF()"></td><td></td></tr>
    </table> 
</div>
 <!--Liste des dette nom regle pendant une periode-->
 <div id="rapportlistdett" >
    <table id="tabnewcomande">         
          <tr><td id="tdlisteDette" colspan="3"><iframe id="listedetterap" src="printRapport.php"></iframe></td></tr>
          <tr id="trdepdate"><td >Dette non réglé du:<input type="date" id="debutrapdette" class="depdate" onchange="rapportlistedette()"> au: <input type="date" id="finrapdette" class="depdate" onchange="rapportlistedette()"></td><td><select id="keppressingRapportregle" class="typePressing" style="border-radius:7px;" onchange="rapportlistedette()"></select></td><td></td></tr>
    </table> 
</div>
<!--Liste des versements pendant une periode-->
<div id="rapportlistverse" >
    <table id="tabnewcomande">         
          <tr><td id="tdlisteDette" colspan="4"><iframe id="listeversearapport" src="printRapport.php"></iframe></td></tr>
          <tr id="trdepdate"><td >Versement du:<input type="date" id="debutrapverse" class="depdate" onchange="rapportaffichverse()"> au: <input type="date" id="finrapverse" class="depdate" onchange="rapportaffichverse()"></td><td><select id="keltypeversearapport" onchange="rapportaffichverse()"></select></td><td><select id="keppressingRapportversement" class="typePressing" style="border-radius:7px;" onchange="rapportaffichverse()"></select></td><td></td></tr>
    </table> 
</div>
 <!--Liste du chiffre d'affaire par client pendant une periode-->
 <div id="rapportlistargantcli" >
    <table id="tabnewcomande">         
          <tr><td id="tdlisteDette" colspan="3"><iframe id="listechiffrecl" src="printRapport.php"></iframe></td></tr>
          <tr id="trdepdate"><td >chiffre d'affaire par client du:<input type="date" id="debutrapchcl" class="depdate" onchange="rapportlistechcl()"> au: <input type="date" id="finrapchcl" class="depdate" onchange="rapportlistechcl()"></td><td><select id="keppressingRapportCAclient" class="typePressing" style="border-radius:7px;" onchange="rapportlistechcl()"></select></td><td></td></tr>
    </table> 
</div>
 <!--Liste du chiffre d'affaire par vetement pendant une periode-->
 <div id="rapportlistargantvet"  style="display: none;">
    <table id="tabnewcomande">         
          <tr><td id="tdlisteDette" colspan="3"><iframe id="listechiffrevet" src="printRapport.php"></iframe></td></tr>
          <tr id="trdepdate"><td >chiffre d'affaire par vetement du:<input type="date" id="debutrapchvet" class="depdate" onchange="rapportlistechvet()"> au: <input type="date" id="finrapchvet" class="depdate" onchange="rapportlistechvet()"></td><td><select id="keppressingRapportCAvet" class="typePressing" style="border-radius:7px;" onchange="rapportlistechvet()"></select></td><td></td></tr>
    </table> 
</div>
 <!--journal des cloture de caisse pendant une periode-->
 <div id="rapportlistcloturcaus">
    <table id="tabnewcomande">         
          <tr><td id="tdlisteDette" colspan="3"><iframe id="listecloturecais" src="printRapport.php"></iframe></td></tr>
          <tr id="trdepdate"><td >Cloture de caisse du:<input type="date" id="debutrapcloturcais" class="depdate" onchange="rapportlisteclotcais()"> au: <input type="date" id="finrapcloturcais" class="depdate" onchange="rapportlisteclotcais()"></td><td><select id="keppressingRapportclotcaisse" class="typePressing" style="border-radius:7px;" onchange="rapportlisteclotcais()"></select></td><td></td></tr>
    </table> 
</div>
   
                    <!--creation du formulaire de creation des comptes utilisateurs-->
    <div class="card" id="formnewcompt">
            <div class="card-body">                
    <div id="ferme" onclick="fermecompte(),btnClick()">X</div>
    <fieldset class="fildsetnewclient">
        <h5 class="card-title">Creation d'un compte</h5>
        <table id="tabnewcomp">
            <tr><td><br><input type="text" placeholder="Nom complet" name="nomuser" id="nomuser" class="form-control"><br></td><td>date de naissance<input type="date" name="datenaissuser" id="datenaissuser" class="form-control"><br></td></tr>
            <tr><td><input type="number" placeholder="téléphone" name="telephoneuser" id="telephoneuser" class="form-control"><br></td><td><input type="text" placeholder="numéro CNI" name="CNIuser" id="CNIuser" class="form-control"><br></td></tr>
            <tr><td><input type="text" placeholder="nom du père" name="pereuser" id="pereuser" class="form-control"><br></td><td><input type="text" placeholder="nom de la mère" name="mereusre" id="mereuser" class="form-control"><br></td></tr>
            <tr><td><input type="text" placeholder="diplôme " name="diplomeuser" id="diplomeuser" class="form-control"><br></td><td><input type="text" placeholder="nationalité" name="nationaliteuser" id="nationaliteuser" class="form-control"><br></td></tr>
            <tr><td><br><select name="typeuser" id="typeContrat" class="form-select"><option value=''>Type de contrat</option><option value='CDD'>CDD</option><option value='CDI'>CDI</option></select><br></td><td>date de recrutement <br><input type="date" name="daterecrute" id="daterecrute" class="form-control"><br></td></tr>
            <tr><td><input type="text" placeholder="Login" name="login" id="login" class="form-control"><br></td><td><input type="password" placeholder="Mot de passe" name="mdpuser" id="mdpuser" class="form-control"><br></td></tr>
            <tr><td ><select name="typeuser" id="typenewuser" class="form-select"><option value=''>Type de compte</option><option value='simple'>Simple utlisateur</option><option value='admin'>Administrateur</option></select><br></td><td ><textarea placeholder="Obligations" rows="1" name="obligation" id="obligation" class="form-control" style="resize:none"></textarea><br></td></tr>
            <tr><td><input type="text" placeholder="Poste" name="poste" id="poste" class="form-control"><br></td>
            <td><select name="" id="PressingRattacher" class="form-select">
                <option value="">Pressing rattaché</option>
            <?php
                require_once('connect.php');
                // récuperation de l'agence en local

                $ag = "SELECT id_agence,nom FROM agence ";
                if($age = $connec -> query($ag)){
                    while($agen = $age -> fetch()){
                        $agence = $agen['id_agence'];
                        ?>
                        <option value="<?php echo $agen['id_agence']?>"><?php echo $agen['nom']?> </option> 
                        <?php
                    }
                }
            ?>
            </select><br></td>
            </tr>
            <tr><td><input type="number" placeholder="Salaire / mois" name="salaire" id="salaire" class="form-control"></td><td ><button id="btnnewcompt" onclick="newcompte(),btnClick()">Creer le compte</button></td></tr>
            <tr><br><td id="resultnewcompt" colspan="2"></td></tr>
        </table>
    </fieldset>
            </div>
    </div>

        <!--creation du formulaire de modification du mot de passe d'un utilisateur-->
    <div class="card" id="formmodifpassword">
            <div class="card-body">                
    <div id="ferme" onclick="fermeupdatepassword(),btnClick()">X</div>
    <fieldset class="fildsetnewclient">
        <h5 class="card-title">Modifier mon mot de passe</h5>
        <table id="tabnewcomp">
            <tr><td><br><input type="password" placeholder="votre mot de passe" name="AncienPasse" id="AncienPasse" class="form-control"><br></td></tr>
            <tr><td><input type="password" placeholder="Nouveau mot de passe" name="newPass" id="newPass" class="form-control"><br></td></tr>
            <tr><td><input type="password" placeholder="Confirme le mot de passe" name="confirmPass" id="confirmPass" class="form-control"><br></td></tr>
            <tr><td style="text-align:center"><button id="btnupdatepassword" onclick="updatePassword()" class="btn btn-primary">Modifier</button></td></tr>
            <tr><br><td id="resultupdatepassword"></td></tr>
        </table>
    </fieldset>
            </div>
    </div>

                    <!--BLOCK permettant la gestion du personnel-->
    <div class="card" id="blockpersonnel">
            <div class="card-body">                
    <div id="ferme" onclick="document.getElementById('blockpersonnel').style.display='none',btnClick()">X</div>
    <fieldset class="fildsetnewclient">
        <h5 class="card-title">Gestion du personnel</h5>
        <input type="hidden" id="idCompGest" >
        <div id="personnelBody"></div>
    </fieldset>
            </div>
    </div>

    <!--BLOCK permettant la gestion du personnel-->
    <div class="card" id="blockFichAllpersonnel">
            <div class="card-body">                
    <div id="ferme" onclick="document.getElementById('blockFichAllpersonnel').style.display='none',btnClick()">X</div>
    <fieldset class="fildsetnewclient">
        <h5 class="card-title">Fiche de paie de tous le personnel</h5>
        <iframe id="AllpersonnelBody" src="printRapport.php" style="width:100%;height:80vh"></iframe><br>
        
    </fieldset>
            </div>
    </div>

    <!--creation du formulaire de modification du vetement-->
    <div class="card" id="formmodifdepot">
            <div class="card-body">
                        <div id="ferme" onclick="fermeformodifvet(),btnClick()">X</div>
                        <fieldset class="fildsetnewclient">
                        <h5 class="card-title">Modification du dépot d'un vêtement</h5>
                            <table id="tabnewcomp">
                                <div id="contform"></div>
                                <tr><td><button id="btnmodifvet" onclick="insertmodifvet(),btnClick()">Valider la modification</button></td></tr>
                                <tr><td id="modifsucces"></td></tr>
                
                            </table>
                        </fieldset>
</div></div>
    <!--creation du formulaire de modification des informations d'un client--> 
    <div class="card" id="formmodifclient">
            <div class="card-body">                
        <div id="ferme" onclick="fermeformmodifclient()">X</div>
        <fieldset class="fildsetnewclient">
            <h5 class="card-title">modification d'un client</h5>
            <table id="tabnewcomp">
                <div id="contformmodifclient"></div>
                <tr><td><button id="btnmodifclient" onclick="insertmodifclient()">Valider la modification</button></td></tr>
                <tr><td id="modifclientsucces"></td></tr>

            </table>
        </fieldset>
            </div>
    </div>

            <!--creation du formulaire de modification des types de vetements-->                 
  
    <div class="card" id="formmodiftypvet">
            <div class="card-body">
        <div id="ferme" onclick="fermeformmodiftypeet()">X</div>
        <fieldset class="fildsetnewclient">
            <legend id="legendnewcomp"></legend>
            <h5 class="card-title">Modification d'un type de vêtement</h5>
            <table id="tabnewcomp">
                <div id="contformmodiftypvet"></div>
                <tr><td><button id="btnmodifclient" onclick="insertmodiftypvet()">Valider la modification</button></td></tr>
                <tr><td id="modiftypvetsucces"></td></tr>

            </table>
        </fieldset>
</div> 
    </div>
                    <!--creation du formulaire de modification des types de depenses-->                 
    <div class="card" id="formmodiftypdep">
            <div class="card-body">
        <div id="ferme" onclick="fermeformmodiftypdep()">X</div>
        <fieldset class="fildsetnewclient">
            <h5 class="card-title">Modification d'un type de dépense</h5>
            <table id="tabnewcomp">
                <div id="contformmodiftypdep"></div>
                <tr><td><button id="btnmodifclient" onclick="insertmodiftypdep()">Valider la modification</button></td></tr>
                <tr><td id="modiftypdep"></td></tr>

            </table>
        </fieldset>
</div>
    </div>    
                        <!--creation du formulaire de modification des depenses-->                 
    <div class="card" id="formmodifdep">
            <div class="card-body">
        <div id="ferme" onclick="fermeformmodifdep()">X</div>
        <fieldset class="fildsetnewclient">
            <h5 class="card-title">Modification d'une dépense</h5>
            <table id="tabnewcomp">
                <div id="contformmodifdep"></div>
                <tr><td><button id="btnmodifclient" onclick="insertmodifdep()">Valider la modification</button></td></tr>
                <tr><td id="modifdep"></td></tr>

            </table>
        </fieldset>
</div>
    </div>    
    
                        <!--creation du formulaire de modification des type de versement-->                 
    <div class="card" id="formmodiftypversem">
            <div class="card-body">
        <div id="ferme" onclick="fermeformmodiftypversa()">X</div>
        <fieldset class="fildsetnewclient">
            <h5 class="card-title">Modification d'un type de versement</h5>
            <table id="tabnewcomp">
                <div id="contformmodiftypversem"></div>
                <tr><td><button id="btnmodifclient" onclick="inserttypversem()">Valider la modification</button></td></tr>
                <tr><td id="modiftypversem"></td></tr>

            </table>
        </fieldset>
</div>    
    </div>

                        <!--creation du formulaire de modification des versements-->                 
    <div class="card" id="formmodifversem">
            <div class="card-body">
        <div id="ferme" onclick="fermeformmodifversa()">X</div>
        <fieldset class="fildsetnewclient">
            <h5 class="card-title">Modification d'un versement</h5>
            <table id="tabnewcomp">
                <div id="contformmodifversem"></div>
                <tr><td><button id="btnmodifclient" onclick="insertmodifversem()">Valider la modification</button></td></tr>
                <tr><td id="modifversem"></td></tr>

            </table>
        </fieldset>
</div>  </div>

<!--creation du formulaire de creation des client-->
<div class="card" id="formnewclient">
 <div class="card-body">
    <div id="ferme" onclick="fermenewcl(),btnClick()">X</div>
    <fieldset class="fildsetnewclient">
        <h5 class="card-title">Enregistrement d'un client</h5>
        <table id="tabnewcomp">
            <tr><td><input type="text" placeholder="Nom complet" name="nomcl" id="nomcl" class="form-control"><br></td></tr>
            <tr><td><input type="number" placeholder="numéro de téléphone" name="telephonecl" id="telephonecl" class="form-control"><br></td></tr>
            <tr><td><button id="btnnewclient" onclick="newclient(),btnClick()">Enregistrer le client</button><br></td></tr>
            <tr><td id="resultnewclient"></td></tr>
        </table>
    </fieldset>
 </div>
</div>
<!--creation du formulaire d'envoi des message aux client qui recupere leur vetement aujourd'hui-->
<div class="card" id="smsvetsortnow">
 <div class="card-body">
    <div id="ferme" onclick="document.getElementById('smsvetsortnow').style.display='none',btnClick()">X</div>
    <fieldset class="fildsetnewclient">
        <h5 class="card-title">Retrait d'aujourd'hui</h5>
        <table id="tabnewcomp">
            <tr><td><Textarea type="text" placeholder="votre message" name="msgallnow" id="msgallnow" class="form-control" resize="no" row=""></Textarea><br></td></tr>
            
            <tr><td><button id="btnnewclient" onclick="smsvetsortnow(),btnClick()">Envoyer le message</button><br></td></tr>
            <tr><td id="resultnewsmssortnow"></td></tr>
        </table>
    </fieldset>
 </div>
</div>
<!--creation du formulaire d'envoi des message aux client dont la date de retrait est passé-->
<div class="card" id="smsretraitDepasse">
 <div class="card-body">
    <div id="ferme" onclick="document.getElementById('smsretraitDepasse').style.display='none',btnClick()">X</div>
    <fieldset class="fildsetnewclient">
        <h5 class="card-title">Date de retrait dépassé</h5>
        <table id="tabnewcomp">
            <tr><td><Textarea type="text" placeholder="votre message" name="msgretraitdepasse" id="msgretraitdepasse" class="form-control" resize="no" row=""></Textarea><br></td></tr>
            
            <tr><td><button id="btnnewclient" onclick="smsvetretraitdepasse(),btnClick()">Envoyer le message</button><br></td></tr>
            <tr><td id="resultnewsmsretraitdepasse"></td></tr>
        </table>
    </fieldset>
 </div>
</div>

    <!--affichage des factures d'un client apres un click sur son nom -->
    <div class="card" id="facture1cl">
            <div class="card-body">
    <div id="ferme" onclick="fermefact1cl(),btnClick()">X</div>
    <fieldset class="fildsetnewclient" style="text-align: center;">

        <div id="tabfact1cl">  
        </div><br>
        <button type="button" class="btn btn-primary" onclick="javascript:imprime_bloc('Facture de GESTPRESSING','tabfact1cl');"><i class="bi bi-printer text-light"></i> Imprimer</button>
    </fieldset>
            </div></div>
    <!--formulaire de creation des types de vetement-->
    <div class="card" id="formnewtypvet" style="left:30%">
            <div class="card-body">
        <div id="ferme" onclick="fermetypvet(),btnClick()">X</div>
        <fieldset class="fildsetnewclient">
        <h5 class="card-title">Créer un type de vêtement</h5>
            <table id="tabnewcomp">
                <tr><td><input type="text" placeholder="Nom du vetement" name="nomvet" id="nomvet" class="form-control"><br></td></tr>
                <tr><td><input type="number" placeholder="prix de lavage" name="prixvet" id="prixvet" class="form-control"><br></td></tr>
                <tr><td><button id="btntypvet" onclick="newtypvet(),btnClick()">Creer le vêtement</button></td></tr>
                <tr><td id="resulttypvet"></td></tr>
            </table>
        </fieldset>
</div></div>
        <!--generation de la facture d'un client-->

        <div class="card" id="blockfacture" style="font-size:12px">
            <div class="card-body">
                <div id="fermer" onclick="fermefact(),btnClick()">X</div>
                <iframe id="blockimprim" src="printRecu.php" style="height:70vh;width:100%">           

                </iframe>
               
            </div>
        </div>                                      <!--gestion des sortie de vetement-->
                                                <div class="card" id="sortievet">
                                                    <div class="card-body">
                                                    
                                                        <div id="fermer" onclick="fermesortvet(),btnClick()" style="width:10%;margin-left:90%">X</div>
              <h5 class="card-title">Rechercher les vêtements rattachés à une facture</h5>

                                                        <table id="tabnewsortie" style="border:0px">
                                                            
                                                              <tr><td id="tdcodefactsort"><input type="number" placeholder="Numéro de la facture" class="form-control" id="codefactsort" ></td><td style="text-align:right"><button class="btn btn-primary" onclick="listehabfact(),btnClick()"><i class="bi bi-search text-light"></i> Recherche</button></td></tr>
                                                           </div> </form><tr><td colspan="3" id="smsFormsort"></td></tr>
                                                            <tr><td colspan="2"><div id="affichvetsort">Liste des vetements de la facture</div></td></tr>
                                                            <tr><td id="etatFctDR"></td></tr>
                                                            <tr><td colspan="2" style='font-weight:bold'>Reste a payer:<span id="restesort">0</span>Fcfa&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="regleDette('regle')"><i class="bi bi-check-circle text-light"></i> Réglé</button>&nbsp;&nbsp;&nbsp;&nbsp;<button class="btn btn-danger" onclick="regleDette('dette')"><i class="bi bi-x-square text-light"></i> Dette</button></td></tr>
                                                        </table>
                                                    </div>
                                                </div>

        </div>                                      <!--gestion de la disponibilitée des vetements -->
                                                <div class="card" id="dispovet">
                                                    <div class="card-body">
                                                    
                                                        <div id="fermer" onclick="fermedispovet(),btnClick()" style="width:10%;margin-left:90%">X</div>
                                                        <h5 class="card-title">Enregistrer la disponibilitée des vetements d'une facture </h5>

                                                        <table id="tabnewsortie" style="border:0px">
                                                            
                                                              <tr><td id="tdcodefactsort"><input type="number" placeholder="Numéro de la facture" class="form-control" id="codefactdispo" ></td><td style="text-align:right"><button class="btn btn-primary" onclick=" listehabfactDisponibilite(),btnClick()"><i class="bi bi-search text-light"></i> Recherche</button></td></tr>
                                                           </div> </form><tr><td colspan="3" id="smsFormsort"></td></tr>
                                                            <tr><td colspan="2"><div id="affichvetdispo">Liste des vetements de la facture</div></td></tr>
                                                            <tr><td id="etatFctDRDispo"></td></tr>
                                                            <tr><td colspan="2" style='font-weight:bold'>Reste a payer:<span id="restedispo">0</span>Fcfa&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="valideDispoVet()" id="btnvalidDispo"><i class="bi bi-check-circle text-light"></i> Valider la disponibilité</button> un SMS est envoyé au client concerné</td></tr>
                                                        </table>
                                                    </div>
                                                </div>
                 <!--Affichage des type de vetement-->
                 <div class="card" id="affichtypevet">
                       <div class="card-body">
                    <div id="fermer" onclick="fermeaffictypvet(),btnClick()" style="width: 10%;margin-left:90%">X</div>
              <h5 class="card-title">Liste des types de vêtement</h5>

                    <table id="tabnewsortie" style="text-align: center;border:0px;">
                        <tr><td colspan="2"><div id="listetypevet" style="border:0px"></div></td></tr>
                        <tr><td colspan="2"><button type="button" class="btn btn-primary" onclick="actualisetypv(),btnClick()"><i class="bi bi-repeat text-light"></i> Actualiser</button></td></tr>

             </table>
                </div>
            </div>
     <!--gestion des reglement des dettes-->
     <div class="card" id="regledett" style="top:2%">
            <div class="card-body">
         <div id="fermer" onclick="ferregdett(),btnClick()" style="width: 10%;margin-left:90%">X</div>
         <h5 class="card-title">Réglé une dette enregistrer</h5>
         <table id="tabnewsortie" style="border:0px">
               <tr><td id="tdcodefactsort"><input type="number" placeholder="Numéro de la facture" class="form-control" id="codefactregdet" ></td><td style="text-align: center;"><button class="btn btn-primary" onclick="regledette(),btnClick()"><i class="bi bi-search text-light"></i> Recherche</button></td></tr>
             <tr><td colspan="2"><br><div id="affichfactdet"></div></td></tr>
        
             <tr style="background: blue;color: white;"><td colspan="2">Montant de la dette:<span id="montdet">0</span>Fcfa&nbsp;&nbsp;&nbsp;<input type="text" placeholder="Montant verse" class="inputcomande" id="avancedette">&nbsp;&nbsp;&nbsp;<button class="deteRegle" onclick="remdette()">Réglé la dette</button></td></tr>
         </table>
     </div>
 </div>
 <!--cloture de caisse-->
 <div class="card" id="blockclokcaisse">
            <div class="card-body">
    <div id="fermer" onclick="fermeclotcaiss(),btnClick()" style="width:10%;margin-left:90%">X</div>
    <h5 class="card-title">Cloture de caisse</h5>
    <table style="width: 100%;">
          <tr style="color:blue;font-weight:bold"><td style="width:20%">Date de cloture:</td><td><input type="date" class="form-control" id="dateclo" onchange="affichetatj()"></td></tr></table>
        <table style="width: 100%;"><tr><td id="afficeta" style="text-align: left;"><br><div class="alert alert-danger" role="alert" style="font-size:12px">Veuillez enregistrer toute les dépenses, versement et les vêtements déposés avant d’effectuer la clôture de caisse</div></td></tr>
        <tr><td><input type="number" placeholder="Montant réel en caisse" class="form-control" id="montreel"><br></td></tr>
        <tr><td><button class="btn btn-success" onclick="clotcaisse()"><i class="bi bi-check2-circle text-light"></i> Enregistrer</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-primary" onclick="affichetatj(),btnClick()"><i class="bi bi-repeat text-light"></i> Actualiser</button>&nbsp;&nbsp;&nbsp;<button class="btn btn-dark" onclick="reportcaisse()"><i class="bi bi-chevron-double-right text-light"></i> Report</button></td></tr>
        <tr><td id="smsclot"></td></tr>
            </table>
</div>
</div>
        <!--formulaire de creation des types de depenses-->
    <div class="card" id="formnewtypdep">
            <div class="card-body">
        <div id="ferme" onclick="fermetypdep(),btnClick()">X</div>
        <fieldset class="fildsetnewclient">
            <h5 class="card-title">Créer un type de dépense</h5>
            <table id="tabnewcomp">
                <tr><td><input type="text" placeholder="Nom de la depense" name="nomdep" id="nomdep" class="form-control"><br></td></tr>
                <tr><td><button id="btntypdep" onclick="inserttypdep(),btnClick()">Créer le type de dépense</button></td></tr>
                <tr><td id="resulttypdep"></td></tr>
            </table>
        </fieldset>
</div>
    </div>
  <!--formulaire de creation des types de versement-->
  <div class="card" id="formnewtypver">
            <div class="card-body">
    <div id="ferme" onclick="fermetypeversea(),btnClick()">X</div>
    <fieldset class="fildsetnewclient">
        <h5 class="card-title">Créer un type de versement</h5>
        <table id="tabnewcomp">
            <tr><td><input type="text" placeholder="Nom du versement" name="nomdep" id="nomvera" class="form-control"><br></td></tr>
            <tr><td><button id="btnverse" onclick="insertversargent(),btnClick()">Créer le type de versement</button></td></tr>
            <tr><td id="resulttypverse"></td></tr>
        </table>
    </fieldset>
</div></div>

        <!--formulaire d'insertion des nouveaux versement-->
        <div class="card" id="formnewverse">
            <div class="card-body">
            <div id="ferme" onclick="fermenewverse(),btnClick()">X</div>
            <fieldset class="fildsetnewclient">
                <h5 class="card-title">Enregistrer un nouveau versement</h5>
                <table id="tabnewcomp">
                    <tr><td id="choixdep"></td></tr>
                    <tr><td><select id="listeinservers" class="form-select">liste type versement</select><br></td></tr>
                    <tr><td><input type="number" placeholder="Montant versé" name="motantdep" id="montversea" class="form-control"><br></td></tr>
                    <tr><td><input type="text" placeholder="Numéro du reçu (pour les versements banquaire)" name="motant" id="numrecu" class="form-control"><br></td></tr>
                    <tr><td><div id="da">Date de versement</div><input type="date" name="DATEDEP" id="datedepota" class="form-control"><br></td></tr>
                    <tr><td><button id="btnnewverA" onclick="insertvesement(),btnClick()">Enregistrer le versement</button></td></tr>
                    <tr><td id="resultverse"></td></tr>
                </table>
            </fieldset>
</div></div>
          <!--formulaire d'insertion des nouveaux depense-->
    <div class="card" id="formnewdep">
            <div class="card-body">
        <div id="ferme" onclick="fermedep()">X</div>
        <fieldset class="fildsetnewclient">
             <h5 class="card-title">Enregistrer une nouvelle dépense</h5>
            <table id="tabnewcomp">
                <tr><td id="choixtypdep"></td></tr>
                <tr><td><input type="text" placeholder="Motif de la dépense" name="motifdep" id="motifdep" class="form-control"><br></td></tr>
                <tr><td><input type="number" placeholder="Montant de la dépense" name="motantdep" id="montantdep" class="form-control"><br></td></tr>
                <tr><td><div id="da">Date de la dépense</div><input type="date" name="DATEDEP" id="DATEDEP" class="form-control"><br></td></tr>
                <tr><td><button id="btnenregdep" onclick="insertdepense(),btnClick()">Enregistrer la dépense</button></td></tr>
                <tr><td id="resultdep"></td></tr>
            </table>
        </fieldset>
</div>
    </div>
          <!--formulaire de generation de carte de fidelite-->
    <div class="card" id="formnewcarte">
            <div class="card-body">
        <div id="ferme" onclick="fermenewcart()">X</div>
        <fieldset class="fildsetnewclient">
            <h5 class="card-title">Généré une nouvelle carte de fidélité</h5>
            <table id="tabnewcomp">
                <tr><td id="choixdep"></td></tr>
                <tr><td><input type="text" placeholder="code du client" name="motifdep" id="codeclcarte" readonly class="form-control"><br></td></tr><tr><td><input type="number" placeholder="Reduction(en pourcentage)" name="reductcarte" class="form-control" id="montreduct"><br></td></tr>
                <tr><td colspan="2"><button id="btnnewcarte" onclick="insertcarte(),btnClick()">Généré la carte</button><br></td></tr>
                <tr><td colspan="2" id="smsnewcart"></td></tr>
                <tr><td colspan="2"><div id="choixclcart">liste des clients</div></td></tr>
                <tr><td colspan="2"><input type="text" placeholder="rechercher un client" id="searchclcarte" class="form-control" onkeyup="clientnewcarte()" style="border:0.5px solid gray"></td></tr>
            </table>
        </fieldset>
</div></div>
          <!--formulaire d'enregistrement des retours de vetement-->
    <div class="card" id="formnewretourvet">
            <div class="card-body">
        <div id="ferme" onclick="document.getElementById('formnewretourvet').style.display='none'">X</div>
        <fieldset class="fildsetnewclient">
            <h5 class="card-title">Enregistrer le retour d'un vetement</h5>
            <table id="tabnewcomp">
                <tr><td id="choixdep"></td></tr>
                <tr><td><input type="text" placeholder="code du vetement" name="motifdep" id="codevetback" readonly class="form-control"><br></td></tr><tr><td><input type="number" placeholder="Quantité retournée" name="reductcarte" class="form-control" id="qteBack"><br></td></tr>
                <tr><td><textarea name="" id="motifBack" class="form-control" resize="no" placeholder="Motif du retour"></textarea><br></td></tr>
                <tr><td colspan="2"><button id="btnnewcarte" onclick="insertRetourVet(),btnClick()">Valider le retour</button><br></td></tr>
                <tr><td colspan="2" id="smsbackvet"></td></tr>
                <tr><td colspan="2"><div id="choixvetFactRetour">liste des clients</div></td></tr>
                <tr><td colspan="2"><input type="text" placeholder="code de la facture" id="searchvetFactRetour" class="form-control" onkeyup="vetFactPrRetour()" style="border:0.5px solid gray"></td></tr>
            </table>
        </fieldset>
</div></div>
       <!-- formulaire d'envoi de message a un client-->
    <div class="card" id="formnsendsmsCl">
            <div class="card-body">
        <div id="ferme" onclick="document.getElementById('formnsendsmsCl').style.display='none'">X</div>
        <fieldset class="fildsetnewclient">
            <h5 class="card-title">Envoyer un message</h5>
            <table id="tabnewcomp">
                <tr><td id="choixdep"></td></tr>
                <tr><td><input type="text" placeholder="code du client" name="codeclsms" id="codeclsms" readonly class="form-control"><br></td></tr><tr><td><textarea  placeholder="votre message" name="smsCl" class="form-control" id="smsCl"></textarea>  <br></td></tr>
                <tr><td colspan="2"><button id="btnnewcarte" onclick="sendSMSOneClient(),btnClick()">Envoyer le message</button><br></td></tr>
                <tr><td colspan="2" id="smsnewsmscl"></td></tr>
                <tr><td colspan="2"><div id="choixclsms">liste des clients</div></td></tr>
                <tr><td colspan="2"><input type="text" placeholder="rechercher un client" id="searchclsms" class="form-control" onkeyup="clientnewsms()" style="border:0.5px solid gray"></td></tr>
            </table>
        </fieldset>
</div></div>
         <!--formulaire de recharge d'une carte de fidelite-->
    <div class="card" id="formrecharcarte">
            <div class="card-body">
        <div id="ferme" onclick="fermemodic()">X</div>
        <fieldset class="fildsetnewclient">
            <h5 class="card-title">Recharger la carte de <i class="bi bi-arrow-down text-dark"></i></h5>
            <table id="tabnewcomp">
                <tr><td id="nomclrechar"></td></tr>
                <tr><td><input type="text"  name="motifdep" placeholder="valeur de recharge(en pourcentage)" id="recharcarte" class="form-control"><br></td></tr>
                <tr><td colspan="2"><button id="btnrecharcarte" onclick="insertmodifcart(),btnClick()">Recharger la carte</button></td></tr>
                <tr><td colspan="2" id="smsmodifcart"></td></tr>
                </table>
        </fieldset>
</div></div>
                 <!--formulaire d'affichage des meilleur client classe par ordre decroissant-->
    <form method="POST" id="formmeilleurcl" style="display: none;">
        <div id="ferme" onclick="fermemodic()">X</div>
        <fieldset class="fildsetnewclient">
            <table id="tabnewcomp">
                <tr><td id="nomclrechar" colspan="2"><div id="blockaffichMcl"></div></td></tr>
                <tr><td id="" colspan="2"></td></tr>
                <tr id="trdepdate"><td >Les meilleur clients du:<input type="date" id="debutMcl" class="depdate" onchange="affcartefidel()"> au: <input type="date" id="finMcl" class="depdate" onchange="affcartefidel()"></td></tr>
                </table>
        </fieldset>
        </form>
       
</td></tr></table>
<!--interface de manipulation des rapports-->
<table id="menurapport">
    <tr>
        <td rowspan="2" id="menugauche">

                <table id="tabimbriquer">
                    <tr><td  id="gestrapport">Groupe Star RAPPORTS</td><td><div id="fermerapport" onclick="closerappo()">X</div></td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="typepressingrapport('keppressingRapportvetdepot'),afficheblock(rapportlistvetdepot)"><img src="./img/Paste_50px.png" class="menuicon">Journal des dépots</td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="typepressingrapport('keppressingRapportvetsort'),afficheblock(rapportlistvetsort)"><img src="./img/Paste_50px.png" class="menuicon">Journal des sorties</td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="typepressingrapport('keppressingRapportvetback'),afficheblock(rapportlistvetback)"><img src="./img/Paste_50px.png" class="menuicon">Journal des retours</td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="typepressingrapport('keppressingRapportdepense'),afficheblock(rapportlistdepense)"><img src="./img/Paste_50px.png" class="menuicon">Journal des depenses</td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="typepressingrapport('keppressingRapportregle'),afficheblock(rapportlistdett)"><img src="./img/Paste_50px.png" class="menuicon">Journal des dettes</td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="typepressingrapport('keppressingRapportfacture'),afficheblock(rapportlistfacture)"><img src="./img/Paste_50px.png" class="menuicon">Journal des factures</td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="typepressingrapport('keppressingRapportversement'),afficheblock(rapportlistverse)" onmousemove="typeversrapport()"><img src="./img/Paste_50px.png" class="menuicon">Journal des versements</td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="rapportlistecarteF()"><img src="./img/Paste_50px.png" class="menuicon">Journal des carte de fidélité</td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="typepressingrapport('keppressingRapportCAclient'),afficheblock(rapportlistargantcli)"><img src="./img/Paste_50px.png" class="menuicon">Chiffre d'affaire par client</td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="typepressingrapport('keppressingRapportCAvet'),afficheblock(rapportlistargantvet)"><img src="./img/Paste_50px.png" class="menuicon">Chiffre d'affaire par vetement</td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="typepressingrapport('keppressingRapportclotcaisse'),afficheblock(rapportlistcloturcaus)"><img src="./img/Paste_50px.png" class="menuicon">Journal des clotures de caisse</td></tr>
                    <tr><td colspan="2" class="tdmenu" onclick="rapportlisteclotcais(),afficheblock(rapportlistcloturcaus)"><img src="./img/Paste_50px.png" class="menuicon">Etats de caisse</td></tr>
                    <tr><td colspan="2" class="tdmenunom"><strong id="nomlogic">Technosoft</strong><br>copyright 2024. version 1.0</td></tr>
                    
                </table>
</td></tr></table>
<div style="width:450px;background:red;z-index:300;position:absolute;top:0px;display:none"><iframe src="printRapport.php" frameborder="0" width="450px" height="600px" style="border:none;"></iframe>
</div>

 <!-- Vendor JS Files -->
 <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="script.js" async></script>
  <script type="text/javascript">                                                       
    // verifi si la machine est connecté
    setInterval(() => {
        if (navigator.onLine) {   
        
            // synchronisation
            synchronisation();
        } else {
            // pas de connexion internet
            synchronisation(); // pour les test
        }
    }, 5000);//300000
    infoUserConnect();      
     
    
    </script>
    </body>
</html>