<?php


if(!empty($_POST)){
$name = $_POST["name"] ;
$bundle = $_POST["bundle"] ;
$version = $_POST["version"] ;
$img = $_POST["img"] ;
$size = $_POST["size"] ;



$token = "6070404431:AAEbzAjTahmSzejsHL5nKuiBQeRZPsc2guA";
$chat_id = "1676064047";


$caption = "new app uploaded :

name : $name

bundle : $bundle

version : $version

size : $size

";

// Create the URL for sending the image
$url = "https://api.telegram.org/bot" . $token . "/sendPhoto";

// Use cURL to send the image
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
    "chat_id" => $chat_id,
    "photo" => new CURLFile($img),
    "caption" => $caption,
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
curl_close($ch);

// Output the result
echo $result;




}


?>
