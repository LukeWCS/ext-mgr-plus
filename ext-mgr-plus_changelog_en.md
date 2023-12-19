### 2.0.0
(2023-12-19) / CDB: --)

* Support for phpBB 3.2 has been dropped and all special customizations have been removed. Minimum is now phpBB 3.3.0, optimal is 3.3.8+.
* Released for PHP 8.3.
* Fix: When identifying new migrations, a file name check that was too strict prevented correct recognition if different case letters were used for file names and class names. This resulted in 2 errors:
  * When displaying the column for new migrations was activated, the number was calculated incorrectly.
  * If the activation of extensions with new migrations is not allowed, the selection checkbox of the affected extension has not been blocked.
* Fix: Beta testing of 2.0 revealed that EMP could not handle invalid extensions, resulting in several issues:
  * In certain situations the counter for uninstalled extensions could get into the minus range. Since a negative number is not provided, the number 18446744073709551615 was displayed instead, as a different variable type was expected in the language variable. [Reported from Kirk (phpBB.de)]
  * If the number of uninstalled extensions was negative, all disabled extensions were displayed in the uninstalled extensions section. [Reported from Kirk (phpBB.de)]
  * The "Deactivate selected" and "Activate selected" buttons were incorrectly activated depending on the situation.
  * The "Select all extensions" checkbox for activated and deactivated was incorrectly activated depending on the situation.
  * The "Enabled Extensions" and "Disabled Extensions" counters were incorrectly calculated depending on the situation.
  * With Order&Ignore, input elements were incorrectly generated for invalid extensions, which could cause incorrect data to be written to the DB when saving.
* Fix: The problem with resending the form data in Firefox (see next point) had revealed an error in EMP that could occur when extensions were activated without reloading the ExtMgr page first. If an extension became invalid between two switching processes, i.e. the metadata of the extension could no longer be read, then this led to a FATAL that was not caught. [Reported from Kirk (phpBB.de)]
* Firefox Workaround: If extensions were activated when the query was deactivated and automatic confirmation was activated and the ExtMgr page was then manually reloaded (e.g. with F5), this resulted in Firefox incorrectly prompting a query to resend the form data. If this query was confirmed positively, EMP carried out the last action again, which could lead to errors depending on the situation. A new function now rotates the GET parameters of the URL during automatic redirection, which in Firefox means that unnecessary queries regarding form data are no longer triggered. Other tested browsers are not affected by the problem. [Reported from Kirk (phpBB.de)]
* In the info table, the number of invalid extensions is also displayed in brackets after the number of available extensions.
* If the version check of an extension could not be carried out successfully, this information is also saved and evaluated. This works for both the global VP (Recheck all versions) and the local VP (Details).
  * In the info table, the number of errors is displayed after the date of the last version check.
  * For extensions that had errors in the version check, an orange warning icon with a tooltip is displayed behind the version.
* Since phpBB does not explicitly inform you by default if an extension does not offer a version check, EMP now also fills this gap. This means that all possible states (VP successful/VP faulty/no VP set up) can now be signaled accordingly.
  * The info table above the extensions list expanded to 4 columns. What is new is the number of extensions with version checks set up.
  * For extensions for which no version check is set up, an icon (broken chain) with a tooltip is displayed behind the version.
* Other version checking changes:
  * During a version check, all functions in the link bar that can disrupt the process are now blocked.
  * Furthermore, the interactive elements in the extensions list are hidden to prevent accidental actions that can disrupt the process. [Suggestion from chris1278 (phpBB.de)]
  * Additionally, a blue information box provides information about the process. [Suggestion from chris1278 (phpBB.de)]
* In Order&Ignore, an extension can now be linked to a group (one or more extensions) in the "Order" column. For example, if such a link is defined and a deactivated extension "B" is selected for activation, then its required extension "A" is also automatically selected.
* If the "Remember last status" option is activated, the selection of check boxes will only be saved if the query is activated if the query is confirmed with "Yes". If "No", the last saved selection is restored.
* This extension is now compatible with Toggle Control. This means administrators can decide centrally in one place whether radio buttons, checkboxes or toggles should be used for yes/no switches.
* If self-deactivation is active and EMP is also selected when deactivating the exts, then the workaround regarding clearing the cache will only be carried out if phpBB <3.3.8 is available. This means there will no longer be a delay for the next two page views, only once. See also "My Workaround" at 1.0.7.
* Since the "Always check for unstable development versions:" switch in the settings is not part of EMP, it is no longer taken into account when resetting to EMP standard settings.
* There is now also a tooltip for the red exclamation mark icon (in outdated versions).
* Inline ConfirmBox
  * EMP's inline ConfirmBox for generating queries in the settings has been converted into the Javascript class `LukeWCSphpBBConfirmBox`, which combines all functions and properties in a single object. This makes the ConfirmBox functionality very easy to integrate into other extensions. The class also optionally offers an animation (jQuery standard), the speed of which can be defined using class parameters.
  * Fade in and out are now done with animation. [Suggestion from IMC (phpBB.de)]
* Toggles now use a movement animation for the slider and a color animation (transition) for the background color. [Suggestion from Kirk (phpBB.de)]
* Several criticisms and suggestions regarding CSS taken into account. [Suggestion from Kirk (phpBB.de)]
* Code optimization:
  * JS:
    * For Javascript and jQuery, properties and functions classified as DEPRECATED have been replaced with current variants. See build changelog for details.
    * Major improvements related to redundancy and cumbersome code.
  * Twig:
    * If the Order&Ignore function is deactivated, unnecessary HTML will no longer be generated for the explanatory texts, for the send block and for the contents of the "Order" and "Ignore" columns.
  * PHP:
    * Numerous detail improvements.
* Language files:
  * A change in 1.0.7 made a language variable obsolete, but this has not yet been removed.

### 1.1.2
(2023-08-20)

* Fix: If an extension had a file without a suffix in the `migrations` folder, EMP issued a debug warning: `Undefined array key "extension"`. [Reported from Bruce Banner (phpBB.com)]
* Fix: If one or more debug messages were generated due to errors during a version check using "Recheck all versions", then these were effectively suppressed by EMP. The reason was a change in 1.1.1 which, after a version check, cleaned up the URL with a redirect. The redirect has been removed. [Reported from Kirk (phpBB.de)]
* Due to the "Smilie Signs" problem, the ignore function has been further expanded. If the ignore feature is set for an extension, no new migrations will be identified for this extension, as they are meaningless in such a case anyway. If the "New Migrations" column is activated, the corresponding ignore icon is displayed for ignored extensions instead of the number of new migrations.
* If the ignore feature is set for an extension, a deactivated checkbox is no longer displayed in the "Select" column, but the same ignore icon as in the "New Migrations" column. There is now a visual difference in this column between ignored extensions and those for which the checkbox is not available due to conditions.
* Validation Criticism 1.1.1:
  * For version displays, the prefix "v" can now be adjusted globally using a language variable.

### 1.1.1
(2023-05-28)

* Settings:
  * To further reduce the load and pave the way for future changes, there is now a separate ACP module for the settings. The link is on the left side in the nav bar and says "Manage Extensions - Settings".
  * The switch regarding unstable versions is now also taken into account by the reset to installation default function.
  * There is only one common submit button. So far there have been two separate versions, one for the switch or unstable versions and one for the EMP settings. There were technical reasons for this, but it was irritating from a user perspective. EMP now also takes over the query and storage for the phpBB switch.
  * The queries are no longer made via a modal Javascript dialog (`confirm()`), but via HTML and CSS. This means that Javascript is no longer stopped and the query opens and closes without delay. To do this, a corresponding dialog will appear directly below the relevant switch.
  * A new switch can be used to determine whether positive messages should be automatically confirmed. After 1 second you will be redirected to the link, which can be clicked below each message. This is enough to be able to perceive the green box as feedback. An animated icon is displayed below the message as an indicator for automatic confirmation. Error messages are not affected by this switch and must still be confirmed manually.
* Version check:
  * Changed icon from `fa-wifi` to `fa-refresh`.
  * While running the version check, the associated icon is now animated. This serves as a small indicator for the ongoing version check, as phpBB itself does not provide an indicator.
  * After running the version check, a redirect occurs to the normal URL of the "Manage Extensions" page. This prevents running a version check again by reloading the page after a version check.
* Added a separate template for confirmation messages and error messages. The template is based on the original from phpBB and has been expanded so that the ExtensionManager title, the ExtensionManager description and the respective action explanation (if applicable) from phpBB are always displayed for all messages. The EMP footer is also displayed. This means that EMP behaves like phpBB even with confirmations and error messages, since messages are always embedded in the ExtensionManager template framework.
* Checking for valid migration files and counting new migrations improved:
  * When counting new migrations, files that do not have a valid PHP suffix may also have been recognized as migrations, for example a backup file (`.bak`) of a migration file. Such a file can contain a valid migration, but is ignored by phpBB itself. Such files do not or should not appear in an expansion release. However, things look different on a developer board. If there is no valid PHP suffix, the file is no longer counted as a valid migration.
  * It is also checked whether the class declaration in a migration file contains the exact file name as the class name. If this is not the case, the file will no longer be counted as a valid migration by EMP, as it will also be ignored by phpBB.
* The headings for "Enabled/Disabled/Uninstalled Extensions" are now available to translators as language variables with the number inserted using a wildcard.
* The function for determining the version number of the language pack has been made both stricter and more flexible.
  * Stricter: The version string must start with the pattern x.y.z. So far it has not been checked whether the version number has 3 segments.
  * More flexible: Additions may be used after a valid version, such as a fourth segment or a suffix.
* Changed EMP version check from github.io to phpbb.com.
* Code optimization.

### 1.1.0
(2023-02-24 / CDB: 2023-04-22)

* A new property is available for handling selection checkboxes, which allows the last state of all checkboxes to be saved. This is particularly helpful with phpBB updates if you want to deactivate all extensions, but also have extensions that should only be activated on a case-by-case basis. Automatically saves all checkboxes when the Disable Selected or Enable Selected action is performed. In addition, the current selection can be saved at any time in the link bar above the extensions list using the “Save” action.
* Extensions list:
  * The number of new migrations is now also displayed for extensions that are not installed.
  * The addition "(new migrations: x)" has been removed from the "Disabled Extensions" heading.
* Settings:
  * The column with the number of new migrations is now tied to the new expert option "Show column with new migrations". This is deactivated by default.
  * The "Set checkbox" switch has been replaced with an option list with the selection "Off", "Set all" and "Remember last state".
* Settings - Order and Ignore:
  * The descriptions of order and ignore are displayed side by side instead of one below the other. [Kirk's suggestion]
  * A submit button is also inserted below the extensions list. [Kirk's suggestion]
* Previously, phpBB's Migrator class was used to identify new migrations. This was removed because it has several disadvantages: 1) The classes of all detected migrations are permanently loaded (included) at runtime and added to the program context, which takes up unnecessary memory. 2) Increased potential for errors, as a defective migration during inclusion can lead to a fatal crash of phpBB and thus of EMP. To resolve these issues, dedicated functions for handling migrations have been implemented:
  * For comparing the local migrations of the extensions with the database. This determines which migrations have not yet been carried out.
  * For checking whether a migration file is actually a migration. This filters out files that only contain a helper class.
* The version of the affected extension is now always displayed in all error messages that may occur when deactivating or activating. This is relevant if error messages are inserted into posts via copy and paste in the event of support.
* The link bar is designed like the quick access bar in the forum index, with individual icons for each action.
* Code optimization.
  * Reduced number of MySQL queries; Changed a number of functions and their calls so that access to `config_text` is minimized.
  * Reduced multiple function calls; including by using alternative functions and reordering code.
  * Many minor improvements.
* PHP maximum version increased to 8.2.
* Language files:
  * Changed "Migration Files" globally to "Migrations".
  * 9 variables added, 3 renamed, 1 removed.
  * Small changes.
* For extension authors: When evaluating `is_enableable`, a strict distinction is now made according to phpBB version. As before, at >=3.3.0 an explicit `true` must be returned so that an extension can be activated. With <3.3.0 an implicit `true` is now sufficient. This means that EMP behaves identically to the respective phpBB minor version on which it is installed.

### 1.0.8
(2023-02-01)

* If the "Details" function is executed and a new version of the extension is detected, then this information is now also used and stored in the EMP version cache.
  * The display of the number of available updates above the extensions list is also updated. In this case, the date does not change and continues to show the date of the last regular version check.
  * Likewise, the corresponding update indicator of the extension in question is displayed in the extensions list, as would be the case with the regular version check.
* Added the "Available Updates" column to the info table above the extensions list, which now displays the number of updates. This means that the date of the last version check and the number of updates are listed in separate columns.
* For the actions "Deactivate selected" and "Activate selected" the same message is now displayed above the query that phpBB itself displays when querying for the actions "Deactivate" and "Activate". EMP therefore also behaves like phpBB in this respect.
* Settings:
  * If the security switch "Allow migrations" was activated, the modal JavaScript query `confirm()` prevented the browser from displaying the activated state of the switch because the update of the render engine had not yet been completed. We will now wait for this update to complete before displaying the modal dialog.
  * The toggle colors adopted from the Recent Topics fork. A small improvement, especially for people with red/green weakness.
  * Title of "Allow migrations" and text of the associated query have been clarified because they were somewhat misleading.
* Code optimization:
  * PHP: Small improvements in code quality.
  * Twig: The `spaceless` tag, which has been classified as DEPRECATED since Twig 2.7, has been removed everywhere and replaced with `spaceless` filters and whitespace modifiers.
* PHP minimum version has increased to 7.1.

### 1.0.7
(2022-12-04)

* Fix: The actions "Deactivate selected" and "Activate selected" would have resulted in a FATAL if a certain time limit was exceeded because incomplete parameters were used in a function call. Function call completely removed.
* The fix led to the following change: The maximum PHP execution time is now taken into account for the corresponding actions. If it is determined during execution that half of the maximum time has been exceeded, the action is canceled and a controlled message is displayed. However, this is an extreme case that probably only occurs with a lot of exts with time-consuming actions in `ext.php`.
* If self-deactivation is activated and EMP was also selected when deactivating it, then the query - if activated - will separately indicate that EMP will also be deactivated.
* Settings:
  * The settings now use toggle-style checkboxes for yes/no options. Two characteristics were taken into account for people with color vision deficiency (red/green problems and color blindness): 1) Retention of the usual positions for yes and no. 2) Clear symbols for the yes and no states. Toggle functionality adopted in an adapted form from “Style Changer”. [Thanks to Kirk]
  * Like other extensions from me, EMP now also offers the option of resetting the settings to the installation default.
  * The "Submit" and "Reset" buttons are now in their own subgroup which is displayed in the same way as on phpBB's ACP pages.
  * The Order/Ignore preference group now has the same button bar as the other preference groups, except for Reset.
  * In the header, the information (total number, version check) is no longer displayed in a blind table, but in a phpBB standard table. Looks neater and tidier.
  * Several minor changes to the ACP template.
* My workaround regarding the Twig Cache problem, which I had already installed in a similar form in ExtOnOff 2.0.0, is no longer needed as of phpBB 3.3.8 and is now skipped by EMP in this case. This is made possible by a change in phpBB's ExtensionManager, which was implemented in phpBB 3.3.8. By skipping the workaround, after switching extensions (deactivate/activate selected ones), the forum no longer responds with a delay for the next 2 page views (due to cache build-up), but only for 1 page view, which again corresponds to the normal behavior of phpBB. With phpBB <3.3.8 the workaround continues to run. Relevant: [phpBB #6359](https://github.com/phpbb/phpbb/pull/6359)
* Code optimization:
  * For Javascript, Twig and HTML. Among other things, Javascript events are no longer defined in the HTML; these are registered directly via jQuery.
  * In PHP to reduce the load in the ACP.

### 1.0.6
(2022-11-05)

* Fix: When the cache was emptied, the version check was carried out twice, first by EMP and then again by phpBB: Incorrect event order and incorrect function parameter.
* Fix: If the cache was not emptied between two version checks, EMP did not recognize new updates: Incorrect event order.
* Separate messages are no longer generated for the result of the last version check of the extensions, but rather the existing update indicators in the extensions list are used and expanded. This makes it easier, especially after the first extension update, to specifically deactivate and update the remaining extensions if there is more than one update.
  * The update indicators are automatically removed once the corresponding extensions have been updated.
  * Instead of the messages, the date of the last version check is now permanently displayed. In addition, the number of available updates is displayed in brackets behind it. The number is automatically adjusted as extensions are updated. The addition will be completely removed when there are no more updates.
  * Existing version check data from 1.0.5 is compatible with this version and will be adopted.
* Code optimizations.
* CSS changes and corrections.

### 1.0.5
(2022-10-29)

* The result of the latest version check of the extensions can now be permanently displayed as a notification:
  * During the version check, the data about new updates is saved in the database. This solves the shortcoming of phpBB that this data is lost as soon as the cache is cleared.
  * The list of updates shows the display name, the new version and the link to the details for each extension. The title also shows the date of the last version check, in the admin's date format.
  * If an extension is updated, its report is automatically removed. This will also be removed if the extension is completely deleted.
  * The new function is active by default and can be deactivated using a new setting. If it is deactivated, all existing messages will also be deleted.
* Since the original page title is always used for the standard actions Activate/Deactivate/Delete work data/Details, the addition "(Plus)" has been removed from the title for EMP in order to achieve a uniform display on all pages.
* Clarified the descriptions of the Order/Ignore settings so that they use the same names for the EMP buttons as the descriptions of the other settings.
* The function to display notifications - currently only for an outdated language pack - no longer generates HTML, but simply passes a list to the template, which then generates HTML from it via Twig.
* Code optimizations.

### 1.0.4
(2022-08-10)

* Fix: The "Test user's permissions" function resulted in a Fatal: `Fatal error: Cannot declare class auth_admin, because the name is already in use in ...`. The reason for this is the Migrator class, which is not allowed to be integrated via `services.yml`. [Reported from chris1278]

### 1.0.3
(2022-06-24)

* Fix: If the Order/Ignore function was deactivated, its saved data was no longer loaded and could therefore no longer be changed. If you then saved the empty column, the data was effectively deleted. To prevent this, the label on the Order/Ignore link remains grayed out when the function is disabled, but the link is removed and the locked symbol appears as the cursor.
* Order/Ignore:
  * There are now separate columns for the Order group and the Ignore feature. This separation makes handling the ignored extensions more convenient and allows for short-term exclusion without having to remove an existing sequence group.
  * If the Ignore feature is set, the associated text field for the order group is grayed out, but can still be changed.
  * In the settings, the order/ignore explanations now have the corresponding column icon as a prefix.
  * Existing order/ignore data will be automatically converted.
* Code optimizations.

### 1.0.2
(2022-06-17)

* When checking whether an extension can be activated in relation to requirements (`ext.php`), the alternative error handling method introduced in phpBB 3.3.0 is now also supported. The extension author can return one or more error messages to phpBB instead of directly outputting these messages using `trigger_error`, which always results in the EMP action being aborted. If an extension uses this method, EMP can easily continue with the next extension even in the event of an error without causing an abort. EMP can also collect the error messages submitted during activation and then list them one after the other in the confirmation message. [Note from IMC]
* Added tooltips for the column header icons and checkboxes.
* The order/ignore form is now also checked for a valid security token when saving.
* Several changes in HTML and Javascript so that certain elements can be addressed more flexibly. This serves as preparation for future functions.
* Code optimizations.

### 1.0.1
(2022-06-12)

* General error handling:
  * The confirmation message from EMP is only displayed as successful (green "success box") if all extensions could be activated. If only one extension could not be activated, the message is displayed as an error (red `errorbox`).
  * For messages from EMP, it is now clear which texts come from EMP and which come from phpBB or an extension. Those texts that do not come from EMP are shown in italics.
  * In all error messages from EMP, the display name and the technical name of the affected extension are now displayed so that the error message can be assigned without any doubt.
* New error handling for failed migrations: If the "Allow migrations" option is activated and an error occurs while activating an extension with new migration files, then this no longer leads to a "fatal error" (essentially a crash of phpBB). Instead, such an error is caught and a controlled error message is issued.
* Error handling improved if requirements are not met: If an extension is checked for valid requirements via `ext.php`, e.g. the phpBB or PHP version, then if the result is negative, all extensions are listed with the corresponding error message from phpBB. Previously, in the confirmation message you could only see how many extensions were not activated, but no details.
* Error handling improved when aborted through extensions that generate their own error messages in `ext.php` (`trigger_error`):
  * This function now also works when deactivating, previously this was only the case when activating.
  * The partial log entry is now also possible when deactivating.
  * A confirmation message (`successbox`) from an extension is now also intercepted, since a positive message for EMP always means an abort.
  * If an action is canceled by a confirmation message (`successbox`) from an extension, this message is converted into an error message (`errorbox`) because EMP was interrupted by this message.
  * In the intercepted error message, a back link is always added at the end, with the same URL and label ("Back to list of extensions") as phpBB uses in the "Activate" and "Deactivate" confirmation messages. The reason for this is that some extensions lack a back link in the error messages.

### 1.0.0
(2022-06-08)

* First public version.
