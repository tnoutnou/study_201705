<?php $actionLists = array(
		array(
			'label' => 'イメージ編集',
			'controller' => 'images',
			'action' => 'edit'),
		array(
			'label' => 'イメージ削除',
			'controller' => 'images',
			'action' => 'delete'),
		array(
			'label' => 'イメージ追加',
			'controller' => 'images',
			'action' => 'add'),
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>
<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">

<div class="images view">
<h2><?php echo __('イメージ参照'); ?></h2>
	<dl>
		<dt><?php echo __('イメージID'); ?></dt>
		<dd>
			<?php echo h($image['Image']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('投稿'); ?></dt>
		<dd>
			<?php echo $this->Html->link($image['Post']['title'], array('controller' => 'posts', 'action' => 'view', $image['Post']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ファイル名'); ?></dt>
		<dd>
			<?php echo h($image['Image']['filename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ディレクトリ名'); ?></dt>
		<dd>
			<?php echo h($image['Image']['dirname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('作成日時'); ?></dt>
		<dd>
			<?php echo h($image['Image']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('更新日時'); ?></dt>
		<dd>
			<?php echo h($image['Image']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<?php /* echo $this->element('login_user'); */	?>
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('イメージ編集'), array('action' => 'edit', $image['Image']['id']), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Form->postLink(__('イメージ削除'), array('action' => 'delete', $image['Image']['id']), array('confirm' => __('本当に削除してもよろしいでしょうか # %s?', $image['Image']['id']), 'class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('イメージ一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('イメージ追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>

	</ul>
</div>
</div>
</div>

