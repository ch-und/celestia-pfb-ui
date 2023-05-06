# Celestia Task: Create an UI for Submitting PFB Transactions

Let's create an UI for Submitting PFB Transactions with me. 
You can read about other tasks [on My Medium](https://medium.com/@batuoc90)

## Prerequisites
To perform this task, you must first run a lightnode. Step by step installation instructions can be found **[here](https://docs.celestia.org/nodes/light-node/)**

## Node API calls
`celestia-node` exposes its REST gateway on port 26659 by default.
Let's take a look at some of the api we will be using in this project.

### Check Balance
I will use this API to check wallet balance and use it as a node status check API.

<table>
  <tr>
    <th>Host:</th>
    <td>http://localhost:26659</td>
  </tr>
  <tr>
    <th>URI:</th>
    <td>/balance</td>
  </tr>
  <tr>
    <th>Method:</th>
    <td>GET</td>
  </tr>
</table>

Response:
```JSON
{
   "denom":"utia",
   "amount":"999995000000000"
}
```

### Submit a PFB transaction
In this example, we will be submitting a `PayForBlob` transaction to the node's `/submit_pfb` endpoint.

<table>
  <tr>
    <th>Host:</th>
    <td>http://localhost:26659</td>
  </tr>
  <tr>
    <th>URI:</th>
    <td>/submit_pfb</td>
  </tr>
  <tr>
    <th>Method:</th>
    <td>POST</td>
  </tr>
  <tr>
    <th>Body:</th>
    <td>
        {
            "namespace_id": "0c204d39600fddd3",
            "data": "f1f20ca8007e910a3bf8b2e61da0f26bca07ef78717a6ea54165f5",
            "gas_limit": 80000,
            "fee": 2000
        }
    </td>
  </tr>
</table>

Some things to consider:

- PFB is a `PayForBlob` Message.
- The endpoint also takes in a `namespace_id` and `data` values.
- Namespace ID should be 8 bytes.
- Data is in hex-encoded bytes of the raw message.
- `gas_limit` is the limit of gas to use for the transaction


## Install

This project I use php for development. I have tried to use docker for convenience in deployment, but when sending request to celestia-node gateway it fails. So I will use apache to host this project.

Install apache webserver
```shell
sudo apt install apache2
```

Install php
```shell
sudo apt install php libapache2-mod-php php-common php-curl php-mbstring
```

Creating a Virtual Host
```shell
cd /var/www
sudo git clone https://github.com/ch-und/celestia-pfb-ui
sudo chown -R $USER:$USER /var/www/celestia-pfb-ui
sudo nano /etc/apache2/sites-available/celestia-pfb-ui.conf
```

Include the following content in this file:
```
<VirtualHost *:80>
    ServerName localhost
    ServerAlias localhost 
    ServerAdmin webmaster@localhost
    DocumentRoot /var/www/celestia-pfb-ui
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```
Now, use a2ensite to enable the new virtual host and a2dissite to disable default host
```
sudo a2ensite celestia-pfb-ui
sudo a2dissite 000-default
```
To make sure your configuration file doesn’t contain syntax errors, run the following command:
```sudo apache2ctl configtest```
Finally, reload Apache so these changes take effect:
```sudo systemctl reload apache2```

So, you can visit the result here:
http://193.30.120.228/