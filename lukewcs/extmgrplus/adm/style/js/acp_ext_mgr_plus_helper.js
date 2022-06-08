/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org/
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

ExtMgrPlus.CheckUncheckAll = function (CheckBoxes, Button) {
	'use strict';

	var ChkBoxAllState = $('#ext_' + CheckBoxes + '_mark_all').prop('checked');

	$('#extmgrplus_list input[name="ext_' + CheckBoxes + '_mark[]"').prop('checked', ChkBoxAllState)
	ExtMgrPlus.SetButtonState(CheckBoxes, Button);
};

ExtMgrPlus.SetButtonState = function (CheckBoxes, Button) {
	'use strict';

	var CheckBoxesChecked = $('#extmgrplus_list input[name="ext_' + CheckBoxes + '_mark[]"').filter(':checked').length;

	$('#extmgrplus_list input[name="extmgrplus_' + Button + '_all').prop('disabled', CheckBoxesChecked == 0);
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
	ExtMgrPlus.ShowOrderColumn(false);
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
	ExtMgrPlus.ShowOrderColumn(show);
	ExtMgrPlus.ShowActionElements(!show);
};

ExtMgrPlus.ShowActionElements = function (show) {
	'use strict';

	if (show) {
		$('#extmgrplus_list .table1 input[type="submit"]')	.show();
		$('#extmgrplus_list input[type="checkbox"]')		.show();
		$('#extmgrplus_list a')								.show();
		$('#extmgrplus_list td.row2 span')					.show();
	} else {
		$('#extmgrplus_list .table1 input[type="submit"]')	.hide();
		$('#extmgrplus_list input[type="checkbox"]')		.hide();
		$('#extmgrplus_list a')								.hide();
		$('#extmgrplus_list td.row2 span')					.hide();
	}
};

ExtMgrPlus.ShowOrderColumn = function (show) {
	'use strict';

	if (show) {
		$('#extmgrplus_list th:nth-of-type(7)')				.show();
		$('#extmgrplus_list td.row3:nth-of-type(4)')		.show();
		$('#extmgrplus_list td:nth-of-type(7)')				.show();
	} else {
		$('#extmgrplus_list th:nth-of-type(7)')				.hide();
		$('#extmgrplus_list td.row3:nth-of-type(4)')		.hide();
		$('#extmgrplus_list td:nth-of-type(7)')				.hide();
	}
};

ExtMgrPlus.ConfirmMigrations = function () {
	'use strict';

	if (!confirm(ExtMgrPlus.lang.MsgConfirmMigrations))	{
		$('.extmgrplus_settings input[name="extmgrplus_enable_migrations"][value="0"]').prop('checked', true);
	}
};

$('#extmgrplus_list').keypress(function(event) {
	if (event.which == '13') {
		event.preventDefault();
	}
});
