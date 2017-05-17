<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="postsTags view">
<h2><?php echo __('Posts Tag'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($postsTag['PostsTag']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Post'); ?></dt>
		<dd>
			<?php echo $this->Html->link($postsTag['Post']['title'], array('controller' => 'posts', 'action' => 'view', $postsTag['Post']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tag'); ?></dt>
		<dd>
			<?php echo $this->Html->link($postsTag['Tag']['id'], array('controller' => 'tags', 'action' => 'view', $postsTag['Tag']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($postsTag['PostsTag']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($postsTag['PostsTag']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Posts Tag'), array('action' => 'edit', $postsTag['PostsTag']['id']), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Posts Tag'), array('action' => 'delete', $postsTag['PostsTag']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $postsTag['PostsTag']['id']), 'class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts Tags'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('New Posts Tag'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('List Posts'), array('controller' => 'posts', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('New Post'), array('controller' => 'posts', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tags'), array('controller' => 'tags', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
	</ul>
</div>
</div>
</div>
