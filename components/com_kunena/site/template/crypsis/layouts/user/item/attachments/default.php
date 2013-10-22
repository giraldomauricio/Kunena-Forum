<?php
/**
 * Kunena Component
 * @package Kunena.Template.Crypsis
 * @subpackage User
 *
 * @copyright (C) 2008 - 2013 Kunena Team. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link http://www.kunena.org
 **/
defined ( '_JEXEC' ) or die ();
?>
<h3>
	<?php echo $this->title;?>
</h3>

<form action="<?php echo KunenaRoute::_('index.php?option=com_kunena&view=user') ?>" method="post" id="adminForm" name="adminForm">
	<input type="hidden" name="task" value="delfile" />
	<input type="hidden" name="boxchecked" value="0" />
	<?php echo JHtml::_( 'form.token' ); ?>

	<table class="table table-bordered table-striped table-hover">
		<tr>
			<th>
				#
			</th>
			<th width="5">
				<input type="checkbox" name="checkall-toggle" value="cid" title="<?php echo JText::_('COM_KUNENA_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)" />
			</th>
			<th>
				<?php echo JText::_('COM_KUNENA_FILETYPE'); ?>
			</th>
			<th>
				<?php echo JText::_('COM_KUNENA_FILENAME'); ?>
			</th>
			<th>
				<?php echo JText::_('COM_KUNENA_FILESIZE'); ?>
			</th>
			<th>
				<?php echo JText::_('COM_KUNENA_ATTACHMENT_MANAGER_TOPIC'); ?>
			</th>
			<th>
				<?php echo JText::_('COM_KUNENA_PREVIEW'); ?>
			</th>
			<th>
				<?php echo JText::_('COM_KUNENA_DELETE'); ?>
			</th>
		</tr>
		<?php
			if (empty($this->items)) :
				echo JText::_('COM_KUNENA_USER_NO_ATTACHMENTS');
			else :
				$i=0;
				foreach ($this->items as $attachment) :
					$message = $attachment->getMessage();
		?>
		<tr>
			<td><?php echo $i+1; ?></td>
			<td>
				<?php if ($attachment->authorise('delete')) echo JHtml::_('grid.id', $i, intval($attachment->id)) ?>
			</td>
			<td class="center">
				<img src="<?php echo $attachment->filetype != '' ? JUri::root(true).'/media/kunena/icons/image.png' : JUri::root(true).'/media/kunena/icons/file.png'; ?>" alt="" title="" />
			</td>
			<td>
				<?php echo $attachment->getFilename(); ?>
			</td>
			<td>
				<?php echo number_format(intval($attachment->size) / 1024, 0, '', ',') . ' ' . JText::_('COM_KUNENA_USER_ATTACHMENT_FILE_WEIGHT'); ?>
			</td>
			<td>
				<?php echo $this->getTopicLink($message->getTopic(), $message); ?>
			</td>
			<td class="center">
				<?php echo $attachment->getThumbnailLink() ; ?>
			</td>
			<td class="center">
				<?php if ($attachment->authorise('delete')) : ?>
				<a href="javascript:void(0);" onclick="return listItemTask('cb<?php echo $i; ?>','delfile')">
					<img src="<?php echo $this->ktemplate->getImagePath('icons/publish_x.png') ?>" alt="" title="" />
				</a>
				<?php endif ?>
			</td>
		</tr>
		<?php
			$i++;
			endforeach;
			endif;
			?>
	</table>

	<input class="btn" type="submit" value="<?php echo JText::_('COM_KUNENA_FILES_DELETE') ?>" style="float:right;" />
</form>
