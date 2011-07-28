<?php
	$extensionClassesPath = t3lib_extMgm::extPath('sp_guestbook', 'Classes/');

	return array(
		'tx_spguestbook_controller_entrycontroller'        => $extensionClassesPath . 'Controller/EntryController.php',
		'tx_spguestbook_domain_model_entry'                => $extensionClassesPath . 'Domain/Model/Entry.php',
		'tx_spguestbook_domain_repository_entryrepository' => $extensionClassesPath . 'Domain/Repository/EntryRepository.php',
		'tx_spguestbook_service_email'                     => $extensionClassesPath . 'Service/Email.php',
		'tx_spguestbook_service_security'                  => $extensionClassesPath . 'Service/Security.php',
		'tx_spguestbook_utility_typoScript'                => $extensionClassesPath . 'Utility/TypoScript.php',
	);
?>