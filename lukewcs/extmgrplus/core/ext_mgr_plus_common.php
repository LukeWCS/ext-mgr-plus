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

namespace lukewcs\extmgrplus\core;

class ext_mgr_plus_common
{
	protected object $config;
	protected object $config_text;
	protected object $language;
	protected object $template;
	protected object $ext_manager;

	protected array  $metadata;
	public    string $u_action;

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

	public function set_meta_template_vars(string $tpl_prefix, string $copyright): void
	{
		$template_vars = [
			'ext_name'		=> $this->metadata['extra']['display-name'],
			'ext_ver'		=> $this->language->lang($tpl_prefix . '_VERSION_STRING', $this->metadata['version']),
			'ext_copyright'	=> $copyright,
			'class'			=> strtolower($tpl_prefix) . '_footer',
		];
		$template_vars += $this->language->is_set($tpl_prefix . '_LANG_VER') ? [
			'lang_desc'		=> $this->language->lang($tpl_prefix . '_LANG_DESC'),
			'lang_ver'		=> $this->language->lang($tpl_prefix . '_VERSION_STRING', $this->language->lang($tpl_prefix . '_LANG_VER')),
			'lang_author'	=> $this->language->lang($tpl_prefix . '_LANG_AUTHOR'),
		] : [];

		$this->template->assign_vars([$tpl_prefix . '_METADATA' => $template_vars]);
	}

	/*
		Determine the version of the language pack with fallback to 0.0.0
	*/
	public function get_lang_ver(string $lang_ext_ver): string
	{
		preg_match('/^([0-9]+\.[0-9]+\.[0-9]+.*)/', $this->language->lang($lang_ext_ver), $matches);
		return ($matches[1] ?? '0.0.0');
	}

	/*
		Check the language pack version for the minimum version and generate notice if outdated
	*/
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
			else /* Fallback if the current language package does not yet have the required variable. */
			{
				$lang_outdated_msg = 'Note: The language pack for the extension <strong>%1$s</strong> is no longer up-to-date. (installed: %2$s / needed: %3$s)';
			}
			$lang_outdated_msg = sprintf($lang_outdated_msg, $this->metadata['extra']['display-name'], $ext_lang_ver, $ext_lang_min_ver);
		}

		return $lang_outdated_msg;
	}

	/*
		Set a variable/array in a config_text variable container or delete one or all variables/arrays
	*/
	public function config_text_set(string $container, ?string $name, $value): void
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
			$vars ??= [];
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

	/*
		Get a variable/array from a config_text variable container
	*/
	public function config_text_get(string $container, ?string $name = null)
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

	/*
		Wrapper for check_form_key
	*/
	public function check_form_key_(string $key): void
	{
		if (!check_form_key($key))
		{
			$this->trigger_error_($this->language->lang('FORM_INVALID'), E_USER_WARNING);
		}
	}

	/*
		Wrapper for trigger_error
	*/
	public function trigger_error_(string $message, int $error_type, ?string $back_link_lang_var = null): void
	{
		if ($error_type == E_USER_NOTICE && $this->config['extmgrplus_switch_auto_redirect'])
		{
			meta_refresh(1, $this->rotate_get_params($this->u_action));
			$this->template->assign_var('EXTMGRPLUS_AUTO_REDIRECT', true);
		}
		$this->template->assign_var('EXTMGRPLUS_TRIGGER_ERROR', true);
		trigger_error($message . $this->back_link($back_link_lang_var), $error_type);
	}

	public function back_link(?string $lang_var = null): string
	{
		return sprintf('<br><br><a href="%1$s">%2$s</a>',
			/* 1 */ $this->u_action,
			/* 2 */ $this->language->lang($lang_var ?? 'BACK_TO_PREV')
		);
	}

	/*
		Rotates the GET parameters (Firefox F5-form-resend-workaround)
	*/
	public function rotate_get_params(string $url_full): string
	{
		$separator	= (strpos($url_full, '&amp;') ? '&amp;' : '&');
		$get_params	= preg_split('/\?|' . $separator . '/', $url_full);
		$url		= array_shift($get_params);
		array_push($get_params, array_shift($get_params));

		return $url . '?' . implode($separator, $get_params);
	}
}
