<?php
require '../mainconfig.php';
$orders = mysqli_query($db, "SELECT * FROM `orders` WHERE `provider_id`= '4' AND `status` IN ('Pending', 'Processing')");
while ($order = mysqli_fetch_array($orders)) {
	$provider = mysqli_query($db, "SELECT * FROM `provider` WHERE `id` = '".$order['provider_id']."';");
	$provider_data = mysqli_fetch_assoc($provider);
	if (mysqli_num_rows($provider) != 0) {

		$post_api = array(
			'api_key' => $provider_data['api_key'],
			'action' => 'status',
			'id' => $order['provider_order_id']
		);
		$curl = post_curl($provider_data['api_url_status'], $post_api);
		$result = json_decode($curl, true);

		//print '<pre>'.print_r($curl,1).'</pre>'; flush(); die();

		if($result['status'] == true) {
			
			if ($result['data']['status'] == 'Completed') {
                $status = 'Success';
            } else if ($result['data']['status'] == 'Success') {
                $status = 'Success';
            } elseif ($result['data']['status'] == 'Canceled') {
                $status = 'Error';
            } elseif ($result['data']['status'] == 'Error') {
                $status = 'Error';
            } elseif ($result['data']['status'] == 'Partial') {
                $status = 'Partial';
            } elseif ($result['data']['status'] == 'Processing') {
                $status = 'Processing';
            } elseif ($result['data']['status'] == 'In progress') {
                $status = 'Processing';
            } elseif ($result['data']['status'] == 'In Progress') {
                $status = 'Processing';
            } else {
                $status = 'Pending';
            }

            $start_count = (isset($result['data']['start_count'])) ? $result['data']['start_count'] : 0;
			$remains = (isset($result['data']['remains'])) ? $result['data']['remains'] : 0;
			$query_update = "UPDATE orders SET status = '".$status."', start_count = '".$start_count."', remains = '".$remains."', api_status_log = '".$curl."', updated_at = '".date('Y-m-d H:i:s')."' WHERE id = '".$order['id']."'";
			mysqli_query($db, $query_update);
			print("ID: ".$order['id'].", ID API: ".$order['provider_order_id'].", STATUS: $status, SC: $start_count, R: $remains | Response: ".$curl."<br />");
		} else {
			print 'gagal mengambil data dari server.<br>';
		}
	} else {
		print 'provider tidak ditemukan.<br>';
	}
}