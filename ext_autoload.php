<?php
	$extensionClassesPath = t3lib_extMgm::extPath('sp_guestbook', 'Classes/');

	return array(
		'tx_spguestbook_controller_entrycontroller'        => $extensionClassesPath . 'Controller/EntryController.php',
		'tx_spguestbook_domain_model_entry'                => $extensionClassesPath . 'Domain/Model/Entry.php',
		'tx_spguestbook_domain_repository_entryrepository' => $extensionClassesPath . 'Domain/Repository/EntryRepository.php',
		'tx_spguestbook_service_email'                     => $extensionClassesPath . 'Service/Email.php',
		'tx_spguestbook_service_security'                  => $extensionClassesPath . 'Service/Security.php',
		'tx_spguestbook_utility_session'                   => $extensionClassesPath . 'Utility/Session.php',
		'tx_spguestbook_utility_typoScript'                => $extensionClassesPath . 'Utility/TypoScript.php',
		'tx_spguestbook_viewhelpers_captchaviewhelper'     => $extensionClassesPath . 'ViewHelpers/CaptchaViewHelper.php',
		'tx_spguestbook_viewhelpers_htmlviewhelper'        => $extensionClassesPath . 'ViewHelpers/HtmlViewHelper.php',
		'tx_spguestbook_captcha_captcha'                   => $extensionClassesPath . 'Catpcha/Captcha.php',
		'tx_spguestbook_captcha_captchainterface'          => $extensionClassesPath . 'Catpcha/CaptchaInterface.php',
		'tx_spguestbook_captcha_captchamanager'            => $extensionClassesPath . 'Catpcha/CaptchaManager.php',
		'tx_spguestbook_captcha_srfreecap'                 => $extensionClassesPath . 'Catpcha/SrFreecap.php',
	);
?>