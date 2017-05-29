<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="categories form">
<?php echo $this->Form->create('Category'); ?>
<?php /* echo $this->Form->create('Category', array('inputDefaults' => array('label' => array('class' => 'label label-default'), 'class' => 'form-control'))); */ ?>
<?php $this->Form->inputDefaults(array('label' => array('text' => '' ,'class' => 'label label-default'), 'class' => 'form-control')); ?>

	<fieldset>
		<legend><?php echo __('Edit Category'); ?></legend>
	<?php
		echo $this->Form->input('id', array('label' => array('text' => 'id')));
		echo $this->Form->input('categoryname', array('label' => array('text' => 'categoryname')));
	?>
	</fieldset>

<?php $this->Form->inputDefaults(array('label' => false, 'class' => 'btn')); ?>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Category.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Category.id')), 'class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('List Categories'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
</div>
</div>
