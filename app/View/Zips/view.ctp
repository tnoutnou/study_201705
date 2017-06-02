<div class="zips view">
<h2><?php echo __('Zip'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Zip Code'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['zip_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ken Name Kana'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['ken_name_kana']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City Name Kana'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['city_name_kana']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Town Name Kana'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['town_name_kana']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ken Name Kan'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['ken_name_kan']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('City Name Kan'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['city_name_kan']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Town Name Kan'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['town_name_kan']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flg1'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['flg1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flg2'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['flg2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flg3'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['flg3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flg4'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['flg4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flg5'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['flg5']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Flg6'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['flg6']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($zip['Zip']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Zip'), array('action' => 'edit', $zip['Zip']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Zip'), array('action' => 'delete', $zip['Zip']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $zip['Zip']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Zips'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Zip'), array('action' => 'add')); ?> </li>
	</ul>
</div>
