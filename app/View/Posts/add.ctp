<?php echo $this->Html->script( 'jquery-git.js'); ?>
<?php $filemaxcnt = 3 ?>
<div id="global-cont" data-filemax=<?php echo $filemaxcnt ?> >
<?php echo $this->Html->script( 'post_edit.js'); ?>

<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="posts form">
<?php echo $this->Form->create('Post', array('type' => 'file', 'enctype' => 'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Add Post !!'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array('label' => array('text' => 'user' ,'class' => 'label label-default'), 'class' => 'selectpicker show-tick form-control'));
		echo $this->Form->input('title', array('label' => array('text' => 'title' ,'class' => 'label label-default'), 'class' => 'form-control'));
		echo $this->Form->input('body', array('label' => array('text' => 'body' ,'class' => 'label label-default'), 'class' => 'form-control'));
		echo $this->Form->input('category_id', array('label' => array('text' => 'category' ,'class' => 'label label-default'), 'class' => 'selectpicker show-tick form-control'));
		echo $this->Form->input('tag_id',array('label' => array('text' => 'tag' ,'class' => 'label label-default'), 'type'=>'select', 'multiple'=>true, 'options'=>$tags, 'class' => 'selectpicker show-menu-arrow form-control'));
	?>
<label class="label label-default">ImageAdd</label>
<div class="input-group"　id="file-input-group1">
<input type="text" class="form-control" id="selectedFile1" readonly>
 <?php
		echo $this->Form->input('Image.0.filename', array('type' => 'file', 'label' => false, 'style'=>'display:none', 'class'=>'cls-inputfile', 'id'=>'addinputFile1'));
	?>
<span class="input-group-btn">
<button id="addselectFile1" class="btn btn-default" type="button">新規ファイル追加</button>
<button id="delFilebtn" class="btn btn-default" type="button">新規ファイル全削除</button>
 </span>
</div>

<?php for ($i = 2; $i <= $filemaxcnt; $i++) {   ?>
<?php $j=$i - 1;   ?>

<?php echo '<div class="input-group"　id="file-input-group' . $i .'" style="display:none">';   ?>
<?php echo '<input type="text" class="form-control" id="selectedFile'. $i .'" readonly>'   ?>
 <?php echo $this->Form->input('Image.' . "$j" . '.filename', array('type' => 'file', 'label' => false, 'style'=>'display:none', 'class'=>'cls-inputfile', 'id'=>'addinputFile' . $i)); ?>
<?php echo '</div>'   ?>

<?php }   ?>

	<?php
		echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post'));
	?>

 <?php
//		echo $this->Form->input('Image.', array('type' => 'file', 'multiple' => 'multiple', 'label' => false, 'id'=>'inputFile'));	//
//		echo $this->Form->input('Image.', array('type' => 'file',                           'label' => false, 'id'=>'inputFile'));	//
//		echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post'));
	?>
	
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

<ul id="img_ul">
</ul>



</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul style="list-style:none;">
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
	</ul>
</div>
</div>
</div>
</div>