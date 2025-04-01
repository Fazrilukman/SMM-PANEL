<?php
require '../mainconfig.php';
if (isset($_SESSION['login'])) {
	exit(header("Location: ".$config['web']['base_url']));
}
if ($_POST) {
	$data = array('username', 'password');
	if (check_input($_POST, $data) == false) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
	} else {
		$input_post = array(
			'username' => mysqli_real_escape_string($db, trim($_POST['username'])),
			'password' => mysqli_real_escape_string($db, trim($_POST['password'])),
		);
		if (check_empty($input_post) == true) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
		} else {
			$check_user = $model->db_query($db, "*", "users", "BINARY username = '".$input_post['username']."'");
			if ($check_user['count'] == 1) {
				if (password_verify($input_post['password'], $check_user['rows']['password']) == true) {
				    if($check_user['rows']['level'] == 'Admin'){
				    require '../lib/seswats.php';
				    $model->db_insert($db, "login_logs", array('user_id' => $check_user['rows']['id'], 'ip_address' => get_client_ip(), 'created_at' => date('Y-m-d H:i:s')));
					$_SESSION['login'] = $check_user['rows']['id'];
					$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil masuk!', 'msg' => 'Selamat datang '.$check_user['rows']['username'].'!');
					exit(header("Location: ".$config['web']['base_url']));
				    }else{
				     $model->db_insert($db, "login_logs", array('user_id' => $check_user['rows']['id'], 'ip_address' => get_client_ip(), 'created_at' => date('Y-m-d H:i:s')));
					$_SESSION['login'] = $check_user['rows']['id'];
					$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil masuk!', 'msg' => 'Selamat datang '.$check_user['rows']['username'].'!');
					exit(header("Location: ".$config['web']['base_url']));   
				    }
				} else {
					$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username atau password salah.');
				}
			} else {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username atau password salah.');
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
									<h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-sign-in fa-fw"></i> Masuk</h4><hr>
									<form class="form-horizontal" method="post">
										<input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
										<div class="form-group">
											<label>Username</label><input type="text" class="form-control" name="username">
										</div>
										<div class="form-group">
											<label>Password</label>
											<a href="/auth/forgot_password" class="text float-right"><small>Lupa kata sandi?</small></a>
											<input type="password" class="form-control" name="password">
										</div>
										<div class="form-group">
												<button class="btn btn-primary btn-block" type="submit"><i class="fa fa-check"></i> Masuk</button>
										</div>
									</form>
									<p class="text-center">
                                    	Belum Punya Akun? <a href="/auth/register">Klik Disini</a>
                                    </p>
									<p class="text-center">
                                	Reset password? <a href="/auth/forgot_password">Klik Disini</a>
                                </p>
								</div>
							</div>
						</div>
<?php
require '../lib/footer.php';
?>