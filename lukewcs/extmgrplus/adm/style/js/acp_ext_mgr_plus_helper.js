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

$(window).ready(function () {
	// ExtMgrPlus.ShowSettings();
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
		var SettingsStateNew = ((SettingsState == 'none') ? '' : 'none');

		$('#version_check_settings').css('display', SettingsStateNew);
		$('#extmgrplus_settings').css('display', SettingsStateNew);

		$('#extmgrplus_order_and_ignore_settings').css('display', SettingsStateNew);
		$('.extmgrplus_order_and_ignore').css('display', SettingsStateNew);

		$('#extmgrplus_button_disable').css('display', ((SettingsStateNew == 'none') ? '' : 'none'));
		$('#extmgrplus_button_enable').css('display', ((SettingsStateNew == 'none') ? '' : 'none'));
		$('.extmgrplus_checkboxes').css('display', ((SettingsStateNew == 'none') ? '' : 'none'));
	},
};
