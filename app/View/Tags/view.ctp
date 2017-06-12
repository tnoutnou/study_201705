<?php $actionLists = array(
		array(
			'label' => 'タグ編集',
			'controller' => 'tags',
			'action' => 'edit'),
		array(
			'label' => 'タグ削除',
			'controller' => 'tags',
			'action' => 'delete'),
		array(
			'label' => 'タグ追加',
			'controller' => 'tags',
			'action' => 'add'),
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>
<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="tags view">
<h2><?php echo __('タグ参照'); ?></h2>
	<dl>
		<dt><?php echo __('タグID'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('タグ名'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['tagname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('作成日時'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('更新日時'); ?></dt>
		<dd>
			<?php echo h($tag['Tag']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('関連投稿一覧'); ?></h3>
	<?php if (!empty($tag['Post'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('投稿ID'); ?></th>
		<th><?php echo __('ユーザID'); ?></th>
		<th><?php echo __('タイトル'); ?></th>
		<th><?php echo __('本文'); ?></th>
		<th><?php echo __('カテゴリID'); ?></th>
		<th><?php echo __('作成日時'); ?></th>
		<th><?php echo __('更新日時'); ?></th>
		<th class="actions"><?php echo __('処理'); ?></th>
	</tr>
	<?php foreach ($tag['Post'] as $post): ?>
		<tr>
			<td><?php echo $post['id']; ?></td>
			<td><?php echo $post['user_id']; ?></td>
			<td><?php echo $post['title']; ?></td>
			<td><?php echo $post['body']; ?></td>
			<td><?php echo $post['category_id']; ?></td>
			<td><?php echo $post['created']; ?></td>
			<td><?php echo $post['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('参照'), array('controller' => 'posts', 'action' => 'view', $post['id'])); ?>
				<?php echo $this->Html->link(__('編集'), array('controller' => 'posts', 'action' => 'edit', $post['id'])); ?>
				<?php echo $this->Form->postLink(__('削除'), array('controller' => 'posts', 'action' => 'delete', $post['id']), array('confirm' => __('本当に削除してもよろしいでしょうか # %s?', $post['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
	<?php endif; ?>
</div>



</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<?php /* echo $this->element('login_user'); */	?>
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('タグ編集'), array('action' => 'edit', $tag['Tag']['id']), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Form->postLink(__('タグ削除'), array('action' => 'delete', $tag['Tag']['id']), array('confirm' => __('本当に削除してもよろしいでしょうか # %s?', $tag['Tag']['id']), 'class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('タグ一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('タグ追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>


</div>
