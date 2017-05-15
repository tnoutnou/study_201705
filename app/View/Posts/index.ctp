<div class="container">
<div class="row">
<!--	<div class="posts index">	-->
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
	<h2><?php echo __('Post11s'); ?></h2>
	<?php echo $this->Form->create('Post', array('url'=>'index')); ?>
		<legend>検索</legend>
		<div class="input-group">
			<span class="input-group-addon">カテゴリ</span>
			<?php echo $this->Form->input('category_id', array('label'=>false, 'div'=>false ,'empty' => true));  ?>
		</div>
		<div class="input-group">
			<span class="input-group-addon">タイトル</span>
			<?php echo $this->Form->input('title', array('label'=>false, 'div'=>false, 'placeholder' => '部分一致検索'));  ?>
		</div>
		<div class="input-group">
			<span class="input-group-addon">タグ</span>
			<?php echo $this->Form->input('tag_id', array('label'=>false, 'div'=>false, 'empty' => true,'font-size'=>'14px'));  ?>
		</div>
	<?php echo $this->Form->end('検索'); ?>

	<?php foreach ($posts as $post): ?>
		<h2><?php echo h($post['Post']['title']); ?>&nbsp;</h2>
		<p>
			<?php echo h(substr($post['Post']['created'],0,10)  . " By " . $post['User']['username']); ?>
		</p>
		<p>
			<?php echo h($post['Post']['body']); ?>
		</p>
		<p>
			<?php echo h("カテゴリ：　" . $post['Category']['categoryname']); ?>
		</p>
		<p>
			<?php echo h("タグ：　"); ?>
			<?php foreach ($post['Tag'] as $taglist) {?>
			<?php echo h($taglist['tagname']); ?>
			<?php } ?>
		</p>


			<?php $base = "/app/webroot/files/image/filename/"; ?>
			<?php foreach ($post['Image'] as $image) {?>
				<?php echo $this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'80','height'=>'80')); ?>
			<?php } ?>
			&nbsp;
		
		
		<p class="actions">		
			<div class="btn-toolbar">
			<div class="btn-group">
				<div class="btn btn-default btn-sm">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id'])); ?>
				</div>
				<div class="btn btn-default btn-sm">
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id'])); ?>
				</div>
				<div class="btn btn-default btn-sm">
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']))); ?>
				</div>
			</div>
			</div>
		</p>

		
	<?php endforeach; ?>
	

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
<!--	<div class="actions">	-->
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List Images'), array('controller' => 'images', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('List PostsTags'), array('controller' => 'PostsTags', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('ログアウト'), array('controller' => 'users', 'action' => 'logout')); ?> </li>
	</ul>
</div>
</div>

