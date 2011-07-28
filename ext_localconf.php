<?php
	if (!defined('TYPO3_MODE')) {
		die ('Access denied.');
	}

		// Make plugin available in frontend
	Tx_Extbase_Utility_Extension::configurePlugin(
		$_EXTKEY,
		'Guestbook',
		array(
			'Entry' => 'list, teaser, new, create',
		),
		array(
			'Entry' => 'create',
		)
	);
?>