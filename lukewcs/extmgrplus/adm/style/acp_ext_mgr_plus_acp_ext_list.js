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

	$('.extmgrplus_order_and_ignore')								.toggle(show);
	$('#extmgrplus_list th:nth-of-type(1n+7):nth-of-type(-1n+8)')	.toggle(show);
	$('#extmgrplus_list td:nth-of-type(1n+7):nth-of-type(-1n+8)')	.toggle(show);
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

// Common

ExtMgrPlus.DisableEnter = function (e) {
	if (e.key == 'Enter' && e.target.type != 'textarea') {
		return false;
	}
};

// Event registration

$(window).ready(function () {
	$('#extmgrplus_list')								.on('keypress'	, ExtMgrPlus.DisableEnter);
	$('#extmgrplus_link_version_check')					.on('click'		, ExtMgrPlus.VersionCheck);
	$('#extmgrplus_link_order_ignore')					.on('click'		, ExtMgrPlus.ShowHideOrderIgnore);
	$('#extmgrplus_link_save_checkboxes')				.on('click'		, ExtMgrPlus.SaveCheckboxes);
	$('input[name="ext_mark_all_enabled"]:enabled')		.on('change'	, {CheckBoxType: 'enabled'}, ExtMgrPlus.CheckUncheckAll);
	$('input[name="ext_mark_all_disabled"]:enabled')	.on('change'	, {CheckBoxType: 'disabled'}, ExtMgrPlus.CheckUncheckAll);
	$('input[name="ext_mark_enabled[]"]:enabled')		.on('change'	, {CheckBoxType: 'enabled'}, ExtMgrPlus.SetButtonState);
	$('input[name="ext_mark_disabled[]"]:enabled')		.on('change'	, {CheckBoxType: 'disabled'}, ExtMgrPlus.SetButtonState);
	$('input[name="ext_ignore[]"]')						.on('change'	, ExtMgrPlus.SetInputBoxState);
});

})();	// IIFE end
