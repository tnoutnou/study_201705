<?php echo $this->Html->css( 'custom.css'); ?>
<div class="posts view">
<h2><?php echo __('Post'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($post['Post']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($post['User']['id'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Title'); ?></dt>
		<dd>
			<?php echo h($post['Post']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Body'); ?></dt>
		<dd>
			<?php echo h($post['Post']['body']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Category_id'); ?></dt>
		<dd>
			<?php echo h($post['Post']['category_id']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('tag_name'); ?></dt>
		<dd>
			<?php foreach ($post['Tag'] as $taglist) {?>
			<?php echo h($taglist['tagname']); ?>
			<?php } ?>
			&nbsp;
		</dd>

		<dt><?php echo __('image'); ?></dt>
		<dd>
			<?php /* $base = $this->Html->url( "/app/webroot/files/image/filename/" ); */ ?>
			<?php $base = "/app/webroot/files/image/filename/"; ?>
			<?php foreach ($post['Image'] as $image) {?>
			<?php echo $this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'100','height'=>'100')); ?>
			<?php } ?>
			&nbsp;
			<?php /* echo $this->Html->image( "/app/webroot/files/image/filename/3/rakugaki.png" ); */ ?>
		</dd>
		
		
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($post['Post']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($post['Post']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Post'), array('action' => 'edit', $post['Post']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Post'), array('action' => 'delete', $post['Post']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
