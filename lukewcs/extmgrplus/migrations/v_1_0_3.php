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

class v_1_0_3 extends \phpbb\db\migration\container_aware_migration
{
	public static function depends_on()
	{
		return ['\lukewcs\extmgrplus\migrations\v_1_0_0'];
	}

	public function update_data()
	{
		return [
			['custom', [[$this, 'split_order_and_ignore']]],
		];
	}

	public function split_order_and_ignore()
	{
		$this->config_text = $this->container->get('config_text');
		$list_db = json_decode($this->config_text->get('extmgrplus_order_and_ignore_list'), true);

		if (isset($list_db['tech_names']))
		{
			$list_order = preg_grep('/^[0-9]{1,2}$/', $list_db['tech_names']);
			$list_ignore = preg_grep('/^-$/', $list_db['tech_names']);
			$list = [];
			if (count($list_order))
			{
				$list['order'] = $list_order;
			}
			if (count($list_ignore))
			{
				$list['ignore'] = array_keys($list_ignore);
			}
			$this->config_text->set('extmgrplus_order_and_ignore_list', json_encode($list));
		}
	}
}
