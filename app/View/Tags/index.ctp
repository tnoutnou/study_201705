<?php $actionLists = array(
		array(
			'label' => 'タグ追加',
			'controller' => 'tags',
			'action' => 'add',
			'id' => null),
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>
<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="tags index">
	<h2><?php echo __('タグ一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-condensed">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('タグID'); ?></th>
			<th><?php echo $this->Paginator->sort('タグ名'); ?></th>
			<th><?php echo $this->Paginator->sort('作成日時'); ?></th>
			<th><?php echo $this->Paginator->sort('更新日時'); ?></th>
			<th class="actions"><?php echo __('処理'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($tags as $tag): ?>
	<tr>
		<td><?php echo h($tag['Tag']['id']); ?>&nbsp;</td>
		<td><?php echo h($tag['Tag']['name']); ?>&nbsp;</td>
		<td><?php echo h($tag['Tag']['created']); ?>&nbsp;</td>
		<td><?php echo h($tag['Tag']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
			<div class="btn-group">
			<?php echo $this->Html->link(__('参照'), array('action' => 'view', $tag['Tag']['id']), array('class'=>'btn btn-default btn-sm')); ?>
			<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $tag['Tag']['id']), array('class'=>'btn btn-default btn-sm')); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $tag['Tag']['id']), array('confirm' => __('本当に削除してもよろしいでしょうか # %s?', $tag['Tag']['id']), 'class'=>'btn btn-default btn-sm')); ?>
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
		<li><?php echo $this->Html->link(__('タグ追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('投稿一覧'), array('controller' => 'posts', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
*/	?>
</div>
</div>
