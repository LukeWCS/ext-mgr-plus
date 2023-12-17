/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org
* @license GNU General Public License, version 2 (GPL-2.0-only)
*
*/

(function () {	// IIFE start

'use strict';

// Extension Manager

function versionCheck() {
	if ($('#extmgrplus_link_version_check').hasClass('disabled')) {
		return;
	}

	showHideActionElements(false);
	$('[id^="extmgrplus_link_"]')			.addClass('disabled');
	$('#extmgrplus_versioncheck_notice')	.show();
	$(location)								.prop('href', $('#extmgrplus_link_version_check').attr('data-url'));
};

function showHideOrderIgnore() {
	if ($('#extmgrplus_link_order_ignore').hasClass('disabled')) {
		return;
	}

	var show = !$('.extmgrplus_order_and_ignore').is(":visible");

	showHideActionElements(!show);
	$('[id^="extmgrplus_link_"]:not([id$="_order_ignore"])')		.toggleClass('disabled', show);
	$('.extmgrplus_order_and_ignore')								.toggle(show);
	$('#extmgrplus_list th:nth-of-type(1n+7):nth-of-type(-1n+8)')	.toggle(show);
	$('#extmgrplus_list td:nth-of-type(1n+7):nth-of-type(-1n+8)')	.toggle(show);
};

function saveCheckboxes() {
	if ($('#extmgrplus_link_save_checkboxes').hasClass('disabled')) {
		return;
	}

	$('input[name="extmgrplus_save_checkboxes"]').click();
};

function showHideActionElements(show) {
	$('#extmgrplus_list td:nth-of-type(1n+4):nth-of-type(-1n+6) *:not(dfn)').toggle(show);
};

function checkUncheckAll(e) {
	$('#extmgrplus_list input[name="ext_mark_' + e.data.checkboxType + '[]"]:enabled').prop('checked', e.currentTarget.checked)
	setButtonState({data: {checkboxType: e.data.checkboxType}});
};

function setCheckboxes(e) {
	const order = $('#extmgrplus_list input[name="ext_order[' + e.currentTarget.value + ']"]').val() ?? '';
	const enabled = e.data.checkboxType == 'enabled';
	const checked = e.currentTarget.checked;
	const dependency = (order.slice(0, 1) != '+');

	// (enabled && (checked && !dependency || !checked && dependency)) ||
	// (!enabled && (checked && dependency || !checked && !dependency))

	if (
		order != '' &&
		(
			(enabled && (checked && dependency || !checked && !dependency)) ||
			(!enabled && (!checked && dependency || checked && !dependency))
		)
	) {
		const orderClean = order.replace(/\+/, '');
		let selectValue;
		let selectCheck;

console.log('---------');
console.log('order     : ' + order);
console.log('enabled   : ' + enabled);
console.log('checked   : ' + checked);
console.log('dependency: ' + dependency);

		// if (!e.currentTarget.checked || order == '' || enabled && !dependency || !enabled && dependency) {
			// return;
		// }
		// if (enabled) {
			// if (checked) {
				// selectValue = (dependency ? '+' : '') + selectValue;
				// selectCheck = dependency;
			// } else {
				// selectCheck = dependency;
			// }
		// } else {
			// if (checked) {
				// selectCheck = !dependency;
			// } else {
				// selectValue = (dependency ? '+' : '') + selectValue;
				// selectCheck = !dependency;
			// }
		// }
		if (enabled) {
			selectValue = (checked && dependency ? '+' : '') + orderClean;
			selectCheck = dependency;
		} else {
			selectValue = (!checked && dependency ? '+' : '') + orderClean;
			selectCheck = !dependency;
		}

		// const $orderList = $('#extmgrplus_list input[name^="ext_order["][value="' + selectValue + '"');

		// $orderList.each(function () {
		$('#extmgrplus_list input[name^="ext_order["][value="' + selectValue + '"').each(function () {
			const orderElement = this.name.replace(/.*?\[(.*?)\]/, '$1');
			$('#extmgrplus_list input[name="ext_mark_' + e.data.checkboxType + '[]"][value="' + orderElement + '"]:enabled').prop('checked', selectCheck);
		});
console.log('selectValue: ' + selectValue);
console.log('selectCheck: ' + selectCheck);
	}

	setButtonState({data: {checkboxType: e.data.checkboxType}});
};

function setButtonState(e) {
	const checkedCount = $('#extmgrplus_list input[name="ext_mark_' + e.data.checkboxType + '[]"]:checked').length;
	const buttonType = e.data.checkboxType == 'enabled' ? 'disable' : 'enable';

	$('#extmgrplus_list input[name="extmgrplus_' + buttonType + '_all').prop('disabled', checkedCount == 0);
};

// Order & Ignore

function setInputBoxState(e) {
	$('#extmgrplus_list input[name="ext_order[' + e.currentTarget.value + ']"]').toggleClass('inactive', e.currentTarget.checked);
};

// Common

function disableEnter(e) {
	if (e.key == 'Enter' && e.target.type != 'textarea') {
		return false;
	}
};

// Event registration

$(window).ready(function () {
	$('#extmgrplus_list')						.on('keypress'	, disableEnter);
	$('#extmgrplus_link_version_check')			.on('click'		, versionCheck);
	$('#extmgrplus_link_order_ignore')			.on('click'		, showHideOrderIgnore);
	$('#extmgrplus_link_save_checkboxes')		.on('click'		, saveCheckboxes);
	$('[name="ext_mark_all_enabled"]:enabled')	.on('change'	, {checkboxType: 'enabled'}, checkUncheckAll);
	$('[name="ext_mark_all_disabled"]:enabled')	.on('change'	, {checkboxType: 'disabled'}, checkUncheckAll);
	// $('[name="ext_mark_enabled[]"]:enabled')	.on('change'	, {checkboxType: 'enabled'}, setButtonState);
	// $('[name="ext_mark_disabled[]"]:enabled')	.on('change'	, {checkboxType: 'disabled'}, setButtonState);
	$('[name="ext_mark_enabled[]"]:enabled')	.on('change'	, {checkboxType: 'enabled'}, setCheckboxes);
	$('[name="ext_mark_disabled[]"]:enabled')	.on('change'	, {checkboxType: 'disabled'}, setCheckboxes);
	$('[name="ext_ignore[]"]')					.on('change'	, setInputBoxState);
});

})();	// IIFE end
