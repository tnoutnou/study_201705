<div class="container">
<div class="row">
<div class="col-sm-6">
<h2>パスワード変更画面 【未完】</h2>
<?php
echo $this->Form->create('User', array(
    'url' => array(
        'controller' => 'users',
        'action' => 'changepw'
    )
));
echo $this->Form->input('old_password', array('class' => 'form-control', 'label' => array('text' => '旧パスワード')));
echo $this->Form->input('User.password', array('class' => 'form-control', 'label' => array('text' => '新パスワード'), 'value'=> ''));
echo $this->Form->input('new_password', array('class' => 'form-control', 'label' => array('text' => '新パスワード【確認】')));
echo $this->Form->end('パスワード変更');
?>

</div>
</div>
</div>
