<?php

try {
	$curl = curl_init();

	curl_setopt_array($curl, array(
		CURLOPT_URL => 'http://127.0.0.1:26659/balance',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => '',
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => 'GET',
	));

	$response = curl_exec($curl);

	curl_close($curl);
	echo $response;
} catch (\Throwable $th) {
	$err = '{"error": 500, "message": "'. $th->getMessage() .'"}';
	echo $err;
}
