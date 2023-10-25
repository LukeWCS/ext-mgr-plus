/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

// Initialization

if (typeof ExtMgrPlus == "undefined")
{
	var ExtMgrPlus = {};
}

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
* phpBB ConfirmBox class for Checkboxes - v0.5.0
* @copyright (c) 2023, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*/
	constructor(submitSelector) {
		this.submitSelector = $(submitSelector);
		var _this = this;

		$('div[id$="_confirmbox"]').each(function () {
			var elementName = $(this)[0].id.replace('_confirmbox', '')
// console.log(elementName);

			$('input[name="' + elementName + '"]')				.on('change'	, _this.Show);
			$('input[name^="' + elementName + '_confirm_"]')	.on('click'		, _this.Button);
		});
	}

	Show = (e) => {
		var defaultState = Boolean($('div[id="' + e.target.name + '_confirmbox"]').attr('data-default'));

// console.log($('input[name="' + e.target.name + '"]')[0].type);
// console.log(e.target.name);
// console.log(this.submitSelector);
		if ($('input[name="' + e.target.name + '"]').prop('checked') != defaultState) {
			$('input[name="' + e.target.name + '"]')		.prop('disabled', true)
			$('input[name="' + e.target.name + '"]')		.addClass('confirmbox_active');
			$('div[id="' + e.target.name + '_confirmbox"]')	.show();
			this.submitSelector								.prop('disabled', true);
		}
	}

	Button = (e) => {
		var elementName = e.target.name.slice(0, e.target.name.indexOf('_confirm_'));
		var defaultState = Boolean($('div[id="' + elementName + '_confirmbox"]').attr('data-default'));
// console.log(elementName);
// console.log(e.target.name);

		if (e.target.name.endsWith('confirm_no')) {
			$('input[name="' + elementName + '"]').prop('checked', defaultState);
		}

		$('input[name="' + elementName + '"]')			.prop('disabled', false);
		$('input[name="' + elementName + '"]')			.removeClass('confirmbox_active');
		$('div[id="' + elementName + '_confirmbox"]')	.hide();
		this.submitSelector								.prop('disabled', $('input[class*="confirmbox_active"]').length);
	}

	HideAll = () => {
		$('input[class*="confirmbox_active"]')	.prop('disabled', false);
		$('input[class*="confirmbox_active"]')	.removeClass('confirmbox_active');
		$('div[id$="_confirmbox"]')				.hide();
		this.submitSelector						.prop('disabled', false);
	}
}

// Extension Manager

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

ExtMgrPlus.ShowHideOrderIgnore = function () {
	var show = ($('.extmgrplus_order_and_ignore').css('display') == 'none');

	if (show) {
		$('.extmgrplus_order_and_ignore').show();
	} else {
		$('.extmgrplus_order_and_ignore').hide();
	}

	ExtMgrPlus.ShowOrderIgnoreColumns(show);
	ExtMgrPlus.ShowActionElements(!show);
};

ExtMgrPlus.ShowActionElements = function (show) {
	if (show) {
		$('#extmgrplus_list th:nth-of-type(1n+4):nth-of-type(-1n+6)')		.show();
		$('#extmgrplus_list td.row3:nth-of-type(1n+4):nth-of-type(-1n+6)')	.show();
		$('#extmgrplus_list td:nth-of-type(1n+4):nth-of-type(-1n+6)')		.show();
		$('#extmgrplus_link_version_check')									.removeClass('disabled');
		$('#extmgrplus_link_save_checkboxes')								.removeClass('disabled');
	} else {
		$('#extmgrplus_list th:nth-of-type(1n+4):nth-of-type(-1n+6)')		.hide();
		$('#extmgrplus_list td.row3:nth-of-type(1n+4):nth-of-type(-1n+6)')	.hide();
		$('#extmgrplus_list td:nth-of-type(1n+4):nth-of-type(-1n+6)')		.hide();
		$('#extmgrplus_link_version_check')									.addClass('disabled');
		$('#extmgrplus_link_save_checkboxes')								.addClass('disabled');
	}
};

ExtMgrPlus.ShowOrderIgnoreColumns = function (show) {
	if (show) {
		$('#extmgrplus_list th:nth-of-type(n+7):nth-of-type(-n+8)')			.show();
		$('#extmgrplus_list td.row3:nth-of-type(n+7):nth-of-type(-n+8)')	.show();
		$('#extmgrplus_list td:nth-of-type(n+7):nth-of-type(-n+8)')			.show();
	} else {
		$('#extmgrplus_list th:nth-of-type(n+7):nth-of-type(-n+8)')			.hide();
		$('#extmgrplus_list td.row3:nth-of-type(n+7):nth-of-type(-n+8)')	.hide();
		$('#extmgrplus_list td:nth-of-type(n+7):nth-of-type(-n+8)')			.hide();
	}
};

ExtMgrPlus.VersionCheck = function (VersionCheckURL) {
	if ($('#extmgrplus_link_version_check').hasClass('disabled')) {
		return;
	}

	$('fieldset.quick a .fa-refresh')	.addClass('fa-spin');
	$(location)							.prop('href', VersionCheckURL);
};

ExtMgrPlus.SaveCheckboxes = function () {
	if ($('#extmgrplus_link_save_checkboxes').hasClass('disabled')) {
		return;
	}

	$('#extmgrplus_list').append('<input type="hidden" name="extmgrplus_save_checkboxes" value="1">');
	$('#extmgrplus_list').submit();
};

ExtMgrPlus.DisableEnter = function (e) {
	if (e.key == 'Enter') {
		return false;
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

ExtMgrPlus.FormReset = function () {
	$('#extmgrplus_settings').trigger("reset");
	ExtMgrPlus.ConfirmBox.HideAll();
};

// Event registration

$(window).ready(function () {
	// Extension Manager
	$('input[name="ext_mark_all_enabled"]:enabled')		.on('change'	, {CheckBoxType: 'enabled'}, ExtMgrPlus.CheckUncheckAll);
	$('input[name="ext_mark_all_disabled"]:enabled')	.on('change'	, {CheckBoxType: 'disabled'}, ExtMgrPlus.CheckUncheckAll);
	$('input[name="ext_mark_enabled[]"]:enabled')		.on('change'	, {CheckBoxType: 'enabled'}, ExtMgrPlus.SetButtonState);
	$('input[name="ext_mark_disabled[]"]:enabled')		.on('change'	, {CheckBoxType: 'disabled'}, ExtMgrPlus.SetButtonState);
	$('input[name="ext_ignore[]"]')						.on('change'	, ExtMgrPlus.SetInputBoxState);
	$('input[name*="ext_order"]')						.on('keypress'	, ExtMgrPlus.DisableEnter);
	// Settings
	$('input[name="extmgrplus_defaults"]')				.on('click'		, ExtMgrPlus.SetDefaults);
	$('input[name="extmgrplus_form_submit"]')			.on('click'		, ExtMgrPlus.FormSubmit);
	$('input[name="extmgrplus_form_reset"]')			.on('click'		, ExtMgrPlus.FormReset);

	ExtMgrPlus.ConfirmBox = new LukeWCSphpBBConfirmBox('input[name="extmgrplus_form_submit"]');
});

})();	// IIFE end
