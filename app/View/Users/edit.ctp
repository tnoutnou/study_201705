<?php echo $this->Html->script( 'jquery-git.js'); ?>
<?php echo $this->Html->script( 'zip.js'); ?>
<?php echo $this->Html->css( 'custom.css'); ?>

<?php $actionLists = array(
		array(
			'label' => 'ユーザ削除',
			'controller' => 'users',
			'action' => 'delete',
			'id' => $this->Form->value('User.id')),
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>

<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="users form">
<?php echo $this->Form->create('User'); ?>
<?php $this->Form->inputDefaults(array('label' => array('text' => '' ,'class' => 'label label-default'), 'class' => 'form-control')); ?>
	<fieldset>
		<legend><?php echo __('ユーザ編集'); ?></legend>
	<?php
		echo $this->Form->input('id', array('label' => array('text' => 'ユーザID')));
		echo $this->Form->input('username', array('label' => array('text' => 'ユーザ名')));
		echo $this->Form->input('zip_id', array('type'=>'text','label' => false , 'style'=>'display:none' ));
		echo $this->Form->input('zip_code', array('label' => array('text' => '郵便番号')));
		echo $this->Form->button('郵便番号から住所', array('type' => 'button','id' => 'tran-btn'));
/*
		echo $this->Form->input('prefecture_name', array('label' => array('text' => '都道府県'), 'disabled'=>'disabled'));
		echo $this->Form->input('city_name', array('label' => array('text' => '市区'), 'disabled'=>'disabled'));
*/
		echo $this->Form->input('prefecture_name', array('label' => array('text' => '都道府県'), 'disabled'=>'disabled' , 'value' => $this->Form->value('Zip.prefecture_name_kan') ));
		echo $this->Form->input('city_name', array('label' => array('text' => '市区'), 'disabled'=>'disabled', 'value' => $this->Form->value('Zip.city_name_kan') ));
		echo $this->Form->input('town_name', array('label' => array('text' => '町村')));
		echo $this->Form->input('detail_name', array('label' => array('text' => '番地以下')));
//		echo $this->Form->input('password', array('label' => array('text' => 'パスワード')));
		echo $this->Form->input('group_id', array('label' => array('text' => 'グループID')));
	?>
	</fieldset>
<?php $this->Form->inputDefaults(array('label' => false, 'class' => 'btn')); ?>
<?php echo $this->Form->end(__('更新')); ?>
<?php echo $this->Html->link(__('パスワード変更'), array('action' => 'changePassword', $this->Form->value('User.id')), array('class'=>'btn btn-default btn-sm')); ?>

</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<?php /* echo $this->element('login_user'); 
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul style="list-style:none;">

		<li><?php echo $this->Form->postLink(__('ユーザ削除'), array('action' => 'delete', $this->Form->value('User.id')), array('confirm' => __('本当に削除してもよろしいでしょうか # %s?', $this->Form->value('User.id')), 'class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('ユーザ一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('グループ一覧'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('グループ追加'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
*/	?>
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


