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
	 * View helper for the "mathguard" extension
	 */
	class Tx_SpGuestbook_ViewHelpers_Captcha_MathGuardViewHelper extends Tx_SpGuestbook_ViewHelpers_Captcha_AbstractCaptchaViewHelper {

		/**
		 * @var string Partial name
		 */
		protected $partialName = 'Captcha/MathGuard';

		/**
		 * @var string Extension key
		 */
		protected $extensionName = 'mathguard';


		/**
		 * Returns the captcha object
		 *
		 * @return object Captcha object
		 */
		public function getCaptcha() {
				// Get mathguard content
			t3lib_div::requireOnce(t3lib_extMgm::extPath('mathguard') . 'class.tx_mathguard.php');
			$mathguard = t3lib_div::makeInstance('tx_mathguard');
			$content   = $mathguard->getCaptcha();
			unset($mathguard);

				// Build captcha object
			return (object) array('html' => $content);
		}

	}
?>