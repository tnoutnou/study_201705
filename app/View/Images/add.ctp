<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="images form">
<?php echo $this->Form->create('Image'); ?>
<?php $this->Form->inputDefaults(array('label' => array('text' => '' ,'class' => 'label label-default'), 'class' => 'form-control')); ?>
	<fieldset>
		<legend><?php echo __('イメージ追加'); ?></legend>
	<?php
		echo $this->Form->input('post_id', array('label' => array('text' => 'post_id')));
		echo $this->Form->input('filename', array('label' => array('text' => 'filename')));
		echo $this->Form->input('dirname', array('label' => array('text' => 'dirname')));
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

		<li><?php echo $this->Html->link(__('イメージ一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<?php echo $this->element('actlistall'); ?>

	</ul>
</div>
</div>
</div>
