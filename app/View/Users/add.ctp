<?php echo $this->Html->script( 'jquery-git.js'); ?>
<?php echo $this->Html->script( 'zip.js'); ?>
<?php echo $this->Html->css( 'custom.css'); ?>

<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="users form">
<?php echo $this->Form->create('User'); ?>
<?php $this->Form->inputDefaults(array('label' => array('text' => '' ,'class' => 'label label-default'), 'class' => 'form-control')); ?>
	<fieldset>
		<legend><?php echo __('ユーザ追加'); ?></legend>
	<?php
		echo $this->Form->input('username', array('label' => array('text' => 'ユーザ名')));
		echo $this->Form->input('zip_code', array('label' => array('text' => '郵便番号')));
		echo $this->Form->button('郵便番号から住所', array('type' => 'button','id' => 'tran-btn'));
		echo $this->Form->input('ken_name_kan', array('label' => array('text' => '都道府県')));
		echo $this->Form->input('city_name_kan', array('label' => array('text' => '市区')));
		echo $this->Form->input('town_name_kan', array('label' => array('text' => '町村')));
		echo $this->Form->input('detail_name_kan', array('label' => array('text' => '番地以下')));
		echo $this->Form->input('password', array('label' => array('text' => 'パスワード')));
		echo $this->Form->input('new_password', array('type'=>'password', 'label' => array('text' => '新パスワード【確認】'), 'value'=> ''));
		echo $this->Form->input('group_id', array('label' => array('text' => 'グループID')));
	?>
	</fieldset>
<?php $this->Form->inputDefaults(array('label' => false, 'class' => 'btn')); ?>	
<?php echo $this->Form->end(__('登録')); ?>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<?php echo $this->element('login_user'); ?>
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('ユーザ一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('グループ一覧'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('グループ追加'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
</div>
</div>

<!-- ポップアップ用の背景とimg -->
<div id="popup-background">
</div>

<div id="popup-sel">
	<p style="font-style:italic">複数の候補があります。選択して下さい。</p>
	<select id="zip-sel" size=5 label="都道府県">
	<!--	<option>1</option>	-->
	</select>
</div>

