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

jimport('joomla.application.component.view');

/**
 * View class for a list of Videos.
 */
class VideosViewItenss extends JViewLegacy
{
	protected $items;
	protected $pagination;
	protected $state;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{
		$this->state		= $this->get('State');
		$this->items		= $this->get('Items');
		$this->pagination	= $this->get('Pagination');

		// Check for errors.
		if (count($errors = $this->get('Errors'))) {
			throw new Exception(implode("\n", $errors));
		}
        
		VideosBackendHelper::addSubmenu('itenss');
        
		$this->addToolbar();
        
        $this->sidebar = JHtmlSidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @since	1.6
	 */
	protected function addToolbar()
	{
		require_once JPATH_COMPONENT.'/helpers/videos.php';

		$state	= $this->get('State');
		$canDo	= VideosBackendHelper::getActions($state->get('filter.category_id'));

		JToolBarHelper::title(JText::_('COM_VIDEOS_TITLE_ITENSS'), 'itenss.png');

        //Check if the form exists before showing the add/edit buttons
        $formPath = JPATH_COMPONENT_ADMINISTRATOR.'/views/itens';
        if (file_exists($formPath)) {

            if ($canDo->get('core.create')) {
			    JToolBarHelper::addNew('itens.add','JTOOLBAR_NEW');
		    }

		    if ($canDo->get('core.edit') && isset($this->items[0])) {
			    JToolBarHelper::editList('itens.edit','JTOOLBAR_EDIT');
		    }

        }

		if ($canDo->get('core.edit.state')) {

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::custom('itenss.publish', 'publish.png', 'publish_f2.png','JTOOLBAR_PUBLISH', true);
			    JToolBarHelper::custom('itenss.unpublish', 'unpublish.png', 'unpublish_f2.png', 'JTOOLBAR_UNPUBLISH', true);
            } else if (isset($this->items[0])) {
                //If this component does not use state then show a direct delete button as we can not trash
                JToolBarHelper::deleteList('', 'itenss.delete','JTOOLBAR_DELETE');
            }

            if (isset($this->items[0]->state)) {
			    JToolBarHelper::divider();
			    JToolBarHelper::archiveList('itenss.archive','JTOOLBAR_ARCHIVE');
            }
            if (isset($this->items[0]->checked_out)) {
            	JToolBarHelper::custom('itenss.checkin', 'checkin.png', 'checkin_f2.png', 'JTOOLBAR_CHECKIN', true);
            }
		}
        
        //Show trash and delete for components that uses the state field
        if (isset($this->items[0]->state)) {
		    if ($state->get('filter.state') == -2 && $canDo->get('core.delete')) {
			    JToolBarHelper::deleteList('', 'itenss.delete','JTOOLBAR_EMPTY_TRASH');
			    JToolBarHelper::divider();
		    } else if ($canDo->get('core.edit.state')) {
			    JToolBarHelper::trash('itenss.trash','JTOOLBAR_TRASH');
			    JToolBarHelper::divider();
		    }
        }

		if ($canDo->get('core.admin')) {
			JToolBarHelper::preferences('com_videos');
		}
        
        //Set sidebar action - New in 3.0
		JHtmlSidebar::setAction('index.php?option=com_videos&view=itenss');
        
        $this->extra_sidebar = '';
        
		JHtmlSidebar::addFilter(

			JText::_('JOPTION_SELECT_PUBLISHED'),

			'filter_published',

			JHtml::_('select.options', JHtml::_('jgrid.publishedOptions'), "value", "text", $this->state->get('filter.state'), true)

		);

		//Filter for the field hits
		$select_label = JText::sprintf('COM_VIDEOS_FILTER_SELECT_LABEL', 'Hits');
		$options = array();
		$options[0] = new stdClass();
		$options[0]->value = "true";
		$options[0]->text = "Sim";
		$options[1] = new stdClass();
		$options[1]->value = "false";
		$options[1]->text = "Não";
		JHtmlSidebar::addFilter(
			$select_label,
			'filter_hits',
			JHtml::_('select.options', $options , "value", "text", $this->state->get('filter.hits'), true)
		);

		//Filter for the field showautor
		$select_label = JText::sprintf('COM_VIDEOS_FILTER_SELECT_LABEL', 'ShowAutor');
		$options = array();
		$options[0] = new stdClass();
		$options[0]->value = "true";
		$options[0]->text = "Sim";
		$options[1] = new stdClass();
		$options[1]->value = "false";
		$options[1]->text = "No";
		JHtmlSidebar::addFilter(
			$select_label,
			'filter_showautor',
			JHtml::_('select.options', $options , "value", "text", $this->state->get('filter.showautor'), true)
		);

        
	}
    
	protected function getSortFields()
	{
		return array(
		'a.id' => JText::_('JGRID_HEADING_ID'),
		'a.ordering' => JText::_('JGRID_HEADING_ORDERING'),
		'a.state' => JText::_('JSTATUS'),
		'a.checked_out' => JText::_('COM_VIDEOS_ITENSS_CHECKED_OUT'),
		'a.checked_out_time' => JText::_('COM_VIDEOS_ITENSS_CHECKED_OUT_TIME'),
		'a.created_by' => JText::_('COM_VIDEOS_ITENSS_CREATED_BY'),
		'a.nome' => JText::_('COM_VIDEOS_ITENSS_NOME'),
		'a.video' => JText::_('COM_VIDEOS_ITENSS_VIDEO'),
		'a.imagem' => JText::_('COM_VIDEOS_ITENSS_IMAGEM'),
		'a.hits' => JText::_('COM_VIDEOS_ITENSS_HITS'),
		'a.showautor' => JText::_('COM_VIDEOS_ITENSS_SHOWAUTOR'),
		);
	}

    
}
