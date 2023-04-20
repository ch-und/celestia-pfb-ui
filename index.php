<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="image/x-icon" href="./assets/images/favicon.png" rel="icon" />
    <title>Celestia | Pay For Blob</title>
    <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>
    <div class="container">
        <header class="flex">
            <div class="header_badge flex row"><img src="./assets/images/celestia-logo.svg" alt="Celestia"> | PayForBlob</div>
            <div class="header_node_status" title="rpc_url">Load status...</div>
        </header>
        <form method="get" class="node">
            <h1>Send transaction</h1>
            <br>
            <div class="form_field_container">
                <span class="form_field_label">Data</span>
                <textarea name="tx_data" class="form_field_textarea" placeholder="Your data to blockchain" required></textarea>
            </div>
            <button class="form_button">Send data</button>
            <!-- inactive -->
        </form>

        <div class="transaction" style="display: none;">
            <div class="block_title">Transaction info</div>
            <div class="transaction_row flex">
                <div class="transaction_row_data">
                    <div><b>Date and Time:</b></div>
                    <span id="tx_info_date"></span>
                </div>
                <div class="transaction_row_data">
                    <div><b>Namespace ID:</b></div>
                    <span id="tx_info_namespace_id"></span>
                </div>
                <div class="transaction_row_data">
                    <div><b>Height:</b></div>
                    <span id="tx_info_height"></span>
                </div>
                <div class="transaction_row_data">
                    <div><b>Gas wanted:</b></div>
                    <span id="tx_info_gas_wanted"></span>
                </div>
                <div class="transaction_row_data">
                    <div><b>Gas used:</b></div>
                    <span id="tx_info_gas_used"></span>
                </div>
                <div class="transaction_row_data">
                    <div><b>Code:</b></div>
                    <span id="tx_info_code"></span>
                </div>
            </div>
            <div class="transaction_info_item">
                <div class="tx_title"><b>Data:</b></div>
                <div>
                    <small><span class="badge">text</span></small>
                    <span id="tx_info_decode_data"></span>
                </div>
                <div>
                    <small><span class="badge badge_orange">hex</span></small> <span id="tx_info_encode_data"></span>
                </div>
            </div>
            <div class="transaction_info_item">
                <div class="tx_title"><b>Transaction hash:</b></div>
                <div>
                    <a href="#" id="tx_info_tx_hash_link" class="flex" target="_blank">
                        <span id="tx_info_tx_hash"></span>
                        <span class="badge_explorer">explorer</span>
                    </a>
                </div>
            </div>
        </div>

        <footer class="flex">
            <div>«ch_und | Reguide.Wiki» &copy; 2023</div>
        </footer>
    </div>
    <!-- JS -->
    <script src="./assets/js/simple-notify.min.js"></script>
    <script src="./assets/js/main.js"></script>
</body>

</html>