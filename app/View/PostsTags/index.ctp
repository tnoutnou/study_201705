<?php $actionLists = array(

		array(
			'label' => '投稿タグ追加',
			'controller' => 'PostsTags',
			'action' => 'add',
			'id' => null),
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>

<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="postsTags index">
	<h2><?php echo __('投稿タグ一覧'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table table-bordered table-condensed">
	<thead>
	<tr>
<?php /* 
			<th><?php echo $this->Paginator->sort('投稿タグID'); ?></th>
*/ ?>
			<th><?php echo $this->Paginator->sort('投稿ID'); ?></th>
			<th><?php echo $this->Paginator->sort('タグID'); ?></th>
			<th><?php echo $this->Paginator->sort('作成日時'); ?></th>
			<th><?php echo $this->Paginator->sort('更新日時'); ?></th>
			<th class="actions"><?php echo __('処理'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($postsTags as $postsTag): ?>
	<tr>

<?php /* 
	<td><?php echo h($postsTag['PostsTag']['id']); ?>&nbsp;</td>
*/ ?>
	
		<td>
			<?php
				echo $this->Html->link(
					$postsTag['Post']['title'],
					array(
						'controller' => 'posts',
						'action' => 'view',
						$postsTag['Post']['id'])
				);
			?>
		</td>

		<td>
			<?php
				echo $this->Html->link(
					$postsTag['Tag']['id'],
					array(
						'controller' => 'tags',
						'action' => 'view',
						$postsTag['Tag']['id'])
				);
			?>
		</td>
		<td><?php echo h($postsTag['PostsTag']['created']); ?>&nbsp;</td>
		<td><?php echo h($postsTag['PostsTag']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<div class="btn-toolbar">
			<div class="btn-group">
			<?php
				echo $this->Html->link(
					__('参照'),
					array(
						'action' => 'view',
						$postsTag['PostsTag']['post_id'],
						$postsTag['PostsTag']['tag_id']),
					array('class'=>'btn btn-default btn-sm'));
			?>
			<?php
				echo $this->Html->link(
					__('編集'),
					array(
						'action' => 'edit',
						$postsTag['PostsTag']['post_id'],
						$postsTag['PostsTag']['tag_id']),
					array('class'=>'btn btn-default btn-sm'));
			?>
			<?php
				echo $this->Form->postLink(
					__('削除'),
					array(
						'action' => 'delete',
						$postsTag['PostsTag']['post_id'],
						$postsTag['PostsTag']['tag_id']),
					array(
						'confirm' => __('本当に削除してもよろしいでしょう # %s?',
						$postsTag['PostsTag']['post_id'] ,
						$postsTag['PostsTag']['tag_id']),
					'class'=>'btn btn-default btn-sm')
				);
			?>
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
		<li><?php echo $this->Html->link(__('投稿タグ追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('タグ一覧'), array('controller' => 'tags', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('タグ追加'), array('controller' => 'tags', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('投稿一覧'), array('controller' => 'posts', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
*/	?>
</div>
</div>
