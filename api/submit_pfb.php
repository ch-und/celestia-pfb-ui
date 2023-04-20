<?php

const __DEFAULT_GAS__ = 80000;
const __DEFAULT_FEE__ = 2000;

if (isset($_POST)) {
    try {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:26659/submit_pfb',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"namespace_id": "0c204d39600fddd3", "data": "f1f20ca8007e910a3bf8b2e61da0f26bca07ef78717a6ea54165f5", "gas_limit": ' . __DEFAULT_GAS__ . ', "fee": ' . __DEFAULT_FEE__ . '}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    } catch (\Throwable $th) {
        $err = '{"error": 500, "message": "' . $th->getMessage() . '"}';
        echo $err;
    }
}
