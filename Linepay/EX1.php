<?php
// curl-setopt-array
// https://www.php.net/manual/en/function.curl-setopt-array
$url = "http://www.mobile01.com/";
// curl_init($url);初始化 一個新的 session，回傳 cURL handle。
// 。(1) curl_init()：建立連線，curl_close($ch)：關閉連線
$ch = curl_init();

$options[CURLOPT_URL]=$url;
$options[CURLOPT_HEADER]=false;
$options[CURLOPT_RETURNTRANSFER]=true;
$options[CURLOPT_USERAGENT]="Googlebot/2.1";
$options[CURLOPT_FOLLOWLOCATION]=true;
// curl_setopt_array($ch , $opt_arr)：以陣列設定curl連線參數
// curl_setopt_array —為 cURL 傳輸設定多個選項
curl_setopt_array($ch, $options);
// curl_exec($ch)：執行curl連線
$output = curl_exec($ch);
curl_close($ch);
echo $output;
// CURLOPT_RETURNTRANSFER => true,         // 將返回結果通過變數接收而非直接輸出
// CURLOPT_HEADER         => false,        // 不包含響應頭部信息
// CURLOPT_FOLLOWLOCATION => true,         // 允許 cURL 追踪跳轉
// CURLOPT_ENCODING       => "",           // 處理所有編碼類型
// CURLOPT_USERAGENT      => "spider",     // 設置用戶代理，模擬瀏覽器的訪問
// CURLOPT_AUTOREFERER    => true,         // 根據 Location 頭部重定向時，自動設置來源頁面 URL
// CURLOPT_CONNECTTIMEOUT => 120,          // 連接超時時間，單位秒
// CURLOPT_TIMEOUT        => 120,          // 請求超時時間，單位秒
// CURLOPT_MAXREDIRS      => 10,           // 最大允許的重定向次數，超過則停止
// CURLOPT_POST           => 1,            // 使用 POST 方法發送數據
// CURLOPT_POSTFIELDS     => $curl_data,   // POST 請求的數據內容
// CURLOPT_SSL_VERIFYHOST => 0,            // 不驗證 SSL 主機
// CURLOPT_SSL_VERIFYPEER => false,        // 不驗證對等證書
// CURLOPT_VERBOSE        => 1             // 啟用詳細輸出，用於調試
?>