<?php $actionLists = array(
		array(
			'label' => 'カテゴリ追加',
			'controller' => 'categories',
			'action' => 'add',
			'id' => null),
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>

<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="categories index">
	<h2><?php echo __('カテゴリ一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-condensed">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('カテゴリID'); ?></th>
			<th><?php echo $this->Paginator->sort('カテゴリ名'); ?></th>
			<th><?php echo $this->Paginator->sort('登録日時'); ?></th>
			<th><?php echo $this->Paginator->sort('更新日時'); ?></th>
			<th class="actions"><?php echo __('処理'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($categories as $category): ?>
	<tr>
		<td><?php echo h($category['Category']['id']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['categoryname']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['created']); ?>&nbsp;</td>
		<td><?php echo h($category['Category']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
			<div class="btn-group">
			<?php echo $this->Html->link(__('参照'), array('action' => 'view', $category['Category']['id']), array('class'=>'btn btn-default btn-sm')); ?>
			<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $category['Category']['id']), array('class'=>'btn btn-default btn-sm')); ?>
			<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $category['Category']['id']), array('confirm' => __('本当に削除してよろしいでしょうか # %s?', $category['Category']['id']), 'class'=>'btn btn-default btn-sm')); ?>
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
		<li><?php echo $this->Html->link(__('カテゴリ追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('投稿一覧'), array('controller' => 'posts', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
*/	?>
</div>
</div>