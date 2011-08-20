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
	 * Captcha manager
	 */
	class Tx_SpGuestbook_Captcha_CaptchaManager implements t3lib_Singleton {

		/**
		 * @var Tx_Extbase_Object_ObjectManager
		 */
		protected $objectManager;

		/**
		 * @var array
		 */
		protected $settings;

		/**
		 * @var Tx_SpGuestbook_Captcha_CaptchaInterface
		 */
		protected $captcha;

		/**
		 * @var string
		 */
		protected $classSchema = 'Tx_SpGuestbook_Captcha_@extension';


		/**
		 * @param Tx_Extbase_Object_ObjectManager $objectManager
		 * @return void
		 */
		public function injectObjectManager(Tx_Extbase_Object_ObjectManager $objectManager) {
			$this->objectManager = $objectManager;
		}


		/**
		 * @param Tx_Extbase_Configuration_ConfigurationManager $configurationManager
		 * @return void
		 */
		public function injectConfigurationManager(Tx_Extbase_Configuration_ConfigurationManager $configurationManager) {
			$this->configurationManager = $configurationManager;
			$this->settings = $this->configurationManager->getConfiguration(
				Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS
			);
			$this->settings = Tx_SpGuestbook_Utility_TypoScript::parse($this->settings);
		}


		/**
		 * Returns the captcha instance by configuration settings
		 *
		 * @return Tx_SpGuestbook_Captcha_CaptchaInterface Captcha instance
		 */
		public function getCaptcha() {
			if (!empty($this->captcha)) {
				return $this->captcha;
			}

				// Check if extension is loaded
			if (empty($this->settings['captchaSupport']) || !t3lib_extMgm::isLoaded($this->settings['captchaSupport'])) {
				throw new Exception('Extension sp_guestbook: No valid captcha extension configured', 1308305987);
			}

				// Get class name
			$className = t3lib_div::underscoredToUpperCamelCase($this->settings['captchaSupport']);
			$className = str_replace('@extension', $className, $this->classSchema);
			if (!class_exists($className)) {
				throw new Exception('Extension sp_guestbook: No class found for configured captcha extension', 1308305988);
			}

				// Get new instance
			$captcha = $this->objectManager->get($className);
			if (empty($captcha)) {
				throw new Exception('Extension sp_guestbook: Can not create an instance of the captcha class', 1308305989);
			}

			return $this->captcha = $captcha;
		}

	}
?>