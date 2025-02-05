<?php

function sendBulkSms($phone, $message) {
    try {
        // Vérifiez que le numéro de téléphone et le message ne sont pas vides
        if (empty($phone)) {
            throw new Exception('Le numéro de téléphone ne doit pas être vide.');
        }
        if (empty($message)) {
            throw new Exception('Le message ne doit pas être vide.');
        }

        // Vérifiez que le numéro de téléphone est au format correct
        if (!preg_match('/^\+237[0-9]{9}$/', "+237" . $phone)) {
            throw new Exception('Le numéro de téléphone doit être au format +237XXXXXXXXX.');
        }

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
            CURLOPT_POSTFIELDS => json_encode(array(
                "sender" => "STARPRESSIN",
                "recipient" => "+237" . $phone,
                "text" => $message
            )),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        if ($response === false) {
           // echo 'Erreur cURL : ' . curl_error($curl);
        } else {
            // Vérifiez si la réponse est un JSON valide
            $responseData = json_decode($response, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                return $responseData;
            } else {
                // La réponse n'est pas un JSON valide, retournez le texte brut
                return $response;
            }
        }

        curl_close($curl);
    } catch(Exception $ex) {
       // return 'Exception : ' . $ex->getMessage();
    }
}


?>
