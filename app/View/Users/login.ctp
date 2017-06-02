<div class="container">
<div class="row">
<div class="col-sm-6">
<h2>ログイン画面</h2>
<?php
echo $this->Form->create('User', array(
    'url' => array(
        'controller' => 'users',
        'action' => 'login'
    )
));
echo $this->Form->input('User.username', array('class' => 'form-control', 'label' => array('text' => 'ユーザ名')));
echo $this->Form->input('User.password', array('class' => 'form-control', 'label' => array('text' => 'パスワード')));
echo $this->Form->end('ログイン');
?>

</div>
</div>
</div>
