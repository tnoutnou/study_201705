<?php $actionLists = array(
		array(
			'label' => 'タグ削除',
			'controller' => 'tags',
			'action' => 'delete',
			'id' => $this->Form->value('Tag.id')),
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>

<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="tags form">
<?php echo $this->Form->create('Tag'); ?>
<?php $this->Form->inputDefaults(array('label' => array('text' => '' ,'class' => 'label label-default'), 'class' => 'form-control')); ?>

	<fieldset>
		<legend><?php echo __('タグ編集'); ?></legend>
	<?php
		echo $this->Form->input('id', array('label' => array('text' => 'タグID')));
		echo $this->Form->input('name', array('label' => array('text' => 'タグ名')));
		echo $this->Form->input('Post', array('label' => array('text' => '投稿')));
	?>
	</fieldset>
<?php $this->Form->inputDefaults(array('label' => false, 'class' => 'btn')); ?>
<?php echo $this->Form->end(__('更新')); ?>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<?php /* echo $this->element('login_user'); 
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('タグ削除'), array('action' => 'delete', $this->Form->value('Tag.id')), array('confirm' => __('本当に削除してもよろしいでしょうか # %s?', $this->Form->value('Tag.id')), 'class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('タグ一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
*/	?>
</div>
</div>
