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
	 * View helper for the "sr_freecap" extension
	 */
	class Tx_SpGuestbook_ViewHelpers_Captcha_FreeCapViewHelper extends Tx_SpGuestbook_ViewHelpers_Captcha_AbstractCaptchaViewHelper {

		/**
		 * @var string Partial name
		 */
		protected $partialName = 'Captcha/FreeCap';

		/**
		 * @var string Extension key
		 */
		protected $extensionName = 'sr_freecap';


		/**
		 * Returns the captcha object
		 *
		 * @return object Captcha object
		 */
		public function getCaptcha() {
				// Get freecap markers
			t3lib_div::requireOnce(t3lib_extMgm::extPath('sr_freecap') . 'pi2/class.tx_srfreecap_pi2.php');
			$freecap = t3lib_div::makeInstance('tx_srfreecap_pi2');
			$markers = $freecap->makeCaptcha();
			unset($freecap);

				// Build captcha object
			$captcha = (object) array(
				'image'      => $markers['###SR_FREECAP_IMAGE###'],
				'cantRead'   => $markers['###SR_FREECAP_CANT_READ###'],
				'accessible' => $markers['###SR_FREECAP_ACCESSIBLE###'],
			);

			return $captcha;
		}

	}
?>