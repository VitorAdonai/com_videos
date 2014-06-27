<?php
/**
 * @version     0.5.0
 * @package     com_videos
 * @copyright   Copyright (C) 2014. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Vitor <vitor@joomlaplus.com.br> - http://www.joomlaplus.com.br
 */

// No direct access.
defined('_JEXEC') or die;

require_once JPATH_COMPONENT.'/controller.php';

/**
 * Itenss list controller class.
 */
class VideosControllerItenss extends VideosController
{
	/**
	 * Proxy for getModel.
	 * @since	1.6
	 */
	public function &getModel($name = 'Itenss', $prefix = 'VideosModel')
	{
		$model = parent::getModel($name, $prefix, array('ignore_request' => true));
		return $model;
	}
}