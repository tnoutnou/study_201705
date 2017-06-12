	
<li><?php echo $this->Html->link(__('投稿一覧'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
<li><?php echo $this->Html->link(__('カテゴリ一覧'), array('controller' => 'categories', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
<li><?php echo $this->Html->link(__('タグ一覧'), array('controller' => 'tags', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
<li><?php echo $this->Html->link(__('投稿タグ一覧'), array('controller' => 'PostsTags', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
<li><?php echo $this->Html->link(__('イメージ一覧'), array('controller' => 'images', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
<li><?php echo $this->Html->link(__('グループ一覧'), array('controller' => 'groups', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
<li><?php echo $this->Html->link(__('ユーザ一覧'), array('controller' => 'users', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>

	
