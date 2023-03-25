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

ExtMgrPlus.ConfirmSwitch = function (e) {
	'use strict';

	if ($('input[name="' + e.target.name + '"]').prop('checked')) {
		requestAnimationFrame(function() {
			setTimeout(function() {
				if (!confirm(ExtMgrPlus.lang['dialog_title'] + ExtMgrPlus.lang[e.target.name])) {
					$('input[name="' + e.target.name + '"]').prop('checked', false)
				}
			});
		});
	}
};

ExtMgrPlus.SetDefaults = function () {
	'use strict';

	var c = ExtMgrPlus.constants;

	$('input[name="extmgrplus_switch_log"]'					).prop('checked'	, true);
	$('input[name="extmgrplus_switch_confirmation"]'		).prop('checked'	, true);
	$('select[name="extmgrplus_select_checkbox_mode"]'		).prop('value'		, c.CheckBoxModeAll);
	$('input[name="extmgrplus_switch_order_and_ignore"]'	).prop('checked'	, true);
	$('input[name="extmgrplus_switch_self_disable"]'		).prop('checked'	, false);
	$('input[name="extmgrplus_switch_migration_col"]'		).prop('checked'	, false);
	$('input[name="extmgrplus_switch_migrations"]'			).prop('checked'	, false);
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

$(window).ready(function() {
	'use strict';
// ExtMgrPlus.ShowHideOrderIgnore();
	$('input[name="force_unstable"]'				).on('change'	, ExtMgrPlus.ConfirmSwitch);
	$('input[name="extmgrplus_switch_migrations"]'	).on('change'	, ExtMgrPlus.ConfirmSwitch);
	$('input[name="extmgrplus_defaults"]'			).on('click'	, ExtMgrPlus.SetDefaults);
	$('input[name="ext_mark_all_enabled"]:enabled'	).on('change'	, {CheckBoxType: 'enabled'}, ExtMgrPlus.CheckUncheckAll);
	$('input[name="ext_mark_all_disabled"]:enabled'	).on('change'	, {CheckBoxType: 'disabled'}, ExtMgrPlus.CheckUncheckAll);
	$('input[name="ext_mark_enabled[]"]:enabled'	).on('change'	, {CheckBoxType: 'enabled'}, ExtMgrPlus.SetButtonState);
	$('input[name="ext_mark_disabled[]"]:enabled'	).on('change'	, {CheckBoxType: 'disabled'}, ExtMgrPlus.SetButtonState);
	$('input[name="ext_ignore[]"]'					).on('change'	, ExtMgrPlus.SetInputBoxState);
});
