<?php $actionLists = array(
		array(
			'label' => '投稿タグ削除',
			'controller' => 'PostsTags',
			'action' => 'delete',
			'id' => $this->Form->value('PostsTag.post_id'),
			'id2' => $this->Form->value('PostsTag.tag_id')),
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>
<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="postsTags form">
<?php echo $this->Form->create('PostsTag'); ?>
<?php
	$this->Form->inputDefaults(
		array(
			'label' => array('text' => '' ,'class' => 'label label-default'),
			'class' => 'form-control'));
?>
	<fieldset>
		<legend><?php echo __('投稿タグ編集'); ?></legend>
	<?php
		echo $this->Form->input('id', array('label' => array('text' => '投稿タグID')));
		echo $this->Form->input('post_id', array('label' => array('text' => 'ポストID')));
		echo $this->Form->input('tag_id', array('label' => array('text' => 'タグID')));
	?>
	</fieldset>
<?php $this->Form->inputDefaults(array('label' => false, 'class' => 'btn', 'disabled'=>'disabled')); ?>
<?php echo $this->Form->end(__('更新')); ?>
</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<?php /* echo $this->element('login_user'); 
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('投稿タグ削除'), array('action' => 'delete', $this->Form->value('PostsTag.id')), array('confirm' => __('本当に削除してよろしいでしょうか # %s?', $this->Form->value('PostsTag.id')), 'class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('投稿タグ一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('タグ一覧'), array('controller' => 'tags', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('タグ登録'), array('controller' => 'tags', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
*/	?>
</div>
</div>

	<!-- ポップアップ用の背景とimg -->
	<div style='font-size:100px;color:red;position:fixed;top:80px;left:240px;'>
		利用中止
	</div>

	