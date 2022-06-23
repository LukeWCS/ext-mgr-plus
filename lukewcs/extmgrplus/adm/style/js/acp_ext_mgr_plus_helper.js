/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

ExtMgrPlus.CheckUncheckAll = function (CheckBoxes, Button) {
	'use strict';

	var ChkBoxAllState = $('#extmgrplus_list input[name="ext_mark_all_' + CheckBoxes + '"]').prop('checked');

	$('#extmgrplus_list input[name="ext_mark_' + CheckBoxes + '[]"]').filter(':enabled').prop('checked', ChkBoxAllState)

	ExtMgrPlus.SetButtonState(CheckBoxes, Button);
};

ExtMgrPlus.SetButtonState = function (CheckBoxes, Button) {
	'use strict';

	var CheckBoxesChecked = $('#extmgrplus_list input[name="ext_mark_' + CheckBoxes + '[]"]').filter(':checked').length;

	$('#extmgrplus_list input[name="extmgrplus_' + Button + '_all').prop('disabled', CheckBoxesChecked == 0);
};

ExtMgrPlus.SetInputBoxState = function (tech_name) {
	'use strict';

	var CheckBoxChecked = $('#extmgrplus_list input[name="ext_ignore[]"][value="' + tech_name + '"]').prop('checked');

	$('#extmgrplus_list input[name="ext_order[' + tech_name + ']"]').css('opacity', (CheckBoxChecked ? '.5' : '1'));
};

ExtMgrPlus.ShowHideSettings = function () {
	'use strict';

	var show = ($('#version_check_settings').css('display') == 'none');

	if (show) {
		$('.extmgrplus_settings')							.show();
	} else {
		$('.extmgrplus_settings')							.hide();
	}
	$('#extmgrplus_order_and_ignore')						.hide();

	ExtMgrPlus.ShowOrderIgnoreColumns(false);
	ExtMgrPlus.ShowActionElements(!show);
};

ExtMgrPlus.ShowHideOrderIgnore = function () {
	'use strict';

	var show = ($('#extmgrplus_order_and_ignore').css('display') == 'none');

	if (show) {
		$('#extmgrplus_order_and_ignore')					.show();
	} else {
		$('#extmgrplus_order_and_ignore')					.hide();
	}
	$('.extmgrplus_settings')								.hide();

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
	} else {
		$('#extmgrplus_list .table1 input[type="submit"]')	.hide();
		$('#extmgrplus_list input[name*="ext_mark_"]')		.hide();
		$('#extmgrplus_list a')								.hide();
		$('#extmgrplus_list td.row2 span')					.hide();
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

ExtMgrPlus.ConfirmMigrations = function () {
	'use strict';

	if (!confirm(ExtMgrPlus.lang.MsgConfirmMigrations))	{
		$('.extmgrplus_settings input[name="extmgrplus_enable_migrations"][value="0"]').prop('checked', true);
	}
};

$('#extmgrplus_list').keypress(function(event) {
	'use strict';

	if (event.which == '13') {
		event.preventDefault();
	}
});
