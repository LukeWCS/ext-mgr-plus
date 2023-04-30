<?php
/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

namespace lukewcs\extmgrplus\core;

class ext_mgr_plus_common
{
	protected $config;
	protected $config_text;
	protected $language;
	protected $template;
	protected $ext_manager;

	protected $u_action;

	public function __construct(
		\phpbb\config\config $config,
		\phpbb\config\db_text $config_text,
		\phpbb\language\language $language,
		\phpbb\template\template $template,
		\phpbb\extension\manager $ext_manager
	)
	{
		$this->config		= $config;
		$this->config_text	= $config_text;
		$this->language		= $language;
		$this->template		= $template;
		$this->ext_manager	= $ext_manager;

		$this->metadata		= $this->ext_manager->create_extension_metadata_manager('lukewcs/extmgrplus')->get_metadata('all');
	}

	public function set_this(
		$u_action
	): void
	{
		$this->u_action = $u_action;
	}

	public function set_template_vars($tpl_prefix): void
	{
		$this->template->assign_vars([
			$tpl_prefix . '_METADATA'	=> [
				'EXT_NAME'		=> $this->metadata['extra']['display-name'],
				'EXT_VER'		=> $this->metadata['version'],
				'LANG_DESC'		=> $this->language->lang($tpl_prefix . '_LANG_DESC'),
				'LANG_VER'		=> $this->language->lang($tpl_prefix . '_LANG_VER'),
				'LANG_AUTHOR'	=> $this->language->lang($tpl_prefix . '_LANG_AUTHOR'),
				'CLASS'			=> strtolower($tpl_prefix) . '_footer',
			],
		]);
	}

	public function check_form_key_error($key): void
	{
		if (!check_form_key($key))
		{
			$this->trigger_error_($this->language->lang('FORM_INVALID'), E_USER_WARNING);
		}
	}

	public function back_link($lang_var = null): string
	{
		return sprintf('<br><br><a href="%1$s">%2$s</a>',
			/* 1 */ $this->u_action,
			/* 2 */ $this->language->lang($lang_var ?? 'BACK_TO_PREV')
		);
	}

	// Determine the version of the language pack with fallback to 0.0.0
	public function get_lang_ver(string $lang_ext_ver): string
	{
		preg_match('/^([0-9]+\.[0-9]+\.[0-9]+)/', $this->language->lang($lang_ext_ver), $matches);
		return ($matches[1] ?? '0.0.0');
	}

	// Check the language pack version for the minimum version and generate notice if outdated
	public function lang_ver_check_msg(string $lang_version_var, string $lang_outdated_var): string
	{
		$lang_outdated_msg = '';
		$ext_lang_ver = $this->get_lang_ver($lang_version_var);
		$ext_lang_min_ver = $this->metadata['extra']['lang-min-ver'];

		if (phpbb_version_compare($ext_lang_ver, $ext_lang_min_ver, '<'))
		{
			if ($this->language->is_set($lang_outdated_var))
			{
				$lang_outdated_msg = $this->language->lang($lang_outdated_var);
			}
			else // Fallback if the current language package does not yet have the required variable.
			{
				$lang_outdated_msg = 'Note: The language pack for the extension <strong>%1$s</strong> is no longer up-to-date. (installed: %2$s / needed: %3$s)';
			}
			$lang_outdated_msg = sprintf($lang_outdated_msg, $this->metadata['extra']['display-name'], $ext_lang_ver, $ext_lang_min_ver);
		}

		return $lang_outdated_msg;
	}

	// Set a variable/array in a config_text variable container or delete one or all variables/arrays
	public function config_text_set(string $container, $name, $value): void
	{
		if ($this->config_text->get($container) === null)
		{
			$vars = null;
		}
		else
		{
			$vars = json_decode($this->config_text->get($container), true);
		}
		if ($name !== null && $value !== null)
		{
			if ($vars === null)
			{
				$vars = [];
			}
			$vars[$name] = $value;
			$this->config_text->set($container, json_encode($vars));
		}
		else if ($name !== null && $value === null)
		{
			unset($vars[$name]);
			$this->config_text->set($container, (is_array($vars) && count($vars) ? json_encode($vars) : ''));
		}
		else if ($name === null && $value === null)
		{
			$this->config_text->set($container, '');
		}
	}

	// Get a variable/array from a config_text variable container
	public function config_text_get(string $container, $name = null)
	{
		$config_text = $this->config_text->get($container);
		if ($config_text === null)
		{
			return null;
		}
		$vars = json_decode($config_text, true);

		if ($name !== null)
		{
			return ($vars[$name] ?? null);
		}
		else
		{
			return ($vars ?? null);
		}
	}

	// Wrapper for trigger_error
	public function trigger_error_(string $message, int $error_type, string $back_link_lang_var = null): void
	{
		$this->template->assign_var('EXTMGRPLUS_LAST_EMP_ACTION', 'trigger_error');
		if ($error_type == E_USER_NOTICE && $this->config['extmgrplus_switch_auto_redirect'])
		{
			meta_refresh(1, $this->u_action);
			$this->template->assign_var('EXTMGRPLUS_AUTO_REDIRECT', true);
		}
		trigger_error($message . $this->back_link($back_link_lang_var), $error_type);
	}
}
