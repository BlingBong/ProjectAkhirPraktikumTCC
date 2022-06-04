<?php
$data = array(
    'username' => $_POST["username"],
    'password' => $_POST["password"]
);

$payload = json_encode($data);

$ch = curl_init('http://192.168.236.128:3000/register');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);

curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($payload)
    )
);

$result = json_decode(curl_exec($ch), true);
curl_close($ch);
if($result['status']){
    header("Location: index.php");
}
else{
    echo "Register Failed";
}
