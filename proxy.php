<?php
/**
 * MAÇTV Gelişmiş PHP Proxy Motoru
 * CORS ve Mixed Content engellerini aşmak için tasarlanmıştır.
 */

error_reporting(0);
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");

$targetUrl = $_GET['url'];

if (!$targetUrl) {
    header("HTTP/1.1 400 Bad Request");
    echo "Hata: URL belirtilmedi.";
    exit;
}

// Tarayıcı gibi görünmek için User-Agent
$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $targetUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // SSL hatalarını yoksay
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

// Referer bilgisini temizle (Bazı yayıncılar referer kontrolü yapar)
curl_setopt($ch, CURLOPT_REFERER, '');

$response = curl_exec($ch);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode == 200) {
    header("Content-Type: " . $contentType);
    echo $response;
} else {
    header("HTTP/1.1 404 Not Found");
    echo "Yayın çekilemedi. Hata kodu: " . $httpCode;
}
?>
