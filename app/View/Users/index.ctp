<?php $actionLists = array(
		array(
			'label' => 'ユーザ追加',
			'controller' => 'users',
			'action' => 'add',
			'id' => null),
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>
<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="users index">
	<h2><?php echo __('ユーザ一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-condensed">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('ユーザID'); ?></th>
			<th><?php echo $this->Paginator->sort('ユーザ名'); ?></th>
			<th><?php echo $this->Paginator->sort('郵便番号'); ?></th>
			<th><?php echo $this->Paginator->sort('都道府県'); ?></th>
			<th><?php echo $this->Paginator->sort('市区'); ?></th>
			<th><?php echo $this->Paginator->sort('町村'); ?></th>
			<th><?php echo $this->Paginator->sort('番地以下'); ?></th>
<!--			<th><?php echo $this->Paginator->sort('パスワード'); ?></th>	-->
			<th><?php echo $this->Paginator->sort('グループID'); ?></th>
			<th><?php echo $this->Paginator->sort('作成日時'); ?></th>
			<th><?php echo $this->Paginator->sort('更新日時'); ?></th>
			<th class="actions"><?php echo __('処理'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($users as $user): ?>
	<tr>
		<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
<!--		<td><?php echo h($user['User']['password']); ?>&nbsp;</td>	-->
		<td><?php echo h($user['User']['zip_code']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['ken_name_kan']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['city_name_kan']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['town_name_kan']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['detail_name_kan']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
		</td>
		<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
		<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
			<div class="btn-group">
			<?php echo $this->Html->link(__('参照'), array('action' => 'view', $user['User']['id']), array('class'=>'btn btn-default btn-sm')); ?>
			<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $user['User']['id']), array('class'=>'btn btn-default btn-sm')); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('本当に削除してもよろしいでしょうか # %s?', $user['User']['id']), 'class'=>'btn btn-default btn-sm')); ?>
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
		'format' => __(' {:page}ページ目表示（全{:pages}ページ） {:current}件表示（全{:count}件）, {:start}件目～{:end}件目 を表示')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('前へ'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('次へ') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<?php /* echo $this->element('login_user'); 
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('ユーザ追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('グループ一覧'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('グループ追加'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('投稿一覧'), array('controller' => 'posts', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
*/	?>
</div>
</div>

