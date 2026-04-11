<?php
header("Access-Control-Allow-Origin: *");
$url = $_GET['url'];
if (!$url) die("URL Yok");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/120.0.0.0 Safari/537.36');
$res = curl_exec($ch);
$info = curl_getinfo($ch);
curl_close($ch);

// Eğer bu bir m3u8 dosyasıysa, içindeki linkleri de proxy'e sokalım
if (strpos($url, '.m3u8') !== false) {
    header("Content-Type: application/vnd.apple.mpegurl");
    $base = substr($url, 0, strrpos($url, '/') + 1);
    
    // Satırları tara, linkleri bul ve proxy.php?url=... formatına çevir
    $res = preg_replace_callback('/^(?!#)(.+)$/m', function($m) use ($base) {
        $link = trim($m[1]);
        if (!filter_var($link, FILTER_VALIDATE_URL)) {
            $link = $base . $link;
        }
        return "proxy.php?url=" . urlencode($link);
    }, $res);
} else {
    header("Content-Type: " . $info['content_type']);
}

echo $res;
?>
