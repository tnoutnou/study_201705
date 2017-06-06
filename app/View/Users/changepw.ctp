<div class="container">
<div class="row">
<div class="col-xs-10 col-sm-6">
<h2>パスワード変更画面</h2>
<?php
	echo $this->Form->create('User', array(
		'url' => array(
			'controller' => 'users',
			'action' => 'changepw'
				),
		'class'=>'form-horizontal'
		));
?>

	<div class="row">

		<?php	echo $this->Form->input('id', array('label' => array('text' => 'ユーザID')));	?>
		<?php	echo $this->Form->input('old_password', array('class' => 'form-control col-sm-6', 'label' => array('text' => '現在のパスワード', 'class'=>'col-sm-6')));	?>
		<?php	echo $this->Form->input('User.password', array('class' => 'form-control col-sm-6', 'label' => array('text' => '新パスワード', 'class'=>'col-sm-6'), 'value'=> ''));	?>
		<?php	echo $this->Form->input('new_password', array('type'=>'password', 'class' => 'form-control col-sm-6', 'label' => array('text' => '新パスワード【確認】', 'class'=>'col-sm-6'), 'value'=> ''));	?>
		<?php	echo $this->Form->hidden('olddbpassword', array('label' => array('text' => '旧')));	?>
		<?php	echo $this->Form->end('パスワード変更');	?>

	</div>

</div>
</div>
</div>
