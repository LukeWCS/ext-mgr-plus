/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

// Initialization

var ExtMgrPlus = {};

(function () {	// IIFE start

'use strict';

ExtMgrPlus.constants = Object.freeze({
	CheckBoxModeOff		: '0',
	CheckBoxModeAll		: '1',
	CheckBoxModeLast	: '2',
});

// Classes

class LukeWCSphpBBConfirmBox {
/*
* phpBB ConfirmBox class for checkboxes - v1.1.0
* @copyright (c) 2023, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*/
	constructor(submitSelector) {
		this.$submitObject = $(submitSelector);
		var _this = this;

		$('div[id$="_confirmbox"]').each(function () {
			var elementName = $(this)[0].id.replace('_confirmbox', '')

			$('input[name="' + elementName + '"]')				.on('change'	, _this.Show);
			$('input[name^="' + elementName + '_confirm_"]')	.on('click'		, _this.Button);
		});
		this.$submitObject.parents('form')						.on('reset'		, this.HideAll);
	}

	Show = (e) => {
		var elementDefault = $('div[id="' + e.target.name + '_confirmbox"]').attr('data-default') == 1;
		var $elementObject = $('input[name="' + e.target.name + '"]');

		if ($elementObject.prop('checked') != elementDefault) {
			$elementObject									.prop('disabled', true)
			$elementObject									.addClass('confirmbox_active');
			$('div[id="' + e.target.name + '_confirmbox"]')	.show();
			this.$submitObject								.prop('disabled', true);
		}
	}

	Button = (e) => {
		var elementName = e.target.name.replace(/_confirm_.*/, '');
		var elementDefault = $('div[id="' + elementName + '_confirmbox"]').attr('data-default') == 1;
		var $elementObject = $('input[name="' + elementName + '"]');

		if (e.target.name.endsWith('_confirm_no')) {
			$elementObject.prop('checked', elementDefault);
		}

		$elementObject									.prop('disabled', false);
		$elementObject									.removeClass('confirmbox_active');
		$('div[id="' + elementName + '_confirmbox"]')	.hide();
		this.$submitObject								.prop('disabled', $('input[class*="confirmbox_active"]').length);
	}

	HideAll = () => {
		var $elementObject = $('input[class*="confirmbox_active"]');

		$elementObject				.prop('disabled', false);
		$elementObject				.removeClass('confirmbox_active');
		$('div[id$="_confirmbox"]')	.hide();
		this.$submitObject			.prop('disabled', false);
	}
}

// Extension Manager

ExtMgrPlus.VersionCheck = function () {
	if ($('#extmgrplus_link_version_check').hasClass('disabled')) {
		return;
	}

	var vcURL = $('#extmgrplus_link_version_check').attr('data-url');

	ExtMgrPlus.ShowHideActionElements(false);

	$('span[id^="extmgrplus_link_"]')		.addClass('disabled');
	$('#extmgrplus_versioncheck_notice')	.show();
	$(location)								.prop('href', vcURL);
};

ExtMgrPlus.ShowHideOrderIgnore = function () {
	if ($('#extmgrplus_link_order_ignore').hasClass('disabled')) {
		return;
	}

	var show = ($('.extmgrplus_order_and_ignore').css('display') == 'none');

	ExtMgrPlus.ShowHideActionElements(!show);

	$('.extmgrplus_order_and_ignore')							.toggle(show);
	$('#extmgrplus_list th:nth-of-type(n+7):nth-of-type(-n+8)')	.toggle(show);
	$('#extmgrplus_list td:nth-of-type(n+7):nth-of-type(-n+8)')	.toggle(show);
};

ExtMgrPlus.SaveCheckboxes = function () {
	if ($('#extmgrplus_link_save_checkboxes').hasClass('disabled')) {
		return;
	}

	$('input[name="extmgrplus_save_checkboxes"]').click();
};

ExtMgrPlus.CheckUncheckAll = function (e) {
	$('#extmgrplus_list input[name="ext_mark_' + e.data.CheckBoxType + '[]"]').filter(':enabled').prop('checked', e.currentTarget.checked)
	ExtMgrPlus.SetButtonState({data: {CheckBoxType: e.data.CheckBoxType}});
};

ExtMgrPlus.SetButtonState = function (e) {
	var CheckedCount = $('#extmgrplus_list input[name="ext_mark_' + e.data.CheckBoxType + '[]"]').filter(':checked').length;
	var Button = {
		'disabled': 'enable',
		'enabled': 'disable',
	};

	$('#extmgrplus_list input[name="extmgrplus_' + Button[e.data.CheckBoxType] + '_all').prop('disabled', CheckedCount == 0);
};

ExtMgrPlus.SetInputBoxState = function (e) {
	var $inputbox = $('#extmgrplus_list input[name="ext_order[' + e.currentTarget.value + ']"]');

	if (e.currentTarget.checked) {
		$inputbox.addClass('inactive');
	} else {
		$inputbox.removeClass('inactive');
	}
};

ExtMgrPlus.ShowHideActionElements = function (show) {
	$('#extmgrplus_list td:nth-of-type(1n+4):nth-of-type(-1n+6) *:not(dfn)')	.toggle(show);

	if (show) {
		$('#extmgrplus_link_version_check')										.removeClass('disabled');
		$('#extmgrplus_link_save_checkboxes')									.removeClass('disabled');
	} else {
		$('#extmgrplus_link_version_check')										.addClass('disabled');
		$('#extmgrplus_link_save_checkboxes')									.addClass('disabled');
	}
};

// Settings

ExtMgrPlus.SetDefaults = function () {
	var c = ExtMgrPlus.constants;

	$('input[name="force_unstable"]')						.prop('checked'	, false);
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

// General

ExtMgrPlus.DisableEnter = function (e) {
	if (e.key == 'Enter' && e.target.type != 'textarea') {
		return false;
	}
};

// Event registration

$(window).ready(function () {
	// Extension Manager
	$('#extmgrplus_link_version_check')					.on('click'		, ExtMgrPlus.VersionCheck);
	$('#extmgrplus_link_order_ignore')					.on('click'		, ExtMgrPlus.ShowHideOrderIgnore);
	$('#extmgrplus_link_save_checkboxes')				.on('click'		, ExtMgrPlus.SaveCheckboxes);
	$('input[name="ext_mark_all_enabled"]:enabled')		.on('change'	, {CheckBoxType: 'enabled'}, ExtMgrPlus.CheckUncheckAll);
	$('input[name="ext_mark_all_disabled"]:enabled')	.on('change'	, {CheckBoxType: 'disabled'}, ExtMgrPlus.CheckUncheckAll);
	$('input[name="ext_mark_enabled[]"]:enabled')		.on('change'	, {CheckBoxType: 'enabled'}, ExtMgrPlus.SetButtonState);
	$('input[name="ext_mark_disabled[]"]:enabled')		.on('change'	, {CheckBoxType: 'disabled'}, ExtMgrPlus.SetButtonState);
	$('input[name="ext_ignore[]"]')						.on('change'	, ExtMgrPlus.SetInputBoxState);
	$('#extmgrplus_list,#extmgrplus_settings')			.on('keypress'	, ExtMgrPlus.DisableEnter);

	// Settings
	$('input[name="extmgrplus_defaults"]')				.on('click'		, ExtMgrPlus.SetDefaults);
	$('input[name="extmgrplus_submit"]')				.on('click'		, ExtMgrPlus.FormSubmit);

	ExtMgrPlus.ConfirmBox = new LukeWCSphpBBConfirmBox('[name="extmgrplus_submit"]');
});

})();	// IIFE end
