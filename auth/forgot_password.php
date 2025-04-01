<?php
function rastgele($uzunluk){
	$a="ABCDEFGHIJKLMNOPRSTUVYZXabcdefghijklmnoprstuvyzx0123456789";
	$b="";
	for($i=0;$i<$uzunluk;$i++){
		$b.=$a[rand(0,56)];
	}
	return $b;
}
require '../mainconfig.php';
if (isset($_SESSION['login'])) {
	exit(header("Location: ".$config['web']['base_url']));
}
	if ($_POST) {
		$input_data = array('email');
		if (check_input($_POST, $input_data) == false) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
		} else {
			$input_post = array(
				'email' => $db->real_escape_string(trim(htmlspecialchars(htmlentities($_POST['email']))))
			);
			if (check_empty($input_post) == true) {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
			} else {
                $newpw = rastgele(8);
				$password_baru = password_hash($newpw, PASSWORD_DEFAULT);
				$email_req = $input_post['email'];
				$check_user2 = mysqli_query($db, "SELECT * FROM users WHERE email = '$email_req'");
				if (mysqli_num_rows($check_user2) == 1) {
				    $check_user = mysqli_fetch_assoc($check_user2);
				    mysqli_query($db, "UPDATE users SET password = '$password_baru' WHERE email = '$email_req'");
                    //tujuan
                    $to = "$email_req";
            
                    //NAMA JASA KODE
                    $subject = "RISET PASSWORD";
            
                    //isi pesan di kirim
                    $messege = "HAY : ".$check_user['full_name']." \r\n Riset Password Baru Anda Berhasill?\r\nUsername : ".$check_user['username']."\r\nPassword : ".$newpw." ";
            
                    //header email
                    $headers = "From: support@yab-group.com\r\n"; //isi Username email hosting
                    $headers .= "Reply-To: support@yab-group.com\r\n"; //isi Username email hosting
                    $headers .= "Content-Type: text/html; charset=UTF-8r\n";
            
                    $send_mail = mail($to, $subject, $messege, $headers);
        
                    if($send_mail ==  true){
						$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Password baru telah dikirim lewat email. Silahkan Cek Folder Spam/Kontak Masuk');
					} else {
						$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Password gagal dikirim.');
					}
				} else {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'email Tidak Di Temukan.');
			}
			}
		}
		//Disable form resubmit after page refresh 1
	header("Location: " . $_SERVER['REQUEST_URI'] . "");
	exit();
	}
require '../lib/header.php';
?>
						<div class="row">
							<div class="offset-lg-3 col-lg-6">
								<div class="card-box">
									<h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-sign-in fa-fw"></i> Masuk</h4>
									<form class="form-horizontal" method="post">
										<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
										<div class="form-group">
											<label>Email Terdaftar</label><input type="email" class="form-control" name="email">
										</div>
										<div class="form-group">
												<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-check"></i> Riset</button>
										</div>
									</form>
									<p class="text-center">
                                    Masuk Ke Akun Saya? <a href="/auth/login">Klik Disini</a>
                                    </p>
								</div>
							</div>
						</div>
<?php
require '../lib/footer.php';
?>