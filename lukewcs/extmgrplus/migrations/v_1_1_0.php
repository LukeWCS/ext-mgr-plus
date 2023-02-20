<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace lukewcs\extmgrplus\migrations;

class v_1_1_0 extends \phpbb\db\migration\container_aware_migration
{
	public static function depends_on()
	{
		return ['\lukewcs\extmgrplus\migrations\v_1_0_6'];
	}

	public function update_data()
	{
		$this->config_text = $this->container->get('config_text');

		return [
			['config.add',			['extmgrplus_switch_log'				, $this->config['extmgrplus_enable_log']]],
			['config.add',			['extmgrplus_switch_confirmation'		, $this->config['extmgrplus_enable_confirmation']]],
			['config.add',			['extmgrplus_select_checkbox_mode'		, $this->config['extmgrplus_enable_checkboxes_all_set']]],
			['config.add',			['extmgrplus_switch_order_and_ignore'	, $this->config['extmgrplus_enable_order_and_ignore']]],
			['config.add',			['extmgrplus_switch_self_disable'		, $this->config['extmgrplus_enable_self_disable']]],
			['config.add',			['extmgrplus_switch_migration_col'		, 0]],
			['config.add',			['extmgrplus_switch_migrations'			, $this->config['extmgrplus_enable_migrations']]],
			['config.add',			['extmgrplus_exec_todo'					, 0]],
			['config_text.add', 	['extmgrplus_list_order_and_ignore'		, $this->config_text->get('extmgrplus_order_and_ignore_list')]],
			['config_text.add', 	['extmgrplus_list_selected'				, '']],
			['config_text.add', 	['extmgrplus_list_version_check'		, $this->config_text->get('extmgrplus_version_check')]],
			['config_text.add',		['extmgrplus_todo'						, '']],

			['config.remove',		['extmgrplus_enable_log']],
			['config.remove',		['extmgrplus_enable_confirmation']],
			['config.remove',		['extmgrplus_enable_checkboxes_all_set']],
			['config.remove',		['extmgrplus_enable_order_and_ignore']],
			['config.remove',		['extmgrplus_enable_self_disable']],
			['config.remove',		['extmgrplus_enable_migrations']],
			['config_text.remove',	['extmgrplus_todo_list']],
			['config_text.remove',	['extmgrplus_order_and_ignore_list']],
			['config_text.remove',	['extmgrplus_version_check']],
		];
	}
}
