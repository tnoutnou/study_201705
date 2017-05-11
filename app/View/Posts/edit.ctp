<div class="posts form">
<?php echo $this->Form->create('Post', array('type' => 'file')); ?>
	<fieldset>
		<legend><?php echo __('Edit Post'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('title');
		echo $this->Form->input('body');
/**		echo $this->Form->input('category_id');		*/
/**		echo $this->Form->input('category_id');		*/
/**        echo $this->Form->input( $this->Form->defaultModel . '.tag.1');		*/
/**        echo $this->Form->input('tag.1.tag_id');		**/
/**		echo $this->Form->input('tag_id'); */
		echo $this->Form->input('Image.0.filename', array('type' => 'file', 'label' => 'Image'));
/**		echo $this->Form->input('Image.0.model', array('type' => 'hidden', 'value' => 'Post'));		*/
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>

<!--	<?php foreach ($data['Tag'] as $taglist) {?>	-->
<!--	<?php echo h($taglist['tagname']); ?>	-->
<!--	<?php } ?>	-->
<ul>
	<?php foreach ($post['Tag'] as $taglist) {?>
	<li>
		<?php echo h($taglist['tagname']); ?>
		<td class="actions">
			<?php echo $this->Html->link(__('TagEdit'), array('controller' => 'PostsTags', 'action' => 'edit', $taglist['PostsTag']['id'])); ?>
<!--	/**		<?php echo $this->Form->postLink(__('TagDelete'), array('controller' => 'PostsTags', 'action' => 'delete', $taglist['PostsTag']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $taglist['id']))); ?>	*/ -->
		</td>		
	</li>
	<?php } ?>
	<?php echo $this->Html->link(__('TagAdd'), array('controller' => 'PostsTags', 'action' => 'add', $this->Form->value('Post.id'))); ?>

	&nbsp;
</ul>

</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Post.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Post.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Posts'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
