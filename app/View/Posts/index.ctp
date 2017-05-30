<?php echo $this->Html->script( 'jquery-git.js'); ?>
<?php echo $this->Html->script( 'test.js'); ?>
<?php echo $this->Html->css( 'custom.css'); ?>
<div class="container">
<div class="row">
<!--	<div class="posts index">	-->
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
	<h2><?php echo __('Posts '); ?></h2>

	<p>
		<input class="btn btn-default btn-sm" id="search-btn" type="button" value="検索非表示">
	</p>

	<?php echo $this->Form->create('Post', array('url'=>'index')); ?>
		<legend>検索条件</legend>
		<div class="input-group">
			<span class="input-group-addon">カテゴリ</span>
			<?php echo $this->Form->input('category_id', array('label'=>false, 'div'=>false ,'empty' => true, 'style' => 'font-size:14px;padding-bottom:5px;padding-top:5px;'));  ?>
		</div>
		<div class="input-group">
			<span class="input-group-addon">タイトル</span>
			<?php echo $this->Form->input('title', array('label'=>false, 'div'=>false, 'placeholder' => '部分一致検索'));  ?>
		</div>
		<div class="input-group">
			<span class="input-group-addon">タグ</span>
			<?php echo $this->Form->input('tag_id', array('label'=>false, 'div'=>false, 'empty' => true, 'style' => 'font-size:14px;padding-bottom:5px;padding-top:5px;'));  ?>
		</div>
	<?php echo $this->Form->end('検索'); ?>

	<?php $i = 1; ?>
	<?php foreach ($posts as $post): ?>
		<h2><?php echo h($post['Post']['title']); ?>&nbsp;</h2>
		<p>
			<?php echo h(substr($post['Post']['created'],0,10)  . " By " . $post['User']['username']); ?>
		</p>
		<p>
			<?php echo nl2br(h($post['Post']['body'])); ?>
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
<!--				<?php /* echo $this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'80','height'=>'80','class'=>'popupimg')); */ ?>	-->				
			<?php $str_i = "popupimg" . $i; ?>
				<?php echo $this->Html->link($this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'80','height'=>'80')) , $base . $image["dirname"] . "/" . $image["filename"], array('escape'=> false,'class'=>'popupimg', 'id'=>$str_i)); ?>
			<?php $i = $i + 1; ?>
			<?php } ?>
			&nbsp;
		
		
		<p class="actions">		
			<div class="btn-toolbar">
			<div class="btn-group">
					<?php echo $this->Html->link(__('View'), array('action' => 'view', $post['Post']['id']), array('class'=>'btn btn-default btn-sm')); ?>
					<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $post['Post']['id']), array('class'=>'btn btn-default btn-sm')); ?>
					<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $post['Post']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']), 'class'=>'btn btn-default btn-sm')); ?>
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

	<?php	echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?>
	<?php	echo $this->Paginator->numbers(array('separator' => '')); ?>
	<?php	echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')); ?>

	</div>
</div>
<!--	<div class="actions">	-->
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<h3><?php echo __('Actions'); ?></h3>
	<ul style="list-style:none;">
		<li><?php echo $this->Html->link(__('New Post'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tag'), array('controller' => 'tags', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistlist'); ?>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
</div>
	<!-- ポップアップ用の背景とimg -->
	<div id="popup-background">
	</div>
		<img id="popup-item" src=""/>
	<div id="popup-text">
		tesaa
	</div>
	<div id="hoge1">
	</div>


	

