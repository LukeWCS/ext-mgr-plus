<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
* Note: This extension is 100% genuine handcraft and consists of selected
*       natural raw materials. There was no AI involved in making it.
*
*/

namespace lukewcs\extmgrplus\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{
	public function __construct(
		protected \lukewcs\extmgrplus\core\ext_mgr_plus $extmgrplus,
	)
	{
	}

	public static function getSubscribedEvents(): array
	{
		return [
			'core.acp_extensions_run_action_before'	=> 'ext_manager_before',
			'core.acp_extensions_run_action_after'	=> 'ext_manager_after',
			'core.adm_page_footer'					=> 'change_msg_template',
		];
	}

	public function ext_manager_before(object $event): void
	{
		$this->extmgrplus->ext_manager_before($event);
	}

	public function ext_manager_after(object $event): void
	{
		$this->extmgrplus->ext_manager_after($event);
	}

	public function change_msg_template(): void
	{
		$this->extmgrplus->change_msg_template();
	}
}
