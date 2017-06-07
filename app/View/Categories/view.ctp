<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="categories view">
<h2><?php echo __('カテゴリ参照'); ?></h2>
	<dl>
		<dt><?php echo __('カテゴリID'); ?></dt>
		<dd>
			<?php echo h($category['Category']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('カテゴリ名'); ?></dt>
		<dd>
			<?php echo h($category['Category']['categoryname']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('登録日時'); ?></dt>
		<dd>
			<?php echo h($category['Category']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('更新日時'); ?></dt>
		<dd>
			<?php echo h($category['Category']['modified']); ?>
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
		<li><?php echo $this->Html->link(__('カテゴリ編集'), array('action' => 'edit', $category['Category']['id']), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Form->postLink(__('カテゴリ削除'), array('action' => 'delete', $category['Category']['id']), array('confirm' => __('本当に削除してもよろしいでしょうか # %s?', $category['Category']['id']), 'class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('カテゴリ一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('カテゴリ追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
</div>
</div>
