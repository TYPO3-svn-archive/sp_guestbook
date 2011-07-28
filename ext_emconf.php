<?php

########################################################################
# Extension Manager/Repository config file for ext "sp_guestbook".
#
# Auto generated 28-07-2011 21:51
#
# Manual updates:
# Only the data in the array - everything else is removed by next
# writing. "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Guestbook',
	'description' => 'A guestbook based on extbase and fluid.',
	'category' => 'plugin',
	'author' => 'Kai Vogel',
	'author_email' => 'kai.vogel@speedprogs.de',
	'author_company' => 'Speedprogs.de',
	'shy' => '',
	'dependencies' => 'cms,extbase,fluid',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'beta',
	'internal' => '',
	'uploadfolder' => 0,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'version' => '0.0.1',
	'constraints' => array(
		'depends' => array(
			'cms' => '',
			'extbase' => '1.3.0-0.0.0',
			'fluid' => '1.3.0-0.0.0',
			'typo3' => '4.5.0-0.0.0',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'suggests' => array(
	),
	'_md5_values_when_last_written' => 'a:29:{s:16:"ext_autoload.php";s:4:"db08";s:12:"ext_icon.gif";s:4:"fe51";s:17:"ext_localconf.php";s:4:"ee1b";s:14:"ext_tables.php";s:4:"9b62";s:14:"ext_tables.sql";s:4:"f1ea";s:38:"Classes/Controller/EntryController.php";s:4:"1131";s:30:"Classes/Domain/Model/Entry.php";s:4:"2b1b";s:45:"Classes/Domain/Repository/EntryRepository.php";s:4:"69ce";s:25:"Classes/Service/Email.php";s:4:"c387";s:30:"Classes/Utility/TypoScript.php";s:4:"7490";s:37:"Configuration/FlexForms/Guestbook.xml";s:4:"1a33";s:27:"Configuration/TCA/Entry.php";s:4:"cd58";s:38:"Configuration/TypoScript/constants.txt";s:4:"15e6";s:34:"Configuration/TypoScript/setup.txt";s:4:"c2f5";s:40:"Resources/Private/Language/locallang.xml";s:4:"ca44";s:78:"Resources/Private/Language/locallang_csh_tx_spguestbook_domain_model_entry.xml";s:4:"38b3";s:43:"Resources/Private/Language/locallang_db.xml";s:4:"e188";s:38:"Resources/Private/Layouts/Default.html";s:4:"7f5c";s:42:"Resources/Private/Partials/FormErrors.html";s:4:"f5bc";s:48:"Resources/Private/Partials/Entry/FormFields.html";s:4:"2750";s:48:"Resources/Private/Partials/Entry/Properties.html";s:4:"887c";s:43:"Resources/Private/Templates/Entry/List.html";s:4:"9ff5";s:42:"Resources/Private/Templates/Entry/New.html";s:4:"e0d2";s:43:"Resources/Private/Templates/Entry/Show.html";s:4:"ea10";s:34:"Resources/Public/Images/Wizard.gif";s:4:"757b";s:49:"Resources/Public/Javascript/galleria-1.2.4.min.js";s:4:"9ba8";s:47:"Resources/Public/Javascript/jquery-1.6.1.min.js";s:4:"a34f";s:39:"Resources/Public/Stylesheet/gallery.css";s:4:"6a09";s:14:"doc/manual.sxw";s:4:"8d2d";}',
);

?>