/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

(function ($) {	// IIFE start

'use strict';

// Classes

class LukeWCSphpBBConfirmBox {
/*
* phpBB ConfirmBox class for checkboxes and yes/no radio buttons - v1.4.3
* @copyright (c) 2023, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*/
	constructor(submitSelector, animDuration = 0) {
		let _this = this;
		this.$submitObject	= $(submitSelector);
		this.$formObject	= this.$submitObject.parents('form');
		this.animDuration	= animDuration;

		this.$formObject.find('div[id$="_confirmbox"]').each(function () {
			const elementName = this.id.replace('_confirmbox', '');

			$('input[name="' + elementName + '"]')				.on('change'	, _this.#Show);
			$('input[name^="' + elementName + '_confirm_"]')	.on('click'		, _this.#Button);
		});
		this.$formObject										.on('reset'		, _this.HideAll);
	}

	#Show = (e) => {
		const $elementObject	= $('input[name="' + e.target.name + '"]');
		const $confirmBoxObject	= $('div[id="' + e.target.name + '_confirmbox"]');

		if ($elementObject.prop('checked') != $confirmBoxObject.attr('data-default')) {
			this.#changeBoxState($elementObject, $confirmBoxObject, true);
		}
	}

	#Button = (e) => {
		const elementName		= e.target.name.replace(/_confirm_.*/, '');
		const $elementObject	= $('input[name="' + elementName + '"]');
		const $confirmBoxObject	= $('div[id="' + elementName + '_confirmbox"]');
		const elementType		= $elementObject.attr('type');

		if (e.target.name.endsWith('_confirm_no')) {
			if (elementType == 'checkbox') {
				$elementObject.prop('checked', $confirmBoxObject.attr('data-default'));
			} else if (elementType == 'radio') {
				$elementObject.filter('[value="' + ($confirmBoxObject.attr('data-default') ? '1' : '0') + '"]').prop('checked', true);
			}
		}
		this.#changeBoxState($elementObject, $confirmBoxObject, null);
	}

	HideAll = () => {
		const $elementObject	= this.$formObject.find('input.confirmbox_active');
		const $confirmBoxObject	= this.$formObject.find('div[id$="_confirmbox"]');

		this.#changeBoxState($elementObject, $confirmBoxObject, false);
	}

	#changeBoxState = ($elementObject, $confirmBoxObject, showBox) => {
		$elementObject		.prop('disabled', !!showBox);
		$elementObject		.toggleClass('confirmbox_active', !!showBox);
		$confirmBoxObject	[showBox ? 'show' : 'hide'](this.animDuration);
		this.$submitObject	.prop('disabled', showBox ?? this.$formObject.find('input.confirmbox_active').length);
	}
}

// Declarations

const constants = Object.freeze({
	CheckBoxModeOff:	'0',
	CheckBoxModeAll:	'1',
	CheckBoxModeLast:	'2',
});
let ConfirmBox;

// Settings form

function setDefaults() {
	const c = constants;

	setSwitch('[name="extmgrplus_switch_log"]',							true);
	setSwitch('[name="extmgrplus_switch_confirmation"]',				true);
	setSwitch('[name="extmgrplus_switch_auto_redirect"]',				false);
	$(        '[name="extmgrplus_select_checkbox_mode"]').prop('value',	c.CheckBoxModeAll);
	setSwitch('[name="extmgrplus_switch_order_and_ignore"]',			true);
	setSwitch('[name="extmgrplus_switch_self_disable"]',				false);
	setSwitch('[name="extmgrplus_switch_instructions"]',				true);
	setSwitch('[name="extmgrplus_switch_migration_col"]',				false);
	setSwitch('[name="extmgrplus_switch_migrations"]',					false);

	ConfirmBox.HideAll();
};

function setSwitch(selector, checked) {
	const $elementObject	= $(selector);
	const elementType		= $elementObject.attr('type');

	if (elementType == 'checkbox') {
		$elementObject.prop('checked', checked);
	} else if (elementType == 'radio') {
		$elementObject.filter('[value="' + (checked ? '1' : '0') + '"]').prop('checked', true);
	}
};

function formSubmit() {
	$('#extmgrplus_settings').submit();
};

// Common

function disableEnter(e) {
	if (e.key == 'Enter' && e.target.type != 'textarea') {
		return false;
	}
};

// Event registration

$(function () {
	$('#extmgrplus_settings')			.on('keypress'	, disableEnter);
	$('[name="extmgrplus_defaults"]')	.on('click'		, setDefaults);
	$('[name="extmgrplus_submit"]')		.on('click'		, formSubmit);

	ConfirmBox = new LukeWCSphpBBConfirmBox('[name="extmgrplus_submit"]', 300);
});

})(jQuery);	// IIFE end
