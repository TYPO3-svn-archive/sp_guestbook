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
	 * View helper for the "captcha" extension
	 */
	class Tx_SpGuestbook_ViewHelpers_CaptchaViewHelper extends Tx_SpGuestbook_ViewHelpers_AbstractViewHelper {

		/**
		 * @var Tx_Extbase_Object_ObjectManager
		 */
		protected $objectManager;

		/**
		 * @var string Partial schema
		 */
		protected $partialSchema = 'Captcha/@extension';


		/**
		 * @param Tx_Extbase_Object_ObjectManager $objectManager
		 * @return void
		 */
		public function injectObjectManager(Tx_Extbase_Object_ObjectManager $objectManager) {
			$this->objectManager = $objectManager;
		}


		/**
		 * Returns the html code for the captcha field
		 *
		 * @return string Html code
		 */
		public function render() {
				// Get captcha instance
			$captchaManager = $this->objectManager->get('Tx_SpGuestbook_Captcha_CaptchaManager');
			$captcha = $captchaManager->getCaptcha();

				// Get partial name
			$className = get_class($captcha);
			$className = substr($className, strrpos($className, '_') + 1);
			$partialName = str_replace('@extension', $className, $this->partialSchema);

				// Get template variables
			$variables = $captcha->getTemplateVariables();
			$variables = array('captcha' => $variables);

				// Render...
			return $this->renderPartial($partialName, '', $variables);
		}

	}
?>