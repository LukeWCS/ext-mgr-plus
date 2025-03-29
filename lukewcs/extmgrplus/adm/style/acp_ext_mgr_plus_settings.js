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

(function ($) {

'use strict';

/*
	Classes
*/

class LukeWCSphpBBConfirmBox {
/*
* phpBB ConfirmBox class for checkboxes and yes/no radio buttons - v1.5.0
* @copyright (c) 2023, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*/
	constructor(submitSelector, animDuration = 0) {
		let _this = this;
		this.$submitObject	= $(submitSelector);
		this.$formObject	= this.$submitObject.parents('form');
		this.animDuration	= animDuration;

		// this.$formObject.find('div[id$="_confirmbox"]').each(function () {
		this.$formObject.find('div.lukewcs_confirmbox').each(function () {
			// const elementName = this.id.replace('_confirmbox', '');
// console.log(this.querySelectorAll('input[type="button"]'));

			// $('input[name="' + elementName + '"]')	.on('change', _this.#Show);
			$('input[name="' + this.dataset['name'] + '"]')	.on('change', _this.#Show);
			// $('input[name^="' + elementName + '_confirm_"]').on('click'	, _this.#Button);
			$(this).find('input[type="button"]')			.on('click'	, _this.#Button);
console.log($(this).find('input[type="button"]'));
		});
		this.$formObject									.on('reset'	, _this.HideAll);
	}

	#Show = (e) => {
		const $elementObject	= $('input[name="' + e.target.name + '"]');
		// const $confirmBoxObject	= $('div[id="' + e.target.name + '_confirmbox"]');
		const $confirmBoxObject	= $('div.lukewcs_confirmbox[data-name="' + e.target.name + '"]');

		if ($elementObject.prop('checked') != $confirmBoxObject.attr('data-default')) {
			this.#changeBoxState($elementObject, $confirmBoxObject, true);
		}
	}

	#Button = (e) => {
		// const elementName		= e.target.name.replace(/_confirm_.*/, '');
		const elementName		= e.target.closest('div.lukewcs_confirmbox').dataset['name'];
console.log(e.target.closest('div.lukewcs_confirmbox'));
console.log(e.target.name);
console.log(elementName);

		const $elementObject	= $('input[name="' + elementName + '"]');
		// const $confirmBoxObject	= $('div[id="' + elementName + '_confirmbox"]');
		const $confirmBoxObject	= $('div.lukewcs_confirmbox[data-name="' + elementName + '"]');
		const elementType		= $elementObject.attr('type');

		// if (e.target.name.endsWith('_confirm_no')) {
		if (e.target.name == 'lukewcs_confirmbox_no') {
			if (elementType == 'checkbox') {
				$elementObject.prop('checked', $confirmBoxObject.attr('data-default'));
			} else if (elementType == 'radio') {
				$elementObject.filter('[value="' + ($confirmBoxObject.attr('data-default') ? '1' : '0') + '"]').prop('checked', true);
			}
		}
		this.#changeBoxState($elementObject, $confirmBoxObject, null);
	}

	HideAll = () => {
		// const $elementObject	= this.$formObject.find('input.confirmbox_active');
		const $elementObject	= this.$formObject.find('input.lukewcs_confirmbox_active');
		// const $confirmBoxObject	= this.$formObject.find('div[id$="_confirmbox"]');
		const $confirmBoxObject	= this.$formObject.find('div.lukewcs_confirmbox');

		this.#changeBoxState($elementObject, $confirmBoxObject, false);
	}

	#changeBoxState = ($elementObject, $confirmBoxObject, showBox) => {
		$elementObject		.prop('disabled', !!showBox);
		// $elementObject		.toggleClass('confirmbox_active', !!showBox);
		$elementObject		.toggleClass('lukewcs_confirmbox_active', !!showBox);
		$confirmBoxObject	[showBox ? 'show' : 'hide'](this.animDuration);
		// this.$submitObject	.prop('disabled', showBox ?? this.$formObject.find('input.confirmbox_active').length);
		this.$submitObject	.prop('disabled', showBox ?? this.$formObject.find('input.lukewcs_confirmbox_active').length);
	}
}

/*
	Declarations
*/

const constants = Object.freeze({
	CheckBoxModeOff:	'0',
	CheckBoxModeAll:	'1',
	CheckBoxModeLast:	'2',
});
let ConfirmBox;

/*
	Settings form
*/

function setDefaults() {
	const c = constants;

	setSwitch('[name="extmgrplus_switch_log"]',							true);
	setSwitch('[name="extmgrplus_switch_confirmation"]',				true);
	setSwitch('[name="extmgrplus_switch_auto_redirect"]',				false);
	$(        '[name="extmgrplus_select_checkbox_mode"]').prop('value',	c.CheckBoxModeAll);
	setSwitch('[name="extmgrplus_switch_order_and_ignore"]',			true);
	setSwitch('[name="extmgrplus_switch_self_disable"]',				false);
	setSwitch('[name="extmgrplus_switch_instructions"]',				true);
	setSwitch('[name="extmgrplus_switch_settings_link"]',				true);
	$(        '[name="extmgrplus_number_vc_limit"]').prop('value',		15);
	setSwitch('[name="extmgrplus_switch_migration_col"]',				false);
	setSwitch('[name="extmgrplus_switch_migrations"]',					false);
	setSwitch('[name="extmgrplus_switch_version_url"]',					false);

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
	$('[name="extmgrplus_save_settings"]').click();
};

/*
	Common
*/

function disableEnter(e) {
	if (e.key == 'Enter' && e.target.type != 'textarea') {
		return false;
	}
};

/*
	Event registration
*/

$(function () {
	$('#extmgrplus_settings')			.on('keypress'	, disableEnter);
	$('[name="extmgrplus_defaults"]')	.on('click'		, setDefaults);
	$('[name="extmgrplus_submit"]')		.on('click'		, formSubmit);

	ConfirmBox = new LukeWCSphpBBConfirmBox('[name="extmgrplus_submit"]', 300);
});

})(jQuery);
