<?php echo $this->Html->script( 'jquery-git.js'); ?>
<?php echo $this->Html->script( 'test.js'); ?>
<?php echo $this->Html->css( 'custom.css'); ?>
<?php $actionLists = array(
		array(
			'label' => '投稿編集',
			'controller' => 'posts',
			'action' => 'edit',
			'id' => $post['Post']['id']),
		array(
			'label' => '投稿削除',
			'controller' => 'posts',
			'action' => 'delete',
			'id' => $post['Post']['id']),
		array(
			'label' => '投稿追加',
			'controller' => 'posts',
			'action' => 'add',
			'id' => null),
);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>
<div class="container">
<div class="row">
<?php echo $this->Html->css('custom.css'); ?>
<div class="posts view">
<div class="blogposts posts index col-xs-12 col-sm-8 col-sm-offset-1 col-md-9 col-md-offset-1">
<!--<h2><?php echo __('投稿参照'); ?></h2>	-->
			&nbsp;
	<div class="row">

		<div class="col-xs-4">
			<?php
				if (!($pre_post['title'] == NULL)) {
					echo $this->Html->link(
						'< 前 「' . h($pre_post['title']) . '」',
						array(
							'action' => 'view',
							$pre_post['id'],
							$pre_post['pkey']),					
						array('class'=>'btn btn-link','style'=>'width:100%;align:left;text-align:left;')
					);
				}
			?>
		</div>
		<div class="col-xs-4">
		<?php
			echo $this->Html->Link(
				__('一覧の戻る'),
				$preurl,
				array(
					'class'=>'btn btn-success btn-sm',
					'style'=>'width:100%;align:center;text-align:center;margin-bottom:5px;',
					'full_base' => true
				)
			);
/*
			echo $this->Html->link(
				__('工事中'),
				array(
					'action' => 'backIndex',
					),
				array(
					'class'=>'btn btn-success btn-sm',
					'style'=>'margin-right:3px;margin-bottom:3px;')
			);
*/
		?>
		</div>

		<div class="col-xs-4">
			<?php
				if (!($nxt_post['title'] == NULL)) {
					echo $this->Html->link(
						'「' . h($nxt_post['title']) . '」 次 ＞',
						array(
							'action' => 'view',
							$nxt_post['id'],
							$nxt_post['pkey']),					
						array('class'=>'btn btn-link','style'=>'width:100%;align:right;text-align:right;')
					);
				}
			?>
		</div>

	</div>

	<div class="panel panel-success">
		<div class="panel-heading">
			<h2><?php echo h($post['Post']['title']); ?>&nbsp;</h2>
		</div>

		<div class="panel-body">
	<p id="writen_date">
		<?php echo h(substr($post['Post']['created'],0,10)  . " By " . $post['User']['username']); ?>
	</p>
	
	<legend></legend>

	
	<p>
		<?php echo nl2br(h($post['Post']['body'])); ?>
	</p>

	<legend></legend>
		
	<div class="row">
		<div class="row">
		<p>
			<div class="col-sm-3">
				<span class="view_other">
					<?php echo h("カテゴリ"); ?>
				</span>
			</div>
			<div class="col-sm-8">
				<span class="label label-info">
					<?php echo h($post['Category']['categoryname']); ?>
				</span>
			</div>
			
		</p>
		<p>
			<div class="col-sm-3">
				<span class="view_other">
					<?php echo h("タグ"); ?>
				</span>
			</div>
			<div class="col-sm-8">
			<?php foreach ($post['Tag'] as $taglist) {?>
			<span class="label label-warning" style="margin-right:3px;">
				<?php echo h($taglist['tagname']); ?>
			</span>
			<?php } ?>
			</div>
		</p>
		</div>

	<div class="col-sm-12" style="margin-top:20px;"></div>

	
	<?php /* $base = $this->Html->url( "/app/webroot/files/image/filename/" ); */ ?>
	<?php $base = "/app/webroot/files/image/filename/"; ?>

	<?php $i = 1; ?>
	<?php foreach ($post['Image'] as $image) {?>

	<?php /* echo $this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'100','height'=>'100','class'=>'popupimg')); */ ?>

	<?php $str_i = "popupimg" . $i; ?>
		<?php echo $this->Html->link($this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'120','height'=>'120')) , $base . $image["dirname"] . "/" . $image["filename"], array('escape'=> false,'class'=>'popupimg view_img', 'id'=>$str_i)); ?>
	<?php $i = $i + 1; ?>

	<?php } ?>
	&nbsp;
	<?php /* echo $this->Html->image( "/app/webroot/files/image/filename/3/rakugaki.png" ); */ ?>

	<p style="margin-top:20px;">
		<span style="margin-left:20px;"><?php echo h("投稿日時：" . $post['Post']['created']); ?></span>
		<span style="margin-left:20px;"><?php echo h("編集日時：" . $post['Post']['modified']); ?></span>
		<span style="margin-left:20px;"><?php echo h("投稿ID：" . $post['Post']['id']); ?></span>
	</p>
	
	</div>

		</div>

	</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-2 col-md-1">
	<?php /* echo $this->element('login_user'); 
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
*/	?>
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


