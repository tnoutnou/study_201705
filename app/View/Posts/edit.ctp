<?php echo $this->Html->script( 'jquery-git.js'); ?>
<?php echo $this->Html->script( 'post_edit.js'); ?>
<div class="container">
<div class="row">
<!--	<div class="posts form col-xs-12 col-sm-12 col-md-10">	-->
<div class="posts form col-xs-12 col-sm-8 col-md-9">
<?php echo $this->Form->create('Post', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Post !3!'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id', array('label' => array('text' => 'user' ,'class' => 'label label-default'), 'class' => 'selectpicker show-tick form-control'));
/**		echo $this->Form->input('title');	*/
		echo $this->Form->input('title', array('label' => array('text' => 'title' ,'class' => 'label label-default'), 'class' => 'form-control'));
/**		echo $this->Form->input('body');	*/
		echo $this->Form->input('body', array('label' => array('text' => 'body' ,'class' => 'label label-default'), 'class' => 'form-control'));
/**		echo $this->Form->input('category_id');		*/
		echo $this->Form->input('category_id', array('label' => array('text' => 'body' ,'class' => 'label label-default'), 'class' => 'selectpicker show-tick form-control'));
/**        echo $this->Form->input( $this->Form->defaultModel . '.tag.1');		*/
/**        echo $this->Form->input('tag.1.tag_id');		**/
		echo $this->Form->input('tag_id',array('label' => array('text' => 'tag' ,'class' => 'label label-default'), 'type'=>'select', 'multiple'=>true, 'options'=>$tags, 'selected'=>$selected, 'class' => 'selectpicker show-menu-arrow form-control'));
	?>
<label class="label label-default">ImageAdd</label>
<div class="input-group"　id="file-input-group1">
 <input type="text" class="form-control" id="selectedFile1" readonly>
 <?php
/**		echo $this->Form->input('Image.0.filename', array('type' => 'file', 'label' => array('text' => 'ImageAdd','class' => 'label label-default'), 'class'=>'btn btn-default btn-sm'));	*/
/**		echo $this->Form->input('Image.0.filename', array('type' => 'file', 'label' => 'ImageAdd'));	*/
/**		echo $this->Form->input('Image.0.filename', array('type' => 'file', 'label' => array('text' => 'ImageAdd','class' => 'label label-default'), 'style'=>'display:none'));	*/
/**		echo $this->Form->input('Image.0.filename', array('type' => 'file', 'label' => array('text' => 'ImageAdd','class' => 'label label-default'), 'style'=>'display:none', 'id'=>'inputFile'));	*/
		echo $this->Form->input('Image.0.filename', array('type' => 'file', 'label' => false, 'style'=>'display:none', 'class'=>'cls-inputfile', 'id'=>'inputFile1'));
	?>
 <span class="input-group-btn">
 <button id="selectFile1" class="btn btn-default" type="button">ファイル選択</button>
 </span>
</div>

<div class="input-group"　id="file-input-group2" style="display:none">
 <input type="text" class="form-control" id="selectedFile2" readonly>
 <?php echo $this->Form->input('Image.1.filename', array('type' => 'file', 'label' => false, 'style'=>'display:none', 'class'=>'cls-inputfile', 'id'=>'inputFile2')); ?>
 <span class="input-group-btn">
 <button id="selectFile2" class="btn btn-default" type="button">ファイル選択</button>
 </span>
</div>

<div class="input-group"　id="file-input-group3" style="display:none">
 <input type="text" class="form-control" id="selectedFile3" readonly>
 <?php echo $this->Form->input('Image.2.filename', array('type' => 'file', 'label' => false, 'style'=>'display:none', 'class'=>'cls-inputfile', 'id'=>'inputFile3')); ?>
 <span class="input-group-btn">
 <button id="selectFile3" class="btn btn-default" type="button">ファイル選択</button>
 </span>
</div>

<?php for ($i = 4; $i <= 3; $i++) {   ?>
<?php $j=$i - 1;   ?>

<?php echo '<div class="input-group"　id="file-input-group' . $i .'" style="display:none">';   ?>
<?php echo '<input type="text" class="form-control" id="selectedFile'. $i .'" readonly>'   ?>
 <?php echo $this->Form->input('Image.' . "$j" . '.filename', array('type' => 'file', 'label' => false, 'style'=>'display:none', 'class'=>'cls-inputfile', 'id'=>'inputFile3')); ?>
<?php echo  '<span class="input-group-btn">'   ?>
<?php echo  '<button id="selectFile'. $i .'" class="btn btn-default" type="button">ファイル選択</button>'   ?>
<?php echo  '</span>'   ?>
<?php echo '</div>'   ?>

<?php }   ?>



	<?php
		echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post'));
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

<ul id="img_ul">
	<?php $base = "/app/webroot/files/image/filename/"; ?>
	<?php foreach ($post['Image'] as $image) {?>
	<li>
		<?php echo $this->Html->image( $base . $image["dirname"] . "/" . $image["filename"] , array('width'=>'80','height'=>'80')); ?>
		<td class="actions">
			<?php /* echo $this->Html->link(__('ImageDelete'), array('controller' => 'Images', 'action' => 'delete', $image['id'])); */ ?>
			<?php echo $this->Form->postLink(__('ImageDelete'), array('controller' => 'Images','action' => 'delete', $image['id']), array('confirm' => __('Are you sure you want to delete ?'))); ?>
		</td>		
	</li>
	<?php } ?>

	&nbsp;
</ul>


		
<!--	<?php foreach ($data['Tag'] as $taglist) {?>	-->
<!--	<?php echo h($taglist['tagname']); ?>	-->
<!--	<?php } ?>	-->
<!--	<ul>	-->
<!--		<?php foreach ($post['Tag'] as $taglist) {?>	-->
<!--		<li>	-->
<!--			<?php echo h($taglist['tagname']); ?>	-->
<!--			<td class="actions">	-->
<!--				<?php echo $this->Html->link(__('TagEdit'), array('controller' => 'PostsTags', 'action' => 'edit', $taglist['PostsTag']['id'])); ?>	-->
<!--	/**		<?php echo $this->Form->postLink(__('TagDelete'), array('controller' => 'PostsTags', 'action' => 'delete', $taglist['PostsTag']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $taglist['id']))); ?>	*/ -->
<!--			</td>			-->
<!--		</li>	-->
<!--		<?php } ?>	-->
<!--		<?php echo $this->Html->link(__('TagAdd'), array('controller' => 'PostsTags', 'action' => 'add', $this->Form->value('Post.id'))); ?>	-->
<!--		-->
<!--		&nbsp;	--> 
<!--	</ul>	-->



</div>
<!--	<div class="actions col-sm-4 col-sm-offset-1">	-->
<!--	<div class="col-xs-6 col-sm-6 col-md-2">	-->
<div class="actions col-xs-6 col-sm-3 col-md-2">
	<h3><?php echo __('Actions'); ?></h3>
	<ul style="list-style:none;">

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Post.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Post.id')), 'class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index'), array('class'=>'btn btn-default btn-sm')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add'), array('class'=>'btn btn-default btn-sm')); ?> </li>
	</ul>
</div>
</div>
</div>


