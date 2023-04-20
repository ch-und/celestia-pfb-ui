<?php

const __DEFAULT_GAS__ = 80000;
const __DEFAULT_FEE__ = 2000;
$reqBody = json_decode(file_get_contents('php://input'));
if (isset($reqBody->tx_data)) {
    try {
        $curl = curl_init();
        
        $random_bytes = random_bytes(8);
        $namespace_id = bin2hex($random_bytes);
        $tx_data = bin2hex(utf8_encode($reqBody->tx_data));

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://localhost:26659/submit_pfb',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{"namespace_id": "' . $namespace_id . '", "data": "' . $tx_data . '", "gas_limit": ' . __DEFAULT_GAS__ . ', "fee": ' . __DEFAULT_FEE__ . '}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $tx_submit_data = json_decode($response);
        $arr = [];
        
        $arr['txhash'] = $txhash;
        $arr['namespace_id'] = $namespace_id;
        $arr['data_hex'] = $tx_data;
        $arr['data'] = $data['tx_data'];
        $arr['gas_wanted'] = $gas_wanted;
        $arr['gas_used'] = $gas_used;
        $arr['height'] = $height;
        $arr['code'] = 200;
        $arr['date'] = date('Y-m-d H:i:s', time());

        echo json_encode($arr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
           
    } catch (\Throwable $th) {
        $err = '{"error": 500, "message": "' . $th->getMessage() . '"}';
        echo $err;
    }
} else {
    $err = '{"error": 500, "message": "Insufficient data"}';
    echo $err;
}
