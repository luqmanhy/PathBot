<?php

function fCurl($url, $data = null, $ref = null, $new = null, $store_cook = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
    curl_setopt($ch, CURLOPT_MAXREDIRS, TRUE);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; WOW64; rv:51.0) Gecko/20100101 Firefox/51.0");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_ENCODING, "gzip");

    if (isset($data)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        	"Accept: application/json",
            "Content-Type: application/json",
            "Content-Length: ".strlen($data).""
        ));
    }
    if ($new == 'TRUE') {
        curl_setopt($ch, CURLOPT_COOKIESESSION, $new);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $store_cook);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $store_cook);
    } else {
        curl_setopt($ch, CURLOPT_COOKIE, 1);
        curl_setopt($ch, CURLOPT_COOKIESESSION, $store_cook);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $store_cook);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $store_cook);
    }

    if ($ref) {
        curl_setopt($ch, CURLOPT_REFERER, $ref);
    }

    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    if ($data) { 
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    }
	


    $result = curl_exec($ch);

    return $result;

    curl_close($ch);
}

