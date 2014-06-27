<?php
/**
 * @version     0.5.0
 * @package     com_videos
 * @copyright   Copyright (C) 2014. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Vitor <vitor@joomlaplus.com.br> - http://www.joomlaplus.com.br
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Itens controller class.
 */
class VideosControllerItens extends JControllerForm
{

    function __construct() {
        $this->view_list = 'itenss';
        parent::__construct();
    }

}