 <?php
require("../mainconfig.php");
$start_date = date('Y-m-d 23:59:00');
$end_date = date('Y-m-d 00:00:01', strtotime('-1 day', strtotime($start_date)));
$check_target = mysqli_query($db, "SELECT * FROM deposits WHERE status ='Pending' AND type = 'auto' AND (created_at BETWEEN '$end_date' AND '$start_date')");
if(mysqli_num_rows($check_target) == 0) {
  die("Tidak ada deposit pending");
} else {
  while($data_target = mysqli_fetch_assoc($check_target)) {
        $input_post = array(
            'id' => $data_target['id'],
            'user_id' => $data_target['user_id'],
            'method_name' => $data_target['method_name'],
            'amount' => $data_target['amount'],
            'post_amount' => $data_target['post_amount'],
            'status' => 'Success',
            'created_at' => $data_target['created_at']

        );
        $ts   = strtotime($input_post['created_at']);
        $tgl = date('Y-m-d', $ts);
        $url = "https://cekduit.my.id/api/status.php";
        $kode = 'ulindzgn-L9rJn0P3EG5fSgi';
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, "kode=".$kode."&jumlah=".$input_post['post_amount']."&bank=".$input_post['method_name']."&tanggal=".$tgl);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,20);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $result = curl_exec($curlHandle);
        curl_close($curlHandle);


        $response = json_decode($result, true);
  
        if($response['status'] == 1) {
            $user = mysqli_query($db, "SELECT * FROM users WHERE id = '".$input_post['user_id']."'");
          $user = mysqli_fetch_assoc($user);
            $a = "UPDATE deposits SET status = 'Success' WHERE id = '".$input_post['id']."'";
          mysqli_query($db, $a);
            $b = "UPDATE users SET balance = '".($user['balance'] + $input_post['amount'])."' WHERE id = '".$input_post['user_id']."'";
          $update= mysqli_query($db, $b);
            if($update == TRUE) {
                echo "ID Deposit: ".$input_post['id']." => Mutasi ditemukan, deposit sukses.<br />";
            } else {
                echo "ID Deposit: ".$input_post['id']." => Mutasi ditemukan, gagal update. <br />";
            }
        } else {
            echo "ID Deposit: ".$input_post['id']." => Mutasi tidak ditemukan<br />";
        }  
    }
} 
?>