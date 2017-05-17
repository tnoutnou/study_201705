<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="images form">
<?php echo $this->Form->create('Image'); ?>
	<fieldset>
		<legend><?php echo __('Edit Image'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('post_id');
		echo $this->Form->input('filename');
		echo $this->Form->input('dirname');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Image.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Image.id')), 'class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('List Images'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
	</ul>
</div>
</div>
</div>
