//fonction d'enregistrement des depot d'habit
function temprest(){
    let jourrste = document.getElementById('jourrste');
    
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
       
        if(xhr.readyState == 4 && xhr.status == 200){
             jourrste.innerHTML = xhr.responseText+' jour(s) / 30';

        
    }}
    xhr.open('GET','temrest.php');
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}
//fonction de modification de sa photo de profil
function UpdateProfilImg(){
    let cookie = localStorage.getItem('login');
    var fileimage = document.getElementById('fileimage').files[0];
    
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
       
        if(xhr.readyState == 4 && xhr.status == 200){
             console.log('Update profil image :  '+xhr.responseText);
             document.location.href = 'index.php';
        
    }}
    var form = new FormData();
    form.append('cookie', cookie);
    form.append('file', fileimage);
    xhr.open('POST','UpdateProfilImg.php');
    //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(form);

}
//fonction d'enregistrement des depot d'habit
function depovetcmd(){
    let codeclient = document.getElementById('codeclient').value;
    let qte = document.getElementById('qte').value;
    let choixtypv = document.getElementById('choixtypv').value;
    let descript = document.getElementById('descript').value;
    let prixvetement = document.getElementById('prixvetement').value;
    let datedepot = document.getElementById('datedepot').value;
    let dateretrait = document.getElementById('dateretrait').value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
       
        if(xhr.readyState == 4 && xhr.status == 200){
         let smsFormCmd = document.getElementById('smsFormCmd');
         let btnfinsaissi = document.getElementById('btnfinsaissi');
         btnfinsaissi.style.display="block";
         smsFormCmd.innerHTML=xhr.responseText;
         affichehabitdepose('debu');
         let repond = xhr.responseText;
         if(repond == '<div class="alert alert-success" role="alert" style="font-size:12px">vêtement enregistrer</div>'){
         let qte = document.getElementById('qte');
         let descript = document.getElementById('descript');
         qte.value='';
         descript.value='';
         }
  
    }}
    xhr.open('POST','depotvet.php');
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send('codeclient='+encodeURI(codeclient)+'&qte='+encodeURI(qte)+'&choixtypv='+encodeURI(choixtypv)+'&descript='+encodeURI(descript)+'&prixvet='+encodeURI(prixvetement)+'&datedepot='+encodeURI(datedepot)+'&dateretrait='+encodeURI(dateretrait)+'&cookie='+encodeURI(cookie));

}
function affichehabitdepose(para){
    let typelavage = document.getElementById('typelavage').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
         let affichvet = document.getElementById('affichvet');
         affichvet.innerHTML=xhr.responseText;
         if(para=='fin'){  
         let btnfinsaissi = document.getElementById('btnfinsaissi');
         btnfinsaissi.style.display="none";
         montfact();
        }
    }}
    xhr.open('GET','newfatcuredepose.php?btn='+para+'&typelavage='+typelavage);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}

//fonction de deconnexion au logiciel gestpressing
function deconnexions(){
    localStorage.removeItem('login');

    // drop cookie
    // Définir la date d'expiration à une date passée pour supprimer le cookie
    document.cookie = "typecompte=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "adminLocal=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";

    window.location.href = 'index.php';
    //window.close();
}
//fonction permettant de supprimer un depot 
function supdepot(para,para2){
    let cookie = localStorage.getItem('login'); 
   if(window.XMLHttpRequest){
    //Mozilla, safari, IE7+...
    xhr = new XMLHttpRequest();
}else if(window.ActiveXObject){
    //IE 6 et anterieur
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
}
xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        if(para2=='debu'){
        affichehabitdepose('debu');
        }
}}
xhr.open('GET','supprimedepot.php?ident='+para+'&cookie='+cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction de stockage de la facture 
function stockFactur(){
    let totalfact = document.getElementById('totalfact').innerHTML;
    let avancefact = document.getElementById('avancefact').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
            ouvrefact();
            let avancefact = document.getElementById('avancefact');
            avancefact.value=0;
            let totalfact = document.getElementById('totalfact');
            totalfact.innerHTML=0;
    }}
    xhr.open('POST','insertfacture.php');
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send('totalfact='+encodeURI(totalfact) + '&avancefact='+encodeURI(avancefact));
}
// affiche facture
function ouvrefact(){
    let blockfacture = document.getElementById('blockfacture');
    blockfacture.style.display="block";
    affichfact();
}
//fonction affiche le montant facture
function montfact(){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
         let totalfact = document.getElementById('totalfact');
         totalfact.innerHTML=xhr.responseText;
    }}
    xhr.open('GET','affichetotalfact.php');
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}
//block de code permettant l'impression
function imprime_bloc(titre,objet){
    //definition de la zone a imprimer
    var zone=document.getElementById(objet).innerHTML;
    //overture du popup
    var fen=window.open("","","height=500,width=600,toolbar=0,menubar=0,scrollbars=1,resizable=1,status=0,location=0,left=30,top=10");
    //style du popup
    fen.document.body.style.color='#000000';
    fen.document.body.style.backgroundColor='#FFFFFF';
    fen.document.body.style.padding="20px";
    fen.document.body.style.textAlign="center";
    fen.document.body.style.width="95%";
    fen.document.body.style.backgroundImage="url('img/bg.jpg')";
    //ajout des donnees a imprimer
    fen.document.title=titre;
    fen.document.body.innerHTML+=""+zone+"";
    //impression du popup
    fen.window.print();
    //fermeture du popup
    fen.window.close();
    return true;
 }

//ferme facture
function fermefact(){
    let blockfacture = document.getElementById('blockfacture');
    blockfacture.style.display="none";
}
//fonction d'affichage de la facture d'un depot
function affichfact(){
    let totalfact = document.getElementById('totalfact').innerHTML;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){

         let iframe = document.getElementById('blockimprim'); 
         iframe.onload = function () { 
              let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
              let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
              listevetentre.innerHTML = xhr.responseText;
          }; 
          iframe.src = 'printRecu.php'; // Actualise l'iframe en réassignant sa source
    }}
    xhr.open('GET','affichefact.php?mtota='+totalfact);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}

//affichage d'une facture deja enregistrer dans le logiciel(vieille facture)
function affichfactenreg(codefact,idclient){
    let blockfacture = document.getElementById('blockfacture');
    blockfacture.style.display='block';
        if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){

         let iframe = document.getElementById('blockimprim'); 
         iframe.onload = function () { 
              let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
              let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
              listevetentre.innerHTML = xhr.responseText;
          }; 
          iframe.src = 'printRecu.php'; // Actualise l'iframe en réassignant sa source
    }}
    xhr.open('GET','affichefactenreg.php?codefact='+codefact+'&idcl='+idclient);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}
//fonction de creation des compte utilisateur
function statutcompt(identifiant){
    btnClick();
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    let cookie = localStorage.getItem('login');
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
     let resulta =  xhr.responseText;
        if(resulta=='non'){
            annonce('Seul l\'administrateur peut Activer ou Désactiver un compte');
        }else if(resulta=='oui'){
            afficheuser('all');
        }
    }}
    xhr.open('GET','statutcompte.php?statut='+identifiant+'&cookie='+cookie);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();
}
    //fonction javascript permettant de lancer un son audio apres un click sur un objet determiner
    function btnClick(){
        var audio = new Audio ("./img/son_click.wav");
        audio.play();
    }

    let telephoneconnect = document.getElementById('telephoneconnect');
    telephoneconnect.addEventListener('click',(e)=>{
        e.preventDefault();
    })
    let btnvalidcmd = document.getElementById('btnvalidcmd');
    btnvalidcmd.addEventListener('click',(e)=>{
        e.preventDefault();
    })
    let btnfinsaissi = document.getElementById('btnfinsaissi');
    btnfinsaissi.addEventListener('click',(e)=>{
        e.preventDefault();
    })
    
/*--------------------------*/
// masque ou voir le mot de passe
e=true;
function imgmdps(){
    let imgmdp = document.querySelector('#imgmdp');
   
    if(e){
       document.querySelector('#mdpconnect').setAttribute("type","text");
       imgmdp.src="./img/oeil.png";
       e=false;
    }else{
        document.querySelector('#mdpconnect').setAttribute("type","password");
        imgmdp.src="./img/oeil (1).png";
        e=true;
    }
}

//function de connexion au logiciel
async function connecter(){
    let telephoneconnect = document.querySelector('#telephoneconnect').value;
    let mdpconnect       = document.querySelector('#mdpconnect').value;
    let pressing         = document.querySelector('#pressingConnect').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function ()
    {
        if(xhr.readyState == 4 && xhr.status == 200)
        {
                let sms       = document.querySelector('#sms');
                sms.innerHTML = xhr.responseText;
                let re        = xhr.responseText;

                //verification si les information reseigne existe dans la base de données
                if(re == '<div class="alert alert-success" role="alert" style="font-size:12px">Ouverture du logiciel dans quelque seconde</div>')
                {
                        localStorage.setItem("login",telephoneconnect);
                        window.location.reload();
                }

        }
    }
    xhr.open('POST','pageconnexion.php');
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send('telephoneconnect=' + encodeURI(telephoneconnect) + '&mdpconnect=' + encodeURI(mdpconnect) + '&pressing=' + encodeURI(pressing));

}

let connexion = document.getElementById('connexion');
connexion.addEventListener('click',(e)=>{
    e.preventDefault();
})

//si vous etez connecter ne plus afficher la boite de connection
function acces (){
    let blockconnexion = document.querySelector('#blockconnexion');
    let tex = localStorage.getItem('login');
    if(tex !== null){
        blockconnexion.setAttribute("style","display:none");
    }else if(tex === null){
        blockconnexion.setAttribute("style","display:block"); 
/*         PressingPrConnexion();   */
    }
}


//fonction d'affichage de tout les comptes utilisateur
function afficheuser(agence){
    
    let affichecompt = document.getElementById('affichecompt');
    affichecompt.style.display='block'; 
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }

xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
       let toutuser = document.querySelector('#toutuser');
       toutuser.innerHTML = xhr.responseText;
       //listAgence('listAgenceCompt');

   }
}
xhr.open('GET','afficheuser.php?agence='+encodeURI(agence));
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();

}

//activation ou desactivation d'un compte par un administrateur
//fonction d'affichage de tout les comptes utilisateur
function statutcompte(para1){
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        afficheuser('all');
        let rep = xhr.responseText;
        alert(rep);
        if(rep=='non'){
        annonce('Seul l\'administrateur peut désactiver un compte');
    }
   }
}
xhr.open('GET','statutcompte.php?id=' +para1+ '&cookie=' +cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();

}
//appele de la boite d'alerte pour informé l'utilisateur
function annonce(para1){
    let blockalert = document.getElementById('blockalert');
    blockalert.style.display="block";
    let messagealert = document.getElementById('messagealert');
    messagealert.innerHTML=para1;
  }
  //fermeture de ma boite d'alert
  //fonction defectuer a reprogramme
  function fermeannonce(){    
      let blockalert = document.getElementById('blockalert');
      blockalert.style.display="none";
      btnClick();
  }
  //fonction d'affichage du formulaire de creation des comptes
  function creercompte(){
      let formnewcompt =document.getElementById('formnewcompt');
      formnewcompt.style.display="block";
  }
  function fermecompte(){
    let formnewcompt =document.getElementById('formnewcompt');
    formnewcompt.style.display="none";
}
  function fermeupdatepassword(){
    let formnewcompt =document.getElementById('formmodifpassword');
    formnewcompt.style.display="none";
}
//fermer le formulaire d'enregistrement d'un client
function fermenewcl(){
    let formnewclient =document.getElementById('formnewclient');
    formnewclient.style.display="none";
}
function fermetypvet(){
    let formnewtypvet =document.getElementById('formnewtypvet');
    formnewtypvet.style.display="none";
}

let btnnewcompt = document.getElementById('btnnewcompt');
btnnewcompt.addEventListener('click',(e)=>{
    e.preventDefault();
})
let btntypvet = document.getElementById('btntypvet');
btntypvet.addEventListener('click',(e)=>{
    e.preventDefault();
})
let btnnewclient = document.getElementById('btnnewclient');
btnnewclient.addEventListener('click',(e)=>{
    e.preventDefault();
})

//fonction de creation des comptes utilisateur
function newcompte(){
    let selectnomuser = document.getElementById('nomuser');
    let nomuser = selectnomuser.value;
    let selecttelephoneuser = document.getElementById('telephoneuser');
    let telephoneuser = selecttelephoneuser.value;
    let selectlogin = document.getElementById('login');
    let login = selectlogin.value;
    let selectmdpuser = document.getElementById('mdpuser');
    let mdpuser = selectmdpuser.value;
    let cookie = localStorage.getItem('login');
    let selecttypenewuser = document.getElementById('typenewuser');
    let typenewuser = selecttypenewuser.value;
    let selectdatenaissuser = document.getElementById('datenaissuser');
    let datenaissuser = selectdatenaissuser.value;
    let selectCNIuser = document.getElementById('CNIuser');
    let CNIuser = selectCNIuser.value;
    let selectpereuser = document.getElementById('pereuser');
    let pereuser = selectpereuser.value;
    let selectmereuser = document.getElementById('mereuser');
    let mereuser = selectmereuser.value;
    let selectdiplomeuser = document.getElementById('diplomeuser');
    let diplomeuser = selectdiplomeuser.value;
    let selectnationaliteuser = document.getElementById('nationaliteuser');
    let nationaliteuser = selectnationaliteuser.value;
    let selecttypeContrat = document.getElementById('typeContrat');
    let typeContrat = selecttypeContrat.value;
    let selectdaterecrute = document.getElementById('daterecrute');
    let daterecrute = selectdaterecrute.value;
    let selectobligation = document.getElementById('obligation');
    let obligation = selectobligation.value;
    let selectposte = document.getElementById('poste');
    let poste = selectposte.value;
    let selectPressingRattacher = document.getElementById('PressingRattacher');
    let PressingRattacher = selectPressingRattacher.value;

    let selectsalaire = document.getElementById('salaire');
    let salaire = selectsalaire.value;

    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let resultnewcompt = document.getElementById('resultnewcompt');
         resultnewcompt.innerHTML=xhr.responseText;
         afficheuser('all');
         let mes =resultnewcompt.innerHTML;
         setTimeout(function(){
            resultnewcompt.innerHTML='';
         },3000);
         if(mes == '<div class="alert alert-success" role="alert" style="font-size:12px">Nouveau compte enregistré</div>'){
         selectnomuser.value=''; selectCNIuser.value;
         selecttelephoneuser.value=''; selectpereuser.value;
         selectlogin.value='';  selectmereuser.value;
         selectmdpuser.value=''; selectdiplomeuser.value;
         selecttypenewuser.value=''; selectnationaliteuser.value;
         selectobligation.value = '';selectsalaire.value = '';
         
         }
         if(mes==''){
             annonce('Seul l\'administrateur peut créer un compte');
         }
    }
   }

    const form = new FormData();
   form.append('nomuser', encodeURI(nomuser));
   form.append('telephoneuser', encodeURI(telephoneuser));
   form.append('login', encodeURI(login));
   form.append('mdpuser', encodeURI(mdpuser));
   form.append('cookie', encodeURI(cookie));
   form.append('typenewuser', encodeURI(typenewuser));
   form.append('datenaissuser', encodeURI(datenaissuser));
   form.append('CNIuser', encodeURI(CNIuser));
   form.append('pereuser', encodeURI(pereuser));
   form.append('mereuser', encodeURI(mereuser));
   form.append('diplomeuser', encodeURI(diplomeuser));
   form.append('nationaliteuser', encodeURI(nationaliteuser));
   form.append('typeContrat', encodeURI(typeContrat));
   form.append('daterecrute', encodeURI(daterecrute));
   form.append('obligation', encodeURI(obligation));
   form.append('poste', encodeURI(poste));
   form.append('salaire', encodeURI(salaire));
   form.append('PressingRattacher', encodeURI(PressingRattacher));

xhr.open('POST','newcompte.php');
//xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send(form);

}
//fonction de suppression des comptes utilisateur
function suppcompteuser(ident){
    btnClick();
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
      let result = xhr.responseText;
      afficheuser('all');
      if(result=='non'){
        annonce('Seul l\'administrateur peut supprimer un compte');

      }
    }
   }
xhr.open('GET','suppcompteuser.php?ident='+ident+'&cookie='+cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();


}

//fonction permettant de gerer l'interface de gestion des clients
function afficheclient(){
    let seachclient = document.getElementById('seachclient').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let toutclient = document.getElementById('toutclient');
         toutclient.innerHTML=xhr.responseText;
    }
   }
xhr.open('GET','afficheclient.php?para='+seachclient);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();

}
//fonction d'affichage des donnees en fonction du client de l'utilisateur
function afficheblock(blockclick){
  btnClick();

  let affichecompt          = document.getElementById('affichecompt');
  let gestclient            = document.getElementById('gestclient');
  let gestvetement          = document.getElementById('gestvetement');
  let gestdepense           = document.getElementById('gestdepense');
  let gestdette             = document.getElementById('gestdette');
  let gestcaisse            = document.getElementById('gestcaisse');
  let gestfidelitecl        = document.getElementById('gestfidelitecl');
  let rapportlistvetdepot   = document.getElementById('rapportlistvetdepot');
  let rapportlistvetsort    = document.getElementById('rapportlistvetsort');
  let rapportlistdepense    = document.getElementById('rapportlistdepense');
  let rapportlistfacture    = document.getElementById('rapportlistfacture');
  let rapportlistcartef     = document.getElementById('rapportlistcartef');
  let rapportlistdett       = document.getElementById('rapportlistdett');
  let rapportlistargantcli  = document.getElementById('rapportlistargantcli');
  let rapportlistargantvet  = document.getElementById('rapportlistargantvet');
  let rapportlistcloturcaus = document.getElementById('rapportlistcloturcaus');
  let rapportlistvetback    = document.getElementById('rapportlistvetback');
  let gestersement          = document.getElementById('gestersement');
  let gestsortaujd          = document.getElementById('gestsortaujd');
  let rapportlistverse      = document.getElementById('rapportlistverse');
  let gestdashbord          = document.getElementById('gestdashbord');
  let gestsms               = document.getElementById('gestsms');
  let operationEffect       = document.getElementById('operationEffect');

  gestdashbord.style.display          = "none";
  gestsortaujd.style.display          = "none";
  rapportlistverse.style.display      = "none";
  gestersement.style.display          = "none";
  rapportlistcloturcaus.style.display = "none";
  rapportlistargantvet.style.display  = "none";
  rapportlistargantcli.style.display  = "none";
  rapportlistdett.style.display       = "none";
  rapportlistcartef.style.display     = "none";
  rapportlistfacture.style.display    = "none";
  rapportlistdepense.style.display    = "none";
  rapportlistvetsort.style.display    = "none";
  rapportlistvetdepot.style.display   = "none";
  rapportlistvetback.style.display    = "none";
  gestfidelitecl.style.display        = "none";
  gestcaisse.style.display            = 'none';
  gestdette.style.display             = 'none';
  gestdepense.style.display           = 'none';
  gestvetement.style.display          = 'none';
  gestclient.style.display            = 'none';
  affichecompt.style.display          = 'none';
  gestsms.style.display               = 'none';
  operationEffect.style.display       = 'none';
  blockclick.style.display            = 'block';
}
//fonction d'enregistrement des clients
function newclient(){
    let selectnomcl = document.getElementById('nomcl');
    let nomcl = selectnomcl.value;
    let selecttelephonecl = document.getElementById('telephonecl');
    let telephonecl = selecttelephonecl.value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let resultnewclient = document.getElementById('resultnewclient');
         resultnewclient.innerHTML=xhr.responseText;
         setTimeout(function(){
             resultnewclient.innerHTML='';

         },3000);
         let re=resultnewclient.innerHTML;
         if(re == '<div class="alert alert-success" role="alert" style="font-size:12px">Nouveau client enregistré</div>'){
                 selectnomcl.value='';
                 selecttelephonecl.value='';
         }
      
    }
   }
xhr.open('POST','newclient.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('nomcl='+nomcl +'&telephonecl='+telephonecl +'&cookie='+cookie);

}
//fonction d'ouverture du formulaire de creation des clients
function ouvrenewclient(){
    let formnewclient = document.getElementById('formnewclient');
    formnewclient.style.display="block";
}
//fonction affiche les clients a séléctionné pour un depot vetement
function clientcom(){
    let cherchecliencmd = document.getElementById('cherchecliencmd').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let listeclientcmd = document.getElementById('listeclientcmd');
         listeclientcmd.innerHTML=xhr.responseText;
         choixtypvet();
    }
   }
xhr.open('GET','afficheclientkicomde.php?crit='+cherchecliencmd);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//selection du code du client qui depose ses vetement 
function texte(para){
 let varia = document.getElementById(para);
 varia.style.background="blue";
 varia.style.color="white";
 btnClick();
 let codeclient = document.getElementById('codeclient');
 codeclient.value=para;
}
//selection du nom du client qui depose ses vetement
function nomclientdep(para){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let nomclient = document.getElementById('nomclient');
         nomclient.value=xhr.responseText;
      
    }
   }
xhr.open('GET','nomclaveccode.php?ide='+para);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
   }
//decoloration apres client ailleur
function decoclient(par){
    let varia = document.getElementById(par);      
 varia.style.background="white";
 varia.style.color="black";
}
//fonction d'ouverture du formulaire de creation des type de vetement
function ouvretypevet(){
    let formnewtypvet = document.getElementById('formnewtypvet');
    formnewtypvet.style.display="block";
}
//fonction d'insertion des type de vetement
function newtypvet(){
    let selectnomvet = document.getElementById('nomvet');
    let nomvet = selectnomvet.value;
    let selectprixvet = document.getElementById('prixvet');
    let prixvet = selectprixvet.value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let resulttypvet = document.getElementById('resulttypvet');
         resulttypvet.innerHTML=xhr.responseText;
         choixtypvet();
         setTimeout(function(){
             resulttypvet.innerHTML='';

         },3000);
         let re=resulttypvet.innerHTML;
         if(re=='<div class="alert alert-success" role="alert" style="font-size:12px">Vêtement créer avec succès</div>'){
             selectnomvet.value='';
             selectprixvet.value='';
         }
  
         
    }
   }
xhr.open('POST','newtypvet.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('nomvet='+ encodeURI(nomvet)+'&prixvet='+encodeURI(prixvet)+'&cookie='+encodeURI(cookie));
}
//action sur le formulaire de depot de vetement
//affichage de la liste de selection des type de vetement
function choixtypvet(){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let keltypvet = document.getElementById('keltypvet');
         keltypvet.innerHTML=xhr.responseText;
         
    }
   }
xhr.open('GET','choixtypvet.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction de recuperation du prix de lavage du vetement selectionner
function prixlavage(){
    let choixtypv = document.getElementById('choixtypv').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let prixvetement = document.getElementById('prixvetement');
         prixvetement.value=xhr.responseText;
         
    }
   }
xhr.open('GET','prixlavage.php?choix='+choixtypv);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//affichage du formulaire de reglement d'une facture
function reglefact(){
    let sortievet = document.getElementById('sortievet');
    sortievet.style.display="block";
}
//affichage du formulaire de d'enregistrement de la disponinlité des vet d'une facture
function dispofact(){
    let sortievet = document.getElementById('dispovet');
    sortievet.style.display="block";
}
//affichage du formulaire de d'enregistrement des vetement retourné
function formretourvet(){
    let sortievet = document.getElementById('formnewretourvet');
    sortievet.style.display="block";
}

//fonction d'affichage de la liste des vetement deposé consernant une facture
function listehabfact(){
    let codefactsort = document.getElementById('codefactsort').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let affichvetsort = document.getElementById('affichvetsort');
         affichvetsort.innerHTML=xhr.responseText;
         affichresteApayer();
         etatfacture();
         
    }
   }
xhr.open('GET','listeHabitFact.php?codefact='+codefactsort);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction de validation de la disponibilitée des vetement d'une facture
function valideDispoVet(){
    let codefactsort = document.getElementById('codefactdispo').value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         const result = xhr.responseText;
         etatfactureDispo();
         
    }
   }
xhr.open('GET','valideDispoVet.php?codefact='+codefactsort+'&cookie='+cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction d'affichage de la liste des vetement deposé consernant une facture pour ca disponibilité
function listehabfactDisponibilite(){
    let codefactsort = document.getElementById('codefactdispo').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let affichvetsort = document.getElementById('affichvetdispo');
         affichvetsort.innerHTML=xhr.responseText;
         affichresteApayerDispo();
         etatfactureDispo();
         
    }
   }
xhr.open('GET','listehabfactDisponibilite.php?codefact='+codefactsort);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//supprimer l'actualisation au click
let btncherchesort = document.getElementById('btncherchesort');
btncherchesort.addEventListener('click',(e)=>{
    e.preventDefault();
})
//fonction affiche reste a payer
function affichresteApayer(){
    let codefactsort = document.getElementById('codefactsort').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let restesort = document.getElementById('restesort');
         restesort.innerHTML=xhr.responseText;

         //liste des pressings
         typepressingDepense();
    }
   }
xhr.open('GET','ResteApayerFact.php?codefact='+codefactsort);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();

}
//fonction affiche reste a payer pour disponibilité
function affichresteApayerDispo(){
    let codefactsort = document.getElementById('codefactdispo').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let restesort = document.getElementById('restedispo');
         restesort.innerHTML=xhr.responseText;

    }
   }
xhr.open('GET','ResteApayerFact.php?codefact='+codefactsort);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();

}
//fonction de reglement d'une facture/ ou la creation d'une dette
function regleDette(RD){
    btnClick();
    let codefactsort = document.getElementById('codefactsort').value;
    let restesort = document.getElementById('restesort').innerHTML;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         affichresteApayer();
         etatfacture();
         
    }
   }
xhr.open('POST','stockreglementDette.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('codefact='+encodeURI(codefactsort) + '&reste='+encodeURI(restesort)+'&btn='+encodeURI(RD)+'&cookie='+encodeURI(cookie));
}

//fonction permettant de faire sortie les vetement
function sortivet(para){
    btnClick();
    let codefactsort = document.getElementById('codefactsort').value;
 let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let retour =xhr.responseText;
        if(retour=='non'){
            annonce('<div class="alert alert-danger" role="alert" style="font-size:13px"><i class="bi bi-x-circle text-danger"></i> Veuillez définir l\'état de la facture(réglé ou dette).</div>')
           }
        listehabfact();
    }
   }
xhr.open('POST','sortievet.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('codefact='+encodeURI(codefactsort) + '&ident='+encodeURI(para)+'&cookie='+encodeURI(cookie));
}

//verification de l'etat de la facture(regle,encour,dette)
function etatfacture(){
    let codefactsort = document.getElementById('codefactsort').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let etatFctDR = document.getElementById('etatFctDR');
        etatFctDR.innerHTML=xhr.responseText;
        affichresteApayer();

    }
   }
xhr.open('GET','etatfacture.php?etat='+codefactsort);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//verification de l'etat de la facture(disponible ou non disponible)
function etatfactureDispo(){
    let codefactsort = document.getElementById('codefactdispo').value;
    var btnDispo     = document.getElementById('btnvalidDispo')
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let etatFctDR = document.getElementById('etatFctDRDispo');
        const Result = xhr.responseText; 
        etatFctDR.innerHTML = Result
        if(Result == '<div style="color:red">Vetements non disponible</div>'){
            btnDispo.style.visibility = 'visible';
        }else{
            btnDispo.style.visibility = 'hidden';
        }
        affichresteApayerDispo();

    }
   }
xhr.open('GET','etatfactureDispo.php?etat='+codefactsort);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//ferme block sortie vetement
function fermesortvet(){
   let sortievet = document.getElementById('sortievet');
   sortievet.style.display="none";
}
//ferme block disponibilité vetement
function fermedispovet(){
   let sortievet = document.getElementById('dispovet');
   sortievet.style.display="none";
}
//ouverture du formulaire de création du type de depense
function ouvretypdep(){
    let formnewtypdep = document.getElementById('formnewtypdep');
    formnewtypdep.style.display="block";
    
}
//fermeture du formulaire de creation du type de depense
function fermetypdep(){
    let formnewtypdep = document.getElementById('formnewtypdep');
    formnewtypdep.style.display='none';
}
//suppression de l'actualisation
let btntypdep = document.getElementById('btntypdep');
btntypdep.addEventListener('click',(e)=>{
    e.preventDefault();
})
//fonction d'insertion du type de depense
function inserttypdep(){
    let selectnomdep = document.getElementById('nomdep');
    let nomdep = selectnomdep.value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let resulttypdep = document.getElementById('resulttypdep');
        resulttypdep.innerHTML=xhr.responseText;
        affichtypdep();
        setTimeout(function(){
            resulttypdep.innerHTML='';

        },3000);
        let re=resulttypdep.innerHTML;
        if(re=='<div class="alert alert-success" role="alert" style="font-size:12px">Type de dépense enregistré</div>'){
                  selectnomdep.value='';
        }
    }
   }
xhr.open('POST','inserttypdep.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('nom='+encodeURI(nomdep)+'&cookie='+encodeURI(cookie));
}
//fonction d'affichage des type de depense
function affichtypdep(){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let listeDepense = document.getElementById('listeDepense');
        listeDepense.innerHTML=xhr.responseText;
        affichresteApayer();

    }
   }
xhr.open('GET','affichetypedep.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction de suppression du type de depense 
function suptypedep(para){
    btnClick();
    let cookie = localStorage.getItem('login'); 
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        affichtypdep();

    }
   }
xhr.open('GET','suptypedep.php?ident='+para+'&cookie='+cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction permettant d'afficher la liste des type de depense
function affichtypedep(){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let choixtypdep = document.getElementById('choixtypdep');
        choixtypdep.innerHTML=xhr.responseText;
    }
   }
xhr.open('GET','affichtypedep.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//suppression de l'actualisation
let btnenregdep = document.getElementById('btnenregdep');
btnenregdep.addEventListener('click',(e)=>{
    e.preventDefault();
})

//fonction d'insertion des depenses
function insertdepense(){
    let selectchoixenregdep = document.getElementById('choixenregdep');
    let choixenregdep = selectchoixenregdep.value;
    let selectmotifdep = document.getElementById('motifdep');
    let motifdep = selectmotifdep.value;
    let selectmontantdep = document.getElementById('montantdep');
    let montantdep = selectmontantdep.value;
    let DATEDEP = document.getElementById('DATEDEP').value;
 let cookie = localStorage.getItem('login');

    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let resultdep = document.getElementById('resultdep');
        resultdep.style.display="block";
        resultdep.innerHTML=xhr.responseText;
        affichdepenses();
        setTimeout(function(){
            resultdep.style.display="none";
        },3000)
    let re=resultdep.innerHTML;
    if(re=='<div class="alert alert-success" role="alert" style="font-size:12px">La dépense a été enregistré avec succès</div>'){
        selectchoixenregdep.value='';
        selectmotifdep.value='';
        selectmontantdep.value='';
    }
        
    }
   }
xhr.open('POST','insertdepense.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('choix='+encodeURI(choixenregdep)+'&motif='+encodeURI(motifdep)+'&montant='+encodeURI(montantdep)+'&datedep='+encodeURI(DATEDEP)+'&cookie='+encodeURI(cookie));
}
//fonction d'ouverture du formulaire d'enregistrement des depenses
function ouvreformdep(){
    let formnewdep = document.getElementById('formnewdep');
    formnewdep.style.display="block";
    btnClick()
    affichtypedep();
}
//fonction de fermeture du formulaire d'enregistrement des depenses
function fermedep(){
    btnClick();
    let formnewdep = document.getElementById('formnewdep');
    formnewdep.style.display="none";
}

//fonction d'affichage des depensee
function affichdepenses(){
    let datedebudep = document.getElementById('datedebudep').value;
    let datefindep = document.getElementById('datefindep').value;
    let pressing = document.getElementById('typePressingdepense').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let listedep = document.getElementById('listedep');
        listedep.innerHTML=xhr.responseText;
        
    }
   }
xhr.open('POST','affichedepense.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('datedebu='+encodeURI(datedebudep)+'&datefin='+encodeURI(datefindep)+'&pressing='+encodeURI(pressing));

}

//fonction de reglement des dettes concernant une facture
function regledette(){
    let codefactregdet = document.getElementById('codefactregdet').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let affichfactdet = document.getElementById('affichfactdet');
        affichfactdet.innerHTML=xhr.responseText;
        montregledette();
      
    }
   }
xhr.open('GET','regledette.php?code='+codefactregdet);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
let btncherchedett = document.getElementById('btncherchedett');
btncherchedett.addEventListener('click',(e)=>{
    e.preventDefault();
})

//fonction d'affichage du montant de la dette
function montregledette(){
    let codefactregdet = document.getElementById('codefactregdet').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let montdet = document.getElementById('montdet');
        montdet.innerHTML=xhr.responseText;
        
    }
   }
xhr.open('GET','affichmontdettereg.php?code='+codefactregdet);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction permettant de regle une dette
function remdette(){
    btnClick();
    let codefactregdet = document.getElementById('codefactregdet').value;
    let selecavancedette = document.getElementById('avancedette');
    let avancedette = selecavancedette.value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        regledette();
        selecavancedette.value='';
    }
   }
xhr.open('GET','remboursedette.php?code='+codefactregdet+'&avance='+avancedette+'&cookie='+cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'ouverture du formulaire de reglement de dette
 function ouvreregdett(){
     let regledett = document.getElementById('regledett');
     regledett.style.display="block";
 }
 //fonction de fermeture du formulaire de reglement de dette
 function ferregdett(){
     let regledett = document.getElementById('regledett');
     regledett.style.display="none";
 }

 //fonction d'affichage des dettes en cours
 function affichdetteCour(){
     let datedebudett = document.getElementById('datedebudett').value;
     let datefindett = document.getElementById('datefindett').value;
     let pressing = document.getElementById('typePressingdette').value;
        if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
      let listedettecour = document.getElementById('listedettecour');
      listedettecour.innerHTML=xhr.responseText;
      affichdetteregle();
    }
   }
xhr.open('GET','affichdettecour.php?deb='+datedebudett+'&fin='+datefindett+'&pressing='+encodeURI(pressing));
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
 }
  //fonction d'affichage des dettes réglé
  function affichdetteregle(){
    let datedebudett = document.getElementById('datedebudett').value;
    let datefindett = document.getElementById('datefindett').value;
    let pressing = document.getElementById('typePressingdette').value;
       if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");

   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listedepregle = document.getElementById('listedepregle');
     listedepregle.innerHTML=xhr.responseText;
  
   }
  }
xhr.open('GET','affichdetteregle.php?deb='+datedebudett+'&fin='+datefindett+'&pressing='+encodeURI(pressing));
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage des etats de caisse de la journée choisi par le client
function affichetatj(){
    let dateclo = document.getElementById('dateclo').value;
    let keppressingcaisse = document.getElementById('keppressingcaisse').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
      let afficeta = document.getElementById('afficeta');
      afficeta.innerHTML=xhr.responseText;
    }
   }
 xhr.open('GET','affichetatj.php?dat='+dateclo+'&pressing='+keppressingcaisse);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}

//fonction permettant d'enregistrer les données de cloture de caisse
function clotcaisse(){btnClick();
    let dateclo = document.getElementById('dateclo').value;
    let montreel = document.getElementById('montreel').value;
    let somdep = document.getElementById('somdep').innerHTML;
    let montnet = document.getElementById('montnet').innerHTML;
    let somentre = document.getElementById('somentre').innerHTML;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
      let smsclot = document.getElementById('smsclot');
      smsclot.innerHTML=xhr.responseText;
      affichclotcais();
    }
   }
 xhr.open('POST','insertcloturefact.php');
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send('date='+encodeURI(dateclo)+'&montreel='+encodeURI(montreel)+'&somdep='+encodeURI(somdep)+'&montnet='+encodeURI(montnet)+'&cookie='+encodeURI(cookie)+'&somentre='+encodeURI(somentre));

}

//fonction d'ouverture du formulaire de cloture de caisse
function ouvreclotcaiss(){
    let blockclokcaisse = document.getElementById('blockclokcaisse');
    blockclokcaisse.style.display="block";
}
//fonction de fermeture du formulaire de cloture de caisse
function fermeclotcaiss(){
    let blockclokcaisse = document.getElementById('blockclokcaisse');
    blockclokcaisse.style.display="none";
}

//fonction d'affichage des cloture de caisse par date
function affichclotcais(){
    let dateclotcais = document.getElementById('dateclotcais').value;
    let keppressingcaisse = document.getElementById('keppressingcaisse').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
      let listeetatcais = document.getElementById('listeetatcais');
      listeetatcais.innerHTML=xhr.responseText;
      //typepressingCaisse();
    }
   }
 xhr.open('GET','affichclotcais.php?dat='+dateclotcais+'&pressing='+keppressingcaisse);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}

//tentative de resolution du probleme de coloration du text dans le block observation en fonction
//du mot contenu dans ce block
//function couleur(){
//let coleur = document.getElementById('coleur');
//   let col=coleur.innerHTML;
//if(col=='perte'){
//    coleur.style.color="red";
//}else if(col=='passable'){
//    coleur.style.color="green";
//}else if(col=='excelent'){
//    coleur.style.color="blue";
//}
//}


// recupere la valeur d'un cookie
function getCookie(name) {
    let cookieArr = document.cookie.split(";");
    for(let i = 0; i < cookieArr.length; i++) {
    let cookiePair = cookieArr[i].split("=");
    if(name == cookiePair[0].trim()) {
    return decodeURIComponent(cookiePair[1]);
    }
    }
    return null;
}

//fonction d'affichage du block gestion fidélité client uniquement pour un compte administrateur
let trfidelite = document.getElementById('trfidelite');
trfidelite.style.display="none";
function affichblockfidel(){
    let utilisateur = getCookie("typecompte");
    if(utilisateur =='simple'){
        document.getElementById('gestcompmenu').style.visibility = 'hidden';
        document.getElementById('gestcartefidelitemenu').style.visibility = 'hidden';
        document.getElementById('rapportmenu').style.visibility = 'hidden';
        document.getElementById('gestoperationmenu').style.visibility = 'hidden';
        
    }
    if(utilisateur =='admin'){
        document.getElementById('gestcompmenu').style.visibility = 'visible';
        document.getElementById('gestcartefidelitemenu').style.visibility = 'visible';
        document.getElementById('rapportmenu').style.visibility = 'visible';
        document.getElementById('gestoperationmenu').style.visibility = 'visible';

       
    }
    let adminlocal = getCookie("adminLocal");
    if(adminlocal == 'admin'){
        document.getElementById('ChangeMode').style.visibility = 'visible';
    }
    if(adminlocal == 'simple'){
        document.getElementById('ChangeMode').style.visibility = 'hidden';
    }
    
/*     let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let fidelite = document.getElementById('fidelite');
      let typc =xhr.responseText;
    
        if(typc=='oui'){
            trfidelite.style.display="block";
            fidelite.innerHTML+="Gestion de la fidélité des clients";
        }else if(typc=='non'){trfidelite.style.display="none";}
    }
   }
 xhr.open('GET','blockfidelite.php?cook='+cookie);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send(); */
}
//fonction d'affichage des clients pour l'attribution des cartes de fidelite
function clientnewcarte(){
    let searchclcarte = document.getElementById('searchclcarte').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let choixclcart = document.getElementById('choixclcart');
        choixclcart.innerHTML=xhr.responseText;
    }
   }
 xhr.open('GET','clientnewcarte.php?nom='+searchclcarte);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction d'affichage des vetements d'une facture pour le retour
function vetFactPrRetour(){
    let searchclcarte = document.getElementById('searchvetFactRetour').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let choixclcart = document.getElementById('choixvetFactRetour');
        choixclcart.innerHTML=xhr.responseText;
    }
   }
 xhr.open('GET','vetFactPrRetour.php?nom='+searchclcarte);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction de recuperation de l'ident du client choisi
function kelclcarte(para){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let codeclcarte = document.getElementById('codeclcarte');
        codeclcarte.value=para;
    }
   }
   xhr.open('GET','clientnewcarte.php?nom='+searchclcarte);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}

//fonction de recuperation de l'ident du vitement a faire retourné
function kelvetretourn(para){
    document.getElementById('codevetback').value = para;
}

//fonction de validaation d'un retour de vetement
function insertRetourVet(){
    let cookie    = localStorage.getItem('login');
    var codevet   = document.getElementById('codevetback').value;
    var qte       = document.getElementById('qteBack').value;
    var motifBack = document.getElementById('motifBack').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let codeclcarte = document.getElementById('smsbackvet');
        codeclcarte.innerHTML = xhr.responseText;
    }
   }
   var formData = new FormData();
   formData.append('cookie', cookie);
   formData.append('codevet', codevet);
   formData.append('qte', qte);
   formData.append('motifBack', motifBack);
 xhr.open('POST','kelvetretourn.php');
 //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send(formData); 
}

//suppression de l'actualisation
let btnnewcarte = document.getElementById('btnnewcarte');
btnnewcarte.addEventListener('click',(e)=>{
    e.preventDefault();
})

//fonction d'insertion des carte de fidelite
function insertcarte(){
    let codecl = document.getElementById('codeclcarte').value;
    let selectmontreduct = document.getElementById('montreduct');
    let montreduct = selectmontreduct.value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let smsnewcart = document.getElementById('smsnewcart');
        smsnewcart.innerHTML=xhr.responseText;
        affcartefidel();
        selectmontreduct.value='';
        setTimeout(function(){
            smsnewcart.innerHTML = '';
        },4000)
        
    }
   }
   xhr.open('POST','insertcarte.php');
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send('codecl='+encodeURI(codecl)+'&mont='+encodeURI(montreduct)+'&cookie='+encodeURI(cookie));
}

//ouverture du formulaire de creation des cartes 
function ouvrenewcart(){
    let formnewcarte = document.getElementById('formnewcarte');
    formnewcarte.style.display="block";
}
//fermeture du formulaire de creation des cartes 
function fermenewcart(){
    btnClick();
    let formnewcarte = document.getElementById('formnewcarte');
    formnewcarte.style.display="none";
}

//affichage de toute les carte de fidelite avec possibilite de faire un filtrage par periode
function affcartefidel(){
    let debutrecharcarte = document.getElementById('debutrecharcarte').value;
    let finrecharcarte = document.getElementById('finrecharcarte').value;
    let nomclcarte = document.getElementById('nomclcarte').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let listecarte = document.getElementById('listecarte');
        listecarte.innerHTML=xhr.responseText;
    }
   }
   xhr.open('GET','ffichcartecarte.php?ddebu='+debutrecharcarte+'&dfin='+finrecharcarte+'&nom='+nomclcarte);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}

//fonction permettant de recharger une carte de fidelite
function recharnomclcarte(ident){
    btnClick();
    let formrecharcarte =document.getElementById('formrecharcarte');
    formrecharcarte.style.display="block";
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let nomclrechar = document.getElementById('nomclrechar');
        nomclrechar.innerHTML=xhr.responseText;
        affichpourcent(ident);
    }
   }
   xhr.open('GET','rechargecarte.php?ident='+ident);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}

//fonction d'affichage du pourcentage pour une modification
function affichpourcent(ident){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let recharcarte = document.getElementById('recharcarte');
        recharcarte.value=xhr.responseText;
    localStorage.setItem("id_carte",ident);

    }
   }
   xhr.open('GET','affichpourcentcarte.php?ident='+ident);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction de modification du pourcentage d'une carte
function insertmodifcart(){
    let recharcarte = document.getElementById('recharcarte').value;
    let nomclrechar = document.getElementById('nomclrechar').innerHTML;
    let cookit = localStorage.getItem('id_carte');
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let smsmodifcart = document.getElementById('smsmodifcart');
        smsmodifcart.innerHTML=xhr.responseText;
        affcartefidel();
        setTimeout(function (){
            smsmodifcart.innerHTML='';

        },3000);

    }
   }
   xhr.open('POST','insertmodifcartcarte.php');
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send('mont='+encodeURI(recharcarte)+'&cookie='+encodeURI(cookit)+'&nomcl='+encodeURI(nomclrechar)+'&cookie='+encodeURI(cookie));
}

//annule l'actualisation
let btnrecharcarte = document.getElementById('btnrecharcarte');
btnrecharcarte.addEventListener('click',(e)=>{
    e.preventDefault();
})

//function de fermeture du formulaire de recharge des carte de fidelite
function fermemodic(){
    btnClick();
    let formrecharcarte = document.getElementById('formrecharcarte');
    formrecharcarte.style.display="none";
}

//fonction d'affichage des meilleur client
function meilleurcl(){
    let debutMcl = document.getElementById('debutMcl').value;
    let finMcl = document.getElementById('finMcl').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let smsmodifcart = document.getElementById('smsmodifcart');
        smsmodifcart.innerHTML=xhr.responseText;
        affcartefidel();

    }
   }
   xhr.open('GET','affichmeilleurcl.php?ddebu='+debutMcl+'&dfin='+finMcl);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();

}

//fonction d'ouverture des rapports
function openrappo(){btnClick();
    let menurapport = document.getElementById('menurapport');
    menurapport.style.display="block";
}
//fonction de fermeture des rapports
function closerappo(){
    btnClick();
    let menurapport = document.getElementById('menurapport');
    menurapport.style.display="none";
}

//fonction d'affichage de la liste des vetements déposé par période ou global
function rapportlistevet(){
    
    let debutrapvetdepot = document.getElementById('debutrapvetdepot').value;
    let finrapvetdepot = document.getElementById('finrapvetdepot').value;
    let pressing = document.getElementById('keppressingRapportvetdepot').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        
       let iframe = document.getElementById('listevetentre'); 
       iframe.onload = function () { 
            let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
            let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
            listevetentre.innerHTML = xhr.responseText;
        }; 
        iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source
    }
   }
 xhr.open('GET','affichrapportvetdepot.php?ddebu='+debutrapvetdepot+'&dfin='+finrapvetdepot+'&pressing='+pressing);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction d'affichage de la liste des vetements retourné
function rapportlistevetback(){
    
    let debutrapvetdepot = document.getElementById('debutrapvetback').value;
    let finrapvetdepot = document.getElementById('finrapvetback').value;
    let pressing = document.getElementById('keppressingRapportvetback').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        
       let iframe = document.getElementById('listevetback'); 
       iframe.onload = function () { 
            let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
            let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
            listevetentre.innerHTML = xhr.responseText;
        }; 
        iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source
    }
   }
 xhr.open('GET','affichrapportvetback.php?ddebu='+debutrapvetdepot+'&dfin='+finrapvetdepot+'&pressing='+pressing);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction d'affichage de la liste des vetements sortie par période ou global
function rapportlistevetsort(){
    
    let debutrapvetsort = document.getElementById('debutrapvetsort').value;
    let finrapvetsort = document.getElementById('finrapvetsort').value;
    let pressing = document.getElementById('keppressingRapportvetsort').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){

        let iframe = document.getElementById('listevetsort'); 
        iframe.onload = function () { 
             let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
             let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
             listevetentre.innerHTML = xhr.responseText;
         }; 
         iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source

    }
   }
 xhr.open('GET','affichrapportvetsort.php?ddebusort='+debutrapvetsort+'&dfinsort='+finrapvetsort+'&pressing='+pressing);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction d'affichage de la liste depenses par période ou global
function rapportlistedepense(){
    let debutrapdep = document.getElementById('debutrapdep').value;
    let finrapdep = document.getElementById('finrapdep').value;
    let pressing = document.getElementById('keppressingRapportdepense').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){

        let iframe = document.getElementById('listedepenserap'); 
        iframe.onload = function () { 
             let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
             let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
             listevetentre.innerHTML = xhr.responseText;
         }; 
         iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source

    }
   }
 xhr.open('GET','affichrapportdepense.php?ddebudep='+debutrapdep+'&dfindep='+finrapdep+'&pressing='+pressing);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction d'affichage de la liste facture par période ou global
function rapportlistefacture(){
    let debutrapfact = document.getElementById('debutrapfact').value;
    let finrapfact = document.getElementById('finrapfact').value;
    let pressing = document.getElementById('keppressingRapportfacture').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){

        let iframe = document.getElementById('listefacturerap'); 
        iframe.onload = function () { 
             let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
             let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
             listevetentre.innerHTML = xhr.responseText;
         }; 
         iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source

    }
   }
 xhr.open('GET','affichrapportfacture.php?ddebufact='+debutrapfact+'&dfinfact='+finrapfact+'&pressing='+pressing);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction d'affichage de la liste des carte de fidélité par période ou global
function rapportlistecarteF(){
    let debutrapcarte = document.getElementById('debutrapcarte').value;
    let finrapcarte = document.getElementById('finrapcarte').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){

        let iframe = document.getElementById('listecartefrap'); 
        iframe.onload = function () { 
             let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
             let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
             listevetentre.innerHTML = xhr.responseText;
         }; 
         iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source

    }
   }
 xhr.open('GET','affichrapportcartef.php?ddebucarte='+debutrapcarte+'&dfincarte='+finrapcarte);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction d'affichage de la liste des dettes par période ou global
function rapportlistedette(){
    let debutrapdette = document.getElementById('debutrapdette').value;
    let finrapdette = document.getElementById('finrapdette').value;
    let pressing = document.getElementById('keppressingRapportregle').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){

        let iframe = document.getElementById('listedetterap'); 
        iframe.onload = function () { 
             let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
             let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
             listevetentre.innerHTML = xhr.responseText;
         }; 
         iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source

    }
   }
 xhr.open('GET','affichrapportdette.php?ddebudet='+debutrapdette+'&dfindet='+finrapdette+'&pressing='+pressing);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction d'affichage de la liste du chiffre d'affaire par client  par période ou global
function rapportlistechcl(){
    let debutrapchcl = document.getElementById('debutrapchcl').value;
    let finrapchcl = document.getElementById('finrapchcl').value;
    let pressing = document.getElementById('keppressingRapportCAclient').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){

        let iframe = document.getElementById('listechiffrecl'); 
        iframe.onload = function () { 
             let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
             let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
             listevetentre.innerHTML = xhr.responseText;
         }; 
         iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source

    }
   }
 xhr.open('GET','affichrapportchiffreaffcl.php?ddebuchcl='+debutrapchcl+'&dfinchcl='+finrapchcl+'&pressing='+pressing);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction d'affichage de la liste du chiffre d'affaire par vetement par période ou global
function rapportlistechvet(){
    let debutrapchvet = document.getElementById('debutrapchvet').value;
    let finrapchvet = document.getElementById('finrapchvet').value;
    let pressing = document.getElementById('keppressingRapportCAvet').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){

     let iframe = document.getElementById('listechiffrevet'); 
     iframe.onload = function () { 
          let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
          let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
          listevetentre.innerHTML = xhr.responseText;
      }; 
      iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source

    }
   }
 xhr.open('GET','affichrapportchiffreaffvet.php?ddebuchvet='+debutrapchvet+'&dfinchvet='+finrapchvet+'&pressing='+pressing);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//fonction d'affichage de la liste des cloture de caisse par vetement par période ou global
function rapportlisteclotcais(){
    let debutrapclotcais = document.getElementById('debutrapcloturcais').value;
    let finrapclotcais = document.getElementById('finrapcloturcais').value;
    let pressing = document.getElementById('keppressingRapportclotcaisse').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){

     let iframe = document.getElementById('listecloturecais'); 
     iframe.onload = function () { 
          let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
          let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
          listevetentre.innerHTML = xhr.responseText;
      }; 
      iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source

    }
   }
 xhr.open('GET','affichrapportclotcais.php?ddebuclotc='+debutrapclotcais+'&dfinclotc='+finrapclotcais+'&pressing='+pressing);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}
//Supprimer un client
function suppclient(idclient){
    let cookie = localStorage.getItem('login');
    btnClick();
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        afficheclient();
    }
   }
xhr.open('GET','suppclient.php?idcli='+idclient+'&cookie='+cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//Affichage de tout les factures d'un client apres un click
function fact1client(idclient){
    btnClick();
    let facture1cl = document.getElementById('facture1cl');
    facture1cl.style.display='block';
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let tabfact1cl = document.getElementById('tabfact1cl');
        tabfact1cl.innerHTML=xhr.responseText;
        

    }
   }
xhr.open('GET','fact1client.php?idcli='+idclient);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction de suppression d'une facture existante
function suppfacture(code,idcl){
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let red = xhr.responseText;
        if(red=='non'){
        annonce('Echec se suppression de la facture. Une facture ne peut etre supprimer que le jour de son enregistrement( pour raison de sécurité)');
        }
        fact1client(idcl);

    }
   }
xhr.open('GET','suppfact1client.php?code='+code+'&cookie='+cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//ferme la liste des factures d'utilisateur
function fermefact1cl(){
    let facture1cl = document.getElementById('facture1cl');
    facture1cl.style.display='none';
}

//fonction d'affichage des type de vetement
function affichtypevete(){
    let affichtypevet = document.getElementById('affichtypevet');
    affichtypevet.style.display="block";
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let listetypevet = document.getElementById('listetypevet');
        listetypevet.innerHTML=xhr.responseText;
        

    }
   }
xhr.open('GET','affichetypevet.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fermeture de l'affichage des type de vetement
function fermeaffictypvet(){
    let affichtypevet = document.getElementById('affichtypevet');
    affichtypevet.style.display='none';
}
//fonction d'actualisation de l'affichage des type de vetement
function actualisetypv(){
    affichtypevete();
}
//fonction de suppression d'un type de vetement
function supptypevet(iden){
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        affichtypevete();

    }
   }
xhr.open('GET','supprimetypvet.php?iden='+iden+'&cookie='+cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction de suppression des depenses
function suppsdepense(identifi){
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        affichdepenses();
    }
   }
xhr.open('GET','supprimedepense.php?identd='+identifi+'&cookie='+cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage du montant de la facture progressivement apres chaque enregistrement
function montfactprogressive(){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let totalfact = document.getElementById('totalfact');
        totalfact.innerHTML=xhr.responseText;

    }
   }
xhr.open('GET','montfactprogressive.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage du formulaire de modifiaction des vetements deposé
function modifvet(idvet){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let contform = document.getElementById('contform');
        contform.innerHTML=xhr.responseText;

    }
   }
xhr.open('GET','modifiervetdepose.php?idvet='+idvet);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction de modifiaction des vetements deposeé avant le click sur fin saissi
function insertmodifvet(){
    let prixumodfi = document.getElementById('prixumodfi').value;
    let qtemodfi = document.getElementById('qtemodfi').value;
    let descriptmodif = document.getElementById('descriptmodif').value;
    let datedepotmodif = document.getElementById('datedepotmodif').value;
    let dateretraitmodif = document.getElementById('dateretraitmodifr').value;
    let identcmd = document.getElementById('identcmd').value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let modifsucces = document.getElementById('modifsucces');
        modifsucces.innerHTML=xhr.responseText;
        affichehabitdepose('debu');
        setTimeout( function(){
            modifsucces.innerHTML=""}
            ,2000
        )
    }
   }
xhr.open('POST','insertmodifvetdepot.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('pu='+encodeURI(prixumodfi)+'&qte='+encodeURI(qtemodfi)+'&descript='+encodeURI(descriptmodif)+'&datede='+encodeURI(datedepotmodif)+'&datere='+encodeURI(dateretraitmodif)+'&ident='+identcmd+'&cookie='+encodeURI(cookie));
}

let btnmodifvet = document.getElementById('btnmodifvet');
btnmodifvet.addEventListener('click',(e)=>{
    e.preventDefault();
})

//fermeture du formulaire de modification des vetements deposer
function fermeformodifvet(){
    let formmodifdepot = document.getElementById('formmodifdepot');
    formmodifdepot.style.display="none";
}
//ouverture du formulaire de modification des vetements deposer
function ouvreformodifvet(){
    let formmodifdepot = document.getElementById('formmodifdepot');
    formmodifdepot.style.display="block";
}

//fonction d'insertion des type de versement
function insertversargent(){
    let selectnomvera = document.getElementById('nomvera');
    let nomvera = selectnomvera.value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let resulttypverse = document.getElementById('resulttypverse');
        resulttypverse.innerHTML=xhr.responseText;
        setTimeout( function(){
            resulttypverse.innerHTML=""}
            ,2000
        )
        affichtypeversa();
        let re=resulttypverse.innerHTML;
        if(re=='<div class="alert alert-success" role="alert" style="font-size:12px">Type de versement enregistré</div>'){
            selectnomvera.value='';
        }
    }
   }
xhr.open('POST','insertypeversement.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('type='+encodeURI(nomvera)+'&cookie='+cookie);
}

let btnverse = document.getElementById('btnverse');
btnverse.addEventListener('click',(e)=>{
    e.preventDefault();
})

let btnmodifclient = document.getElementById('btnmodifclient');
btnmodifclient.addEventListener('click',(e)=>{
    e.preventDefault();
})

//fonction d'ouverture du formulaire de creation des type de versement
function ouvretypeversea(){
    let formnewtypver = document.getElementById('formnewtypver');
    formnewtypver.style.display="block";
}

//fonction fermeture du formulaire de creation des type de versement
function fermetypeversea(){
    let formnewtypver = document.getElementById('formnewtypver');
    formnewtypver.style.display="none";
}

//fonction d'affichage des type de versement afin de faire des recherche en fonction d'un type precis
function typevers(){
    
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let keltypeversea = document.getElementById('keltypeversea');
        keltypeversea.innerHTML=xhr.responseText;
        affichtypeversa();
    }
   }
xhr.open('GET','affichkeltypeverse.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction d'affichage des type de versement afin de généré les rapports de versement
function typeversrapport(){
    
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let keltypeversearapport = document.getElementById('keltypeversearapport');
        keltypeversearapport.innerHTML=xhr.responseText;
        affichtypeversa();
    }
   }
xhr.open('GET','affichkeltypeverserapport.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage des rapports de versement
function rapportaffichverse(){
    let debutrapverse = document.getElementById('debutrapverse').value;
    let finrapverse = document.getElementById('finrapverse').value;
    let keltypeversearapport = document.getElementById('keltypeversearapport').value;
    let pressing = document.getElementById('keppressingRapportversement').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){

        let iframe = document.getElementById('listeversearapport'); 
        iframe.onload = function () { 
             let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
             let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
             listevetentre.innerHTML = xhr.responseText;
         }; 
         iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source
        
    }
   }
xhr.open('GET','affichverserapport.php?ddebu='+debutrapverse+'&dfin='+finrapverse+'&choix='+keltypeversearapport+'&pressing='+pressing);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage des type de versement
function affichtypeversa(){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let listversement = document.getElementById('listversement');
        listversement.innerHTML=xhr.responseText;
        typepressingVersement();
    }
   }
xhr.open('GET','affichtypeversa.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction de suppression des type de versement
function supptyveser(identver){
    btnClick();
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        affichtypeversa();
    }
   }
xhr.open('GET','supptypeversement.php?ident='+identver+'&cookie='+cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction d'affichage des type de versement sur le formulaire d'enregistrement des versement
function selecttyveser(){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let listeinservers = document.getElementById('listeinservers');
        listeinservers.innerHTML=xhr.responseText;
    }
   }
xhr.open('GET','selectypeversement.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'insertion d'un versement
function insertvesement(){
     let selectlisteinservers = document.getElementById('listeinservers');
     let listeinservers = selectlisteinservers.value;
     let selectmontversea = document.getElementById('montversea');
     let montversea = selectmontversea.value;
     let selectnumrecu = document.getElementById('numrecu');
     let numrecu = selectnumrecu.value;
     let datedepota = document.getElementById('datedepota').value;
    let cookie = localStorage.getItem('login');
     if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let resultverse = document.getElementById('resultverse');
        resultverse.innerHTML=xhr.responseText;
        setTimeout( function(){
            resultverse.innerHTML=""}
            ,2000
        )
        affichetoutvesement();
        let re = resultverse.innerHTML;
        if(re=='<div class="alert alert-success" role="alert" style="font-size:12px">Versement enregistré</div>'){
            selectlisteinservers.value='';
            selectmontversea.value='';
            selectnumrecu.value='';
        }
        
    }
   }
xhr.open('POST','insertnewversement.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('choix='+encodeURI(listeinservers)+'&montv='+encodeURI(montversea)+'&date='+encodeURI(datedepota)+'&cookie='+encodeURI(cookie)+'&numrecu='+encodeURI(numrecu));
}

let btnnewverA = document.getElementById('btnnewverA');
btnnewverA.addEventListener('click',(e)=>{
    e.preventDefault();
})

//fonction d'afichage des versments
function affichetoutvesement(){
    let keltypeversea = document.getElementById('keltypeversea').value;
    let datedebuverse = document.getElementById('datedebuverse').value;
    let datefinverse = document.getElementById('datefinverse').value;
    let keppressingVersement = document.getElementById('keppressingVersement').value;
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");

   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
       let listeversement = document.getElementById('listeversement');
       listeversement.innerHTML=xhr.responseText;
   }
  }
xhr.open('GET','affichetoutversement.php?choix='+keltypeversea+'&datedebu='+datedebuverse+'&datefin='+datefinverse+'&pressing='+keppressingVersement);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction de suppresion des versement 
function suppvesement(ident){ 
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
    affichetoutvesement();
   }
  }
xhr.open('GET','suppversement.php?ident='+ident+'&cookie='+cookie);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'ouverture du formulaire d'enregistrement des versement
function ouvrenewverse(){
    btnClick();
    let formnewverse = document.getElementById('formnewverse');
    formnewverse.style.display="block";
}
//fonction de fermeture du formulaire d'enregistrement des versement
function fermenewverse(){
    let formnewverse = document.getElementById('formnewverse');
    formnewverse.style.display="none";
}

//fonction d'affichage du client a modifier 
function formodifclient(ident){ 
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let contformmodifclient = document.getElementById('contformmodifclient');
     contformmodifclient.innerHTML = xhr.responseText
   }
  }
xhr.open('GET','formodifclient.php?ident='+ident);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction d'insertion des modification d'un client
function insertmodifclient(){ 
    btnClick();
    let newnomcl = document.getElementById('newnomcl').value;
    let newphonecl = document.getElementById('newphonecl').value;
    let ident = document.getElementById('ident').value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let modifclientsucces = document.getElementById('modifclientsucces');
     modifclientsucces.innerHTML = xhr.responseText;
     setTimeout(function(){
        modifclientsucces.innerHTML = '';
     },3000)
   }
  }
xhr.open('POST','insertmodifclient.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('newnom='+encodeURI(newnomcl)+'&newphone='+encodeURI(newphonecl)+'&ident='+encodeURI(ident)+'&cookie='+encodeURI(cookie));
}

//fonction d'ouverture du formulaire de modification des client
function ouvreformmodifclient(ident){
    formodifclient(ident)
    let formmodifclient = document.getElementById('formmodifclient');
    formmodifclient.style.display="block";
}

//fonction fermeture du formulaire de modification des client
function fermeformmodifclient(){
    btnClick();
    let formmodifclient = document.getElementById('formmodifclient');
    formmodifclient.style.display="none";
}

//fonction d'affichage du type de vetement a modifier 
function formodiftypvet(ident){ 
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let contformmodiftypvet = document.getElementById('contformmodiftypvet');
     contformmodiftypvet.innerHTML = xhr.responseText
   }
  }
xhr.open('GET','formodiftypvet.php?ident='+ident);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'insertion des modification d'un type de vetement
function insertmodiftypvet(){ 
    btnClick();
    let newnomtypvewt = document.getElementById('newnomtypvewt').value;
    let newprixtypvet = document.getElementById('newprixtypvet').value;
    let ident = document.getElementById('identtypvet').value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let modiftypvetsucces = document.getElementById('modiftypvetsucces');
     modiftypvetsucces.innerHTML = xhr.responseText;
     setTimeout(()=>{
        modiftypvetsucces.innerHTML ='';
     },3000)
   }
  }
xhr.open('POST','insertmodiftypvet.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('newnom='+encodeURI(newnomtypvewt)+'&newprix='+encodeURI(newprixtypvet)+'&ident='+encodeURI(ident)+'&cookie='+encodeURI(cookie));
}

//suppression de l'actualisation apres un click sur le bouton de modiication
let formmodiftypvet = document.getElementById('formmodiftypvet');
formmodiftypvet.addEventListener('click',(e)=>{
    e.preventDefault()
})

//fonction d'ouverture du formulaire de modification des type de vetement
function ouvreformmodiftypvet(ident){
    formodiftypvet(ident)
    let formmodiftypvet = document.getElementById('formmodiftypvet');
    formmodiftypvet.style.display="block";
}

//fonction fermeture du formulaire de modification des type de vetement
function fermeformmodiftypeet(){
    btnClick();
    let formmodiftypvet = document.getElementById('formmodiftypvet');
    formmodiftypvet.style.display="none";
}

//fonction d'affichage du type de depense a modifier 
function formodiftypdep(ident){ 
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let contformmodiftypdep = document.getElementById('contformmodiftypdep');
     contformmodiftypdep.innerHTML = xhr.responseText
   }
  }
xhr.open('GET','formodiftypdep.php?ident='+ident);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'insertion des modification d'un type de depense
function insertmodiftypdep(){ 
    btnClick();
    let newnomdep = document.getElementById('newnomdep').value;
    let identypdep = document.getElementById('identypdep').value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let modiftypdep = document.getElementById('modiftypdep');
     modiftypdep.innerHTML = xhr.responseText;
     affichtypdep();
     setTimeout(()=>{
        modiftypdep.innerHTML ='';
     },3000)
   }
  }
xhr.open('POST','insertmodiftypdep.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('newnom='+encodeURI(newnomdep)+'&ident='+encodeURI(identypdep)+'&cookie='+encodeURI(cookie));
}

let formmodiftypdep = document.getElementById('formmodiftypdep');
formmodiftypdep.addEventListener('click',(e)=>{
    e.preventDefault();
})

//fonction d'ouverture du formulaire de modification des type de vetement
function ouvreformmodiftypdep(ident){
    formodiftypdep(ident)
    let formmodiftypdep = document.getElementById('formmodiftypdep');
    formmodiftypdep.style.display="block";
}

//fonction fermeture du formulaire de modification des type de vetement
function fermeformmodiftypdep(){
    btnClick();
    let formmodiftypdep = document.getElementById('formmodiftypdep');
    formmodiftypdep.style.display="none";
}

//fonction d'affichage de la depense a modifier 
function formodifdepense(ident){ 
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let contformmodifdep = document.getElementById('contformmodifdep');
     contformmodifdep.innerHTML = xhr.responseText
   }
  }
xhr.open('GET','formodifdepense.php?ident='+ident);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}


//fonction d'insertion des modification d'une depense
function insertmodifdep(){ 
    btnClick();
    let newtypdepenses = document.getElementById('newtypdepenses').value;
    let newmotif = document.getElementById('newmotif').value;
    let newmontdep = document.getElementById('newmontdep').value;
    let idendep = document.getElementById('idendep').value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let modifdep = document.getElementById('modifdep');
     modifdep.innerHTML = xhr.responseText;
     affichdepenses();
     setTimeout(()=>{
        modifdep.innerHTML ='';
     },3000)
   }
  }
xhr.open('POST','insertmodifdep.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('newtypdep='+encodeURI(newtypdepenses)+'&newmotif='+encodeURI(newmotif)+'&newmontdep='+encodeURI(newmontdep)+'&ident='+encodeURI(idendep)+'&cookie='+cookie);
}

//fonction d'ouverture du formulaire de modification des depense
function ouvreformmodifdep(ident){
    formodifdepense(ident)
    let formmodifdep = document.getElementById('formmodifdep');
    formmodifdep.style.display="block";
}

//fonction fermeture du formulaire de modification des depense
function fermeformmodifdep(){
    btnClick();
    let formmodifdep = document.getElementById('formmodifdep');
    formmodifdep.style.display="none";
}

let formmodifdep = document.getElementById('formmodifdep');
formmodifdep.addEventListener('click',(e)=>{
    e.preventDefault();
})

//fonction d'affichage du type de versement a modifier 
function formodiftypversem(ident){ 
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let contformmodiftypversem = document.getElementById('contformmodiftypversem');
     contformmodiftypversem.innerHTML = xhr.responseText
   }
  }
xhr.open('GET','formodiftypversem.php?ident='+ident);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'insertion des modification du type de versement
function inserttypversem(){ 
    btnClick();
    let newtypversa = document.getElementById('newtypversa').value;
    let idendep = document.getElementById('identypversa').value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let modiftypversem = document.getElementById('modiftypversem');
     modiftypversem.innerHTML = xhr.responseText;
     affichtypeversa();
     setTimeout(()=>{
        modiftypversem.innerHTML ='';
     },3000)
   }
  }
xhr.open('POST','insertmodiftypversem.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('newtypversa='+encodeURI(newtypversa)+'&ident='+encodeURI(idendep)+'&cookie='+encodeURI(cookie));
}


//fonction d'ouverture du formulaire de modification des types de versement
function ouvreformmodiftypversa(ident){
    formodiftypversem(ident)
    let formmodiftypversem = document.getElementById('formmodiftypversem');
    formmodiftypversem.style.display="block";
}

//fonction fermeture du formulaire de modification des types de versement
function fermeformmodiftypversa(){
    btnClick();
    let formmodiftypversem = document.getElementById('formmodiftypversem');
    formmodiftypversem.style.display="none";
}

//fonction d'affichage du versement a modifier 
function formodifversement(ident){ 
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let contformmodifversem = document.getElementById('contformmodifversem');
     contformmodifversem.innerHTML = xhr.responseText
   }
  }
xhr.open('GET','formodifversements.php?ident='+ident);
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'insertion des modification d'un versement
function insertmodifversem(){ 
    btnClick();
    let newtypva = document.getElementById('newtypva').value;
    let newmontversa = document.getElementById('newmontversa').value;
    let identva = document.getElementById('idenversea').value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let modifversem = document.getElementById('modifversem');
     modifversem.innerHTML = xhr.responseText;
     affichetoutvesement();
     setTimeout(()=>{
        modifversem.innerHTML ='';
     },3000)
   }
  }
xhr.open('POST','insertmodifversem.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('newtypva='+encodeURI(newtypva)+'&ident='+encodeURI(identva)+'&newmontversa='+encodeURI(newmontversa)+'&cookie='+encodeURI(cookie));
}


//fonction d'ouverture du formulaire de modification des versement
function ouvreformmodifversa(ident){
    formodifversement(ident)
    let formmodifversem = document.getElementById('formmodifversem');
    formmodifversem.style.display="block";
}

//fonction fermeture du formulaire de modification des versement
function fermeformmodifversa(){
    btnClick();
    let formmodifversem = document.getElementById('formmodifversem');
    formmodifversem.style.display="none";
}

//fonction permettant d'effectuer un report apres une cloture de caisse
function reportcaisse(){ 
    btnClick();
    let montreel = document.getElementById('montreel').value;
    let dateclo = document.getElementById('dateclo').value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let smsclot = document.getElementById('smsclot');
     smsclot.innerHTML = xhr.responseText;
   }
  }
xhr.open('POST','repportcaisse.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('montreel='+encodeURI(montreel)+'&dateclo='+encodeURI(dateclo)+'&cookie='+encodeURI(cookie));
}

//fonction affichage des entrées en caisse 
function affichentrecaisse(){ 
    btnClick();
    let dateclotcais       = document.getElementById('dateentrecais').value;
    let dateentrecaisfin   = document.getElementById('dateentrecaisfin').value;
    let keppressingcaisse  = document.getElementById('keppressingcaisse').value;
    let montInfcaiss       = document.getElementById('montInfcaiss').value;

    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listeetatcais = document.getElementById('listeetatcais');
     listeetatcais.innerHTML = xhr.responseText;
   }
  }
xhr.open('GET','afiichentrecaisse.php?dateclot='+dateclotcais+'&datefinclot='+dateentrecaisfin+'&pressing='+encodeURI(keppressingcaisse)+'&mont='+encodeURI(montInfcaiss));
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'actualisation de l'affichage de la cloture de caisse et la liste des entrees en caisse
function actualiseentrecaisse(){

    let dateclotcais = document.getElementById('dateclotcais').value="";
    let dateentrecais = document.getElementById('dateentrecais').value="";
    affichentrecaisse()
}

//fonction d'affichage des vetements present dans le pressing 
function affichvetpresent(){ 
    const pressing = document.getElementById('selectpressingStock').value;
    let datedepotvetstock = document.getElementById('datedepotvetstock').value;
    btnClick();
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listestock = document.getElementById('listestock');
     listestock.innerHTML = xhr.responseText;
   }
  }
xhr.open('GET','afiichvetpresent.php?datedepotvetstock='+datedepotvetstock+'&pressing='+encodeURI(pressing));
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage des  Vêtements à nettoyer.
function affichvetAlaver(){ 
    btnClick();
    const pressing = document.getElementById('selectpressingStock').value;
    btnClick();
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listestock = document.getElementById('listestock');
     listestock.innerHTML = xhr.responseText;
   }
  }
xhr.open('GET','affichvetAlaver.php?pressing='+encodeURI(pressing));
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage des vetements qui sorte aujourd'hui 
function affichvetsortnow(){ 
    const pressing = document.getElementById('selectpressingStock').value;
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listestock = document.getElementById('listestock');
     listestock.innerHTML = xhr.responseText;
     listAgenceStock('listAgenceStock');
   }
  }
xhr.open('GET','affichvetsortnow.php?id='+encodeURI(pressing));
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage des vetements que la date de sortie est depassé
function affichvetsortdepasse(){ 
    const pressing = document.getElementById('selectpressingStock').value;
    btnClick();
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listestock = document.getElementById('listestock');
     listestock.innerHTML = xhr.responseText;
   }
  }
xhr.open('GET','affichvetsortdepasse.php?pressing='+encodeURI(pressing));
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}


// actualisation du dashbord
function actudashbord(){
    window.location.reload();
}
//-- Actualiser la liste des vetement present au pressing --//
function actulistvetpresent(){
    let datedepotvetstock = document.getElementById('datedepotvetstock').value = '';
    affichvetpresent();
}
//-- Actualiser la liste des depenses au pressing --//
function actulistdepensepressing(){   
    let datedebudep = document.getElementById('datedebudep').value = '';
    let datefindep = document.getElementById('datefindep').value = '';
    affichdepenses();
}

//--- Actualiser la carte de fidelite en vidant les dates
function actucartefidelite(){
    
    let debutrecharcarte = document.getElementById('debutrecharcarte').value = ''; 
    let finrecharcarte = document.getElementById('finrecharcarte').value = '';
    affcartefidel(); 
}

//quel traitement est selectioné(gestion client,gestion compte, ...)
function selectmenu(para){
    let tabbordmenu = document.getElementById('tabbordmenu');
    tabbordmenu.style.textAlign = 'left';
    tabbordmenu.style.color = 'white';
    let gestcompmenu = document.getElementById('gestcompmenu');
    gestcompmenu.style.textAlign = 'left';
    gestcompmenu.style.color = 'white';
    let gestclientmenu = document.getElementById('gestclientmenu');
    gestclientmenu.style.textAlign = 'left';
    gestclientmenu.style.color = 'white';
    let gestvetmenu = document.getElementById('gestvetmenu');
    gestvetmenu.style.textAlign = 'left';
    gestvetmenu.style.color = 'white';
    let geststockmenu = document.getElementById('geststockmenu');
    geststockmenu.style.textAlign = 'left';
    geststockmenu.style.color = 'white';
    let gestdepensemenu = document.getElementById('gestdepensemenu');
    gestdepensemenu.style.textAlign = 'left';
    gestdepensemenu.style.color = 'white';
    let gestdettemenu = document.getElementById('gestdettemenu');
    gestdettemenu.style.textAlign = 'left';
    gestdettemenu.style.color = 'white';
    let gestversemenu = document.getElementById('gestversemenu');
    gestversemenu.style.textAlign = 'left';
    gestversemenu.style.color = 'white';
    let gestsuicaisemenu = document.getElementById('gestsuicaisemenu');
    gestsuicaisemenu.style.textAlign = 'left';
    gestsuicaisemenu.style.color = 'white';
    let gestmessagemenu = document.getElementById('gestmessagemenu');
    gestmessagemenu.style.textAlign = 'left';
    gestmessagemenu.style.color = 'white';
    let gestcartefidelitemenu = document.getElementById('gestcartefidelitemenu');
    gestcartefidelitemenu.style.textAlign = 'left';
    gestcartefidelitemenu.style.color = 'white';
    let rapportmenu = document.getElementById('rapportmenu');
    rapportmenu.style.textAlign = 'left';
    rapportmenu.style.color = 'white';
    let deconnexionmenu = document.getElementById('deconnexionmenu');
    deconnexionmenu.style.textAlign = 'left';
    deconnexionmenu.style.color = 'white';
    let gestoperationmenu = document.getElementById('gestoperationmenu');
    gestoperationmenu.style.textAlign = 'left';
    gestoperationmenu.style.color = 'white';
    let kel = document.getElementById(''+para);
    kel.style.textAlign = 'center';
    kel.style.color = 'rgb(26, 219, 61)';
}

//fonction d'affichage des agences enregistrer
function listAgence(idlist){ 
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listestock = document.getElementById(''+idlist);
     listestock.innerHTML = xhr.responseText;
   }
  }
xhr.open('GET','listAgence.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage des agences pour la gestion de stock
function listAgenceStock(idlist){ 
    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listestock = document.getElementById(''+idlist);
     listestock.innerHTML = xhr.responseText;
   }
  }
xhr.open('GET','listAgenceStock.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage des agences pour les depenses
function typepressingDepense(){ 

    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listestock = document.getElementById('typePressingdepense');
     listestock.innerHTML = xhr.responseText;
   }
  }
xhr.open('GET','typepressingDepense.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage des agences pour les dettes
function typepressingDette(){ 

    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listestock = document.getElementById('typePressingdette');
     listestock.innerHTML = xhr.responseText;
     
   }
  }
xhr.open('GET','typepressingDette.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//fonction d'affichage des agences pour les versements
function typepressingVersement(){ 

    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listestock = document.getElementById('keppressingVersement');
     listestock.innerHTML = xhr.responseText;
   }
  }
xhr.open('GET','typepressingVersement.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

function QuelPressingGestStock(id){
    document.getElementById('selectpressingStock').value = id;
}

//fonction d'affichage des agences pour la caisse
function typepressingCaisse(){ 

    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listestock = document.getElementById('keppressingcaisse');
     listestock.innerHTML = xhr.responseText;
     affichclotcais();
   }
  }
xhr.open('GET','typepressingVersement.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}
//fonction d'affichage des agences pour le rapport depot vet
function typepressingrapport(id){ 

    if(window.XMLHttpRequest){
       //Mozilla, safari, IE7+...
       xhr = new XMLHttpRequest();
   }else if(window.ActiveXObject){
       //IE 6 et anterieurs
       xhr = new ActiveXObject("Microsoft.XMLHTTP");
   }
   xhr.onreadystatechange = function (){
   if(xhr.readyState == 4 && xhr.status == 200){
     let listestock = document.getElementById(''+id);
     listestock.innerHTML = xhr.responseText;
     if(id=='keppressingRapportvetdepot'){
        rapportlistevet();
     }
     if(id == 'keppressingRapportvetsort'){
        rapportlistevetsort();
     }
     if(id == 'keppressingRapportdepense'){
        rapportlistedepense();
     }
     if(id == 'keppressingRapportfacture'){
        rapportlistefacture();
     }
     if(id == 'keppressingRapportregle'){
        rapportlistedette();
     }
     if(id == 'keppressingRapportversement'){
        rapportaffichverse();
     }
     if(id == 'keppressingRapportCAclient'){
        rapportlistechcl();
     }
     if(id == 'keppressingRapportCAvet'){
        rapportlistechvet();
     }
     if(id == 'keppressingRapportclotcaisse'){
        rapportlisteclotcais();
     }
     if(id == 'keppressingRapportvetback'){
        rapportlistevetback();
     }
   }
  }
xhr.open('GET','typepressingVersement.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send();
}

//envoi des message aux utilisateurs qui retire leurs vetement aujourd'hui
function smsvetsortnow(){
    let selectmsgallnow = document.getElementById('msgallnow');
    let msgallnow = selectmsgallnow.value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let resultnewclient = document.getElementById('resultnewsmssortnow');
         resultnewclient.innerHTML=xhr.responseText;
       /*  setTimeout(function(){
             resultnewclient.innerHTML='';

         },3000);*/
         let re=resultnewclient.innerHTML;
/*          if(re == '<div class="alert alert-success" role="alert" style="font-size:12px">Nouveau client enregistré</div>'){
                 selectnomcl.value='';
                 selecttelephonecl.value='';
         } */
      
    }
   }
xhr.open('POST','smsvetsortnow.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('msgallnow='+msgallnow +'&cookie='+cookie);

}
//envoi des message aux utilisateurs que la date de retrait est depassé
function smsvetretraitdepasse(){
    let selectmsgallnow = document.getElementById('msgretraitdepasse');
    let msgallnow = selectmsgallnow.value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let resultnewclient = document.getElementById('resultnewsmsretraitdepasse');
         resultnewclient.innerHTML=xhr.responseText;
       /*  setTimeout(function(){
             resultnewclient.innerHTML='';

         },3000);*/
         let re=resultnewclient.innerHTML;
/*          if(re == '<div class="alert alert-success" role="alert" style="font-size:12px">Nouveau client enregistré</div>'){
                 selectnomcl.value='';
                 selecttelephonecl.value='';
         } */
      
    }
   }
xhr.open('POST','smsvetretraitdepasse.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('msgallnow='+msgallnow +'&cookie='+cookie);

}

//fonction d'affichage des clients pour l'envoi des message
function clientnewsms(){
    let searchclcarte = document.getElementById('searchclsms').value;
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let choixclcart = document.getElementById('choixclsms');
        choixclcart.innerHTML=xhr.responseText;
    }
   }
 xhr.open('GET','clientnewsms.php?nom='+searchclcarte);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}

//fonction de recuperation de l'ident du client choisi
function kelclsms(para){
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
 
    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
        let codeclcarte = document.getElementById('codeclsms');
        codeclcarte.value=para;
    }
   }
   xhr.open('GET','clientnewsms.php?nom='+searchclcarte);
 xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
 xhr.send();
}

//envoi des message aux utilisateurs que la date de retrait est depassé
function sendSMSOneClient(){
    let selectcodeclsms = document.getElementById('codeclsms');
    let codeclsms = selectcodeclsms.value;
    let selectsmsCl = document.getElementById('smsCl');
    let smsCl = selectsmsCl.value;
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieurs
        xhr = new ActiveXObject("Microsoft.XMLHTTP");

    }
    xhr.onreadystatechange = function (){
    if(xhr.readyState == 4 && xhr.status == 200){
         let resultnewclient = document.getElementById('smsnewsmscl');
         resultnewclient.innerHTML=xhr.responseText;
       /*  setTimeout(function(){
             resultnewclient.innerHTML='';

         },3000);*/
         let re=resultnewclient.innerHTML;
/*          if(re == '<div class="alert alert-success" role="alert" style="font-size:12px">Nouveau client enregistré</div>'){
                 selectnomcl.value='';
                 selecttelephonecl.value='';
         } */
      
    }
   }
xhr.open('POST','sendSMSOneClient.php');
xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
xhr.send('codeclsms='+codeclsms +'&cookie='+cookie+'&smsCl='+smsCl);

}

function afficheMessageSend(){
  
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
         let affichvet = document.getElementById('toutsms');
         affichvet.innerHTML=xhr.responseText;

    }}
    xhr.open('GET','afficheMessageSend.php');
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}

function synchronisation(){
    let cookie = localStorage.getItem('login');
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){

    }}
    xhr.open('GET','synchronisation/synchronisation.php?cookie='+encodeURI(cookie));
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}

// affiche le block pour la gestion du personnel
function affichblockGestpersonnel(idCompte){
    document.getElementById('idCompGest').value = idCompte;
    document.getElementById('blockpersonnel').style.display = 'block';
  
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById('personnelBody').innerHTML = xhr.responseText;
            affichformPaieEmploye();
    }}
    xhr.open('GET','affichblockGestpersonnel.php');
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}
// affiche le formulaire de paiement d'un employé
function affichformPaieEmploye(){
    var idcompte = document.getElementById('idCompGest').value; 
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){

            let iframe = document.getElementById('contentElemetGestPersonnel'); 
            iframe.onload = function () { 
                 let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
                 let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
                 listevetentre.innerHTML = xhr.responseText;
             }; 
             iframe.src = 'iframeFormPaie.php'; // Actualise l'iframe en réassignant sa source

    }}
    xhr.open('GET','affichformPaieEmploye.php?idcompte='+idcompte);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}

// insertion des salaire des employé
function insertPaieEmploye(userid){
    const debutdate = document.getElementById('datedebutpaie').value;
    const agenceEmployer = document.getElementById('agenceEmployer').value;
    const datefinpaie = document.getElementById('datefinpaie').value;
    const salaireEmplMontverse = document.getElementById('salaireEmplMontverse').value;
    let cookie = localStorage.getItem('login');
    btnClick();
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById('responseRequest').innerHTML = xhr.responseText;
            setTimeout(() => {
                document.getElementById('responseRequest').innerHTML = '';
            }, 10000);

    }}
    let form = new FormData();
    form.append('debutdate',debutdate);
    form.append('agenceEmployer',agenceEmployer);
    form.append('datefinpaie',datefinpaie);
    form.append('salaireEmplMontverse',salaireEmplMontverse);
    form.append('userid',userid);
    form.append('cookie',cookie);
    xhr.open('POST','insertPaieEmploye.php');
   // xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(form);

}

// affiche le dossier d'un employer
function affichdossierEmploye(){
    var idcompte = document.getElementById('idCompGest').value; 
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){

            let iframe = document.getElementById('contentElemetGestPersonnel'); 
            iframe.onload = function () { 
                 let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
                 let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
                 listevetentre.innerHTML = xhr.responseText;
             }; 
             iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source

    }}
    xhr.open('GET','affichdossierEmploye.php?idcompte='+idcompte);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}
// affiche la fiche de paie d'un employé
function affichPaieEmploye(){
    

    var idcompte = document.getElementById('idCompGest').value; 

    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
        

            let iframe = document.getElementById('contentElemetGestPersonnel'); 
            iframe.onload = function () { 
                 let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
                 let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
                 listevetentre.innerHTML = xhr.responseText;
             }; 
             iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source    
             affichBodyPaieEmploye();
            
    }}
    xhr.open('GET','affichPaieEmploye.php?idcompte='+idcompte);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}
// affiche le contrat de travail
function affichContratEmploye(){
    

    var idcompte = document.getElementById('idCompGest').value; 

    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
        

            let iframe = document.getElementById('contentElemetGestPersonnel'); 
            iframe.onload = function () { 
                 let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
                 let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
                 listevetentre.innerHTML = xhr.responseText;
             }; 
             iframe.src = 'printRapport.php'; // Actualise l'iframe en réassignant sa source    
            
            
    }}
    xhr.open('GET','affichContratEmploye.php?idcompte='+idcompte);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}
// affiche le corps de la fiche de paie d'un employé
function affichBodyPaieEmploye(){
    btnClick();
    var idcompte = document.getElementById('idCompGest').value; 
    var datefinfiche = document.getElementById('datefinfiche').value; 
    var datedebutfiche = document.getElementById('datedebutfiche').value; 
console.log(idcompte);

    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
                document.getElementById('contentPaiement').innerHTML = xhr.responseText;
            
    }}
    xhr.open('GET','affichBodyPaieEmploye.php?idcompte='+idcompte+'&datefin='+datefinfiche+'&datedebut='+datedebutfiche);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}
// supprimer un paiement
function DropPaieEmploye(idSalaire){
    let cookie = localStorage.getItem('login');
    btnClick();
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
            affichBodyPaieEmploye();

    }}
    xhr.open('GET','DropPaieEmploye.php?id='+idSalaire+'&cookie='+cookie);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}

// affiche la fiche de paie de tous les employés
function affichAllPaieEmploye(){
    
    document.getElementById('blockFichAllpersonnel').style.display='block'; 
    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
            let iframe = document.getElementById('AllpersonnelBody'); 
            iframe.onload = function () { 
                 let iframeDocument = iframe.contentDocument || iframe.contentWindow.document; 
                 let listevetentre = iframeDocument.getElementById('contentPrintRapport'); 
                 listevetentre.innerHTML = xhr.responseText;
             }; 
             iframe.src = 'printRapport.php';
            affichBodyAllPaieEmploye();
            
    }}
    xhr.open('GET','affichAllPaieEmploye.php');
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}

// affiche le corps de la fiche de paie de tous les employés
function affichBodyAllPaieEmploye(){
    btnClick();
    var datefinfiche = document.getElementById('datefinAllfiche').value; 
    var datedebutfiche = document.getElementById('datedebutAllfiche').value; 

    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById('contentAllPaiement').innerHTML = xhr.responseText;

    }}
    xhr.open('GET','affichBodyAllPaieEmploye.php?datefin='+datefinfiche+'&datedebut='+datedebutfiche);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}
// affiche la liste des opérations effectuer
function affichOperationEffectuees(){
    btnClick();
    var datefin = document.getElementById('datefinoperation').value; 
    var datedebut = document.getElementById('datedebutoperation').value; 

    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById('lisoperation').innerHTML = xhr.responseText;

    }}
    xhr.open('GET','affichOperationEffectuees.php?datefin='+datefin+'&datedebut='+datedebut);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send();

}

// modification du mot de passe
function updatePassword(){
    btnClick();
    var AncienPasse = document.getElementById('AncienPasse').value; 
    var newPass     = document.getElementById('newPass').value; 
    var confirmPass = document.getElementById('confirmPass').value; 
    let cookie      = localStorage.getItem('login');

    if(window.XMLHttpRequest){
        //Mozilla, safari, IE7+...
        xhr = new XMLHttpRequest();
    }else if(window.ActiveXObject){
        //IE 6 et anterieur
        xhr = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xhr.onreadystatechange = function (){
        if(xhr.readyState == 4 && xhr.status == 200){
            document.getElementById('resultupdatepassword').innerHTML = xhr.responseText;

    }}
    var form = new FormData();
    form.append('AncienPasse', AncienPasse);
    form.append('newPass', newPass);
    form.append('confirmPass', confirmPass);
    form.append('cookie', cookie);

    xhr.open('POST','updatePassword.php');
    //xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send(form);

}