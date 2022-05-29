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
		\phpbb\config\config $config,
		\lukewcs\extmgrplus\core\ext_mgr_plus $extmgrplus
	)
	{
		$this->config		= $config;
		$this->extmgrplus	= $extmgrplus;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.common'							=> 'todo',
			'core.acp_extensions_run_action_before'	=> 'ext_manager',
			'core.acp_extensions_run_action_after'	=> 'ext_manager_tpl',
		];
	}

	public function todo()
	{
		if ($this->config['extmgrplus_exec_todo'])
		{
			$this->extmgrplus->todo();
		}
	}

	public function ext_manager($event)
	{
		if ($event['action'] == 'list')
		{
			$this->extmgrplus->ext_manager($event);
		}
	}

	public function ext_manager_tpl($event)
	{
		if ($event['action'] == 'list')
		{
			$event['tpl_name'] = '@lukewcs_extmgrplus/acp_ext_mgr_plus_acp_ext_list';
		}
	}
}
