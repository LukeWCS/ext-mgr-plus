<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace lukewcs\extmgrplus\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	public function __construct(
		\phpbb\config\db_text $config_text,
		\lukewcs\extmgrplus\core\ext_mgr_plus $extmgrplus,
		\phpbb\extension\manager $ext_manager
)
	{
		$this->config_text			= $config_text;
		$this->extmgrplus			= $extmgrplus;
		$this->extension_manager	= $ext_manager;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.common'							=> 'todo',
			'core.acp_extensions_run_action_before'	=> 'ext_manager',
			'core.acp_extensions_run_action_after'	=> 'ext_manager_tpl',
			'core.adm_page_footer'					=> 'catch_errorbox',
		];
	}

	public function todo()
	{
		if ($this->config_text->get('extmgrplus_jobs') !== '')
		{
			$this->extmgrplus->todo();
		}
	}

	public function ext_manager($event)
	{
		if ($event['action'] == 'list' && $this->extension_manager->is_enabled('lukewcs/extmgrplus'))
		{
			$this->extmgrplus->ext_manager($event);
		}
	}

	public function ext_manager_tpl($event)
	{
		if ($event['action'] == 'list' && $this->extension_manager->is_enabled('lukewcs/extmgrplus'))
		{
			$event['tpl_name'] = '@lukewcs_extmgrplus/acp_ext_mgr_plus_acp_ext_list';
		}
	}

	public function catch_errorbox()
	{
		if ($this->extension_manager->is_enabled('lukewcs/extmgrplus'))
		{
			$this->extmgrplus->catch_errorbox();
		}
	}
}
