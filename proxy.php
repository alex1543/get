<?php

	/* Чтение настроек из двух строчек */
	$text = file_get_contents("set.ini");
	$list = explode("\r\n", $text);

	/* Адрес и порт (первая строка), логин и пароль (вторая строка) */
	$proxy = $list[0];
	$proxyauth = $list[1];


	if ($_GET['mode'] == 1) header("Access-Control-Allow-Origin: *");
	if ($_GET['mode'] == 2) header('Content-Type: application/octet-stream');

    echo get_page($_GET['url'], $proxy, $proxyauth);
	
	function get_page($url, $proxy, $proxyauth) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        
        curl_setopt($ch, CURLOPT_PROXY, $proxy);
        curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxyauth);
        
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
?>