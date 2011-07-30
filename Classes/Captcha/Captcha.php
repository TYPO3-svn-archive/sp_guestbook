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
	 * The "captcha" extension class
	 */
	class Tx_SpGuestbook_Captcha_Captcha implements Tx_SpGuestbook_Captcha_CaptchaInterface {

		/**
		 * Returns the template variables for captcha field
		 *
		 * @return array Template variables
		 */
		public function getTemplateVariables() {
			$fileName = t3lib_extMgm::siteRelPath('captcha') . 'captcha/captcha.php';
			return array('image' => $fileName);
		}


		/**
		 * Checks if the input is identical to captcha value
		 * 
		 * @param string $inputValue Content of the captcha field
		 * @return boolean TRUE if values are identical
		 */
		public function checkInput($inputValue) {
			session_start();
			$captcha = $_SESSION['tx_captcha_string'];
			return ($captcha === $inputValue);
		}

	}
?>