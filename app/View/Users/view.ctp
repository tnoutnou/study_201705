<?php $actionLists = array(
		array(
			'label' => 'ユーザ編集',
			'controller' => 'users',
			'action' => 'edit',
			'id' => $user['User']['id']),
		array(
			'label' => 'ユーザ削除',
			'controller' => 'users',
			'action' => 'delete',
			'id' => $user['User']['id']),
		array(
			'label' => 'ユーザ追加',
			'controller' => 'users',
			'action' => 'add',
			'id' => null),
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>

<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="users view">
<h2><?php echo __('ユーザ参照'); ?></h2>
	<dl>
		<dt><?php echo __('ユーザID'); ?></dt>
		<dd>
			<?php echo h($user['User']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('ユーザ名'); ?></dt>
		<dd>
			<?php echo h($user['User']['username']); ?>
			&nbsp;
		</dd>
<!--		<dt><?php echo __('パスワード'); ?></dt>	-->
<!--		<dd>	-->
<!--			<?php echo h($user['User']['password']); ?>	-->
<!--			&nbsp;	-->
<!--		</dd>	-->
		<dt><?php echo __('郵便番号'); ?></dt>
		<dd>
			<?php echo h($user['User']['zip_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('都道府県'); ?></dt>
		<dd>
			<?php echo h($user['User']['ken_name_kan']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('市区'); ?></dt>
		<dd>
			<?php echo h($user['User']['city_name_kan']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('町村'); ?></dt>
		<dd>
			<?php echo h($user['User']['town_name_kan']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('番地以下'); ?></dt>
		<dd>
			<?php echo h($user['User']['detail_name_kan']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('グループ'); ?></dt>
		<dd>
			<?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('作成日時'); ?></dt>
		<dd>
			<?php echo h($user['User']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('編集日時'); ?></dt>
		<dd>
			<?php echo h($user['User']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related">
	<h3><?php echo __('関連投稿一覧'); ?></h3>
	<?php if (!empty($user['Post'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('投稿ID'); ?></th>
		<th><?php echo __('ユーザID'); ?></th>
		<th><?php echo __('タイトル'); ?></th>
		<th><?php echo __('本文'); ?></th>
		<th><?php echo __('作成日時'); ?></th>
		<th><?php echo __('編集日時'); ?></th>
		<th class="actions"><?php echo __('処理'); ?></th>
	</tr>
	<?php foreach ($user['Post'] as $post): ?>
		<tr>
			<td><?php echo $post['id']; ?></td>
			<td><?php echo $post['user_id']; ?></td>
			<td><?php echo $post['title']; ?></td>
<!--			<td><?php echo $post['body']; ?></td>	-->
<!--			先頭の１行だけ出力	-->
				<?php
					$n_ｃnt = substr_count($post['body'], "\n");
					if ($n_ｃnt >= 1) {
//						$n_pos = strpos($post['body'], "\n", strpos($post['body'], "\n", strpos($post['body'], "\n", strpos($post['body'], "\n", strpos($post['body'], "\n") + 1)+1)+1)+1);
						$n_pos = strpos($post['body'], "\n");
					}else {
						$n_pos = strlen($post['body']);
					}
				?>
			<td><?php echo nl2br(h(substr($post['body'],0,$n_pos))); ?></td>


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
	<?php /* echo $this->element('login_user'); 
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('ユーザ編集'), array('action' => 'edit', $user['User']['id']), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Form->postLink(__('ユーザ削除'), array('action' => 'delete', $user['User']['id']), array('confirm' => __('本当に削除してもよろしいでしょうか # %s?', $user['User']['id']) , 'class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('ユーザ一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('ユーザ追加'), array('action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('グループ一覧'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('グループ追加'), array('controller' => 'groups', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
*/	?>

</div>
</div>

