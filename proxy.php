<?php
/**
 * MAÇTV Profesyonel Proxy Motoru
 */

error_reporting(0);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Content-Security-Policy: upgrade-insecure-requests");

$targetUrl = $_GET['url'];

if (!$targetUrl) {
    die("Hata: URL belirtilmedi.");
}

$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $targetUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
curl_setopt($ch, CURLOPT_REFERER, 'https://www.tabii.com/');

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200) {
    // Tarayıcıyı videoyu oynatmaya zorlayan başlıklar
    header("Content-Type: application/vnd.apple.mpegurl");
    header("Cache-Control: no-cache");
    echo $response;
} else {
    header("HTTP/1.1 404 Not Found");
    echo "Yayın çekilemedi. Kod: " . $httpCode;
}
?>
