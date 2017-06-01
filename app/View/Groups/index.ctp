<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="groups index">
	<h2><?php echo __('Groups'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-condensed">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('グループID'); ?></th>
			<th><?php echo $this->Paginator->sort('グループ名'); ?></th>
			<th><?php echo $this->Paginator->sort('作成日時'); ?></th>
			<th><?php echo $this->Paginator->sort('更新日時'); ?></th>
			<th class="actions"><?php echo __('処理'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($groups as $group): ?>
	<tr>
		<td><?php echo h($group['Group']['id']); ?>&nbsp;</td>
		<td><?php echo h($group['Group']['name']); ?>&nbsp;</td>
		<td><?php echo h($group['Group']['created']); ?>&nbsp;</td>
		<td><?php echo h($group['Group']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
			<div class="btn-group">
			<?php echo $this->Html->link(__('参照'), array('action' => 'view', $group['Group']['id']), array('class'=>'btn btn-default btn-sm')); ?>
			<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $group['Group']['id']), array('class'=>'btn btn-default btn-sm')); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $group['Group']['id']), array('confirm' => __('本当に削除していもよろしいでしょうか？ # %s?', $group['Group']['id']), 'class'=>'btn btn-default btn-sm')); ?>
			</div>
			</div>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('グループ追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('ユーザ一覧'), array('controller' => 'users', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('ユーザ追加'), array('controller' => 'users', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
</div>
</div>
