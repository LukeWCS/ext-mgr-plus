/**
*
* Extension Manager Plus. An extension for the phpBB Forum Software package.
*
* @copyright (c) 2022, LukeWCS, https://www.wcsaga.org/
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

$(window).ready(function () {
	$('div.errorbox p').prepend(ExtMgrPlus.TemplateVars.LastExtMsg);
});
