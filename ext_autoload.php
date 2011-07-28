<?php
	$extensionClassesPath = t3lib_extMgm::extPath('sp_guestbook', 'Classes/');

	return array(
		'tx_spguestbook_controller_entrycontroller'            => $extensionClassesPath . 'Controller/EntryController.php',
		'tx_spguestbook_domain_model_entry'                    => $extensionClassesPath . 'Domain/Model/Entry.php',
		'tx_spguestbook_domain_repository_entryrepository'     => $extensionClassesPath . 'Domain/Repository/EntryRepository.php',
		'tx_spguestbook_service_email'                         => $extensionClassesPath . 'Service/Email.php',
		'tx_spguestbook_service_security'                      => $extensionClassesPath . 'Service/Security.php',
		'tx_spguestbook_utility_typoScript'                    => $extensionClassesPath . 'Utility/TypoScript.php',
		'tx_spguestbook_viewhelpers_abstractcaptchaviewhelper' => $extensionClassesPath . 'ViewHelpers/AbstractCaptchaViewHelper.php',
		'tx_spguestbook_viewhelpers_captchaviewhelper'         => $extensionClassesPath . 'ViewHelpers/CaptchaViewHelper.php',
		'tx_spguestbook_viewhelpers_freecapviewhelper'         => $extensionClassesPath . 'ViewHelpers/FreeCapViewHelper.php',
		'tx_spguestbook_viewhelpers_mathguardviewhelper'       => $extensionClassesPath . 'ViewHelpers/MathGuardViewHelper.php',
		'tx_spguestbook_viewhelpers_recaptchaviewhelper'       => $extensionClassesPath . 'ViewHelpers/RecaptchaViewHelper.php',
	);
?>