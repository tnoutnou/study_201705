<!-- ログイン中のユーザを表示	-->
	<?php if ($this->Session->read('Auth.User')) {	?>
<!--		<p style='position:fixed;'><?php echo 'ようこそ ' . $this->Session->read('login_user') . ' さん';	?></p>	-->
<!--		<h6>ようこそ</h6>	-->
		<h6><?php echo 'ようこそ ' . $this->Session->read('login_user') . ' さん';	?></h6>
	<?php	}	?>

	


	