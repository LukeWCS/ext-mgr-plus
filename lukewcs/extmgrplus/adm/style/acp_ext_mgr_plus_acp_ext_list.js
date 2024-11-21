/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
* Note: This extension is 100% genuine handcraft and consists of selected
*       natural raw materials. There was no AI involved in making it.
*
*/

(function ($) {

'use strict';

/*
	Extension Manager
*/

function versionCheck() {
	if ($('#extmgrplus_link_version_check').hasClass('disabled')) {
		return;
	}

	$(location).prop('href', $('#extmgrplus_link_version_check').attr('data-url'));
};

function showExtProperties() {
	if ($('#extmgrplus_link_ext_properties').hasClass('disabled')) {
		return;
	}

	const show = !$('.ext_properties').is(":visible");

	showHideActionElements(!show);
	$('[id^="extmgrplus_link_"]:not([id$="_ext_properties"])')		.toggleClass('disabled', show);
	$('.ext_properties')											.toggle(show);
	$('#extmgrplus_list th:nth-of-type(1n+8):nth-of-type(-1n+9)')	.toggle(show);
	$('#extmgrplus_list td:nth-of-type(1n+8):nth-of-type(-1n+9)')	.toggle(show);
};

function saveCheckboxes() {
	if ($('#extmgrplus_link_save_checkboxes').hasClass('disabled')) {
		return;
	}

	$('input[name="extmgrplus_save_checkboxes"]').click();
};

function showHideActionElements(show) {
	$('#extmgrplus_list td:nth-of-type(1n+5):nth-of-type(-1n+7) *:not(dfn)').toggle(show);
};

function checkUncheckAll(e) {
	$('input[name="ext_mark_' + e.data.checkboxType + '[]"]:enabled').prop('checked', e.currentTarget.checked)
	setButtonState({data: {checkboxType: e.data.checkboxType}});
};

function setCheckboxes(e) {
	const orderValue = $('input[name="ext_order[' + e.currentTarget.value + ']"]').val() ?? '';
	const extEnabled = e.data.checkboxType == 'enabled';
	const extChecked = e.currentTarget.checked;
	const dependency = orderValue.charAt(0) != '+';

	if (orderValue != '' && (
			(extEnabled && (extChecked && dependency || !extChecked && !dependency)) ||
			(!extEnabled && (!extChecked && dependency || extChecked && !dependency))
		)
	) {
		const orderClean = orderValue.replace(/\+/, '');
		let selectValue;
		let selectCheck;

		if (extEnabled) {
			selectValue = (extChecked && dependency ? '+' : '') + orderClean;
			selectCheck = dependency;
		} else {
			selectValue = (!extChecked && dependency ? '+' : '') + orderClean;
			selectCheck = !dependency;
		}

		$('input[name^="ext_order["][value="' + selectValue + '"').each(function () {
			const extName = this.name.replace(/.*?\[(.*?)\]/, '$1');

			$('input[name="ext_mark_' + e.data.checkboxType + '[]"][value="' + extName + '"]:enabled').prop('checked', selectCheck);
		});
	}
	setButtonState({data: {checkboxType: e.data.checkboxType}});
};

function setButtonState(e) {
	const checkedCount = $('input[name="ext_mark_' + e.data.checkboxType + '[]"]:checked').length;
	const buttonType = e.data.checkboxType == 'enabled' ? 'disable' : 'enable';

	$('input[name="extmgrplus_' + buttonType + '_all"]').prop('disabled', checkedCount == 0);
};

function setInputBoxState(e) {
	$('input[name="ext_order[' + e.currentTarget.value + ']"]').toggleClass('inactive', e.currentTarget.checked);
};

/*
	Common
*/

function disableEnter(e) {
	if (e.key == 'Enter' && e.target.type != 'textarea') {
		return false;
	}
};

/*
	Event registration
*/

$(function () {
	$('#extmgrplus_list')						.on('keypress'	, disableEnter);
	$('#extmgrplus_link_version_check')			.on('click'		, versionCheck);
	$('#extmgrplus_link_ext_properties')		.on('click'		, showExtProperties);
	$('#extmgrplus_link_save_checkboxes')		.on('click'		, saveCheckboxes);
	$('[name="ext_mark_all_enabled"]:enabled')	.on('change'	, {checkboxType: 'enabled'}, checkUncheckAll);
	$('[name="ext_mark_all_disabled"]:enabled')	.on('change'	, {checkboxType: 'disabled'}, checkUncheckAll);
	$('[name="ext_mark_enabled[]"]:enabled')	.on('change'	, {checkboxType: 'enabled'}, setCheckboxes);
	$('[name="ext_mark_disabled[]"]:enabled')	.on('change'	, {checkboxType: 'disabled'}, setCheckboxes);
	$('[name="ext_ignore[]"]')					.on('change'	, setInputBoxState);
});

})(jQuery);
