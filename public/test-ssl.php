<?php
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://www.google.com");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);  // Mengaktifkan verifikasi SSL
curl_setopt($ch, CURLOPT_CAINFO, "C:/xampp/php/cacert.pem"); // Pastikan path ke cacert.pem benar

$response = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'CURL Error: ' . curl_error($ch);
} else {
    echo 'Connection Success!';
}

curl_close($ch);
?>
