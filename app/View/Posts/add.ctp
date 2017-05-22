<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="posts form">
<?php echo $this->Form->create('Post', array('type' => 'file', 'enctype' => 'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Add Post'); ?></legend>
	<?php
//		echo $this->Form->input('user_id');
		echo $this->Form->input('user_id', array('label' => array('text' => 'user' ,'class' => 'label label-default'), 'class' => 'selectpicker show-tick form-control'));
//		echo $this->Form->input('title');
		echo $this->Form->input('title', array('label' => array('text' => 'title' ,'class' => 'label label-default'), 'class' => 'form-control'));
//		echo $this->Form->input('body');
		echo $this->Form->input('body', array('label' => array('text' => 'body' ,'class' => 'label label-default'), 'class' => 'form-control'));
//		echo $this->Form->input('category_id');
		echo $this->Form->input('category_id', array('label' => array('text' => 'body' ,'class' => 'label label-default'), 'class' => 'selectpicker show-tick form-control'));
//		echo $this->Form->input('Image.0.filename', array('type' => 'file', 'label' => false, 'style'=>'display:none', 'id'=>'inputFile'));
//		echo $this->Form->input('Image.0.filename', array('type' => 'file', 'multiple' => 'multiple', 'label' => false, 'id'=>'inputFile'));	//
		echo $this->Form->input('Image.', array('type' => 'file', 'multiple' => 'multiple', 'label' => false, 'id'=>'inputFile'));	//
//		echo $this->Form->input('Image.0.filename', array('type' => 'file', 'label' => false, 'id'=>'inputFile'));
		echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul style="list-style:none;">
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
	</ul>
</div>
</div>
</div>
</div>