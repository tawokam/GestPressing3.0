<?php

// vérifi si l'utilisateur connecter est un admin ou un simple user
if(isset($_COOKIE["typecompte"]))
{
    if($_COOKIE["typecompte"] == 'admin') 
    {
        $server = "mysql:host=127.0.0.1";
        $bd     = "pressingline";
        $util   = "root";
        $mtp    = "";
        $connec = new PDO("$server;dbname=$bd","$util","$mtp");//echo '<option>1</option>';
    } 
    else if($_COOKIE["typecompte"] == 'simple')
    {
        $server = "mysql:host=127.0.0.1";
        $bd     = "pressing2";
        $util   = "root";
        $mtp    = "";
        $connec = new PDO("$server;dbname=$bd","$util","$mtp");//echo '<option>2</option>';
    }
}
else
{
    // verifions si la machine est connecté : si oui connexion recupere les pressing en ligne dans le cas contraire les pressing local
    function isConnected() 
    {  
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, "http://www.google.com");  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5); // Timeout de 5 secondes  
        $result = curl_exec($ch);  
        curl_close($ch);  
        
        return $result !== false;  
    }  
    
    $result = isConnected();
    if ($result) 
    {
        //La machine est connectée à Internet.
        $server = "mysql:host=127.0.0.1";
        $bd     = "pressingline";
        $util   = "root";
        $mtp    = "";
        $connec = new PDO("$server;dbname=$bd","$util","$mtp");
    }
    else
    {
        //La machine n'est pas connectée à Internet.
        $server = "mysql:host=127.0.0.1";
        $bd     = "pressing2";
        $util   = "root";
        $mtp    = "";
        $connec = new PDO("$server;dbname=$bd","$util","$mtp");
    } 
       
}


?>