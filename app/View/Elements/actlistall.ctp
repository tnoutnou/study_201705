	
<!--<li><?php echo $this->Html->link(__('ログアウト'), array('controller' => 'users', 'action' => 'logout'), array('class'=>'btn btn-default btn-sm')); ?> </li>	-->
<li>
	<?php
		if ($this->Session->read('Auth.User')) {
			echo $this->Html->link(__('ログアウト'), array('controller' => 'users', 'action' => 'logout'), array('class'=>'btn btn-default btn-sm'));
		}else{
			echo $this->Html->link(__('ログイン'), array('controller' => 'users', 'action' => 'login'), array('class'=>'btn btn-default btn-sm'));
		}
	?>
</li>

	

