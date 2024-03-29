<?php
	/*********************************************************************
	 *  Copyright notice
	 *
	 *  (c) 2011 Kai Vogel <kai.vogel@speedprogs.de>, Speedprogs.de
	 *
	 *  All rights reserved
	 *
	 *  This script is part of the TYPO3 project. The TYPO3 project is
	 *  free software; you can redistribute it and/or modify
	 *  it under the terms of the GNU General Public License as published
	 *  by the Free Software Foundation; either version 3 of the License,
	 *  or (at your option) any later version.
	 *
	 *  The GNU General Public License can be found at
	 *  http://www.gnu.org/copyleft/gpl.html.
	 *
	 *  This script is distributed in the hope that it will be useful,
	 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *  GNU General Public License for more details.
	 *
	 *  This copyright notice MUST APPEAR in all copies of the script!
	 ********************************************************************/

	/**
	 * Validator for input of a captcha field
	 */
	class Tx_SpGuestbook_Validators_CaptchaValidator extends Tx_Extbase_Validation_Validator_AbstractValidator {

		/**
		 * @var Tx_Extbase_Object_ObjectManager
		 */
		protected $objectManager;

		/**
		 * @var Tx_SpGuestbook_Captcha_CaptchaManager
		 */
		protected $captchaManager;


		/**
		 * @param Tx_Extbase_Object_ObjectManager $objectManager
		 * @return void
		 */
		public function injectObjectManager(Tx_Extbase_Object_ObjectManager $objectManager) {
			$this->objectManager = $objectManager;
		}


		/**
		 * @param Tx_SpGuestbook_Captcha_CaptchaManager $captchaManager
		 * @return void
		 */
		public function injectCaptchaManager(Tx_SpGuestbook_Captcha_CaptchaManager $captchaManager) {
			$this->captchaManager = $captchaManager;
		}


		/**
		 * Checks whether the captcha field input is valid or not
		 * 
		 * @param string $value Input value
		 * @return boolean TRUE if input is valid
		 */
		public function isValid($value) {
			return (bool) $this->captchaManager->getCaptcha()->checkInput($value);
		}

	}
?>