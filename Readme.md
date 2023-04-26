# Celestia Task: Create an UI for Submitting PFB Transactions

## Prerequisites
Để thực hiện nhiệm vụ này, trước hết bạn phải chạy một lightnode. Hướng dẫn cài đặt step by step các bạn có thể tham khảo ở đây [here](https://docs.celestia.org/nodes/light-node/)

## Node API calls
Cùng tìm hiểu một chút về các api của celestia node. `celestia-node` exposes its REST gateway on port 26659 by default.

### Check Balance
Host: http://127.0.0.1:26659
URI: /balance
Method: GET

Response