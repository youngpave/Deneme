<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover">
    <title>MAÇTV | VIP Panel</title>
    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
    <style>
        :root { --bg: #05070a; --card: #121620; --blue: #2563eb; --gray: #94a3b8; --tg-color: #0088cc; }
        html, body { background: var(--bg); color: white; font-family: -apple-system, sans-serif; margin: 0; padding: 0; height: 100%; overflow: hidden; }

        .top-bar {
            width: 100%; height: 50px; background: var(--card); display: flex; align-items: center; justify-content: space-between;
            padding: 0 15px; box-sizing: border-box; border-bottom: 1px solid rgba(255,255,255,0.1);
            position: fixed; top: 0; z-index: 2000; padding-top: env(safe-area-inset-top); height: calc(50px + env(safe-area-inset-top));
        }

        .brand { font-weight: 800; letter-spacing: 1px; color: white; font-size: 18px; }
        .brand span { color: var(--blue); }

        .tg-button {
            background: var(--tg-color); color: white; text-decoration: none; padding: 6px 12px;
            border-radius: 8px; font-size: 12px; font-weight: bold; display: flex; align-items: center; gap: 6px;
        }

        #player-container { 
            width: 100%; background: #000; position: fixed; top: calc(50px + env(safe-area-inset-top)); 
            z-index: 1000; display: flex; justify-content: center;
        }

        @media (max-width: 1023px) { #player-container { aspect-ratio: 16 / 9; } }
        @media (min-width: 1024px) { #player-container { height: 400px; } }
        
        .video-js { width: 100% !important; height: 100% !important; }
        iframe { width: 100%; height: 100%; border: none; display: none; background: #000; }
        
        .container { height: 100vh; overflow-y: auto; padding: 15px; box-sizing: border-box; -webkit-overflow-scrolling: touch; }

        @media (max-width: 1023px) { .container { padding-top: calc(56.25vw + 60px + env(safe-area-inset-top)); } }
        @media (min-width: 1024px) { .container { padding-top: calc(460px + env(safe-area-inset-top)); max-width: 800px; margin: 0 auto; } }

        .ch-card { 
            background: var(--card); display: flex; align-items: center; padding: 14px; 
            border-radius: 12px; margin-bottom: 8px; cursor: pointer; border: 1px solid rgba(255,255,255,0.05);
        }
        .icon { 
            width: 38px; height: 38px; background: linear-gradient(135deg, var(--blue), #1e40af); 
            border-radius: 8px; margin-right: 12px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 11px;
        }
        .info { flex: 1; }
        .title { display: block; font-size: 14px; font-weight: 600; }
        .tag { font-size: 9px; color: var(--gray); text-transform: uppercase; }
    </style>
</head>
<body>

    <div class="top-bar">
        <div class="brand">MAÇ<span>TV</span></div>
        <a href="https://t.me/wlsXVcZCSKw2MmI0" target="_blank" class="tg-button">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="white"><path d="M12 0C5.373 0 0 5.373 0 12s5.373 12 12 12 12-5.373 12-12S18.627 0 12 0zm5.894 8.221l-1.97 9.28c-.145.658-.537.818-1.084.508l-3-2.21-1.446 1.394c-.14.14-.303.26-.546.26l.184-2.85 5.236-4.72c.227-.203-.045-.316-.35-.116l-6.47 4.072-2.764-.864c-.6-.19-.614-.6.126-.888l10.798-4.162c.5-.184.937.114.81.806z"/></svg>
            KATIL
        </a>
    </div>

    <div id="player-container">
        <video id="my-video" class="video-js vjs-big-play-centered" controls preload="auto" playsinline webkit-playsinline></video>
        <iframe id="external-frame" allowfullscreen></iframe>
    </div>

    <div class="container">
        <div id="channel-list"></div>
    </div>

    <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
    <script>
        const videoPlayer = videojs('my-video');
        const iframe = document.getElementById('external-frame');
        const videoElement = document.getElementById('my-video');
        
        const channels = [
            { name: "BEIN SPORTS HABER", url: "https://www.canlitv.diy/player/iframe.php?url=https://www.youtube.com/embed/i7UpPgxfZZ8" },
            { name: "BEIN SPORTS 1 HD", url: "https://virazo.sx/ch?id=91" },
            { name: "BEIN SPORTS 1 Yedek HD", url: "https://selcuksports179.top/matches?id=bein-sports-1" },
            { name: "BEIN SPORTS 1 Yedek 2", url: "https://zonalive.click/player/33/151" },
            { name: "BEIN SPORTS 2 HD", url: "https://zonalive.click/player/33/152" },
            { name: "BEIN SPORTS 2 Yedek", url: "https://selcuksports179.top/matches?id=bein-sports-2" },
            { name: "BEIN SPORTS 3 HD", url: "https://antenasport.org/beinsport3tr.php" },
            { name: "BEIN SPORTS 3 Yedek", url: "https://selcuksports179.top/matches?id=bein-sports-3" },
            { name: "BEIN SPORTS 4", url: "https://api.codetabs.com/v1/proxy/?quest=https://andro.okan11gote12sokan.cfd/checklist/androstreamlivedebs4.m3u8" },
            { name: "BEIN SPORTS 5", url: "https://api.codetabs.com/v1/proxy/?quest=https://andro.okan11gote12sokan.cfd/checklist/androstreamlivdeebs5.m3u8" },
            { name: "BEIN SPORTS MAX 1", url: "https://selcuksports179.top/matches?id=bein-sports-max-1" },
            { name: "BEIN SPORTS MAX 2", url: "https://selcuksports179.top/matches?id=bein-sports-max-2" },
            { name: "SKY SPORTS", url: "https://streamcrichd.com/update/skyf1.php" },
            { name: "DAZN 1", url: "https://la14hd.com/vivo/canales.php?stream=dazn1" },
            { name: "TNT SPOR 1", url: "https://streamcrichd.com/update/bt1.php" },
            { name: "TNT SPOR 2", url: "https://streamcrichd.com/update/bt2.php" },
            { name: "TİVİBU SPOR 1", url: "https://api.codetabs.com/v1/proxy/?quest=https://andro.okan11gote12sokan.cfd/checklist/androstreamlivedets1.m3u8" },
            { name: "TİVİBU SPOR 2", url: "https://api.codetabs.com/v1/proxy/?quest=https://andro.okan11gote12sokan.cfd/checklist/androstreamlivedets2.m3u8" },
            { name: "TİVİBU SPOR 3", url: "https://api.codetabs.com/v1/proxy/?quest=https://andro.okan11gote12sokan.cfd/checklist/androstreamlivedets3.m3u8" },
            { name: "TİVİBU SPOR 4", url: "https://api.codetabs.com/v1/proxy/?quest=https://andro.okan11gote12sokan.cfd/checklist/androstreamlivedets4.m3u8" },
            { name: "S SPORT", url: "https://api.codetabs.com/v1/proxy/?quest=https://andro.okan11gote12sokan.cfd/checklist/androstreamlivedess1.m3u8" },
            { name: "S SPORT 2", url: "https://api.codetabs.com/v1/proxy/?quest=https://andro.okan11gote12sokan.cfd/checklist/androstreamlivedess2.m3u8" },
            { name: "TV8.5", url: "https://rkhubpaomb.turknet.ercdn.net/fwjkgpasof/tv8bucuk/tv8bucuk.m3u8" },
            { name: "TRT SPOR", url: "https://tv-trtspor1.medya.trt.com.tr/master_1080.m3u8" },
            { name: "TABİİ SPOR", url: "https://hlsssssss.amgtmeme.workers.dev/https://corestream.ronaldovurdu.help//hls/tabii.m3u8" },
            { name: "TABİİ SPOR Yedek", url: "https://75betorspintv.live/channel?id=ex7" },
            { name: "TABİİ SPOR 1", url: "https://Pz4qT7nW1mR9sH2vL5xK8jG3y.medya.trt.com.tr/master_1440p.m3u8" },
            { name: "TABİİ SPOR 1 Yedek", url: "https://75betorspintv.live/channel?id=ex1" },
            { name: "TABİİ SPOR 2", url: "https://mr8bv4kl1nq7sh9tw2xp5zj6g.medya.trt.com.tr/master_1440p.m3u8" },
            { name: "TABİİ SPOR 3", url: "https://mr4vl7nq2sh9tw5xp1zk3gj8b.medya.trt.com.tr/master_1440p.m3u8" },
            { name: "TABİİ SPOR 4", url: "https://sh7tq2nw5mr1vl9xp4zk3gj8k.medya.trt.com.tr/master_1440p.m3u8" },
            { name: "TABİİ SPOR 5", url: "https://z3mmimwz148csv0vaxtphqspf.medya.trt.com.tr/master_1080p.m3u8" },
            { name: "TABİİ SPOR 6", url: "https://nw5mr1vl9xp4zk2sh7tq3gj6b.medya.trt.com.tr/master_1440p.m3u8" }
        ];

        function playChannel(url, channelName) {
            const isVideo = url.toLowerCase().includes('.m3u8');
            if (isVideo) {
                iframe.style.display = 'none';
                videoElement.style.display = 'block';
                videoPlayer.src({ src: url, type: 'application/x-mpegURL' });
                videoPlayer.load();
                videoPlayer.play().catch(e => console.log(e));
            } else {
                videoPlayer.pause();
                videoElement.style.display = 'none';
                iframe.style.display = 'block';
                iframe.src = url;
            }
        }

        const listDiv = document.getElementById('channel-list');
        channels.forEach(ch => {
            const card = document.createElement('div');
            card.className = 'ch-card';
            card.onclick = () => playChannel(ch.url, ch.name);
            card.innerHTML = `
                <div class="icon">${ch.name.substring(0,2)}</div>
                <div class="info">
                    <span class="title">${ch.name}</span>
                    <span class="tag">MAÇTV VIP</span>
                </div>
                <div style="color:var(--blue)">▶</div>
            `;
            listDiv.appendChild(card);
        });
    </script>
</body>
</html>
