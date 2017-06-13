<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarEexample8">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
<!--			<a class="navbar-brand" href="#"></a>	-->
		</div>
		

		<div class="collapse navbar-collapse navbar-right" id="navbarEexample8">
			<?php if ($this->Session->read('Auth.User') and (count($actionLists) > 0) ) { ?>
				<div class="btn-group">
					<button type="button" class="btn btn-default navbar-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						操作メニュー
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
						<?php foreach ($actionLists as $actionList): ?>
							<li>
								<?php 
									if ($actionList['action'] == 'delete') {
										echo $this->Form->postLink(
											__($actionList['label']),
											array('controller' => $actionList['controller'],
												'action' => $actionList['action'],
												$actionList['id']),
											array('confirm' => __('本当に削除してもよろしいでしょうか？ '))
										);					
									} else {
										echo $this->Html->link(
											__($actionList['label']),
											array('controller' => $actionList['controller'],
												'action' => $actionList['action'],
												$actionList['id'])
										);
									}
								?>
							</li>
						<?php endforeach; ?>
					</ul>
				</div>
			<?php } ?>

			<?php if ($this->Session->read('admin_flg') == '1') {	?>
				<div class="btn-group">
					<button type="button" class="btn btn-default navbar-btn dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
						管理者メニュー
						<span class="caret"></span>
					</button>
					<ul class="dropdown-menu" role="menu">
							<li><?php echo $this->Html->link(__('カテゴリ追加'), array('controller' => 'categories', 'action' => 'add')); ?></li>
							<li><?php echo $this->Html->link(__('タグ追加'), array('controller' => 'tags', 'action' => 'add')); ?></li>

							<li><?php echo $this->Html->link(__('投稿一覧'), array('controller' => 'posts', 'action' => 'index')); ?></li>
							<li><?php echo $this->Html->link(__('カテゴリ一覧'), array('controller' => 'categories', 'action' => 'index')); ?></li>
							<li><?php echo $this->Html->link(__('タグ一覧'), array('controller' => 'tags', 'action' => 'index')); ?></li>
							<li><?php echo $this->Html->link(__('投稿タグ一覧'), array('controller' => 'PostsTags', 'action' => 'index')); ?></li>
							<li><?php echo $this->Html->link(__('イメージ一覧'), array('controller' => 'images', 'action' => 'index')); ?></li>
							<li><?php echo $this->Html->link(__('グループ一覧'), array('controller' => 'groups', 'action' => 'index')); ?></li>
							<li><?php echo $this->Html->link(__('ユーザ一覧') , array('controller' => 'users', 'action' => 'index')); ?></li>
					</ul>
				</div>

			<?php }	?>
			
			<?php
				if ($this->Session->read('Auth.User')) {
					echo $this->Html->link(
						__('ログアウト'),
						array('controller' => 'users', 'action' => 'logout'),
						array('class'=>'btn btn-default navbar-btn')
					);
				}else{
					echo $this->Html->link(
						__('ログイン'),
						array('controller' => 'users', 'action' => 'login'),
						array('class'=>'btn btn-default navbar-btn')
					);
				}
			?>			
			
			
			<?php if ($this->Session->read('Auth.User')) {	?>
				<p class="navbar-text navbar-right">
					ようこそ
					<a href="#" class="navbar-link">
					<?php echo $this->Session->read('login_user'); ?>
					</a>
					さん
				</p>
			<?php	} else {	?>
			<?php	}	?>

			
		</div>
	</div>
</nav>