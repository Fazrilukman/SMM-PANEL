<?php
require("../mainconfig.php");

$check_provider = mysqli_query($db, "SELECT * FROM `provider` WHERE `id` = '4'");
$data_provider = mysqli_fetch_assoc($check_provider);

if (mysqli_num_rows($check_provider) != 0) {

	$api_key = $data_provider['api_key'];
	$keuntungan = 1.1;
	$url = $data_provider['api_url_order'];

	$postdata = "api_key=$api_key&action=layanan";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	$chresult = curl_exec($ch);
	curl_close($ch);
	$result_data = json_decode($chresult, true);

	//print '<pre>'.print_r($result_data,1).'</pre>'; flush(); die();

	if(!empty($result_data['data'])) {
		foreach ($result_data['data'] as $key => $services) {

			$sid = $services['sid'];
			$service = $services['layanan'];
			$category = $services['kategori'];
			$min = $services['min'];
			$max = $services['max'];
			$real_price = $services['harga'];
			$price = $real_price *$keuntungan;
			$profit_api = $price - $real_price;
			$note = $services['catatan'];

			//$category = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $category);
		   // $category = preg_replace('/[\x00-\x1F\x7F]/', '', $category);
		    //$category = preg_replace('/[\x00-\x1F\x7F]/u', '', $category);
		    
		    //$service = preg_replace('/[\x00-\x1F\x7F-\xFF]/', '', $service);
		    //$service = preg_replace('/[\x00-\x1F\x7F]/', '', $service);
		    //$service = preg_replace('/[\x00-\x1F\x7F]/u', '', $service);

			//$category = trim($category); 
		   // $service = trim($service);
		    //$note = trim($note);

		    //$category = str_replace('\'', '', $category);
		    //$service = str_replace('\'', '', $service);

		    $category = str_replace('ZAYNFLAZZ', 'Provider', $category);
		    $service = str_replace('ZaynFlazz', 'SM', $service);
		    $note = str_replace('Zaynflazz', 'SM', $note);

		    $service = str_replace('ZF', 'PROVIDER Z', $service);


		    $check_cat = mysqli_query($db, "SELECT * FROM `categories` WHERE `name` = '$category'");
		    $data_cat = mysqli_fetch_assoc($check_cat);
		    if (mysqli_num_rows($check_cat) == 0) {
		        $insert_service = mysqli_query($db, "INSERT INTO `categories` (`id`, `name`) VALUES (NULL, '$category');");
		        $check_data = mysqli_query($db, "SELECT * FROM `categories` WHERE `name` = '$category'");
		       $get_data = mysqli_fetch_assoc($check_data);
		       $post_cat = $get_data['id'];
		    } else {
		        $post_cat = $data_cat['id'];
		    }

		    $check_service = mysqli_query($db, "SELECT * FROM `services` WHERE `provider_service_id` = '$sid' AND `provider_id` = '4';");
		    if (mysqli_num_rows($check_service) == 0) {
		        $insert_service = mysqli_query($db, "INSERT INTO `services` (`id`, `category_id`, `service_name`, `note`, `min`, `max`, `price`, `profit`, `status`, `provider_id`, `provider_service_id`) VALUES (NULL, '$post_cat', '$service', '$note', '$min', '$max', '$price', '$profit_api', '1', '4', '$sid');");
		    } else {
		        $insert_service = mysqli_query($db, "UPDATE `services` SET `service_name` = '$service', `note` = '$note', `min` = '$min', `max` = '$max', `price` = '$price', `profit` = '$profit_api' WHERE `provider_service_id` = '$sid' AND `provider_id` = '4';");
		    }

		    print "<b>SID:</b> $sid | <b>Service:</b> $service | <b>Note:</b> $note | <b>Min:</b> $min | <b>Max:</b> $max<br><hr>"; flush();
		}
	}
} else {
	print 'provider tidak ditemukan.<br>';
}