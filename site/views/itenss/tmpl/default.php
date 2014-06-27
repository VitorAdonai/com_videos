<?php
/**
 * @version     0.5.0
 * @package     com_videos
 * @copyright   Copyright (C) 2014. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Vitor <vitor@joomlaplus.com.br> - http://www.joomlaplus.com.br
 */
// no direct access
defined('_JEXEC') or die;
?>
<script type="text/javascript">
    function deleteItem(item_id){
        if(confirm("<?php echo JText::_('COM_VIDEOS_DELETE_MESSAGE'); ?>")){
            document.getElementById('form-itens-delete-' + item_id).submit();
        }
    }
</script>

<div class="items">
    <ul class="items_list">
<?php $show = false; ?>
        <?php foreach ($this->items as $item) : ?>

            
				<?php
					if($item->state == 1 || ($item->state == 0 && JFactory::getUser()->authorise('core.edit.own',' com_videos.itens.'.$item->id))):
						$show = true;
						?>
							<li>
								<a href="<?php echo JRoute::_('index.php?option=com_videos&view=itens&id=' . (int)$item->id); ?>"><?php echo $item->nome; ?></a>
								<?php
									if(JFactory::getUser()->authorise('core.edit.state','com_videos.itens.'.$item->id)):
									?>
										<a href="javascript:document.getElementById('form-itens-state-<?php echo $item->id; ?>').submit()"><?php if($item->state == 1): echo JText::_("COM_VIDEOS_UNPUBLISH_ITEM"); else: echo JText::_("COM_VIDEOS_PUBLISH_ITEM"); endif; ?></a>
										<form id="form-itens-state-<?php echo $item->id ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_videos&task=itens.save'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
											<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
											<input type="hidden" name="jform[state]" value="<?php echo (int)!((int)$item->state); ?>" />
											<input type="hidden" name="option" value="com_videos" />
											<input type="hidden" name="task" value="itens.publish" />
											<?php echo JHtml::_('form.token'); ?>
										</form>
									<?php
									endif;
									if(JFactory::getUser()->authorise('core.delete','com_videos.itens.'.$item->id)):
									?>
										<a href="javascript:deleteItem(<?php echo $item->id; ?>);"><?php echo JText::_("COM_VIDEOS_DELETE_ITEM"); ?></a>
										<form id="form-itens-delete-<?php echo $item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_videos&task=itens.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
											<input type="hidden" name="jform[id]" value="<?php echo $item->id; ?>" />
											<input type="hidden" name="option" value="com_videos" />
											<input type="hidden" name="task" value="itens.remove" />
											<?php echo JHtml::_('form.token'); ?>
										</form>
									<?php
									endif;
								?>
							</li>
						<?php endif; ?>

<?php endforeach; ?>
        <?php
        if (!$show):
            echo JText::_('COM_VIDEOS_NO_ITEMS');
        endif;
        ?>
    </ul>
</div>
<?php if ($show): ?>
    <div class="pagination">
        <p class="counter">
            <?php echo $this->pagination->getPagesCounter(); ?>
        </p>
        <?php echo $this->pagination->getPagesLinks(); ?>
    </div>
<?php endif; ?>


									<?php if(JFactory::getUser()->authorise('core.create','com_videos')): ?><a href="<?php echo JRoute::_('index.php?option=com_videos&task=itens.edit&id=0'); ?>"><?php echo JText::_("COM_VIDEOS_ADD_ITEM"); ?></a>
	<?php endif; ?>