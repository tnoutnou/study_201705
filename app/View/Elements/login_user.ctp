<!-- ログイン中のユーザを表示	-->
	<?php if ($this->Session->read('Auth.User')) {	?>
<!--		<p style='position:fixed;'><?php echo 'ようこそ ' . $this->Session->read('login_user') . ' さん';	?></p>	-->
		<p><?php echo 'ようこそ ' . $this->Session->read('login_user') . ' さん';	?></p>
	<?php	}	?>

	


	