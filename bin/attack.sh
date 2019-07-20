#!/bin/sh

#
# 特定のURLに大量のリクエストを送る
#

### 同時接続数50、計5000リクエスト
ab -n 5000 -c 50 http://localhost/neec-counter/counter1.php
