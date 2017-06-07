<div class="zips index">
	<h2><?php echo __('Zips'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('zip_code'); ?></th>
			<th><?php echo $this->Paginator->sort('ken_name_kana'); ?></th>
			<th><?php echo $this->Paginator->sort('city_name_kana'); ?></th>
			<th><?php echo $this->Paginator->sort('town_name_kana'); ?></th>
			<th><?php echo $this->Paginator->sort('ken_name_kan'); ?></th>
			<th><?php echo $this->Paginator->sort('city_name_kan'); ?></th>
			<th><?php echo $this->Paginator->sort('town_name_kan'); ?></th>
			<th><?php echo $this->Paginator->sort('flg1'); ?></th>
			<th><?php echo $this->Paginator->sort('flg2'); ?></th>
			<th><?php echo $this->Paginator->sort('flg3'); ?></th>
			<th><?php echo $this->Paginator->sort('flg4'); ?></th>
			<th><?php echo $this->Paginator->sort('flg5'); ?></th>
			<th><?php echo $this->Paginator->sort('flg6'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($zips as $zip): ?>
	<tr>
		<td><?php echo h($zip['Zip']['id']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['zip_code']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['ken_name_kana']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['city_name_kana']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['town_name_kana']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['ken_name_kan']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['city_name_kan']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['town_name_kan']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['flg1']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['flg2']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['flg3']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['flg4']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['flg5']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['flg6']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['created']); ?>&nbsp;</td>
		<td><?php echo h($zip['Zip']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $zip['Zip']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $zip['Zip']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $zip['Zip']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $zip['Zip']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __(' {:page}ページ目表示（全{:pages}ページ） {:current}件表示（全{:count}件）, {:start}件目～{:end}件目 を表示')	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('前へ'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('次へ') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Zip'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('list Buser'), array('controller' => 'Busers' ,'action' => 'index')); ?></li>
	</ul>
</div>
