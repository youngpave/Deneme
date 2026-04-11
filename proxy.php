<?php
/**
 * MAÇTV Gelişmiş PHP Proxy Motoru - Debug Versiyon
 */

error_reporting(E_ALL); // Hataları görmemiz için açtık
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");

$targetUrl = $_GET['url'];

if (!$targetUrl) {
    header("HTTP/1.1 400 Bad Request");
    echo "Hata: URL belirtilmedi.";
    exit;
}

// Modern ve gerçekçi bir User-Agent
$userAgent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $targetUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 15); // Zaman aşımını biraz kısalttık
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);

// ÖNEMLİ: Tabii ve bazı IPTV'ler Referer ister
curl_setopt($ch, CURLOPT_REFERER, 'https://www.tabii.com/');

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);

// Eğer cURL hata verirse detayını yazdır
if (curl_errno($ch)) {
    $error_msg = curl_error($ch);
    curl_close($ch);
    die("cURL Hatası: " . $error_msg);
}

curl_close($ch);

if ($httpCode == 200) {
    // Yayın m3u8 ise başlığı doğru set et
    if (strpos($targetUrl, '.m3u8') !== false) {
        header("Content-Type: application/vnd.apple.mpegurl");
    } else {
        header("Content-Type: " . $contentType);
    }
    echo $response;
} else {
    header("HTTP/1.1 $httpCode Not Found");
    echo "Yayın çekilemedi. Sunucu Yanıtı: " . $httpCode;
    echo "<br>Denenen URL: " . htmlspecialchars($targetUrl);
}
?>
