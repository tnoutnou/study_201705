<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="postsTags form">
<?php echo $this->Form->create('PostsTag'); ?>
<?php $this->Form->inputDefaults(array('label' => array('text' => '' ,'class' => 'label label-default'), 'class' => 'form-control')); ?>
	<fieldset>
		<legend><?php echo __('投稿タグ追加'); ?></legend>
	<?php
		echo $this->Form->input('post_id', array('label' => array('text' => '投稿ID')));
		echo $this->Form->input('tag_id', array('label' => array('text' => 'タグID')));
	?>
	</fieldset>
<?php $this->Form->inputDefaults(array('label' => false, 'class' => 'btn')); ?>
<?php echo $this->Form->end(__('登録')); ?>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('投稿タグ一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('タグ一覧'), array('controller' => 'tags', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('タグ追加'), array('controller' => 'tags', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
</div>
</div>
