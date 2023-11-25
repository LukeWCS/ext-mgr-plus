/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

var ExtMgrPlus = {};

(function () {	// IIFE start

'use strict';

// Classes

class LukeWCSphpBBConfirmBox {
/*
* phpBB ConfirmBox class for checkboxes - v1.3.0
* @copyright (c) 2023, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*/
	constructor(submitSelector, animDuration = 0) {
		this.$submitObject = $(submitSelector);
		this.$formObject = this.$submitObject.parents('form');
		this.animDuration = animDuration;
		var _this = this;

		this.$formObject.find('div[id$="_confirmbox"]').each(function () {
			var elementName = this.id.replace('_confirmbox', '');

			$('input[name="' + elementName + '"]')				.on('change'	, _this.#Show);
			$('input[name^="' + elementName + '_confirm_"]')	.on('click'		, _this.#Button);
		});
		this.$formObject										.on('reset'		, _this.HideAll);
	}

	#Show = (e) => {
		var $elementObject		= $('input[name="' + e.target.name + '"]');
		var $confirmBoxObject	= $('div[id="' + e.target.name + '_confirmbox"]');

		if ($elementObject.prop('checked') != $confirmBoxObject.attr('data-default')) {
			this.#changeBoxState($elementObject, $confirmBoxObject, true);
		}
	}

	#Button = (e) => {
		var elementName			= e.target.name.replace(/_confirm_.*/, '');
		var $elementObject		= $('input[name="' + elementName + '"]');
		var $confirmBoxObject	= $('div[id="' + elementName + '_confirmbox"]');

		if (e.target.name.endsWith('_confirm_no')) {
			$elementObject.prop('checked', $confirmBoxObject.attr('data-default'));
		}

		this.#changeBoxState($elementObject, $confirmBoxObject, null);
	}

	HideAll = () => {
		var $elementObject		= this.$formObject.find('input.confirmbox_active');
		var $confirmBoxObject	= this.$formObject.find('div[id$="_confirmbox"]');

		this.#changeBoxState($elementObject, $confirmBoxObject, false);
	}

	#changeBoxState = ($elementObject, $confirmBoxObject, showBox) => {
		$elementObject		.prop('disabled', !!showBox);
		$elementObject		.toggleClass('confirmbox_active', !!showBox);
		$confirmBoxObject	[!!showBox ? 'show' : 'hide'](this.animDuration);
		this.$submitObject	.prop('disabled', showBox ?? this.$formObject.find('input.confirmbox_active').length);
	}
}

// Constants

ExtMgrPlus.constants = Object.freeze({
	CheckBoxModeOff		: '0',
	CheckBoxModeAll		: '1',
	CheckBoxModeLast	: '2',
});

// Settings

ExtMgrPlus.SetDefaults = function () {
	var c = ExtMgrPlus.constants;

	$('input[name="extmgrplus_switch_log"]')				.prop('checked'	, true);
	$('input[name="extmgrplus_switch_confirmation"]')		.prop('checked'	, true);
	$('input[name="extmgrplus_switch_auto_redirect"]')		.prop('checked'	, false);
	$('select[name="extmgrplus_select_checkbox_mode"]')		.prop('value'	, c.CheckBoxModeAll);
	$('input[name="extmgrplus_switch_order_and_ignore"]')	.prop('checked'	, true);
	$('input[name="extmgrplus_switch_self_disable"]')		.prop('checked'	, false);
	$('input[name="extmgrplus_switch_migration_col"]')		.prop('checked'	, false);
	$('input[name="extmgrplus_switch_migrations"]')			.prop('checked'	, false);
	ExtMgrPlus.ConfirmBox.HideAll();
};

ExtMgrPlus.FormSubmit = function () {
	$('#extmgrplus_settings').submit();
};

// Common

ExtMgrPlus.DisableEnter = function (e) {
	if (e.key == 'Enter' && e.target.type != 'textarea') {
		return false;
	}
};

// Event registration

$(window).ready(function () {
	$('#extmgrplus_settings')				.on('keypress'	, ExtMgrPlus.DisableEnter);
	$('input[name="extmgrplus_defaults"]')	.on('click'		, ExtMgrPlus.SetDefaults);
	$('input[name="extmgrplus_submit"]')	.on('click'		, ExtMgrPlus.FormSubmit);

	ExtMgrPlus.ConfirmBox = new LukeWCSphpBBConfirmBox('[name="extmgrplus_submit"]', 300);
});

})();	// IIFE end
