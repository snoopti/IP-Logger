<?php
function getDeviceFromUserAgent($userAgent)
{
    $devices = array(
        'iPhone' => 'iPhone',
        'iPad' => 'iPad',
        'Android' => 'Android',
        'Windows Phone' => 'Windows Phone',
        'Windows' => 'Windows',
        'Macintosh' => 'Macintosh',
        'Linux' => 'Linux'
    );

    foreach ($devices as $device => $keyword) {
        if (strpos($userAgent, $keyword) !== false) {
            return $device;
        }
    }

    return '?';
}
function getCountryFromIP($userIP)
{
    $apiURL = "http://ip-api.com/json/$userIP";
    $response = file_get_contents($apiURL);
    if ($response !== false) {
        $result = json_decode($response, true);
        if ($result && $result['status'] === 'success') {
            return $result['country'];
        }
    }
    return '?';
}
$userIP = $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'];
$currentPage = $_SERVER['REQUEST_URI'];
$device = getDeviceFromUserAgent($userAgent);
$country = getCountryFromIP($_SERVER['REMOTE_ADDR']);

$webhookURL = 'YOUR-WEBHOOK-URL'; // replace with your webhookurl

$message = [
    "content" => "",
    "embeds" => [
        [
            "title" => "",
            "color" => hexdec("800080"),
            "fields" => [

                [
                    "name" => "🌐 IP",
                    "value" => $userIP,
                    "inline" => false
                ],
                [
                    "name" => "🌍 Country",
                    "value" => $country,
                    "inline" => true
                ],
                [
                    "name" => "💻 Device",
                    "value" => $device,
                    "inline" => true
                ],
                [
                    "name" => "📄 Page",
                    "value" => $currentPage,
                    "inline" => true
                ]

            ],
            "timestamp" => date("c")
        ]
    ]
];

$dataEncoded = json_encode($message);

$ch = curl_init($webhookURL);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $dataEncoded);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    exit();
} else {
    exit();
}
