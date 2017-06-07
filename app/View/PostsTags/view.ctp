<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="postsTags view">
<h2><?php echo __('投稿タグ'); ?></h2>
	<dl>
		<dt><?php echo __('投稿タグID'); ?></dt>
		<dd>
			<?php echo h($postsTag['PostsTag']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('投稿'); ?></dt>
		<dd>
			<?php echo $this->Html->link($postsTag['Post']['title'], array('controller' => 'posts', 'action' => 'view', $postsTag['Post']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('タグ'); ?></dt>
		<dd>
			<?php echo $this->Html->link($postsTag['Tag']['id'], array('controller' => 'tags', 'action' => 'view', $postsTag['Tag']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('作成日時'); ?></dt>
		<dd>
			<?php echo h($postsTag['PostsTag']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('更新日時'); ?></dt>
		<dd>
			<?php echo h($postsTag['PostsTag']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<?php echo $this->element('login_user'); ?>
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('投稿タグ編集'), array('action' => 'edit', $postsTag['PostsTag']['id']), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Form->postLink(__('投稿タグ削除'), array('action' => 'delete', $postsTag['PostsTag']['id']), array('confirm' => __('本当に削除してもよろしいでしょうか # %s?', $postsTag['PostsTag']['id']), 'class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('投稿タグ一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('投稿タグ追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('タグ一覧'), array('controller' => 'tags', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('タグ追加'), array('controller' => 'tags', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
</div>
</div>
