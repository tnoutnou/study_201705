<div class="zips form">
<?php echo $this->Form->create('Zip'); ?>
	<fieldset>
		<legend><?php echo __('Edit Zip'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('zip_code');
		echo $this->Form->input('prefecture_name_kana');
		echo $this->Form->input('city_name_kana');
		echo $this->Form->input('town_name_kana');
		echo $this->Form->input('prefecture_name_kan');
		echo $this->Form->input('city_name_kan');
		echo $this->Form->input('town_name_kan');
		echo $this->Form->input('flg1');
		echo $this->Form->input('flg2');
		echo $this->Form->input('flg3');
		echo $this->Form->input('flg4');
		echo $this->Form->input('flg5');
		echo $this->Form->input('flg6');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Zip.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Zip.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Zips'), array('action' => 'index')); ?></li>
	</ul>
</div>
