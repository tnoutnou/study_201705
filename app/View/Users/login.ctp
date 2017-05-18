<div class="container">
<div class="row">
<div class="col-sm-6">
<h2>Login</h2>
<?php
echo $this->Form->create('User', array(
    'url' => array(
        'controller' => 'users',
        'action' => 'login'
    )
));
echo $this->Form->input('User.username', array('class' => 'form-control'));
echo $this->Form->input('User.password', array('class' => 'form-control'));
echo $this->Form->end('Login');
?>

</div>
</div>
</div>
