<?php

function sendBulkSms($phone, $message) {
    /* try {
        curl --location 'https://api.avlytext.com/v1/sms?api_key=dMoSJgddqOQyB1tir3cnk5jm2eDNr0u0jsbgpvZ8Knwd58ZDU1FlSTClJgaZupwr4K00'
         $url = 'https://api.camoo.cm/v1/sms.json'; 
        $data '{
            "sender": "MyApp",
            "recipient": "+237699224477",
            "text": "This is a test message."
        }'
         $data = [
        'from' => 'Groupe Star.SARL',
        'to' => $phone, // Convertir le tableau en chaîne de caractères séparée par des virgules
        'message' => $message,
        'api_key' => '36ce6d30a0563a',
        'api_secret' => '4d1049156ee4cff0e35cf31e4f8ebe9b7dbe6b785c998b1563b8df31239eaacd'
        ]; 
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        
        $result = curl_exec($ch);
        curl_close($ch);
        
        return $result;
        
    } catch (Exception $ex) {
        throw new Exception($ex);
    } */


    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://api.avlytext.com/v1/sms?api_key=cVU2NU7fQofFIdkmdEwi5jhUY6FAyiiOWJxvO6Kmi2Uy1ZK1yXk9kuaAN5Qn65PtpnM1',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>'{
        "sender": "MyApp",
        "recipient": "+237699388115",
        "text": "This is a test message."
    }',
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    echo $response;
    
} 
?>
<!--  \
--header 'Content-Type: application/json' \
--data '{
    "sender": "MyApp",
    "recipient": "+237699224477",
    "text": "This is a test message."
}' -->