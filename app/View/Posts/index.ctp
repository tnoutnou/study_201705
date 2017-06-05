<?php echo $this->Html->script( 'jquery-git.js'); ?>
<?php echo $this->Html->script( 'test.js'); ?>
<?php echo $this->Html->css( 'custom.css'); ?>
<div class="container">
	<div class="row">
<!--	<div class="posts index">	-->
		<div class="blogposts posts index col-xs-12 col-sm-10 col-md-10"">
			<h2><?php echo __('投稿一覧 '); ?></h2>
			<p>
				<input class="btn btn-default btn-sm" id="search-btn" type="button" value="検索非表示">
			</p>

	<!--	<?php echo $this->Form->create('Post', array('url'=>'index')); ?>	-->
			<?php echo $this->Form->create('Post', array('url'=>'index', 'class'=>'form-horizontal')); ?>
			<legend>検索条件</legend>
			<div class="row">
<!--				<div class="btn-group-sm">	-->
	<!--			<span class="input-group-addon" style="padding-bottom:3px!important;padding-top:3px!important;">カテゴリ</span>	-->
					<div class="form-group">
						<label class="control-label col-sm-3">カテゴリ</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('category_id', array('label'=>false, 'div'=>false ,'empty' => true, 'type'=>'select', 'multiple'=>true, 'class' => 'selectpicker show-menu-arrow form-control', ' style'=>'=padding-bottom:3px!important;padding-top:3px!important;'));  ?>
						</div>
					</div>
<!--				</div>	-->

<!--				<div class="input-group">	-->
	<!--			<span class="input-group-addon">カテゴリ文字検索</span>	-->
					<div class="form-group">
						<label class="control-label col-sm-3">カテゴリ文字検索</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('category_str', array('label'=>false, 'div'=>false, 'placeholder' => '部分一致検索', 'class' => 'form-control'));  ?>
						</div>
					</div>
<!--				</div>	-->

	<!--			<span class="input-group-addon">タイトル</span>		-->
					<div class="form-group">
						<label class="control-label col-sm-3">タイトル</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('title', array('label'=>false, 'div'=>false, 'placeholder' => '部分一致検索', 'class' => 'form-control'));  ?>
						</div>
					</div>

	<!--			<span class="input-group-addon">タグ</span>	-->
					<div class="form-group">
						<label class="control-label col-sm-3">タグ</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('tag_id', array('label'=>false, 'div'=>false, 'empty' => true, 'type'=>'select', 'multiple'=>true, 'class' => 'selectpicker show-menu-arrow form-control', 'style' => 'font-size:34px;padding-bottom:35px;padding-top:35px;'));  ?>
						</div>
					</div>

	<!--			<span class="input-group-addon">タグ文字検索</span>		-->
					<div class="form-group">
						<label class="control-label col-sm-3">タグ文字検索</label>
						<div class="col-sm-8">
							<?php echo $this->Form->input('tag_str', array('label'=>false, 'div'=>false, 'placeholder' => '部分一致検索', 'class' => 'form-control'));  ?>
						</div>
					</div>

				<?php echo $this->Form->end('検索'); ?>
			</div>

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
						<?php echo $this->Html->link(__('参照'), array('action' => 'view', $post['Post']['id']), array('class'=>'btn btn-default btn-sm')); ?>
						<?php echo $this->Html->link(__('編集'), array('action' => 'edit', $post['Post']['id']), array('class'=>'btn btn-default btn-sm')); ?>
						<?php echo $this->Form->postLink(__('削除'), array('action' => 'delete', $post['Post']['id']), array('confirm' => __('本当に削除してもよろしいでしょうか # %s?', $post['Post']['id']), 'class'=>'btn btn-default btn-sm')); ?>
				</div>
				</div>
			</p>

			
		<?php endforeach; ?>
		
			<p>
			<?php
			echo $this->Paginator->counter(array(
				'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
			));
			?>
			</p>

			<div class="paging">
				<?php	echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled')); ?>
				<?php	echo $this->Paginator->numbers(array('separator' => '')); ?>
				<?php	echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled')); ?>
			</div>
		</div>
<!--	<div class="actions">	-->
		<div class="blogaction actions col-xs-2 col-sm-2 col-md-2">
			<h3><?php echo __('処理'); ?></h3>
			<ul style="list-style:none;">
				<li><?php echo $this->Html->link(__('投稿追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?></li>
				<li><?php echo $this->Html->link(__('カテゴリ追加'), array('controller' => 'categories', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
				<li><?php echo $this->Html->link(__('タグ追加'), array('controller' => 'tags', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
				<?php echo $this->element('actlistlist'); ?>
				<?php echo $this->element('actlistall'); ?>
			</ul>
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


	

