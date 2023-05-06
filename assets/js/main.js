{
    // API config
    const api = {
      submit_pfb: "/api/submit_pfb.php",
      node_status: "/api/balance.php",
      explorer: "https://testnet.mintscan.io/celestia-incentivized-testnet/",
    };

    // form selector
    const form = document.body.querySelector("form");

    // check node status
    document.body.onload = async (e) => {
      const node_status = await fetch(api.node_status)
      .then(response => {
        if (response.ok) {
          return response.json();
        }
        throw new Error('Data error');
      }).then(data => {
        document.body.querySelector(".header_node_status").classList.toggle("active");
        document.body.querySelector(".header_node_status").textContent = `Node active | ${(data.amount / 1000000).toFixed(2)} TIA`;
        return data;
      }).catch(err => {
        document.body.querySelector(".header_node_status").classList.toggle("inactive");
        document.body.querySelector(".header_node_status").textContent = 'Node inactive';
        form.querySelector('.form_button').classList.toggle("inactive");
        form.querySelector('.form_button').textContent = "Node is inactive";
        new Notify({
          status: 'error',
          title: 'Error',
          text: 'Try to reload the page',
          effect: 'slide',
          type: 3,
          position: 'right bottom'
        });
        console.log(err);
      });
    };

    // create PayForBlob transaction
    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      form.querySelector('.form_button').classList.toggle("loader");
      let tx_form = {
        "tx_data": form['tx_data'].value
      };

      const connect = await fetch(api.submit_pfb, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify(tx_form)
      })
      .then(response => {
        if (response.ok) {
          return response.json();
        }
        throw new Error('Data error');
      }).then(data => {
        document.getElementById("tx_info_date").textContent = data.date;
        document.getElementById("tx_info_namespace_id").innerHTML = data.namespace_id;
        document.getElementById("tx_info_height").innerHTML = data.height;
        document.getElementById("tx_info_gas_wanted").innerHTML = data.gas_wanted;
        document.getElementById("tx_info_gas_used").innerHTML = data.gas_used;
        document.getElementById("tx_info_decode_data").innerHTML = data.data;
        document.getElementById("tx_info_encode_data").innerHTML = data.data_hex;
        document.getElementById("tx_info_tx_hash").innerHTML = data.txhash;
        document.getElementById("tx_info_code").innerHTML = data.code;
        document.getElementById("tx_info_tx_hash_link").setAttribute("href", api.explorer + "txs/" + data.txhash);
        
        let txblock = document.querySelector(".transaction");
        txblock.style.display = "block";

        let transaction_status_submitted = new Notify({
          status: 'success',
          title: 'Transaction submitted',
          text: '',
          effect: 'slide',
          type: 3,
          position: 'right bottom'
        });

        form.querySelector('.form_button').classList.toggle("loader");
        window.scrollTo(0, document.body.scrollHeight);

        return data;
      }).catch(err => {
        form.querySelector('.form_button').classList.toggle("loader");
        new Notify({
          status: 'error',
          title: 'Error',
          text: err.message,
          effect: 'slide',
          type: 3,
          position: 'right bottom'
        });
        console.log(err);
      });
    });
}
