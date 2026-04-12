<?php
header("Access-Control-Allow-Origin: *");
$url = $_GET['url'];
if (!$url) die("URL Yok");

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
// ÖNEMLİ: Render'ın yavaş kalmaması için buffer'ı kapatıyoruz
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);

$res = curl_exec($ch);
$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
curl_close($ch);

header("Content-Type: " . $contentType);
echo $res;
?>
