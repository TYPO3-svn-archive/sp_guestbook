<?php
	$extensionClassesPath = t3lib_extMgm::extPath('sp_guestbook', 'Classes/');

	return array(
		'tx_spguestbook_controller_entrycontroller'                    => $extensionClassesPath . 'Controller/EntryController.php',
		'tx_spguestbook_domain_model_entry'                            => $extensionClassesPath . 'Domain/Model/Entry.php',
		'tx_spguestbook_domain_repository_entryrepository'             => $extensionClassesPath . 'Domain/Repository/EntryRepository.php',
		'tx_spguestbook_service_email'                                 => $extensionClassesPath . 'Service/Email.php',
		'tx_spguestbook_service_security'                              => $extensionClassesPath . 'Service/Security.php',
		'tx_spguestbook_utility_typoScript'                            => $extensionClassesPath . 'Utility/TypoScript.php',
		'tx_spguestbook_viewhelpers_abstractviewhelper'                => $extensionClassesPath . 'ViewHelpers/AbstractViewHelper.php',
		'tx_spguestbook_viewhelpers_captcha_abstractcaptchaviewhelper' => $extensionClassesPath . 'ViewHelpers/Catpcha/AbstractCaptchaViewHelper.php',
		'tx_spguestbook_viewhelpers_captcha_captchaviewhelper'         => $extensionClassesPath . 'ViewHelpers/Catpcha/CaptchaViewHelper.php',
		'tx_spguestbook_viewhelpers_captcha_freecapviewhelper'         => $extensionClassesPath . 'ViewHelpers/Catpcha/FreeCapViewHelper.php',
		'tx_spguestbook_viewhelpers_captcha_mathguardviewhelper'       => $extensionClassesPath . 'ViewHelpers/Catpcha/MathGuardViewHelper.php',
		'tx_spguestbook_viewhelpers_captcha_recaptchaviewhelper'       => $extensionClassesPath . 'ViewHelpers/Catpcha/RecaptchaViewHelper.php',
	);
?>