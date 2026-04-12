<?php
/**
 * MAÇTV Android & Xiaomi Uyumlu Full Proxy
 */

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");

$url = $_GET['url'];
if (!$url) die("URL Belirtilmedi");

// Android/Chrome gibi davranalım
$userAgent = 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/123.0.0.0 Mobile Safari/537.36';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
$res = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

// Eğer bu bir playlist (M3U8) ise içeriği düzenle
if (strpos($res, '#EXTM3U') !== false) {
    header("Content-Type: application/vnd.apple.mpegurl");
    
    // Orijinal URL'nin ana dizini (Göreli linkler için)
    $baseUrl = substr($url, 0, strrpos($url, '/') + 1);
    
    $lines = explode("\n", $res);
    $newContent = "";
    
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line && $line[0] !== '#' && !filter_var($line, FILTER_VALIDATE_URL)) {
            // "segment1.ts" gibi kısa linkleri proxy.php?url=... formatına sok
            $newContent .= "proxy.php?url=" . urlencode($baseUrl . $line) . "\n";
        } elseif (filter_var($line, FILTER_VALIDATE_URL)) {
            // "http://.../seg.ts" gibi tam linkleri proxy.php'ye sok
            $newContent .= "proxy.php?url=" . urlencode($line) . "\n";
        } else {
            $newContent .= $line . "\n";
        }
    }
    echo $newContent;
} else {
    // Eğer bu bir video parçasıysa (ts) ham halini ve doğru tipini gönder
    header("Content-Type: " . ($info['content_type'] ?: "video/mp2t"));
    echo $res;
}
?>
