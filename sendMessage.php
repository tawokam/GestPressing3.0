<?php

function sendBulkSms($phone, $message) {
try {
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
"sender" => "STARPRESSING",
"recipient" => "+237" . $phone,
"text" => $message
)),
CURLOPT_HTTPHEADER => array(
'Content-Type: application/json'
),
));

$response = curl_exec($curl);

if ($response === false) {
echo 'Erreur cURL : ' . curl_error($curl);
} else {
$responseData = json_decode($response, true);
if ($responseData['status'] == 'success') {
echo 'Message envoyé avec succès !';
} else {
echo 'Erreur : ' . $response;
}
}
} catch(Exception $ex) {
echo $ex;
} 
}

?>