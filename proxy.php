<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET");

$url = $_GET['url'];
if (!$url) die("URL Belirtilmedi");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/123.0.0.0 Safari/537.36');
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
$res = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

// Eğer sonuç bir playlist ise içindeki linkleri senin sitene yönlendirir
if (strpos($res, '#EXTM3U') !== false) {
    header("Content-Type: application/vnd.apple.mpegurl");
    
    // Orijinal URL'nin ana dizinini bul (parçalar için)
    $baseUrl = substr($url, 0, strrpos($url, '/') + 1);
    
    $lines = explode("\n", $res);
    $output = "";
    
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line && $line[0] !== '#' && !filter_var($line, FILTER_VALIDATE_URL)) {
            // Göreli linkleri (segment1.ts gibi) tam linke çevir ve proxy'e sok
            $output .= "proxy.php?url=" . urlencode($baseUrl . $line) . "\n";
        } elseif (filter_var($line, FILTER_VALIDATE_URL)) {
            // Tam linkleri proxy'e sok
            $output .= "proxy.php?url=" . urlencode($line) . "\n";
        } else {
            $output .= $line . "\n";
        }
    }
    echo $output;
} else {
    // Eğer sonuç video parçasıysa (ts dosyası) olduğu gibi ver
    header("Content-Type: " . $info['content_type']);
    echo $res;
}
?>
