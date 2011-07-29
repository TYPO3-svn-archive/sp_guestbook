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
	 * Abstract base class for all captcha view helpers
	 */
	abstract class Tx_SpGuestbook_ViewHelpers_Captcha_AbstractCaptchaViewHelper extends Tx_SpGuestbook_ViewHelpers_AbstractViewHelper {

		/**
		 * @var string Partial name
		 */
		abstract protected $partialName;

		/**
		 * @var string Extension key
		 */
		abstract protected $extensionName;


		/**
		 * Returns the html code for the captcha field
		 *
		 * @return string Html content
		 */
		protected function render() {
				// Check if extension is loaded
			if (empty($this->settings['captchaSupport']) || !t3lib_extMgm::isLoaded($this->settings['captchaSupport'])) {
				throw new Exception('Extension sp_guestbook: Defined captcha extension is not loaded', 1308305987);
			}

				// Check if view helper is allowed to render defined extension
			if (empty($this->extensionName) || $this->settings['captchaSupport'] !== $this->extensionName) {
				throw new Exception('Extension sp_guestbook: View helper is not allowed to render defined captcha extension', 1308305988);
			}

				// Check if a partial name was defined in view helper
			if (empty($this->partialName)) {
				throw new Exception('Extension sp_guestbook: No partial found to render', 1308305989);
			}

			$captcha = $this->getCaptcha();
			return parent::renderPartial($this->partialName, '', array('captcha' => $captcha));
		}

	}
?>