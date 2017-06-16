<?php echo $this->Html->script('jquery-git.js'); ?>
<?php echo $this->Html->script('test.js'); ?>
<?php echo $this->Html->css('custom.css'); ?>
<?php $actionLists = array(
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
		<div class="blogposts posts index col-xs-12 col-sm-9 col-md-9">
			<h2><?php echo __('投稿一覧'); ?></h2>

		<?php $i = 1; ?>
		<?php foreach ($posts as $post): ?>
		
			<div class="one_post clearfix">
			
<!--				<legend></legend>	-->

<!--			<h2><?php echo h($post['Post']['title']); ?>&nbsp;</h2>	-->
			<h2>
				<?php echo $this->Html->link(
					h($post['Post']['title']),
					array(
						'action' => 'view',
						$post['Post']['id']),
					array('class'=>'custom-a')
					);
				?>
			</h2>


			<p>
				<?php echo h(substr($post['Post']['created'],0,10)  . " By " . $post['User']['username']); ?>
			</p>


			<div class="col-sm-3 col-md-2">
<!--		添付イメージの表示	-->

				<?php
					$base = "/app/webroot/files/image/filename/";
					foreach ($post['Image'] as $image) {
						$str_i = "popupimg" . $i;
/*				echo $this->Html->link($this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'100','height'=>'100')) , $base . $image["dirname"] . "/" . $image["filename"], array('escape'=> false, 'class'=>'popupimg_ind', 'id'=>$str_i)); ?>	*/
/*				echo $this->Html->link($this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'100','height'=>'100')) , $base . $image["dirname"] . "/" . $image["filename"], array('escape'=> false,'class'=>'popupimg_ind', 'id'=>$str_i), array('action'=>'view', $post['Post']['id']), array('escape'=> false) ); ?>	*/
/*				echo $this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'100','height'=>'100') , array('url'=>array('action'=>'view', $post['Post']['id']))) ; ?>	*/
						echo $this->Html->image(
							$base . $image["dirname"] . "/" . $image["filename"],
								array(
									'width'=>'100','height'=>'100',
									'url'=>array('action'=>'view', $post['Post']['id'])
								)
							);
						$i = $i + 1;
/*	イメージは１つのみ表示するように修正（１回でループを抜ける）		*/
						break;
					}
					
					/*	添付イメージが１つも無い場合の処理 */
					if (count($post['Image']) == 0) {
						echo $this->Html->image(
							"/app/webroot/img/m_e_others_501_noimg.png",
							array(
								'width'=>'100','height'=>'100',
								'url'=>array('action'=>'view', $post['Post']['id'])
							)
						);						
					}					
				?>
			</div>
			
			
			
<!--		本文	-->
			<div class="col-sm-9 col-md-10">
				<p class="blogbody">
		<!--			先頭の５行だけ出力	-->
						<?php
							$n_ｃnt = substr_count($post['Post']['body'], "\n");
							if ($n_ｃnt >= 5) {
								$n_pos = strpos($post['Post']['body'], "\n", strpos($post['Post']['body'], "\n", strpos($post['Post']['body'], "\n", strpos($post['Post']['body'], "\n", strpos($post['Post']['body'], "\n") + 1)+1)+1)+1);
							}else {
								$n_pos = strlen($post['Post']['body']);
							}
						?>
						<?php
							echo $this->Html->link(
								nl2br(h(substr($post['Post']['body'],0,$n_pos))),
								array('action' => 'view', $post['Post']['id']),
								array('escape'=> false,
								'class'=>'custom-a')
							);
						?>
				</p>
			</div>

			
			&nbsp;
			
			<div class="col-sm-12"></div>
			
			<div class="col-sm-10">
			<div class="row">
				<p>
					<div class="col-sm-2">
						<?php echo "カテゴリ"; ?>
					</div>
					<div class="col-sm-10">
<!--					<span class="label label-info category-label"　data-category-id="<?php echo h($post['Category']['id']); ?>">	-->
					<div class="btn btn-xs btn-info category-label" data-category-id="<?php echo h($post['Category']['id']); ?>">
						<?php echo h($post['Category']['categoryname']); ?>
					</div>
					</div>
				</p>

				<div class="col-sm-12" style="padding-top:5px;"></div>

				<p>
					<div class="col-sm-2">
						<?php echo "タグ"; ?>
					</div>
					<div class="col-sm-10">
						<?php foreach ($post['Tag'] as $taglist) {?>
							<div class="btn btn-xs btn-warning tag-label" data-tag-id="<?php echo h($taglist['id']); ?>" style="margin-right:3px;">
								<?php echo h($taglist['tagname']); ?>
							</div>
						<?php } ?>
					</div>
				</p>
			</div>
			</div>

			
<!--			<div class="col-sm-10"></div>	-->
			<div class="col-sm-2">			
<!--			<p class="actions">			-->
<!--				<div class="btn-toolbar">	-->
<!--				<div class="btn-group btn-group-sm">	-->
<!--						<?php /* echo $this->Html->link(__('参照'), array('action' => 'view', $post['Post']['id']), array('class'=>'btn btn-default btn-sm')); */ ?>	-->
<!--管理者 or 投稿者＝ログインユーザなら「編集」「削除」ボタンを表示する。	-->
						<?php
							if (($this->Session->read('admin_flg') == '1') or ($this->Session->read('login_user') == $post['User']['username'] )) {
								echo $this->Html->link(
									__('編集'),
									array(
										'action' => 'edit',
										$post['Post']['id']),
									array(
										'class'=>'btn btn-success btn-sm',
										'style'=>'margin-right:3px;margin-bottom:3px;')
								);
								echo $this->Form->postLink(
									__('削除'),
									array(
										'action' => 'delete',
										$post['Post']['id']),
									array(
										'confirm' => __('本当に削除してもよろしいでしょうか # %s?', $post['Post']['id']),
										'class'=>'btn btn-warning btn-sm',
										'style'=>'margin-right:3px;margin-bottom:3px;')
								);
							}
						?>
<!--				</div>	-->
<!--			</p>	-->
			</div>

			
			</div>

		<?php endforeach; ?>
		
			<p>
			<?php
			echo $this->Paginator->counter(array(
				'format' => __(' {:page}ページ目表示（全{:pages}ページ） {:current}件表示（全{:count}件）, {:start}件目～{:end}件目 を表示')
			));
			?>
			</p>

			<div class="paging">
				<?php
					echo $this->Paginator->prev('< ' . __('前へ'), array(), null, array('class' => 'prev disabled'));
					echo $this->Paginator->numbers(array('separator' => ''));
					echo $this->Paginator->next(__('次へ') . ' >', array(), null, array('class' => 'next disabled'));
				?>
			</div>
		</div>
<!--	<div class="actions">	-->
<!--	★★★★★★★★★★★★★★★★★★★★★★★★	右側	開始　★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★	-->
		<div class="blogaction actions col-xs-12 col-sm-3 col-md-3">

			<div style="padding-top:10px;"></div>

<!--	★★★★★★★★★★★★★★★★★★★★★★★★	検査機能開始	★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★	-->
			<p>
				<input class="btn btn-info btn-sm" id="search-btn" type="button" value="検索非表示">
			</p>

			<?php echo $this->Form->create('Post', array('url'=>'index')); ?>
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h4>検索条件</h4>
				</div>
				<div class="panel-body">
			<div class="row">
					<div class="form-group">
						<label class="control-label col-sm-12">カテゴリ</label>
						<div class="col-sm-12">
							<?php
								echo $this->Form->input(
									'category_id',
									array(
										'label'=>false,
										'div'=>false ,
										'empty' => true,
										'type'=>'select',
										'multiple'=>true,
										'class' => 'selectpicker show-menu-arrow form-control',
										'style'=>'=padding-bottom:3px!important;padding-top:0px!important;margin-top:0px!important;'
									)
								);
							?>
						</div>
					</div>

					<div class="col-sm-12" style="padding-top:15px"></div>
					
					<div class="form-group">
						<label class="control-label col-sm-12">カテゴリ文字検索</label>
						<div class="col-sm-12">
							<?php
								echo $this->Form->input(
									'category_str',
									array(
										'label'=>false,
										'div'=>false,
										'placeholder' => '部分一致検索',
										'class' => 'form-control'
									)
								);
							?>
						</div>
					</div>

					<div class="col-sm-12" style="padding-top:15px"></div>
					
					<div class="form-group">
						<label class="control-label col-sm-12">タイトル</label>
						<div class="col-sm-12">
							<?php
								echo $this->Form->input(
									'title',
									array(
										'label'=>false,
										'div'=>false,
										'placeholder' => '部分一致検索',
										'class' => 'form-control'
									)
								);
							?>
						</div>
					</div>

					<div class="col-sm-12" style="padding-top:15px"></div>
					
					<div class="form-group">
						<label class="control-label col-sm-12">タグ</label>
						<div class="col-sm-12">
							<?php
								echo $this->Form->input(
									'tag_id',
									array(
										'label'=>false,
										'div'=>false,
										'empty' => true,
										'type'=>'select',
										'multiple'=>true,
										'class' => 'selectpicker show-menu-arrow form-control',
										'style' => 'font-size:34px;padding-bottom:35px;padding-top:35px;margin-top:0px!important;'
									)
								);
							?>
						</div>
					</div>

					<div class="col-sm-12" style="padding-top:15px"></div>
					
					<div class="form-group">
						<label class="control-label col-sm-12">タグ文字検索</label>
						<div class="col-sm-12">
							<?php
								echo $this->Form->input(
									'tag_str',
										array(
											'label'=>false,
											'div'=>false,
											'placeholder' => '部分一致検索',
											'class' => 'form-control'
										)
								);
							?>
						</div>
					</div>

	<!--			アーカイブ用		-->
					<?php
						echo $this->Form->input(
							'created_ym',
							array(
								'label'=>false,
								'div'=>false,
								'type' => 'hidden',
								'class' => 'form-control'
							)
						);
					?>
					
				<div class="col-sm-12" style="padding-top:10px;"></div>
				
<!--				<div class="col-sm-12" style="padding-right:10px;">	-->
				<div class="col-sm-12">
<!--				<div class="col-sm-12" style="margin-left:auto;margin-right:10px;">	-->
<!--					<?php /*echo $this->Form->end(array('label'=> '検索', 'div' => false, 'id' => 'src_btn', 'class'=>'btn btn-primary pull-right', 'style'=>'margin-left:auto;margin-right:10px;')); */ ?>	-->
					<?php
						echo $this->Form->end(
								array(
									'label'=> '検索',
									'div' => false,
									'id' => 'src_btn',
									'class'=>'btn btn-primary pull-right')
						);
					?>
				</div>
<!--				<div class="col-sm-3"></div>	-->

			</div>
			</div>

			</div>
<!--	★★★★★★★★★★★★★★★★★★★★★★★★	検査機能終了	★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★	-->



		<?php /* echo $this->element('login_user'); 
			<h3><?php echo __('処理'); ?></h3>
			<ul style="list-style:none;">
				<li><?php echo $this->Html->link(__('投稿追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?></li>
				<li><?php echo $this->Html->link(__('カテゴリ追加'), array('controller' => 'categories', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
				<li><?php echo $this->Html->link(__('タグ追加'), array('controller' => 'tags', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
				<?php echo $this->element('actlistlist'); ?>
				<?php echo $this->element('actlistall'); ?>
			</ul>
*/ ?>			
			<div style="padding-top:10px;"></div>
			<div class="panel panel-success">
				<div class="panel-heading">
					<h4><?php echo __('最近の投稿'); ?></h4>
				</div>
				<div class="panel-body">
					<?php foreach ($recent_posts as $recent_key => $recent_post): ?>
						<p>
							<?php
								echo $this->Html->link(
									$recent_post,
									array('action' => 'view', $recent_key),
									array('escape'=> false, 'class'=>'custom-a','style'=>'word-wrap:break-word;')
								);
							?>			
						</p>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="panel panel-warning">
				<div class="panel-heading">
					<h4><?php echo __('アーカイブ'); ?></h4>
				</div>
				<div class="panel-body">
					<?php foreach ($arcive_posts as $arcive_post): ?>
						<p class="arcive_ym" data-arc-ym="<?php echo $arcive_post['Post']['CreatedYM'] ?>" >
							<?php echo $arcive_post['Post']['CreatedYM'] . '(' .$arcive_post['Post']['cnt'] . ')';	?>			
						</p>
					<?php endforeach; ?>
				</div>
			</div>
			
		</div>
<!--	★★★★★★★★★★★★★★★★★★★★★★★★	右側	終了　★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★★	-->

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

	<!-- 上へ用 -->
<!--    <div id="back-to-top" style="position:fixed;right:75px;bottom:75px;background:skyblue;Opacity:0.5;color:pink"><a href="#"><p style="padding-top:15px">上に戻る</p></a></div>	-->
<!--    <div id="back-to-top" style="position:fixed;right:75px;bottom:75px;background:skyblue;Opacity:0.5;color:pink"><a href="#"><p style="padding-top:15px">上に戻る</p></a></div>	-->
	<?php echo $this->Html->image("/app/webroot/img/icon_up_64.png" , array('id' => 'back-to-top', 'style' => 'position:fixed;right:75px;bottom:75px;')) ; ?>


	
	
	
	
	
	