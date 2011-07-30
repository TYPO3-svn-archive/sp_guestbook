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

	require_once(t3lib_extMgm::extPath('sr_freecap') . 'pi2/class.tx_srfreecap_pi2.php');

	/**
	 * The "sr_freecap" extension class
	 */
	class Tx_SpGuestbook_Captcha_SrFreecap implements Tx_SpGuestbook_Captcha_CaptchaInterface {

		/**
		 * @var object Instance of the captcha extension
		 */
		protected $captcha;


		/**
		 * Initialize class
		 */
		public function __construct() {
			$this->captcha = t3lib_div::makeInstance('tx_srfreecap_pi2');
		}


		/**
		 * Returns the template variables for captcha field
		 *
		 * @return array Template variables
		 */
		public function getTemplateVariables() {
			$markers = $this->captcha->makeCaptcha();
			return array(
				'image'      => $markers['###SR_FREECAP_IMAGE###'],
				'cantRead'   => $markers['###SR_FREECAP_CANT_READ###'],
				'accessible' => $markers['###SR_FREECAP_ACCESSIBLE###'],
			);
		}


		/**
		 * Checks if the input is identical to captcha value
		 * 
		 * @param string $inputValue Content of the captcha field
		 * @return boolean TRUE if values are identical
		 */
		public function checkInput($inputValue) {
			return (bool) $this->captcha->checkWord($inputValue);
		}

	}
?>