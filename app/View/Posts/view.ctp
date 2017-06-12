<?php echo $this->Html->script( 'jquery-git.js'); ?>
<?php echo $this->Html->script( 'test.js'); ?>
<?php echo $this->Html->css( 'custom.css'); ?>
<?php $actionLists = array(
		array(
			'label' => '投稿編集',
			'controller' => 'posts',
			'action' => 'edit'),
		array(
			'label' => '投稿削除',
			'controller' => 'posts',
			'action' => 'delete'),
		array(
			'label' => '投稿追加',
			'controller' => 'posts',
			'action' => 'add'),
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>
<div class="container">
<div class="row">
<?php echo $this->Html->css( 'custom.css'); ?>
<div class="posts view">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<h2><?php echo __('投稿参照'); ?></h2>
			&nbsp;
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

	<?php /* $base = $this->Html->url( "/app/webroot/files/image/filename/" ); */ ?>
	<?php $base = "/app/webroot/files/image/filename/"; ?>

	<?php $i = 1; ?>
	<?php foreach ($post['Image'] as $image) {?>

	<?php /* echo $this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'100','height'=>'100','class'=>'popupimg')); */ ?>

	<?php $str_i = "popupimg" . $i; ?>
		<?php echo $this->Html->link($this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'100','height'=>'100')) , $base . $image["dirname"] . "/" . $image["filename"], array('escape'=> false,'class'=>'popupimg', 'id'=>$str_i)); ?>
	<?php $i = $i + 1; ?>

	<?php } ?>
	&nbsp;
	<?php /* echo $this->Html->image( "/app/webroot/files/image/filename/3/rakugaki.png" ); */ ?>

	<p>
		<?php echo h("投稿日時：" . $post['Post']['created']); ?>
	</p>
	<p>
		<?php echo h("編集日時：" . $post['Post']['modified']); ?>
	</p>
	<p>
		<?php echo h("投稿ID：" . $post['Post']['id']); ?>
	</p>
	
<!--	<dl>	-->
<!--		<dt><?php echo __('投稿ID'); ?></dt>	-->
<!--		<dd>	-->
<!--			<?php echo h($post['Post']['id']); ?>	-->
<!--			&nbsp;	-->
<!--		</dd>	-->
<!--		<dt><?php echo __('投稿者名'); ?></dt>	-->
<!--		<dd>	-->
<!--			<?php echo $this->Html->link($post['User']['username'], array('controller' => 'users', 'action' => 'view', $post['User']['id'])); ?>	-->
<!--			&nbsp;	-->
<!--		</dd>	-->
<!--		<dt><?php echo __('タイトル'); ?></dt>	-->
<!--		<dd>	-->
<!--			<?php echo h($post['Post']['title']); ?>	-->
<!--			&nbsp;	-->
<!--		</dd>	-->
<!--		<dt><?php echo __('本文'); ?></dt>	-->
<!--		<dd>	-->
<!--			<?php echo h($post['Post']['body']); ?>	-->
<!--			&nbsp;	-->
<!--		</dd>	-->

<!--		<dt><?php echo __('カテゴリ'); ?></dt>	-->
<!--		<dd>	-->
<!--			<?php echo h($post['Category']['categoryname']); ?>	-->
<!--			&nbsp;	-->
<!--		</dd>	-->

<!--		<dt><?php echo __('タグ名'); ?></dt>	-->
<!--		<dd>	-->
<!--			<?php foreach ($post['Tag'] as $taglist) {?>	-->
<!--			<?php echo h($taglist['tagname']); ?>	-->
<!--			<?php } ?>	-->
<!--			&nbsp;	-->
<!--		</dd>	-->

<!--		<dt><?php echo __('添付イメージ'); ?></dt>	-->
<!--		<dd>	-->
<!--			<?php /* $base = $this->Html->url( "/app/webroot/files/image/filename/" ); */ ?>	-->
<!--			<?php $base = "/app/webroot/files/image/filename/"; ?>	-->

<!--			<?php $i = 1; ?>	-->
<!--			<?php foreach ($post['Image'] as $image) {?>	-->

<!--			<?php /* echo $this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'100','height'=>'100','class'=>'popupimg')); */ ?>	-->

<!--			<?php $str_i = "popupimg" . $i; ?>	-->
<!--				<?php echo $this->Html->link($this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'100','height'=>'100')) , $base . $image["dirname"] . "/" . $image["filename"], array('escape'=> false,'class'=>'popupimg', 'id'=>$str_i)); ?>	-->
<!--			<?php $i = $i + 1; ?>	-->

<!--			<?php } ?>	-->
<!--			&nbsp;	-->
<!--			<?php /* echo $this->Html->image( "/app/webroot/files/image/filename/3/rakugaki.png" ); */ ?>	-->
<!--		</dd>	-->
		
		
<!--		<dt><?php echo __('投稿日時'); ?></dt>	-->
<!--		<dd>	-->
<!--			<?php echo h($post['Post']['created']); ?>	-->
<!--			&nbsp;	-->
<!--		</dd>	-->
<!--		<dt><?php echo __('編集日時'); ?></dt>	-->
<!--		<dd>	-->
<!--			<?php echo h($post['Post']['modified']); ?>	-->
<!--			&nbsp;	-->
<!--		</dd>	-->
<!--	</dl>	-->

</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<?php /* echo $this->element('login_user'); */	?>
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul style="list-style:none;">
		<?php if (($this->Session->read('admin_flg') === '1') or ($this->Session->read('login_user') === $post['User']['username'] )) {	?>
			<li><?php echo $this->Html->link(__('投稿編集'), array('action' => 'edit', $post['Post']['id']), array('class'=>'btn btn-default btn-sm')); ?> </li>
			<li><?php echo $this->Form->postLink(__('投稿削除'), array('action' => 'delete', $post['Post']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $post['Post']['id']), 'class'=>'btn btn-default btn-sm')); ?> </li>
		<?php }	?>
		<li><?php echo $this->Html->link(__('投稿追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistlist'); ?>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
</div>
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


