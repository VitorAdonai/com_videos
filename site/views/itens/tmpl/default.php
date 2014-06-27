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

//Load admin language file
$lang = JFactory::getLanguage();
$lang->load('com_videos', JPATH_ADMINISTRATOR);
$canEdit = JFactory::getUser()->authorise('core.edit', 'com_videos.' . $this->item->id);
if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_videos' . $this->item->id)) {
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>
<?php if ($this->item) : ?>

<link href="components/com_videos/views/player/video-js.css" rel="stylesheet" type="text/css">
<script src="components/com_videos/views/player/video.js"></script>

 <script>
    videojs.options.flash.swf = "/components/com_videos/views/player/video-js.swf";
</script>

<!-- Player -->

<div class="row-fluid">
		<div class="col-md-12">
			<h1 class="title-video"><?php echo $this->item->nome; ?></h1>
    <div class="video">
     <video id="example_video_1" class="video-js vjs-default-skin" controls preload="none" width="<?php echo $this->item->width; ?>" height="<?php echo $this->item->height; ?>"
      poster="<?php echo $this->item->imagem; ?>"
      data-setup="{}">
    <source src="<?php echo $this->item->video; ?>" type='video/mp4' />
    <source src="http://video-js.zencoder.com/oceans-clip.webm" type='video/webm' />
    <source src="http://video-js.zencoder.com/oceans-clip.ogv" type='video/ogg' />
   
    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
  </video>
		</div>
	</div>
</div>
<!-- End Player -->

<!-- Send by and Shared -->
<div class="row-fluid">
		<div class="col-md-4"><strong>Enviado por: <?php echo $this->item->created_by_name; ?></strong><br><?php echo $this->item->checked_out_time; ?>
		</div>
		<div class="col-md-8">
		</div>
</div>
<!-- End Send by and Shared -->

<!-- Comments -->
<div class="row-fluid">
	<div class="col-md-12">
<?php
if ($this->item->comentarios == "true") {
    echo "<div id='fb-root'></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = '//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.0';
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script><br>
<div class='fb-comments' data-href='http://joomlaplus.com.br' data-width='100%' data-numposts='7' data-colorscheme='light'></div>";
 }
 else {
 	echo "";
 }
?>
	</div>
</div>
<!-- End Comments -->

<!-- Original fields-->

    <div class="item_fields">

        <ul class="fields_list">

            			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_ID'); ?>:
			<?php echo $this->item->id; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_ORDERING'); ?>:
			<?php echo $this->item->ordering; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_STATE'); ?>:
			<?php echo $this->item->state; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_CHECKED_OUT'); ?>:
			<?php echo $this->item->checked_out; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_CHECKED_OUT_TIME'); ?>:
			<?php echo $this->item->checked_out_time; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_CREATED_BY'); ?>:
			<?php echo $this->item->created_by_name; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_NOME'); ?>:
			<?php echo $this->item->nome; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_VIDEO'); ?>:
			<?php echo $this->item->video; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_IMAGEM'); ?>:
			<?php echo $this->item->imagem; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_HITS'); ?>:
			<?php echo $this->item->hits; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_SHOWAUTOR'); ?>:
			<?php echo $this->item->showautor; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_COMENTARIOS'); ?>:
			<?php echo $this->item->comentarios; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_WIDTH'); ?>:
			<?php echo $this->item->width; ?></li>
			<li><?php echo JText::_('COM_VIDEOS_FORM_LBL_ITENS_HEIGHT'); ?>:
			<?php echo $this->item->height; ?></li>


        </ul>

    </div>

<!-- -->




    <?php if($canEdit && $this->item->checked_out == 0): ?>
		<a href="<?php echo JRoute::_('index.php?option=com_videos&task=itens.edit&id='.$this->item->id); ?>"><?php echo JText::_("COM_VIDEOS_EDIT_ITEM"); ?></a>
	<?php endif; ?>
								<?php if(JFactory::getUser()->authorise('core.delete','com_videos.itens.'.$this->item->id)):
								?>
									<a href="javascript:document.getElementById('form-itens-delete-<?php echo $this->item->id ?>').submit()"><?php echo JText::_("COM_VIDEOS_DELETE_ITEM"); ?></a>
									<form id="form-itens-delete-<?php echo $this->item->id; ?>" style="display:inline" action="<?php echo JRoute::_('index.php?option=com_videos&task=itens.remove'); ?>" method="post" class="form-validate" enctype="multipart/form-data">
										<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
										<input type="hidden" name="option" value="com_videos" />
										<input type="hidden" name="task" value="itens.remove" />
										<?php echo JHtml::_('form.token'); ?>
									</form>
								<?php
								endif;
							?>
<?php
else:
    echo JText::_('COM_VIDEOS_ITEM_NOT_LOADED');
endif;
?>
