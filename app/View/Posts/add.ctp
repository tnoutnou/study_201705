<?php echo $this->Html->script( 'jquery-git.js'); ?>
<?php $filemaxcnt = 3 ?>
<div id="global-cont" data-filemax=<?php echo $filemaxcnt ?> >
<?php echo $this->Html->script( 'post_edit.js'); ?>

<?php $actionLists = array(
		);
?>
<?php echo $this->element('blog_nav', ["actionLists" => $actionLists]); ?>

<div class="container">
<div class="row">
<div class="blogposts posts index col-xs-12 col-sm-8 col-md-9">
<div class="posts form">
<?php echo $this->Form->create('Post', array('type' => 'file', 'enctype' => 'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('投稿 追加'); ?></legend>
	<?php
		echo $this->Form->input('user_id', array('label' => array('text' => 'ユーザ名' ,'class' => 'label label-default'), 'class' => 'selectpicker show-tick form-control'));
		echo $this->Form->input('title', array('label' => array('text' => 'タイトル' ,'class' => 'label label-default'), 'class' => 'form-control'));
		echo $this->Form->input('body', array('rows' => 10,'label' => array('text' => '本文' ,'class' => 'label label-default'), 'class' => 'form-control'));
		echo $this->Form->input('category_id', array('label' => array('text' => 'カテゴリ' ,'class' => 'label label-default'), 'class' => 'selectpicker show-tick form-control'));
		echo $this->Form->input('tag_id',array('label' => array('text' => 'タグ' ,'class' => 'label label-default'), 'type'=>'select', 'multiple'=>true, 'options'=>$tags, 'class' => 'selectpicker show-menu-arrow form-control'));
		
	?>
<label class="label label-default">イメージ追加</label>
<div class="input-group" id="file-input-group1">
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

<?php echo '<div class="input-group" id="file-input-group' . $i .'" style="display:none">';   ?>
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
<div class="col-sm-10"></div>
<div class="col-sm-2">
<?php echo $this->Form->end(__('登録')); ?>
</div>

<ul id="img_ul">
</ul>



</div>
</div>
<div class="blogaction actions col-xs-6 col-sm-3 col-md-2">
	<?php /* echo $this->element('login_user'); 
<div class="actions">
	<h3><?php echo __('処理'); ?></h3>
	<ul style="list-style:none;">
		<?php echo $this->element('actlistlist'); ?>
		<?php echo $this->element('actlistall'); ?>
	</ul>
</div>
*/	?>
</div>
</div>
</div>