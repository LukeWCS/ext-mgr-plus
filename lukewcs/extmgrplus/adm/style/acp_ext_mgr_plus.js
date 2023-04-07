/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

if (typeof ExtMgrPlus == "undefined")
{
	ExtMgrPlus = {};
}

ExtMgrPlus.constants = Object.freeze({
	CheckBoxModeOff		: '0',
	CheckBoxModeAll		: '1',
	CheckBoxModeLast	: '2',
});

// Extension Manager

ExtMgrPlus.CheckUncheckAll = function (e) {
	'use strict';

	$('#extmgrplus_list input[name="ext_mark_' + e.data.CheckBoxType + '[]"]').filter(':enabled').prop('checked', e.currentTarget.checked)
	ExtMgrPlus.SetButtonState({data: {CheckBoxType: e.data.CheckBoxType}});
};

ExtMgrPlus.SetButtonState = function (e) {
	'use strict';

	var CheckedCount = $('#extmgrplus_list input[name="ext_mark_' + e.data.CheckBoxType + '[]"]').filter(':checked').length;
	var Button = {
		'disabled': 'enable',
		'enabled': 'disable',
	};

	$('#extmgrplus_list input[name="extmgrplus_' + Button[e.data.CheckBoxType] + '_all').prop('disabled', CheckedCount == 0);
};

ExtMgrPlus.SetInputBoxState = function (e) {
	'use strict';

	$('#extmgrplus_list input[name="ext_order[' + e.currentTarget.value + ']"]').css('opacity', (e.currentTarget.checked ? '.5' : '1'));
};

ExtMgrPlus.ShowHideOrderIgnore = function () {
	'use strict';

	var show = ($('.extmgrplus_order_and_ignore').css('display') == 'none');

	if (show) {
		$('.extmgrplus_order_and_ignore')					.show();
	} else {
		$('.extmgrplus_order_and_ignore')					.hide();
	}

	ExtMgrPlus.ShowOrderIgnoreColumns(show);
	ExtMgrPlus.ShowActionElements(!show);
};

ExtMgrPlus.ShowActionElements = function (show) {
	'use strict';

	if (show) {
		$('#extmgrplus_list .table1 input[type="submit"]')	.show();
		$('#extmgrplus_list input[name*="ext_mark_"]')		.show();
		$('#extmgrplus_list a')								.show();
		$('#extmgrplus_list td.row2 span')					.show();
		$('#extmgrplus_link_version_check')					.removeClass('disabled');
		$('#extmgrplus_link_save_checkboxes')				.removeClass('disabled');
	} else {
		$('#extmgrplus_list .table1 input[type="submit"]')	.hide();
		$('#extmgrplus_list input[name*="ext_mark_"]')		.hide();
		$('#extmgrplus_list a')								.hide();
		$('#extmgrplus_list td.row2 span')					.hide();
		$('#extmgrplus_link_version_check')					.addClass('disabled');
		$('#extmgrplus_link_save_checkboxes')				.addClass('disabled');
	}
};

ExtMgrPlus.ShowOrderIgnoreColumns = function (show) {
	'use strict';

	if (show) {
		$('#extmgrplus_list th:nth-of-type(7)')				.show();
		$('#extmgrplus_list td.row3:nth-of-type(4)')		.show();
		$('#extmgrplus_list td:nth-of-type(7)')				.show();
		$('#extmgrplus_list th:nth-of-type(8)')				.show();
		$('#extmgrplus_list td.row3:nth-of-type(5)')		.show();
		$('#extmgrplus_list td:nth-of-type(8)')				.show();
	} else {
		$('#extmgrplus_list th:nth-of-type(7)')				.hide();
		$('#extmgrplus_list td.row3:nth-of-type(4)')		.hide();
		$('#extmgrplus_list td:nth-of-type(7)')				.hide();
		$('#extmgrplus_list th:nth-of-type(8)')				.hide();
		$('#extmgrplus_list td.row3:nth-of-type(5)')		.hide();
		$('#extmgrplus_list td:nth-of-type(8)')				.hide();
	}
};

ExtMgrPlus.VersionCheck = function (VersionCheckURL) {
	'use strict';

	if (($('.extmgrplus_order_and_ignore').css('display') != 'none')) {
		return;
	}

	$('.fa-refresh.extmgrplus_link_icon').addClass('fa-spin');
	$(location).prop('href', ExtMgrPlus.tpl['versioncheck_url']);
};

ExtMgrPlus.SaveCheckboxes = function () {
	'use strict';

	if (($('.extmgrplus_order_and_ignore').css('display') != 'none')) {
		return;
	}

	$('#extmgrplus_list').append('<input type="hidden" name="extmgrplus_save_checkboxes" value="1">');
	$('#extmgrplus_list').submit();
};

$('#extmgrplus_list').keypress(function(e) {
	'use strict';

	if (e.which == '13') {
		e.preventDefault();
	}
});

// Settings

ExtMgrPlus.ConfirmBox = function (e) {
	'use strict';

var defaultState = Boolean($('div[id="' + e.target.name + '_confirmbox"]').attr('data-default'));

	if ($('input[name="' + e.target.name + '"]').prop('checked') != defaultState) {
		$('input[name="' + e.target.name + '"]').prop('disabled', true)
		$('input[name="' + e.target.name + '"]').addClass('confirmbox_active');
		$('div[id="' + e.target.name + '_confirmbox"]').show();
		$('input[name="extmgrplus_form_submit"]').prop('disabled', true);
	}
};

ExtMgrPlus.ConfirmBoxButton = function (e) {
	'use strict';

	var elementName = e.target.name.slice(0, e.target.name.indexOf('_confirm_'));
	var defaultState = Boolean($('div[id="' + elementName + '_confirmbox"]').attr('data-default'));

	if (e.target.name.endsWith('_no')) {
		$('input[name="' + elementName + '"]').prop('checked', defaultState);
	}

	$('input[name="' + elementName + '"]').prop('disabled', false);
	$('input[name="' + elementName + '"]').removeClass('confirmbox_active');
	$('div[id="' + elementName + '_confirmbox"]').hide();
	$('input[name="extmgrplus_form_submit"]').prop('disabled', $('input[class*="confirmbox_active"]').length);
}

ExtMgrPlus.ConfirmBoxHide = function () {
	'use strict';

	$('input[class*="confirmbox_active"]').prop('disabled', false);
	$('input[class*="confirmbox_active"]').removeClass('confirmbox_active');
	$('div[id$="_confirmbox"]').hide();
	$('input[name="extmgrplus_form_submit"]').prop('disabled', false);
};

ExtMgrPlus.SetDefaults = function () {
	'use strict';

	var c = ExtMgrPlus.constants;

	$('input[name="force_unstable"]'						).prop('checked'	, false);
	$('input[name="extmgrplus_switch_log"]'					).prop('checked'	, true);
	$('input[name="extmgrplus_switch_confirmation"]'		).prop('checked'	, true);
	$('select[name="extmgrplus_select_checkbox_mode"]'		).prop('value'		, c.CheckBoxModeAll);
	$('input[name="extmgrplus_switch_order_and_ignore"]'	).prop('checked'	, true);
	$('input[name="extmgrplus_switch_self_disable"]'		).prop('checked'	, false);
	$('input[name="extmgrplus_switch_migration_col"]'		).prop('checked'	, false);
	$('input[name="extmgrplus_switch_migrations"]'			).prop('checked'	, false);
	ExtMgrPlus.ConfirmBoxHide();
};

ExtMgrPlus.FormSubmit = function () {
	'use strict';

	$('#extmgrplus_settings').submit();
};

ExtMgrPlus.FormReset = function () {
	'use strict';

	$('#extmgrplus_settings').trigger("reset");
	ExtMgrPlus.ConfirmBoxHide();
};

// Register onChange and onClick events

$(window).ready(function() {
	'use strict';

	$('input[name="ext_mark_all_enabled"]:enabled'	).on('change'	, {CheckBoxType: 'enabled'}, ExtMgrPlus.CheckUncheckAll);
	$('input[name="ext_mark_all_disabled"]:enabled'	).on('change'	, {CheckBoxType: 'disabled'}, ExtMgrPlus.CheckUncheckAll);
	$('input[name="ext_mark_enabled[]"]:enabled'	).on('change'	, {CheckBoxType: 'enabled'}, ExtMgrPlus.SetButtonState);
	$('input[name="ext_mark_disabled[]"]:enabled'	).on('change'	, {CheckBoxType: 'disabled'}, ExtMgrPlus.SetButtonState);
	$('input[name="ext_ignore[]"]'					).on('change'	, ExtMgrPlus.SetInputBoxState);
	$('input[name="extmgrplus_defaults"]'			).on('click'	, ExtMgrPlus.SetDefaults);
	$('input[name="extmgrplus_form_submit"]'		).on('click'	, ExtMgrPlus.FormSubmit);
	$('input[name="extmgrplus_form_reset"]'			).on('click'	, ExtMgrPlus.FormReset);

	$('div[id$="_confirmbox"]').each(function() {
		var elementName = $(this)[0].id.replace('_confirmbox', '')

		$('input[name="' + elementName + '"]').on('change', ExtMgrPlus.ConfirmBox);
		$('input[name^="' + elementName + '_confirm_"]').on('click', ExtMgrPlus.ConfirmBoxButton);
	});
});
