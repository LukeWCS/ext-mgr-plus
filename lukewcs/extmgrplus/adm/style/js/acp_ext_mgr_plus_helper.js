/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

ExtMgrPlus.CheckUncheckAll = function (CheckBoxes, Button) {
	'use strict';

	var ChkBoxAllState = $('#ext_' + CheckBoxes + '_mark_all').prop('checked');

	$('[name="ext_' + CheckBoxes + '_mark[]"').prop('checked', ChkBoxAllState)
	ExtMgrPlus.SetButtonState(CheckBoxes, Button);
};

ExtMgrPlus.SetButtonState = function (CheckBoxes, Button) {
	'use strict';

	var CheckBoxesChecked = $('[name="ext_' + CheckBoxes + '_mark[]"').filter(':checked').length;

	$('#extmgrplus_button_' + Button).prop('disabled', CheckBoxesChecked == 0);
};

ExtMgrPlus.ShowSettings = function () {
	'use strict';

	var SettingsState = $('#version_check_settings').css('display');

	if (SettingsState == 'none') {
		$('.extmgrplus_settings')								.show();
		$('#extmgrplus_list .table1 th:nth-of-type(7)')			.show();
		$('#extmgrplus_list .table1 td.row3:nth-of-type(4)')	.show();
		$('#extmgrplus_list .table1 td:nth-of-type(7)')			.show();

		$('#extmgrplus_list .table1 input[type="submit"]')		.hide();
		$('#extmgrplus_list .table1 input[type="checkbox"]')	.hide();
		$('#extmgrplus_list .table1 a')							.hide();
		$('#extmgrplus_list .table1 td.row2 span')				.hide();
	} else {
		$('.extmgrplus_settings')								.hide();
		$('#extmgrplus_list .table1 th:nth-of-type(7)')			.hide();
		$('#extmgrplus_list .table1 td.row3:nth-of-type(4)')	.hide();
		$('#extmgrplus_list .table1 td:nth-of-type(7)')			.hide();

		$('#extmgrplus_list .table1 input[type="submit"]')		.show();
		$('#extmgrplus_list .table1 input[type="checkbox"]')	.show();
		$('#extmgrplus_list .table1 a')							.show();
		$('#extmgrplus_list .table1 td.row2 span')				.show();
	}
};

ExtMgrPlus.ConfirmMigrations = function () {
	'use strict';

	if (!confirm(ExtMgrPlus.lang.MsgConfirmMigrations))	{
		$('#extmgrplus_migrations_no').prop('checked', true);
	}
};

$('#extmgrplus_list').keypress(function(event) {
	if (event.which == '13') {
		event.preventDefault();
	}
});

// ExtMgrPlus.ShowSettings();
