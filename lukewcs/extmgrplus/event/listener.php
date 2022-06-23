<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace lukewcs\extmgrplus\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	public function __construct(
		\lukewcs\extmgrplus\core\ext_mgr_plus $extmgrplus
)
	{
		$this->extmgrplus = $extmgrplus;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.common'							=> 'todo',
			'core.acp_extensions_run_action_before'	=> 'ext_manager',
			'core.acp_extensions_run_action_after'	=> 'ext_manager_tpl',
			'core.adm_page_footer'					=> 'catch_message',
		];
	}

	public function todo()
	{
		$this->extmgrplus->todo();
	}

	public function ext_manager($event)
	{
		$this->extmgrplus->ext_manager($event);
	}

	public function ext_manager_tpl($event)
	{
		$this->extmgrplus->ext_manager_tpl($event);
	}

	public function catch_message()
	{
		$this->extmgrplus->catch_message();
	}
}
