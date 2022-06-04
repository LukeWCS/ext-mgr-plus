/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

$('#extmgrplus_list').keypress(function(event) {
	if (event.which == '13') {
		event.preventDefault();
	}
});

var ExtMgrPlus = {
	CheckUncheckAll: function (CheckBoxes, Button) {
		'use strict';

		var ChkBoxAllState = $('#ext_' + CheckBoxes + '_mark_all').prop('checked');

		$('[name="ext_' + CheckBoxes + '_mark[]"').prop('checked', ChkBoxAllState)
		ExtMgrPlus.SetButtonState(CheckBoxes, Button);
	},
	SetButtonState: function (CheckBoxes, Button) {
		'use strict';

		var CheckBoxesChecked = $('[name="ext_' + CheckBoxes + '_mark[]"').filter(':checked').length;

		$('#extmgrplus_button_' + Button).prop('disabled', CheckBoxesChecked == 0);
	},
	ShowSettings: function () {
		'use strict';

		var SettingsState = $('#version_check_settings').css('display');

		if (SettingsState == 'none') {
			$('.extmgrplus_settings')						.show();

			$('#extmgrplus_list th:nth-child(7)')			.show();
			$('#extmgrplus_list td.row3:nth-child(4)')		.show();
			$('#extmgrplus_list td:nth-child(7)')			.show();

			$('#extmgrplus_button_disable')					.hide();
			$('#extmgrplus_button_enable')					.hide();
			$('#extmgrplus_list input[type="checkbox"]')	.hide();

			$('#extmgrplus_list a')							.hide();
			$('#extmgrplus_list td.row2 span')				.hide();
		} else {
			$('.extmgrplus_settings')						.hide();

			$('#extmgrplus_list th:nth-child(7)')			.hide();
			$('#extmgrplus_list td.row3:nth-child(4)')		.hide();
			$('#extmgrplus_list td:nth-child(7)')			.hide();

			$('#extmgrplus_button_disable')					.show();
			$('#extmgrplus_button_enable')					.show();
			$('#extmgrplus_list input[type="checkbox"]')	.show();

			$('#extmgrplus_list a')							.show();
			$('#extmgrplus_list td.row2 span')				.show();
		}
	},
};

// ExtMgrPlus.ShowSettings();
