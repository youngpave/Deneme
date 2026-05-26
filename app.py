from flask import Flask, request, Response
from flask_cors import CORS
import requests
from urllib.parse import urlparse, urljoin, quote, unquote
import re
import traceback
import os
 
app = Flask(__name__)
CORS(app, resources={r"/*": {"origins": "*"}})

def detect_m3u_type(content):
    if "#EXTM3U" in content and "#EXTINF" in content:
        return "m3u8"
    return "m3u"

def replace_key_uri(line, headers_query):
    match = re.search(r'URI="([^"]+)"', line)
    if match:
        key_url = match.group(1)
        proxied_key_url = f"/proxy/key?url={quote(key_url)}&{headers_query}"
        return line.replace(key_url, proxied_key_url)
    return line

@app.route('/proxy/m3u')
def proxy_m3u():

    m3u_url = request.args.get('url', '').strip()

    if not m3u_url:
        return "Errore: Parametro 'url' mancante", 400

    headers = {
        "User-Agent": "Mozilla/5.0",
        "Referer": "https://vavoo.to/",
        "Origin": "https://vavoo.to"
    }

    try:

        response = requests.get(
            m3u_url,
            headers=headers,
            allow_redirects=True,
            timeout=(10, 20)
        )

        response.raise_for_status()

        m3u_content = response.text
        final_url = response.url

        parsed_url = urlparse(final_url)

        base_url = (
            f"{parsed_url.scheme}://"
            f"{parsed_url.netloc}"
            f"{parsed_url.path.rsplit('/', 1)[0]}/"
        )

        headers_query = "&".join([
            f"h_{quote(k)}={quote(v)}"
            for k, v in headers.items()
        ])

        modified_m3u8 = []

        for line in m3u_content.splitlines():

            line = line.strip()

            if line.startswith("#EXT-X-KEY") and 'URI="' in line:
                line = replace_key_uri(line, headers_query)

            elif line and not line.startswith("#"):

                segment_url = urljoin(base_url, line)

                line = (
                    f"/proxy/ts?"
                    f"url={quote(segment_url)}"
                    f"&{headers_query}"
                )

            modified_m3u8.append(line)

        modified_m3u8_content = "\n".join(modified_m3u8)

        return Response(
            modified_m3u8_content,
            content_type="application/vnd.apple.mpegurl",
            headers={
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers": "*",
                "Access-Control-Allow-Methods": "*"
            }
        )

    except Exception as e:
        return f"Errore: {str(e)}", 500

@app.route('/proxy/ts')
def proxy_ts():

    ts_url = request.args.get('url', '').strip()

    if not ts_url:
        return "Errore: Parametro 'url' mancante", 400

    headers = {
        unquote(key[2:]).replace("_", "-"): unquote(value).strip()
        for key, value in request.args.items()
        if key.lower().startswith("h_")
    }

    try:

        response = requests.get(
            ts_url,
            headers=headers,
            stream=True,
            allow_redirects=True,
            timeout=(10, 30)
        )

        response.raise_for_status()

        def generate():
            for chunk in response.iter_content(chunk_size=8192):
                if chunk:
                    yield chunk

        return Response(
            generate(),
            content_type="video/mp2t",
            headers={
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers": "*",
                "Access-Control-Allow-Methods": "*"
            }
        )

    except Exception as e:
        return f"Errore TS: {str(e)}", 500

@app.route('/proxy/key')
def proxy_key():

    key_url = request.args.get('url', '').strip()

    if not key_url:
        return "Errore: Parametro 'url' mancante", 400

    headers = {
        unquote(key[2:]).replace("_", "-"): unquote(value).strip()
        for key, value in request.args.items()
        if key.lower().startswith("h_")
    }

    try:

        response = requests.get(
            key_url,
            headers=headers,
            allow_redirects=True,
            timeout=(5, 15)
        )

        response.raise_for_status()

        return Response(
            response.content,
            content_type="application/octet-stream",
            headers={
                "Access-Control-Allow-Origin": "*",
                "Access-Control-Allow-Headers": "*",
                "Access-Control-Allow-Methods": "*"
            }
        )

    except Exception as e:
        return f"Errore KEY: {str(e)}", 500

@app.route('/')
def index():
    return "Proxy started!"

if __name__ == '__main__':
    print("Proxy started!")
    app.run(host="0.0.0.0", port=7860, debug=False)
